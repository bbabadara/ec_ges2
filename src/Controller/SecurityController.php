<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    #[Route(path: '/security/login', name: 'app_security_login',methods:["GET","POST"])]
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route(path: '/security/logout', name: 'app_security_logout',methods:["GET"])]
    public function logout(){
        // rien a faire
    }
}
