<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getQuestionAttribute()
    {
        $lang = App::getLocale();
        $column = "question_" . $lang;
        return $this->{$column};
    }
    public function getAnswerAttribute()
    {
        $lang = App::getLocale();
        $column = "answer_" . $lang;
        return $this->{$column};
    }

    public function admin() {
       return $this->belongsTo(\App\Models\User::class,'added_by');
    }
}
