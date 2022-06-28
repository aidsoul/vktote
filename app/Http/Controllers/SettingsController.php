<?php

namespace Vktote\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vktote\Http\Controllers\Controller;
use Vktote\Http\Controllers\UserInterface;
use Vktote\Http\Controllers\UserRoleTrait;
use Vktote\Settings\Group;

/**
 * SettingsController
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class SettingsController extends Controller implements UserInterface
{
    use UserRoleTrait;

    public function index():ResponseInterface
    {
        if(is_dir(PATH_GROUP_FOLDER)){
            $scDir = scandir(PATH_GROUP_FOLDER);
            $dir = [];
            foreach($scDir as $k=>$i){
                if ($i == '.' || $i == '..' || $i == USER_CONFIG) {
                    continue;
                }
                $dir[] = $i;
            }
        }
        $this->writePage('settings/index.twig',compact('dir'));
        return $this->response;
    }

    public function groupAdd():ResponseInterface
    {
        $this->writePage('settings/group-add.twig');
        return $this->response;
    }

    /**
     * Ajax request to create a profile
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function groupAddRequest():ResponseInterface
    {
        $this->response
        ->getBody()
        ->write((new Group)
        ->create());
        return $this->response;
    }

    /**
     * Delete group function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteFolderProfile(ServerRequestInterface $request):ResponseInterface
    {
        $ask = (new Group)->delete($request->getQueryParams()['name']);
        $this->response
        ->getBody()
        ->write($ask);
        return $this->response;
    }
    
}

