<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersWithRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete in reversse order becuase of relation
        //DB::table('favorites')->delete();
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();


        factory(App\User::class,3)->create()->each(function ($u){
            $u->questions()
                ->saveMany(factory(App\Question::class,rand(1,5))->make()
                )->each(function ($q) {
                    $q->answers()->saveMany(factory(App\Answer::class, rand(0, 10))->make());
                });
        });
    }
}
