<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use PDO;
use Throwable;

class MigrateSqliteToMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:migrate-to-mysql {--fresh : Jalankan migrate:fresh sebelum menyalin data} {--copy-data : Otomatis salin data dari SQLite tanpa konfirmasi prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat database MySQL, menjalankan migration, dan menyalin data dari SQLite ke MySQL';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $mysqlConfig = config('database.connections.mysql');
        $host = $mysqlConfig['host'] ?? '127.0.0.1';
        $port = $mysqlConfig['port'] ?? '3306';
        $database = $mysqlConfig['database'] ?? 'tk_nu_04_alhidayah';
        $username = $mysqlConfig['username'] ?? 'root';
        $password = $mysqlConfig['password'] ?? '';

        $this->info("=== Langkah 1: Memeriksa & Membuat Database MySQL ===");
        $this->line("Target Database: <comment>{$database}</comment> di {$host}:{$port}");

        try {
            $pdo = new PDO("mysql:host={$host};port={$port}", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            $this->info("✔ Database MySQL `{$database}` siap digunakan.");
        } catch (Throwable $e) {
            $this->error("Gagal terhubung ke MySQL: " . $e->getMessage());
            $this->warn("Pastikan layanan MySQL di Laragon sudah berjalan (klik tombol 'Start All' di Laragon).");
            return Command::FAILURE;
        }

        $this->newLine();
        $this->info("=== Langkah 2: Menjalankan Migration di MySQL ===");
        try {
            if ($this->option('fresh')) {
                $this->warn("Menjalankan migrate:fresh...");
                Artisan::call('migrate:fresh', ['--force' => true], $this->output);
            } else {
                Artisan::call('migrate', ['--force' => true], $this->output);
            }
            $this->info("✔ Struktur tabel di MySQL berhasil dibuat.");
        } catch (Throwable $e) {
            $this->error("Gagal menjalankan migration: " . $e->getMessage());
            return Command::FAILURE;
        }

        $this->newLine();
        $this->info("=== Langkah 3: Migrasi Data dari SQLite ke MySQL ===");
        $sqlitePath = database_path('database.sqlite');

        if (!file_exists($sqlitePath)) {
            $this->warn("File SQLite ({$sqlitePath}) tidak ditemukan. Melewati penyalinan data.");
            return Command::SUCCESS;
        }

        $shouldCopy = $this->option('copy-data') || $this->confirm('Apakah Anda ingin menyalin data dari SQLite (data sekolah, guru, siswa, dll) ke MySQL?', true);

        if (!$shouldCopy) {
            $this->line("Penyalinan data dibatalkan oleh pengguna.");
            $this->info("Selesai! Konfigurasi sekarang menggunakan MySQL.");
            return Command::SUCCESS;
        }

        try {
            // Pastikan koneksi SQLite menunjuk ke file database.sqlite secara absolut
            config(['database.connections.sqlite.database' => $sqlitePath]);
            DB::purge('sqlite');
            DB::reconnect('sqlite');

            $sqliteTables = DB::connection('sqlite')
                ->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT IN ('sqlite_sequence', 'migrations') ORDER BY name ASC;");

            if (empty($sqliteTables)) {
                $this->warn("Tidak ada tabel dengan data di SQLite.");
                return Command::SUCCESS;
            }

            // Nonaktifkan pemeriksaan foreign key sementara untuk penyalinan data
            DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS = 0;');

            $bar = $this->output->createProgressBar(count($sqliteTables));
            $bar->start();

            foreach ($sqliteTables as $tableObj) {
                $tableName = $tableObj->name;

                // Pastikan tabel ada di MySQL
                $hasTableInMysql = DB::connection('mysql')->getSchemaBuilder()->hasTable($tableName);
                if (!$hasTableInMysql) {
                    $bar->advance();
                    continue;
                }

                $mysqlColumns = DB::connection('mysql')->getSchemaBuilder()->getColumnListing($tableName);
                $rows = DB::connection('sqlite')->table($tableName)->get();

                if ($rows->isNotEmpty()) {
                    DB::connection('mysql')->table($tableName)->truncate();

                    // Chunk insert dan sesuaikan kolom dengan skema MySQL
                    $chunks = $rows->chunk(100);
                    foreach ($chunks as $chunk) {
                        $records = $chunk->map(function ($item) use ($mysqlColumns) {
                            $data = (array) $item;
                            return array_intersect_key($data, array_flip($mysqlColumns));
                        })->toArray();

                        DB::connection('mysql')->table($tableName)->insert($records);
                    }
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();

            // Aktifkan kembali pemeriksaan foreign key
            DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS = 1;');

            $this->info("✔ Seluruh data berhasil dipindahkan dari SQLite ke MySQL!");
        } catch (Throwable $e) {
            DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS = 1;');
            $this->error("Terjadi kendala saat menyalin data: " . $e->getMessage());
            return Command::FAILURE;
        }

        $this->newLine();
        $this->info("==================================================");
        $this->info(" Aplikasi berhasil berpindah ke database MySQL! ");
        $this->info("==================================================");

        return Command::SUCCESS;
    }
}
