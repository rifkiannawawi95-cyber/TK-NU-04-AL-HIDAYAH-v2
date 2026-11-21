<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        if (Testimoni::count() === 0) {
            Testimoni::create([
                'nama' => 'Bunda Aisyah',
                'peran' => 'Wali Santri Kelompok B',
                'rating' => 5,
                'pesan' => 'Alhamdulillah, sejak sekolah di TK NU 04, anak saya jadi rajin sholat dhuha dan hafal doa-doa harian. Ustadzah-ustadzahnya sangat sabar, hangat, dan telaten membimbing.',
                'is_approved' => true,
                'approved_at' => now(),
            ]);

            Testimoni::create([
                'nama' => 'Ayah Rizky',
                'peran' => 'Wali Santri Kelompok A',
                'rating' => 5,
                'pesan' => 'Area bermainnya luas 1.475 m² dan terlindungi aman. Anak saya selalu antusias dan ceria setiap pagi saat berangkat ke sekolah. Terus maju TK NU 04 Situbondo!',
                'is_approved' => true,
                'approved_at' => now(),
            ]);

            Testimoni::create([
                'nama' => 'Umi Fatimah',
                'peran' => 'Wali Santri Kelompok B',
                'rating' => 5,
                'pesan' => "Pendidikan adab Ahlussunnah wal Jama'ah-nya sangat terasa di rumah. Anak diajarkan bersalaman, menghormati orang tua, dan santun berbicara dengan teman sebaya.",
                'is_approved' => true,
                'approved_at' => now(),
            ]);
        }
    }
}
