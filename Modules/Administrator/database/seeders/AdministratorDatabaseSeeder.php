<?php

namespace Modules\Administrator\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Administrator\Models\Administrator;

class AdministratorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::reguard();

        $data = [
            'email' => 'admin@email.com',
            'password' => '123123123',
            'first_name' => 'Super',
            'middle_name' => 'Ace',
            'last_name' => 'Admin',
        ];

        if (is_null(Administrator::first())) {
            Administrator::create($data);
        }
    }
}
