<?php

namespace Vktote\Settings;

use Vktote\Config\Config;
use Vktote\Config\Vk;
use Vktote\DataBase\Vkgroup;
use Vktote\File\File;

/**
 * Group class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class Group
{
    /**
     * Send message function
     *
     * @param integer $status
     * @param string $pathIni
     * @param string $pathPhp
     * @return void
     */
    private function send(int $status, string $pathIni, string $pathPhp):array
    {
        return [
            'status'=>$status,
            'file'=>$_POST['fileName'],
            'pathIni' =>$pathIni,
            'pathPhp' =>$pathPhp
            ];
    }

    /**
     * Create group function
     *
     * @return void
     */
    public function create():string
    {
            $send = [];
            $file = new File;
            $file->set($_POST['fileName']);

        if (!is_dir($file->folder)) {
            mkdir($file->folder);
        }
        if (!file_exists($file->configPath)) {
            file_put_contents($file->configPath, include SETTINGS_PATTERN.'/PatternIni.php');
            file_put_contents($file->phpPath, include SETTINGS_PATTERN.'/PatternPhp.php');
            $send = $this->send(1, $file->configPath, $file->phpPath);
        } else {
            $send = $this->send(0, $file->configPath, $file->phpPath);
        }
        return json_encode($send);
    }


    private function checkFileExist(string $file, int $status){
        if(!file_exists($file)){
            die(json_encode(['status'=> $status,'name'=>$file]));
        }
    }

    /**
     * Delete group function
     *
     * @param string $dirDelete
     * @return array
     */
    public function delete(string $dirName):string
    {
        $file = new File;
        $file->set($dirName);
        $ret = ['status'=> 0,'name'=>$file->folder];
        if (is_dir($file->folder)) {

            $this->checkFileExist($file->configPath,4);
            $this->checkFileExist($file->phpPath,5);

            try
            {
                // delete group from database
                Config::set($file->iniFullPath);
                $vk = new Vkgroup;
                if($idGroup = $vk->check(Vk::get()->idGroup)){
                    $vk->delete($idGroup);
                }else{
                    die(json_encode(['status'=> 3,'name'=>Vk::get()->idGroup]));
                }
            }catch(\Exception $e){
                die(json_encode(['status'=> 2]));
            }
            unlink($file->configPath);
            unlink($file->phpPath);
            rmdir($file->folder);
            $ret = ['status'=> 1,'name'=> 0];
        }
        return json_encode($ret);
    }
}
