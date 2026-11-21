<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\KalenderAkademik;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class CriticalSecurityAndValidationTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(string $role = 'user'): User
    {
        $user = User::factory()->create();
        $user->forceFill(['role' => $role])->save();

        return $user->fresh();
    }

    public function test_user_tidak_bisa_escalate_role_dan_mass_assign_field_terlarang(): void
    {
        // Mass assignment ke User tidak boleh mengubah role (bukan fillable)
        $victim = User::factory()->create();
        $victim->forceFill(['role' => 'user'])->save();

        $victim->fill(['role' => 'admin', 'name' => 'Hacker'])->save();
        $victim->refresh();

        $this->assertSame('user', $victim->role);
        $this->assertSame('Hacker', $victim->name);

        // User biasa tidak boleh mengakses aksi admin (tidak bisa eskalasi lewat endpoint admin)
        $user = $this->makeUser('user');
        $this->actingAs($user)
            ->post(route('admin.siswa.store'), [
                'nama' => 'Siswa X',
                'kelas' => 'A',
                'jenis_kelamin' => 'L',
                'role' => 'admin',
            ])
            ->assertStatus(403);

        $this->assertDatabaseCount('siswas', 0);
    }

    public function test_validasi_menolak_input_invalid_pada_crud_utama(): void
    {
        $admin = $this->makeUser('admin');

        // Siswa invalid
        $this->actingAs($admin)
            ->from(route('admin.siswa.index'))
            ->post(route('admin.siswa.store'), [
                'nama' => '',
                'kelas' => 'Z',
                'jenis_kelamin' => 'X',
            ])
            ->assertRedirect(route('admin.siswa.index'))
            ->assertSessionHasErrors(['nama', 'kelas', 'jenis_kelamin']);

        // Guru invalid
        $this->actingAs($admin)
            ->from(route('admin.guru.index'))
            ->post(route('admin.guru.store'), [
                'nama' => '',
                'jabatan' => '',
            ])
            ->assertRedirect(route('admin.guru.index'))
            ->assertSessionHasErrors(['nama', 'jabatan']);

        // Kalender invalid
        $this->actingAs($admin)
            ->from(route('admin.kalender.index'))
            ->post(route('admin.kalender.store'), [
                'nama_kegiatan' => '',
                'tanggal_mulai' => 'bukan-tanggal',
                'tanggal_selesai' => '2026-01-01',
            ])
            ->assertRedirect(route('admin.kalender.index'))
            ->assertSessionHasErrors(['nama_kegiatan', 'tanggal_mulai']);

        $this->assertDatabaseCount('siswas', 0);
        $this->assertDatabaseCount('gurus', 0);
        $this->assertDatabaseCount('kalender_akademiks', 0);
    }

    public function test_pencarian_siswa_tidak_lepas_scope_filter_lain(): void
    {
        $admin = $this->makeUser('admin');

        Siswa::create(['nama' => 'Ani Target', 'kelas' => 'A', 'jenis_kelamin' => 'P']);
        Siswa::create(['nama' => 'Ani Beda', 'kelas' => 'B', 'jenis_kelamin' => 'P']);
        Siswa::create(['nama' => 'Budi Target', 'kelas' => 'A', 'jenis_kelamin' => 'L']);

        $response = $this->actingAs($admin)->get(route('admin.siswa.index', [
            'search' => 'Ani',
            'kelas' => 'A',
        ]));

        $response->assertOk();
        $response->assertSee('Ani Target');
        $response->assertDontSee('Ani Beda');
        $response->assertDontSee('Budi Target');
    }

    public function test_kop_surat_meng_escape_subjudul(): void
    {
        $payload = '<script>alert(1)</script>';

        $html = Blade::render('<x-kop-surat judul="Judul" :subjudul="$subjudul" />', [
            'subjudul' => $payload,
        ]);

        $this->assertStringNotContainsString($payload, $html);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $html);
    }
}
