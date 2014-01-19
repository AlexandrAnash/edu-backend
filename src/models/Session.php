<?php

namespace App\Model;


class Session {

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public function login ($userId)
    {
        $_SESSION['userId'] = $userId;
    }

    public function loginAdmin ($userId)
    {
        $_SESSION['adminId'] = $userId;
    }

    public function logout()
    {
        unset($_SESSION['userId']);
    }

    public function logoutAdmin()
    {
        unset($_SESSION['adminId']);
    }

    public function setName($userName)
    {
        $_SESSION['userName'] = $userName;
    }

    public function isLoggedIn()
    {
        //var_dump(isset($_SESSION['userId']) ? true : false);
        return isset($_SESSION['userId']) ? true : false;
    }

    public function setRating($userRating)
    {
        $_SESSION['userRating'] = $userRating;
    }

    public function getCustomer()
    {
        return $_SESSION['userId'];
    }

    public function getSessionId()
    {
        return session_id();
    }

    public function generateToken()
    {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function getToken()
    {
        return isset($_SESSION['token']) ? $_SESSION['token'] : null;
    }

    public function validateToken($token)
    {
        $valid = $this->getToken() === $token;
        unset($_SESSION['token']);
        return $valid;
    }

    public function getQuoteId()
    {
        return isset($_SESSION['quote_id']) ? $_SESSION['quote_id'] : null;
    }

    public function setQuoteId($id)
    {
        $_SESSION['quote_id'] = $id;
    }

}