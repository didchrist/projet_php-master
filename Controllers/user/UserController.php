<?php

namespace Controllers\user;

use Models\user\UserManager;
use PDOException;


class UserController
{
    private $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }
    private function getClean()
    {
        $_POST = filter_input_array(INPUT_POST, [
            'email' => FILTER_SANITIZE_EMAIL,
            'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'nom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'prenom' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'pseudonyme' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ]);
    }

    public function getUser()
    {
        $this->getClean();
        require_once './Views/errors.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userManager->getUser($email);
            $password_bdd = $user->motdepasse ?? '';

            if (password_verify($password, $password_bdd)) {
                setcookie("utilisateur", $user->pseudonyme, time() + 3600 * 24, "", "/", 1, 1);
                $_SESSION['utilisateur'] = $user->pseudonyme;
                header('Location: homepage');
            } else {
                $error = ERROR_WRONG_LOGIN;
            }
        }
        require_once './Views/login.php';
    }
    public function addUser()
    {
        $this->getClean();
        require_once './Views/errors.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudonyme = $_POST['pseudonyme'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            try {
                $this->userManager->addUser($nom, $prenom, $pseudonyme, $email, $password);
            } catch (PDOException $e) {
                $error = ERROR_ALREADY_TAKEN;
                $verif = 1;
            }
            if ($verif != 1) {
                header('Location: homepage');
            }
        }
        require_once './Views/register.php';
    }

    public function updateUser()
    {
        $this->getClean();
        require_once './Views/errors.php';
        if (isset($_COOKIE['utilisateur'])) {
            $info = $_COOKIE['utilisateur'];
        } else {
            $info = $_SESSION['utilisateur'] ?? '';
        }
        $user = $this->userManager->getUser($info);
        $nom = $user->nom;
        $prenom = $user->prenom;
        $pseudonyme = $user->pseudonyme;
        $email = $user->email;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudonyme_tmp = $_POST['pseudonyme'];
            $email_tmp = $_POST['email'];
            $id = $user->id;
            try {
                $this->userManager->updateUser($nom, $prenom, $pseudonyme_tmp, $email_tmp, $id);
                $pseudonyme = $pseudonyme_tmp;
                $email = $email_tmp;
                $_SESSION['utilisateur'] = $pseudonyme;
                $_COOKIE['utilisateur'] = $pseudonyme;
            } catch (PDOException $e) {
                $error = ERROR_ALREADY_TAKEN;
            }
        }
        require_once './Views/register.php';
    }
    public function delogUser()
    {
        unset($_SESSION['utilisateur']);
        setcookie("utilisateur", "", time() - (60 * 60 * 24 * 7), "", "/");
        unset($_COOKIE['utilisateur']);
        header("Location: homepage");
    }
}