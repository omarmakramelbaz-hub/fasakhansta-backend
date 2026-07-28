<?php

namespace App\Interfaces;

interface QuestionAnswerRepositoryInterface 
{
    public function getAllQuestionAnswers($request);
    public function getQuestionAnswerById($question_answerId);
    public function deleteQuestionAnswer($question_answerId);
    public function createQuestionAnswer(array $question_answerDetails);
    public function updateQuestionAnswer($question_answerId, array $newDetails);
    public function deleteAllQuestionAnswers($ids);

}