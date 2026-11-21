<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production') || str_contains(request()->getHost(), 'vercel.app')) {
            URL::forceScheme('https');
        }
        // 1. Pastikan direktori media storage publik tersedia otomatis
        try {
            $mediaFolders = ['galeri', 'acara', 'prestasi', 'gurus', 'settings'];

            foreach ($mediaFolders as $folder) {
                $storageDir = storage_path('app/public/' . $folder);
                if (!File::isDirectory($storageDir)) {
                    File::makeDirectory($storageDir, 0755, true, true);
                }

                $publicDir = public_path('storage/' . $folder);
                if (!File::isDirectory($publicDir)) {
                    File::makeDirectory($publicDir, 0755, true, true);
                }
            }

            // Jika symlink public/storage belum ada, coba generate otomatis
            $pubStorage = public_path('storage');
            if (!file_exists($pubStorage) && !is_link($pubStorage)) {
                @Artisan::call('storage:link');
            }
        } catch (\Throwable $e) {
            // Abaikan jika ada batasan akses sistem file sementara
        }

        // 2. Auto-migration kolom foto pada tabel prestasis jika belum ada
        try {
            if (Schema::hasTable('prestasis') && !Schema::hasColumn('prestasis', 'foto')) {
                Schema::table('prestasis', function (Blueprint $table) {
                    $table->string('foto')->nullable()->after('keterangan');
                });
            }
        } catch (\Throwable $e) {
            // Kolom mungkin sudah ditambahkan
        }

        // 3. Auto-setup skema database kompleks jika tabel kelas belum ada
        try {
            if (!Schema::hasTable('kelas')) {
                $migFile = database_path('migrations/2026_11_07_000000_create_complex_school_erp_tables.php');
                if (file_exists($migFile)) {
                    $mig = require $migFile;
                    $mig->up();
                }

                $seeder = new \Database\Seeders\ComplexSchoolErpSeeder();
                $seeder->run();
            }
        } catch (\Throwable $e) {
            // Abaikan jika migrasi sudah berjalan
        }
    }
}
