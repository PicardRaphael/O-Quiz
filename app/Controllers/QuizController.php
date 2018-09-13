<?php

namespace oQuiz\Controllers;

use oQuiz\Models\QuestionsModel;
use oQuiz\Models\QuizzesModel;
use oQuiz\Models\LevelsModel;
use oQuiz\Models\UsersModel;

class QuizController extends BaseController
{
    public function quiz($url_params)
    {
        $quizId = $url_params['id'];
        $questionsModel = QuestionsModel::getQuestionsByQuizId($quizId);
        $quizModel = QuizzesModel::find($quizId);

        $authorId = $quizModel->getId_author();
        $author = UsersModel::find($authorId);

        $levelModel = LevelsModel::findAll();

        $usersList = UsersModel::findAll();

        $questionsTb = [];

        $quizId = $quizModel->getId();
        $nbr_question = QuestionsModel::nbrQuestions($quizId);

        //shuffle();

        //dump($questionsModel);
        //exit;

        foreach ($levelModel as $nameIdLevel) {
            $levelName[$nameIdLevel->getId()] = $nameIdLevel->getName();
        }

        $this->displayHTML('quiz/quiz', [
            'questions' => $questionsModel,
            'reponses' => $questionsTb,
            'quiz' => $quizModel,
            'levelName' => $levelName,
            'author' => $author,
            'nbrQuestion' => $nbr_question,
        ]);
    }

    public function quizPost($url_params)
    {
        $quizId = $url_params['id'];

        $questions = QuestionsModel::getQuestionsByQuizId($quizId);

        $resultatList = [];

        $goodAnswers = 0;
        $falseAnswers = 0;
        $emptyAnswers = 0;

        if (!empty($_POST)) {
            foreach ($questions as $idQuestion => $question) {
                $answer = isset($_POST['question_'.$question->getId()]) ? $_POST['question_'.$question->getId()] : '';

                if ($question->getProp1() == $answer) {
                    $resultatList[] = array(
                        'question' => $question->getId(),
                        'resultat' => 'Bonne reponse',
                        'anecdote' => $question->getAnecdote(),
                        'wikipedia' => $question->getWiki(),
                    );
                    ++$goodAnswers;
                } elseif ($answer == '') {
                    $resultatList[] = array(
                        'question' => $question->getId(),
                        'resultat' => 'Reponse vide',
                    );
                    ++$emptyAnswers;
                } else {
                    $resultatList[] = array(
                        'question' => $question->getId(),
                        'resultat' => 'Mauvaise reponse',
                        'anecdote' => $question->getAnecdote(),
                        'wikipedia' => $question->getWiki(),
                    );
                    ++$falseAnswers;
                }

                $answer = [
                    'goodAnswers' => $goodAnswers,
                    'falseAnswers' => $falseAnswers,
                    'emptyAnswers' => $emptyAnswers,
                ];
            }
            $jsonData = [
                'code' => 1,
                'resultat' => $resultatList,
                'nbrAnswers' => $answer,
            ];
            $this->displayJson($jsonData);
        }
    }
}
