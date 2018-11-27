<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votables', function (Blueprint $table) {
            //polymorphic relation user - question - answer
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("votable_id");
            $table->string("votable_type"); //
            $table->tinyInteger("vote"); // 1 or -1
            $table->timestamps();
            $table->unique(["user_id","votable_id","votable_type"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votables');
    }
}
