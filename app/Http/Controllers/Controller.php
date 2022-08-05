<?php

namespace Vktote\Http\Controllers;

use Laminas\Diactoros\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Vktote\Settings\User;

/**
 * Controller class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class Controller
{

    /**
     * @var object
     */
    protected object $user;
    /**
     * @var boolean
     */
    protected bool $access;

    /**
     * Undocumented variable
     *
     * @var object
     */
    protected object $response;

    public function __construct()
    {
        $this->response = new Response();
        $user = new User();
        $this->user = $user;
        $this->access = $user->existUser();
    }

    /**
     * Role function
     *
     * @return void
     */
    protected function role(): void
    {
        if ($this->access !== true) {
            exit(ERROR_404);
        }
    }

    /**
     * Creating an output page function
     *
     * @param string $page
     * @param array $context
     * @return void
     */
    protected function writePage(string $page, array $context = []): void
    {
        $this->response
            ->getBody()
            ->write($this->render($page, $context));
    }

    /**
     * Reder twig-page function
     *
     * @param string $page
     * @param array $context
     * @return string
     */
    private function render(string $page, array $context = []): string
    {
        $loader = new FilesystemLoader('view');
        $view = new Environment($loader);
        return $view->render($page, $context);
    }
}
