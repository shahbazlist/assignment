<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'user.view',
            'user.create',
            'shorturl.view',
            'shorturl.create'
        ];

        foreach($permission as $key=>$val){
            Permission::create(['name'=> $val]);
        } 
    }
}
