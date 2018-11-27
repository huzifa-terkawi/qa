<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable= ['title','body'];

    public function user()
    {
        return $this->belongsTo(User::class);
        // q = new Question::find(1);
        // q->user->email ; //

    }

    public function setTitleAttribute($val)
    {
        $this->attributes['title']=$val;
        $this->attributes['slug']=str_slug($val);
    }

    public function getUrlAttribute()
    {
        return route('questions.show',$this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0)
        {
            if($this->best_answer_id)
                return "answered-accepted";
            return "answered";
        }
        return "unanswered";

    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);

    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id ;
        $this->save();
    }

    public function favorites()
    {
        //return $this->belongsToMany(User::class,'favorites','question_id','user_id');

        //chain time stamp with created and updated from parent table to child table
        return $this->belongsToMany(User::class,'favorites')->withTimestamps();
    }

    public function isFavoriated()
    {
        return $this->favorites()->where('user_id',auth()->id())->count()>0;
    }

    public function getIsFavoritedAttribute()
    {
        return  $this->isFavoriated();
    }

    public function getFavoritedCountAttribute()
    {
        return $this->favorites()->count();
    }

    //polymorphic relation many-to-many-to-many
    public function votes()
    {
        return $this->morphToMany(User::class,"votable");
    }


    public function upVotes(){return $this->votes()->wherePiviot('vote',1);}
    public function downVotes(){return $this->votes()->wherePiviot('vote',-1);}
}
