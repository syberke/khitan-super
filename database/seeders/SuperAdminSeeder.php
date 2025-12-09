<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data super admin
        $name = "Super Admin";
        $email = "adminbazma@bansos.com";
        $plainPassword = "super2025";

        // Cek apakah super admin sudah ada
        if (!User::where('email', $email)->exists()) {

            User::create([
                'name'     => $name,
                'email'    => $email,
                'role'     => 'superadmin',
                'region'   => 'Pusat',
                'password' => Hash::make($plainPassword),
            ]);

            echo "Super Admin dibuat:\n";
            echo "Email    : $email\n";
            echo "Password : $plainPassword\n";
        } else {
            echo "Super Admin sudah ada. Tidak dibuat ulang.\n";
        }
    }
}
