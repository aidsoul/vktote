<?php

namespace Vktote\Settings;

use Vktote\Config\Config;
use Vktote\Config\Vk;
use Vktote\DataBase\Models\VkgroupModel;
use Vktote\Settings\File\File;

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
     * 
     * @return array
     */
    private function send(int $status, string $pathIni): array
    {
        return [
            'status' => $status,
            'file' => $_POST['fileName'],
            'pathIni' => $pathIni
        ];
    }

    /**
     * Create group function
     *
     * @return void
     */
    public function create(): string
    {
        $send = [];
        $file = new File();
        $file->set($_POST['fileName']);

        if (!is_dir($file->folder)) {
            mkdir($file->folder);
        }
        if (!file_exists($file->configPath)) {
            file_put_contents($file->configPath, include SETTINGS_PATTERN . '/PatternIni.php');
            $send = $this->send(1, $file->configPath);
        } else {
            $send = $this->send(0, $file->configPath);
        }

        return json_encode($send);
    }

    /**
     * Check exist file function
     *
     * @param string $file
     * @param integer $status
     * @return void
     */
    private function checkFileExist(string $file, int $status): void
    {
        if (!file_exists($file)) {
            die(json_encode(['status' => $status, 'name' => $file]));
        }
    }

    /**
     * Delete group function
     *
     * @param string $dirDelete
     * @return array
     */
    public function delete(string $dirName): string
    {
        $file = new File();
        $file->set($dirName);
        $ret = [];
        if (is_dir($file->folder)) {
            //check if exist ini file
            $this->checkFileExist($file->configPath, 4);
            try {
                // delete group from database
                Config::set($file->iniFullPath);
                $vk = new VkgroupModel();
                if ($idGroup = $vk->check(Vk::get()->idGroup)) {
                    $vk->remove($idGroup);
                } else {
                    die(json_encode(['status' => 3, 'name' => Vk::get()->idGroup]));
                }
            } catch (\Exception $e) {
                die(json_encode(['status' => 2]));
            }
            unlink($file->configPath);
            rmdir($file->folder);
            $ret = ['status' => 1, 'name' => 0];
        } else {
            $ret = ['status' => 0, 'name' => $file->folder];
        }

        return json_encode($ret);
    }
}
