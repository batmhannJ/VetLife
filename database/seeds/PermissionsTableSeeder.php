<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'patient_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'stock_management_access',
            ],
            [
                'id'    => '19',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '20',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '21',
                'title' => 'patient_create',
            ],
            [
                'id'    => '22',
                'title' => 'patient_edit',
            ],
            [
                'id'    => '23',
                'title' => 'patient_show',
            ],
            [
                'id'    => '24',
                'title' => 'patient_delete',
            ],
            [
                'id'    => '25',
                'title' => 'patient_access',
            ],
            [
                'id'    => '26',
                'title' => 'test_create',
            ],
            [
                'id'    => '27',
                'title' => 'test_edit',
            ],
            [
                'id'    => '28',
                'title' => 'test_show',
            ],
            [
                'id'    => '29',
                'title' => 'test_delete',
            ],
            [
                'id'    => '30',
                'title' => 'test_access',
            ],
            [
                'id'    => '31',
                'title' => 'prescription_create',
            ],
            [
                'id'    => '32',
                'title' => 'prescription_edit',
            ],
            [
                'id'    => '33',
                'title' => 'prescription_show',
            ],
            [
                'id'    => '34',
                'title' => 'prescription_delete',
            ],
            [
                'id'    => '35',
                'title' => 'prescription_access',
            ],
            [
                'id'    => '36',
                'title' => 'medicine_create',
            ],
            [
                'id'    => '37',
                'title' => 'medicine_edit',
            ],
            [
                'id'    => '38',
                'title' => 'medicine_show',
            ],
            [
                'id'    => '39',
                'title' => 'medicine_delete',
            ],
            [
                'id'    => '40',
                'title' => 'medicine_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
