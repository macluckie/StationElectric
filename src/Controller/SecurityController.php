<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Security\ClienHttp;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Action\Oauth2\AuthGoogleAction;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class SecurityController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request, ClienHttp $client, TokenStorage $token): Response
    {        
        if ($this->getUser()) {
            return $this->redirectToRoute('app_station');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/google', name: 'app_oauth2')]
    public function loginGoogle(Request $request): RedirectResponse
    {    
        $oauth2Action = new AuthGoogleAction($request, $this->client);
        $url = $oauth2Action->urlAUTH();
        return $this->redirect($url);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(Session $session): void
    {
        $session->clear();
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
