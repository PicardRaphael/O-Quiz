<?php

namespace oQuiz;

use AltoRouter;
use oQuiz\Controllers\BaseController;

/* Class qui sert de FrontController */
class App extends AltoRouter
{
    /* Surchage/Override du constructeur du parent */
    public function __construct()
    {
        /* Exécute le constructeur du parent (AltoRouter) */
        parent::__construct();

        $this->setBasePath($_SERVER['BASE_URI']);

        /* J'appelle ma méthode defineRoutes qui se charge de remplir */
        $this->defineRoutes();

        /* Je définis une constante (pas lié à une classe)  le dossier app = APP_PATH*/
        // define définit constante
        define('APP_PATH', __DIR__);
    }

    private function defineRoutes()
    {
        /* Route => Home - Accueil */

        // (GET/POST , url , Controller#Méthode , alias)
        $this->map('GET', '/', 'Main#home', 'main_home');

        $this->map('GET', '/quiz/[i:id]', 'Quiz#quiz', 'quiz_quiz');
        $this->map('POST', '/quiz/[i:id]', 'Quiz#quizPost', 'quiz_quizPost');

        $this->map('GET', '/signup', 'User#signup', 'user_signup');
        $this->map('POST', '/signup', 'User#signupPost', 'user_signuppost');

        $this->map('GET', '/signin', 'User#signin', 'user_signin');
        $this->map('POST', '/signin', 'User#signinPost', 'user_signinpost');

        $this->map('GET', '/logout', 'User#logout', 'user_logout');

        $this->map('GET', '/compte', 'User#profil', 'user_profil');
    }

    public function run()
    {
        /*dump($this->routes);exit;*/
        $match = $this->match();

        if ($match === false) {
            BaseController::sendHttpError('404', 'Page 404 not found');
        } else {
            list($controllerName, $methodName) = explode('#', $match['target']);

            /* Je complète le nom du controller */
            $controllerName = '\\oQuiz\\Controllers\\'.$controllerName.'Controller';

            /* Je crée une instance du controller */
            $controller = new $controllerName();

            /* Je définis la  valeur de la propriété app du Controller */
            $controller->setApp($this);

            /* J'appele la méthode qui est après le # */
            $controller->$methodName($match['params']);
        }
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function getRouter(): AltoRouter
    {
        return $this;
    }
}
