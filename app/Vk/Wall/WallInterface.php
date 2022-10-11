<?php 

namespace Vktote\Vk\Wall;

use Generator;

/**
 * Wall interface
 * 
 * @license 
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface WallInterface
{
    /**
     * Get clean wall array
     *
     * @return \Generator
     */
    public function get(): Generator;
}