<?php

namespace Vktote\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Http\Controllers\Controller;

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
