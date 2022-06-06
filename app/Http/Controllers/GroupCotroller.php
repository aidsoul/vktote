<?php

namespace Vktote\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Bot;
use Vktote\Http\Controllers\Controller;
use Vktote\Http\Controllers\UserInterface;
use Vktote\Http\Controllers\UserRoleTrait;

/**
 * GroupCotroller class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class GroupCotroller extends Controller implements UserInterface
{
    use UserRoleTrait;
    /**
     * Checking the existence of files
     *
     * @param \Laminas\Diactoros\Response $response
     * @param string $file
     * @return void
     */
    private function checkExistFile(string $file):void
    {
        if (file_exists($file)) {
            Bot::start($file);
        } else {
            $this->response
            ->getBody()
            ->write('The file has not been created or it does not exist: '.$file.'<br>');
        }
    }

    /**
     * GET request to launch the bot
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(ServerRequestInterface $request):ResponseInterface
    {
        if (isset($request->getQueryParams()['name'])) {
            $groupName = $request->getQueryParams()['name'];
            if (empty($groupName)) {
                $this->response
                ->getBody()
                ->write('Query param is null');
            } else {
                $groupFolder = PATH_GROUP_FOLDER.'/'.$groupName;
                $fileIniPath = $groupFolder.'/'.GROUP_CONFIG;
                $filePhpPath =  $groupFolder.'/'.GROUP_PHP;
                
                // Checking if there is a directory
                if (is_dir($groupFolder)) {
                // ini file
                    $this->checkExistFile($fileIniPath);
                // // php file
                // $this->checkExistFile($filePhpPath);
                } else {
                    $this->response
                    ->getBody()
                    ->write('Folder not found');
                }
            }
        //Group not found
        } else {
            $this->response
            ->getBody()
            ->write(ERROR_404);
        }
        return  $this->response;
    }
}
