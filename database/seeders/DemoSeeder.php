<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed demo/sample data for local or staging environments.
     * Avoid running in production unless you explicitly intend to.
     */
    public function run(): void
    {
        if (app()->environment('production') && ! filter_var(env('ALLOW_DEMO_SEED', false), FILTER_VALIDATE_BOOL)) {
            if ($this->command) {
                $this->command->error('DemoSeeder aborted: refusing to run in production. Set ALLOW_DEMO_SEED=true only if you explicitly intend to seed demo data.');
            }

            return;
        }

        $this->call([
            SchoolSeeder::class,
            ComplexSchoolErpSeeder::class,
        ]);
    }
}
