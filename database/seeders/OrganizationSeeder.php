<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_organizations')->insert([
            'acronym' => 'FIRS',
            'username'    => 'firs',
            'email' => 'api@firs.gov.ng',
            'organization_name' => 'Federal Inland Revenue Service',
            'address' => 'Zone 5, Abuja',
            'contact_phone' => '08038117031',
            'password' => bcrypt('Qa1234@'),
            'is_active'    => '1',
            'is_registered' => '1',
            'registered_on' => '2021/10/14',
            'registration_hash' => '',
            'password_reset_hash' => '',
            'password_hash_control' => '',
            'units' => '1000',
            'role' => 'Accessor'
       ]);
    }
}
