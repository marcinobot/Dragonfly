<?php

namespace UserBundle\Handler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router, $security, $container;

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
        } elseif ($this->security->isGranted('ROLE_USER')) {
            return new RedirectResponse($this->router->generate('panel_home'));
        } else {
            return new RedirectResponse($this->router->generate('fos_user_security_login'));
        }
    }
} 