<?php

namespace Vktote\File;

/**
 * File class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class File
{
    private string $folder;
    private string $configPath;
    private string $iniFile;
    private string $iniFullPath;
    private string $phpPath;

    /**
     * Set function
     *
     * @param string $data $_POST or $_GET
     * @return void
     */
    public function set(string $data):void
    {
        if (!empty($data)) {
            $this->folder = PATH_GROUP_FOLDER.'/'.$data;
            $this->configPath = $this->folder.'/'.GROUP_CONFIG;
            $this->iniFile = GROUP_CONFIG;
            $this->iniFullPath = $this->folder.'/'.GROUP_CONFIG;
            $this->phpPath = $this->folder.'/'.GROUP_PHP;
        }
    }

    /**
     * __get function
     *
     * @param string $name
     * @return void
     */
    public function __get(string $name)
    {
        return $this->$name;
    }
}
