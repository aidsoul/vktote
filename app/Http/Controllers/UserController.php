<?php

namespace Vktote\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Security\CsrfToken;

/**
 * UserController class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class UserController extends Controller
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function login(): ResponseInterface
    {
        // Validate CSRF token
        $csrfToken = $_POST['csrf_token'] ?? null;
        if (!CsrfToken::validate($csrfToken)) {
            $this->response = $this->response->withHeader('Content-Type', 'application/json');
            $this->response
                ->getBody()
                ->write(json_encode(['status' => -1, 'error' => 'CSRF validation failed']));
            return $this->response;
        }
        
        $this->response = $this->response->withHeader('Content-Type', 'application/json');
        $this->response
            ->getBody()
            ->write($this->user->checkIfExist());

        return  $this->response;
    }

    /**
     * Exit function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function exit(ServerRequestInterface $request): ResponseInterface
    {
        $this->user->exitUser();
        $user = $this->user->existUser();
        $this->writePage('index.twig', compact('user'));

        return $this->response;
    }
}
