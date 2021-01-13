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
            ['name' => 'HSSE', 'description' => 'HSSE department', 'color_code' => '#28A899'],
            ['name' => 'Finance', 'description' => 'Financial department', 'color_code' => '#26A4F2'],
            ['name' => 'IT', 'description' => 'IT description', 'color_code' => '#30497C'],
            ['name' => 'Proc', 'description' => 'Proc description', 'color_code' => '#335DE7'],
            ['name' => 'Lean Academy', 'description' => 'Lean Academy description', 'color_code' => '#F91262'],
            ['name' => 'HR', 'description' => 'Human resources', 'color_code' => '#384AD7'],
        ];

        DB::table('departments')->delete();

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
