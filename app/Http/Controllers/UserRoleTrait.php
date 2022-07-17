<?php

namespace Vktote\Http\Controllers;

/**
 * UserRoleTrait trait
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
trait UserRoleTrait
{
    public function __construct()
    {
        parent::__construct();
        $this->role();
    }
}
