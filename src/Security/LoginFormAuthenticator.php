<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    protected function getLoginUrl(Request $request): string
    {
        // TODO: Implement getLoginUrl() method.
    }

    public function authenticate(Request $request)
    {
        // TODO: Implement authenticate() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function supports(Request $request)
    {

    }
}
