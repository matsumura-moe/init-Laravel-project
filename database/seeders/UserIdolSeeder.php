<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserIdol;
use App\Models\Idol;

class UserIdolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $idols = Idol::get();

        foreach ($users as $user) {

            $count = rand(3, 5);
            $random_idols = $idols->shuffle()->slice(0, $count);   // ランダムで３〜５件のアイドルを取得

            foreach ($random_idols as $random_idol) {

                $user_idol = new UserIdol();
                $user_idol->user_id = $user->id;
                $user_idol->idol_id = $random_idol->id;
                $user_idol->save();

            }

        }
    }
}