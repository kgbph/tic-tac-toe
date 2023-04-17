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
     * Class constructor
     *
     * @param int $x
     * @param int $y
     * @return void
     */
    public function __construct(
        public $x,
        public $y
    ) {
    }

    /**
     * Get cell occupier
     *
     * @return null|int
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set cell occupier
     *
     * @param int $player
     * @return self
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }
}
