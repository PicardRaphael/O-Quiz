<?php

namespace oQuiz\Controllers;

use League\Plates\Engine as Plates;
use oQuiz\App;
use oQuiz\Utils\ConnectedUser;

abstract class BaseController
{
    /**
     * @var App
     */
    private $app;

    /**
     * @param App $application
     */
    public function setApp(App $application)
    {
        $this->app = $application;
    }

    /**
     * @param string $templateName
     * @param array  $data
     */
    protected function displayHTML(string $templateName, array $data = array())
    {
        /* Create new Plates instance */
        $templates = new Plates(APP_PATH.'/Views');

        /* J'ajoute une donnée pour tout le moteur de template */
        $templates->addData([
            'baseURL' => $this->app->getBasePath(),
            'router' => $this->app->getRouter(),
            'isConnected' => ConnectedUser::isConnected(),
            'connectedUser' => ConnectedUser::getUser(),
        ]);

        /* Render a template */
        echo $templates->render($templateName, $data);
    }

    /**
     * Permet d'afficher des données au format JSON.
     *
     * @param mixed
     */
    public function displayJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function getRouter(): \AltoRouter
    {
        return $this->app->getRouter();
    }

    /**
     * Méthode permettant d'afficher l'url fournit.
     *
     * @param string $url
     */
    protected function redirect(string $url)
    {
        header('Location: '.$url);
        exit;
    }

    public static function sendHttpError(int $errorCode, string $htmlContent = '')
    {
        if ($errorCode == 404) {
            header('HTTP/1.0 404 Not Found');
            echo $htmlContent;
            exit;
        } elseif ($errorCode == 403) {
            header('HTTP/1.0 403 Forbidden');
            echo $htmlContent;
            exit;
        }
    }
}
