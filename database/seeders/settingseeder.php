<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class settingseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('settings')->insert([
            'school_name'   => 'My School',
            'email'         => 'school@example.com',
            'phone'         => '0912345678',
            'address'       => 'Khartoum, Sudan',
            'academic_year' => '2025-01-01',
            'img'           => null,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
    }

