<?php

namespace App\Objects;

class Cell
{
    /**
     * Cell occupier
     *
     * @var null|int
     */
    protected $player = null;

    /**
     * Get cell occupier
     *
     * @return null|int
     */
    public function getPlayer()
    {
        return $this->player;
    }
}
