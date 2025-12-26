<?php

namespace Database\Seeders;
use App\Models\tb_sys_mf_user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $existing = tb_sys_mf_user::where('name', 'System Administrator')->first();
        $hashed_pw = Hash::make('Kerberos2014!');

        if(!isset($existing)){
            tb_sys_mf_user::create([
                'code'  => 'sa',
                'name' => 'System Administrator',
                'email' => 'evergara@shinra.com.ph',
                'email_verified_at' => now(),
                'password' => $hashed_pw,
                'is_active' => 1,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
