<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Terminal;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terminals = [
            ['name' => 'KTS-Dubai Office', 'matricule' => 'AE004L', 'code' => '1', 'terminal_entry_point_id' => null, 'status' => true,
            ],
        ];

        DB::table('terminals')->delete();

        foreach ($terminals as $terminal) {
            Terminal::create($terminal);
        }
    }
}
