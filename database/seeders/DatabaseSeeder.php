<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReferenceDataSeeder::class);

        // Previously this hardcoded a real personal email and a fixed, weak password
        // directly in this file, which then got committed and pushed publicly. The
        // admin account is now driven by .env (documented in .env.example) with a
        // random password generated and printed once if none is configured.
        $email = env('SEED_ADMIN_EMAIL', 'admin@example.com');
        $password = env('SEED_ADMIN_PASSWORD');

        if (! $password) {
            $password = Str::random(16);
            if ($this->command) {
                $this->command->warn("No SEED_ADMIN_PASSWORD set — generated one for {$email}: {$password}");
            }
        }

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => env('SEED_ADMIN_NAME', 'Admin'),
                'password' => Hash::make($password),
            ]
        );
    }
}
