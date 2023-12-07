<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminOld = User::first();
        if($adminOld){
          $adminOld->delete();
        }
        $admin = User::create([
            'login' => 'admin',
            'password' => Hash::make('qwerty123')
        ]);
        Auth::loginUsingId($admin->id);
        Auth::user()->createToken('authToken')->accessToken;
    }
}