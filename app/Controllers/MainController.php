<?php

namespace oQuiz\Controllers;

use oQuiz\Models\QuizzesModel;
use oQuiz\Models\UsersModel;

class MainController extends BaseController
{
    public function home()
    {
        $quizzesList = QuizzesModel::findAll();
        $usersList = UsersModel::findAll();

        foreach ($usersList as $usersIdQuiz) {
            $userFirstName[$usersIdQuiz->getId()] = $usersIdQuiz->getFirst_name();
        }
        foreach ($usersList as $usersIdQuiz) {
            $userLastName[$usersIdQuiz->getId()] = $usersIdQuiz->getLast_name();
        }

        $this->displayHTML('main/home', [
            'quizzesList' => $quizzesList,
            'userFirstName' => $userFirstName,
            'userLastName' => $userLastName,
        ]);
    }
}
