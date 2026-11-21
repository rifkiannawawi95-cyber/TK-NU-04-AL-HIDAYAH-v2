<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Buat direktori storage publik jika belum ada
        $storagePublicDir = storage_path('app/public/galeri');
        if (! File::isDirectory($storagePublicDir)) {
            File::makeDirectory($storagePublicDir, 0755, true, true);
        }

        // Hindari error pada path public/storage (bisa berupa symlink atau tidak dapat ditulis di testing)
        $publicStorageDir = public_path('storage/galeri');
        $publicStoragePath = public_path('storage');
        $canUsePublicStorage = ! is_link($publicStoragePath) && (File::isDirectory($publicStorageDir) || @File::makeDirectory($publicStorageDir, 0755, true, true));

        // 2. Migrasikan file dari public/uploads/galeri ke storage/app/public/galeri jika ada
        $oldUploadsDir = public_path('uploads/galeri');
        if (File::isDirectory($oldUploadsDir)) {
            $files = File::files($oldUploadsDir);
            foreach ($files as $file) {
                $sourcePath = $file->getPathname();
                if (! File::exists($sourcePath)) {
                    continue;
                }

                $filename = $file->getFilename();
                $targetInStorage = $storagePublicDir . DIRECTORY_SEPARATOR . $filename;

                if (! File::exists($targetInStorage)) {
                    @File::copy($sourcePath, $targetInStorage);
                }

                if ($canUsePublicStorage) {
                    $targetInPublic = $publicStorageDir . DIRECTORY_SEPARATOR . $filename;
                    if (! File::exists($targetInPublic)) {
                        @File::copy($sourcePath, $targetInPublic);
                    }
                }
            }
        }

        // 3. Sanitasi data foto yang sudah ada di tabel galeris
        if (Schema::hasTable('galeris')) {
            $galeris = DB::table('galeris')->get();
            foreach ($galeris as $galeri) {
                if (empty($galeri->foto)) {
                    continue;
                }

                $clean = ltrim(trim($galeri->foto), '/\\');

                // Jika path lama /uploads/galeri/xxx.jpg -> ubah jadi galeri/xxx.jpg
                if (str_starts_with($clean, 'uploads/galeri/')) {
                    $filename = basename($clean);
                    DB::table('galeris')
                        ->where('id', $galeri->id)
                        ->update(['foto' => 'galeri/' . $filename]);
                } elseif (str_starts_with($clean, 'storage/')) {
                    $sub = substr($clean, 8);
                    DB::table('galeris')
                        ->where('id', $galeri->id)
                        ->update(['foto' => $sub]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op untuk menjaga integritas file media
    }
};

