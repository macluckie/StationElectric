<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Domain\Oauth2\OauthGoogle;
use App\Action\Oauth2\AuthGoogleAction;
use App\Action\Oauth2\RepositoryAction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AppStationAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';
    private $client;
    private $em;
    private $provider;

    public function __construct(private UrlGeneratorInterface $urlGenerator, HttpClientInterface $client,EntityManagerInterface $em, UserProviderInterface $provider )
    {
        $this->client = $client;
        $this->em = $em;
        $this->provider = $provider;
    }

    public function supports(Request $request): bool
    {
        return $request->query->has('code');
    }

    public function authenticate(Request $request): Passport
    {
        $oauth2Action = new AuthGoogleAction($request, $this->client);
        $repoAction = new RepositoryAction($this->em);
        $googleAuthDomain = new OauthGoogle($oauth2Action, $repoAction);
        $user =  $googleAuthDomain->getUserOauthGoogle();
        if ($user == null) {
            throw new UnauthorizedHttpException('user not allowed');
        }
        $email = $user->getEmail();
        $request->getSession()->set(Security::LAST_USERNAME, $email);
        
        return new SelfValidatingPassport(        
            new UserBadge($email, function () use ($user) {
                try {
                    $this->provider->loadUserByIdentifier($user->getEmail());
                } catch (\Throwable $th) {
                    dd($th->getMessage());
                }
                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        // For example:
        return new RedirectResponse($this->urlGenerator->generate('app_station'));
        // throw new \Exception('TODO: provide a valid redirect inside ' . __FILE__);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {    
        return new RedirectResponse('http://localhost:8081');
    }

    protected function getLoginUrl(Request $request): string
    {
        // dump('coucou3getlogin');
        // return $this->urlGenerator->generate(self::LOGIN_ROUTE);
        return '';
    }
}
