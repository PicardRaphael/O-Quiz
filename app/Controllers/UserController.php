<?php

namespace oQuiz\Controllers;

use oQuiz\Models\UsersModel;
use oQuiz\Utils\ConnectedUser;
use oQuiz\Models\QuizzesModel;

class UserController extends BaseController
{
    public function signin()
    {
        $this->displayHTML('user/signin');
    }

    public function signinPost()
    {
        $router = $this->getRouter();
        $url = $router->generate('main_home');
        $errorList = array();
        //Formulaire soumis
        //Condition ternaire pour récup données
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        //je traite les données enlève les espace
        $email = trim($email);
        $password = trim($password);
        //Je valide les données
        // Je cherche les erreurs que je vais stocker dans $errorList
        if (empty($email)) {
            $errorList[] = "L'email doit être renseigné";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = "L'email est incorrect";
        }
        if (empty($password)) {
            $errorList[] = 'Le mot de passe doit être renseigné';
        } elseif (strlen($password) < 8) {
            $errorList[] = 'Le mot de passe doit contenir au moins 8 caractères';
        }
        if (empty($errorList)) {
            $userModel = UsersModel::findByEmail($email);
            if ($userModel === false) {
                $errorList[] = 'Email non reconnu';
            } else {
                if (password_verify($password, $userModel->getPassword())) {
                    ConnectedUser::connect($userModel);
                    $jsonData = [
                        'code' => 1,
                        'redirect' => $url,
                        'errors' => [],
                     ];
                    $this->displayJson($jsonData);
                } else {
                    $errorList[] = 'Mdp invalide';
                }
            }
        }
        $jsonData = [
            'code' => 2,
            'errors' => $errorList,
        ];
        $this->displayJson($jsonData);
    }

    public function signup()
    {
        $this->displayHTML('user/signup');
    }

    public function signupPost()
    {
        $router = $this->getRouter();
        $url = $router->generate('main_home');
        // Tableau stockant les erreurs du formulaire
        $errorList = array();
        // tableau stockant les valeurs de chaque champ du formulaire
        $fieldValues = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
        ];
        // Je teste si le formulaire est soumis
        if (!empty($_POST)) {
            // Le formulaire a été soumis
            // => je récupère les données
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $passwordConfirm = isset($_POST['password2']) ? $_POST['password2'] : '';
            $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
            $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';

            // Je traite les données
            $email = trim($email);
            $password = trim($password);
            $passwordConfirm = trim($passwordConfirm);
            $first_name = trim(strip_tags($first_name));
            $last_name = strip_tags($last_name); // ou htmlentities pour "echapper"
            // Je valide les données
            // => je cherche les erreurs que je vais stocker dans $errorList
            if (empty($email)) {
                $errorList['code'] = '1';
                $errorList['errorMsg'] = 'L\'email doit être renseigné';
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errorList['code'] = '2';
                $errorList['errorMsg'] = 'L\'email est incorrect';
            }
            if (empty($password)) {
                $errorList['code'] = '3';
                $errorList['errorMsg'] = 'Le mot de passe doit être renseigné';
            } elseif (strlen($password) < 8) {
                $errorList['code'] = '4';
                $errorList['errorMsg'] = 'Le mot de passe doit contenir au moins 8 caractères';
            } elseif ($password !== $passwordConfirm) {
                $errorList['code'] = '5';
                $errorList['errorMsg'] = 'Les deux mots de passe doivent être identiques';
            }
            if (empty($first_name)) {
                $errorList['code'] = '6';
                $errorList['errorMsg'] = 'Le nom doit être renseigné';
            }
            if (empty($last_name)) {
                $errorList['code'] = '7';
                $errorList['errorMsg'] = 'Le prénom doit être renseigné';
            }
            // Si il n'y a pas d'erreur
            if (empty($errorList)) {
                // Je peux insérer en DB le UserModel
                // Je créé l'objet UserModel
                $userModel = new UsersModel();
                // Je hash le mot de passe de façon sécurisée
                $hash = password_hash($password, PASSWORD_DEFAULT);
                // Je définis une valeur pour chaque propriété
                $userModel->setEmail($email);
                $userModel->setLast_name($last_name);
                $userModel->setPassword($hash);
                $userModel->setFirst_name($first_name);
                if ($userModel->save()) {
                    $errorList['code'] = '0';
                    $errorList['errorMsg'] = 'Bingo';
                    $errorList['url'] = $url;
                } else {
                    $errorList['code'] = '7';
                    $errorList['errorMsg'] = 'Erreur dans la sauvegarde';
                }
            }
            // Sinon, je fournis les valeurs pour les champs
            // Je renseigne les valeurs soumis dans $fieldValues pour les réafficher
            $fieldValues['first_name'] = $first_name;
            $fieldValues['last_name'] = $last_name;
            $fieldValues['email'] = $email;
        }
        // $errorList = join('<br>', $errorList);
        $this->displayJson($errorList);
    }

    public function logout()
    {
        ConnectedUser::disconnect();
        $this->redirect($this->getRouter()->generate('main_home'));
    }

    public function profil()
    {
        $user = $_SESSION['user'];
        $userId = $user->getId();
        $quizAuthor = QuizzesModel::getQuizsByAuthorId($userId);
        $this->displayHTML('user/profil', [
            'quizList' => $quizAuthor,
        ]);
    }
}
