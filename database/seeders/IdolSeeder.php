<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Idol;

class IdolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idol_names = [
            '尾木 波菜',
            '落合 希来里',
            '蟹沢 萌子',
            '河口 夏音',
            '川中子 奈月心',
            '櫻井 もも',
            '菅波 美玲',
            '鈴木 瞳美',
            '谷崎 早耶',
            '冨田 菜々風',
            '永田 詩央里',
            '本田 珠由記',
        ];

        foreach ($idol_names as $idol_name) {

            $idol = new Idol();
            $idol->name = $idol_name;
            $idol->save();

        }
    }
}
