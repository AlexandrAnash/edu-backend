<?php
namespace App\Controller;

class ErrorController
{
    public function notFoundAction()
    {
        require_once __DIR__ . '/../views/Error404.phtml';
    }
}