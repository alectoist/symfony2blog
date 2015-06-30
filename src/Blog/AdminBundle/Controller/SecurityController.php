<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * Login action
     * 
     * @return Response
     * 
     * @Route("/login")
     * @Template()
     */
    public function loginAction($name='')
    {

        $request = $this->getRequest();
        $session = $request->getSession();
        
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {    
          $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
          $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        return $this->render(
                'AdminBundle:Security:login.html.twig',
                [
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error'         => $error
                ]
                );
    }
    
    /**
     * Check the login
     * 
     * @Route("login_check")
     */
    public function loginCheck()
    {
        
    }
}


