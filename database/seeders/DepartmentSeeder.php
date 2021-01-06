<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['name' => 'HSSE', 'description' => 'HSSE department', 'color_code' => '#fff'],
            ['name' => 'Finance', 'description' => 'Financial department', 'color_code' => '#fff'],
            ['name' => 'IT', 'description' => 'IT description', 'color_code' => '#fff'],
        ];

        DB::table('departments')->delete();

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
