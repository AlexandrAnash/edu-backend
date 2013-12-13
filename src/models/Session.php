<?php

namespace App\Model;


class Session {

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

//    public function login ($userId)
//    {
//        $_SESSION['userId'] = $userId;
//    }
//
//    public function logout()
//    {
//        unset($_SESSION['userId']);
//    }
//
//    public function getName($userName)
//    {
//        $_SESSION['userName'] = $userName;
//    }

    public function isLoggedIn()
    {
        return isset($_SESSION['customerId']) ? true : false;
    }

    //public function getRating($userRating)
    //{
    //    $_SESSION['userRating'] = $userRating;
    //}

    public function getCustomer()
    {
        return $_SESSION['customerId'];
    }

    public function getSessionId()
    {
        return session_id();
    }


}