<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id', 'question_id'];

    public static function boot()
    {
        parent::boot();
        static::created(function($answer){
            $answer->question->increment('answers_count');

        });

        static::deleted(function ($answer) {
            $question = $answer->question;
            $question->decrement('answers_count');
            if($question->best_answer_id == $answer->id)
            {
                $question->best_answer_id = NULL;
                $question->save();
            }
        });

   }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);

    }

    public function getStatusAttribute()
    {
        return $this->question->best_answer_id == $this->id ? "vote-accepted" : '';
    }

    public function getIsBestAttribute()
    {
        return $this->question->best_answer_id == $this->id;
    }

    //polymorphic relation many-to-many-to-many
    public function votes()
    {
        return $this->morphToMany(User::class,"votable");
    }
}
