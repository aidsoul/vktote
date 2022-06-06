<?php

namespace Vktote\DataBase;

/**
 * Help trait
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
trait Help
{

    /**
     * @var string
     */
    private string $tableName;

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->getClassName();
    }

    /**
     * Get class name function
     *
     * @return void
     */
    private function getClassName(): void
    {
        $this->tableName = mb_strtolower((new \ReflectionClass($this))->getShortName());
    }
}
