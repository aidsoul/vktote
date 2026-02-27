<?php

namespace Vktote\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Security\CsrfToken;

/**
 * SiteController class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class SiteController extends Controller
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $user = $this->user->existUser();
        $csrfToken = CsrfToken::input();
        $this->writePage('index.twig', compact('user', 'csrfToken'));

        return $this->response;
    }
}
