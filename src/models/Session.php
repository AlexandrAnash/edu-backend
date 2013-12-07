<?php

namespace App\Model;


class Session {

    public function __construct()
    {
        session_start();
    }

    public function login ($userId)
    {
        $_SESSION['userId'] = $userId;
    }

    public function logout()
    {
        unset($_SESSION['userId']);
    }

    public function getName($userName)
    {
        $_SESSION['userName'] = $userName;
    }

    public function getRating($userRating)
    {
        $_SESSION['userRating'] = $userRating;
    }


} 