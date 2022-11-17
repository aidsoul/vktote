<?php

namespace Vktote\Http\Controllers;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Bot;
use Vktote\Message\Message;

/**
 * ApiController class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class ApiCotroller
{

    /**
     * !!! In work !!!
     * 
     * @param ServerRequestInterface $request
     * 
     * @return ResponseInterface
     */
    public function botStart(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $response = new Response();
        $group = $params['group'] ?? false;
        $reply = '';
        if (!empty($group)) {
            $file = $_SERVER['DOCUMENT_ROOT'] . '/' . PATH_GROUP_FOLDER . '/' . $group . '/' . GROUP_CONFIG;
            if (file_exists($file)) {
                try {
                    Bot::start($file);
                    $reply = 'Mission accomplished';
                } catch (\Exception $e) {
                    Message::find()->getByKey('General', 0);
                }
            } else {
                $reply = Message::find()->getByKey('Api', 'notExistGroup');
            }
        } else {
            $reply = ERROR_404;
        }
        $response->getBody()
            ->write($reply);

        return $response;
    }
}