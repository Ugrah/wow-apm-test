<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JsonForm;
use DB;

class JsonFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_forms = [
            [
                'name' => 'Leader Led',
                'schema' => '{"text": {"type": "string","title": "Text"},"choice": {"enum": ["text","cat"],"type": "string"},"category": {"enum": ["Geography","Entertainment","History","Arts","Science","Sports"],"type": "string","title": "Category"}}',
                'form' => '[{"key": "choice","type": "selectfieldset","items": ["text","category"],"title": "Make a choice","titleMap": {"cat": "Search by category","text": "Search by text"}},{"type": "submit","value": "Submit"}]'
            ],
            [
                'name' => 'Kaizen', 
                'schema' => '{"cost": {"type": "string","title": "Cost savings (annualized USD)"},"time": {"type": "string","title": "Time saving (annualized in hours)"},"title": {"type": "string","title": "Kaizen title", "required": true},"avoidance": {"type": "string","title": "Cost avoidance (annualized USD)"},"departments": {"enum": ["1","2","3","4"],"type": "string","title": "Departments"},"improvement": {"type": "boolean", "title": "Significant safety improvement?"},"primaryTool": {"enum": ["178","179","180","181","182","183"],"type": "string","title": "Primary Tool"},"productivity": {"type": "string","title": "Productivity increase (Moves)"}}', 
                'form' => '["title",{"key": "departments", "titleMap": {"1": "HHSE","2": "Finance", "3": "IT","4": "Tool"}},{"key": "primaryTool", "titleMap": {"178": "Kaizen basic", "179": "SP","180": "PS","181": "VM/DM"}},"improvement","time","cost","productivity", "avoidance","time",{"type": "submit", "value": "Submit", "htmlClass": "btn-block"}]'
            ],
        ];

        DB::table('json_forms')->delete();

        foreach ($json_forms as $json_form) {
            JsonForm::create($json_form);
        }
    }
}
