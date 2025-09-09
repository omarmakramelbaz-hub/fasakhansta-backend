<?php

namespace App\Repositories;

use App\Interfaces\QuestionAnswerRepositoryInterface;
use App\Models\QuestionAnswer;
use App\Http\Traits\UploadImageTrait;

class QuestionAnswerRepository implements QuestionAnswerRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllQuestionAnswers($request) 
    {
        $searchQuery = trim($request->query('search'));
       
        return QuestionAnswer::where('question_'.app()->getLocale(), 'like', '%' . $request->search . '%')->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);
    }

    public function getQuestionAnswerById($question_answerId) 
    {
        return QuestionAnswer::findOrFail($question_answerId);
    }

    public function deleteQuestionAnswer($question_answerId) 
    {
        // $question_answer->destroy($question_answerId);  
         $get_user = QuestionAnswer::whereId($question_answerId)->delete();
    }

    public function createQuestionAnswer(array $question_answerDetails) 
    {
        $question_answer = QuestionAnswer::create($question_answerDetails);
        
        return $question_answer;
    }

    public function updateQuestionAnswer($question_answerId, array $newDetails) 
    {
        $question_answer = QuestionAnswer::whereId($question_answerId)->first();
        return $question_answer->update($newDetails);
    }

    public function deleteAllQuestionAnswers($ids) 
    {
        $question_answers= QuestionAnswer::whereIn('id',explode(",",$ids))->delete();
    
        return $question_answers;
    }
    
}