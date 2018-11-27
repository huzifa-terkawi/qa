<?php

use Illuminate\Database\Seeder;
use \App\Question;
use App\Answer;
use App\User;
class VotableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("votables")->where("votable_type",'App\Question')->delete();
        $users = User::all();
        $user_count = $users->count();
        $votes=[-1,1];
        foreach (Question::all() as $question){
            $rndUser = rand(1,$user_count);
            for ($i = 0 ; $i < $rndUser ; $i++){
                $user = $users[$i];
                $user->voteQuestions()->attach($question,["vote"=>$votes[rand(0,1)]]);
            }
        }

    }
}
