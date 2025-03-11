<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/security/login', name: 'app_security_login',methods:["GET","POST"])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
         // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',[
                    'controller_name' => 'LoginController',
                    'last_username' => $lastUsername,
                    'error'         => $error,
                 ]);
    }

    #[Route(path: '/security/logout', name: 'app_security_logout',methods:["GET"])]
    public function logout(){
        // rien a faire
    }
}
