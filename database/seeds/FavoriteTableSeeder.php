<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Answer;
use App\User;
class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->delete();
        $users = User::pluck('id')->all();
        $userCount = count($users);
        foreach (Question::all() as $question) {
            $favCountByUser = rand(1,$userCount);
            for ($i = 0 ; $i < $favCountByUser;$i++){
                $user = $users[$i];
                $question->favorites()->attach($user);//make many to many relation
            }
        }
    }
}
