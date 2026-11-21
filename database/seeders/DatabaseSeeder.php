<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Intentionally safe for production: does not create demo users or sample data.
     * For local/demo data, run: php artisan db:seed --class=DemoSeeder
     */
    public function run(): void
    {
        if ($this->command) {
            $this->command->info('DatabaseSeeder: no default production seed data.');
            $this->command->info('Use `php artisan db:seed --class=DemoSeeder` for demo/sample data (non-production).');
        }
    }
}
