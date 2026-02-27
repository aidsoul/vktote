<?php

namespace Vktote\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Http\Controllers\UserInterface;
use Vktote\Http\Controllers\UserRoleTrait;
use Vktote\Settings\Group;
use Vktote\Security\CsrfToken;

/**
 * SettingsController
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class SettingsController extends Controller implements UserInterface
{
    use UserRoleTrait;

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(): ResponseInterface
    {
        if (is_dir(PATH_GROUP_FOLDER)) {
            $scDir = scandir(PATH_GROUP_FOLDER);
            $dir = [];
            foreach ($scDir as $k => $i) {
                if (
                    $i == '.' || 
                    $i == '..' || 
                    $i == USER_CONFIG || 
                    $i == GROUP_START ||
                    is_file($i)
                ) {
                    if (is_file($i)) {
                        continue;
                    }
                    continue;
                }
                $dir[] = $i;
            }
        }
        $this->writePage('settings/index.twig', compact('dir'));

        return $this->response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function groupAdd(): ResponseInterface
    {
        $csrfToken = CsrfToken::input();
        $this->writePage('settings/group-add.twig', [
            'dbCommon' => DB_COMMON,
            'csrfToken' => $csrfToken
        ]);

        return $this->response;
    }

    /**
     * Ajax request to create a profile
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function groupAddRequest(): ResponseInterface
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
        
        $this->response
            ->getBody()
            ->write((new Group)->create());

        return $this->response;
    }

    /**
     * Delete group function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteFolderProfile(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $name = $params['name'] ?? '';
        
        // Validate input to prevent path traversal
        if (empty($name) || !preg_match('/^[a-zA-Z0-9_-]+$/', $name)) {
            $this->response = $this->response->withHeader('Content-Type', 'application/json');
            $this->response
                ->getBody()
                ->write(json_encode(['status' => -1, 'error' => 'Invalid group name']))
            ;
            return $this->response;
        }
        
        $ask = (new Group)->delete($name);
        $this->response
            ->getBody()
            ->write($ask);
            
        return $this->response;
    }
}
