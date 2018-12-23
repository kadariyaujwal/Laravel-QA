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

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute(){
        // return route('users.show',$this->id);
        return "#";
    }
    
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute(){
        $email = $this->image;
        $size = 20;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;
    }

    public function favourites(){
        return $this->belongsToMany(Question::class,'favourites')->withTimeStamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class,'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class,'votable');
    }

    public function voteQuestion(Question $question,$vote){

        $voteQuestions = $this->voteQuestions();
        if($voteQuestions->where('votable_id',$question->id)->exists()){

            $voteQuestions->updateExistingPivot($question,['vote'=>$vote]);

        }

        else{
            $voteQuestions->attach($question,['vote'=>$vote]);
        }

        $question->load('votes');
        $downVotes = (int) $question->downVotes()->sum('vote');
        $upVotes = (int) $question-> upVotes()->sum('vote');

        $question->votes_count = $upVotes + $downVotes;

        $question->save();



    }
}
