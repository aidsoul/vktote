<?php

namespace Vktote\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Http\Controllers\Controller;

/**
 * SiteController class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class SiteController extends Controller
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $user = $this->user->existUser();
        $this->writePage('index.twig', compact('user'));

        return $this->response;
    }
}
