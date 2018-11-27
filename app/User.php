<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute()
    {
        //return route('questions.show',$this->id);
        return "#";
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;
        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
        return $grav_url;
    }

    // user could favorite many question
    public function favorites()
    {
        //return $this->belongsToMany(Question::class,'favorites','user_id','question_id');

        //chain time stamp with created and updated from parent table to child table
        return $this->belongsToMany(Question::class,'favorites')->withTimestamps();
    }

    //polymorphic relation many-to-many-to-many
    public function voteQuestions()
    {
        //relate this to votable.user_id with Question in votable_id and type vo
        return $this->morphedByMany(Question::class,'votable'); // table name is singular
    }

    //polymorphic relation many-to-many-to-many
    public function voteAnswers()
    {
        //relate this to votable.user_id with Answer in votable_id and type vo
        return $this->morphedByMany(Answer::class,'votable'); // table name is singular
    }

    public function voteQuestion(Question $question,$vote){
        $v = $this->voteQuestions();
        if($v->where("votable_id",$question->id)->exists()){
            //$v->where("votable_id",$question->id)->delete();
            //$v->updateExistingPivot($question,["vote"=>$vote]);
            $v->where("votable_id",$question->id)->detach($question->id);
        }

        $v->attach($question,["vote"=>$vote]);
        $question->load("votes");
        $up = (int)($question->votes()->where('vote',1)->sum('vote'));//remove wherePiviot
        $down = (int)($question->votes()->where('vote',-1)->sum('vote'));
        $question->votes_count = $up + $down -1;
        $question->save();
    }
}
