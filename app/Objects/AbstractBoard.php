<?php

namespace App\Objects;

abstract class AbstractBoard
{
    /**
     * Board cells
     *
     * @var array
     */
    protected $cells;

    /**
     * Board height
     *
     * @var int
     */
    protected $height;

    /**
     * Board width
     *
     * @var int
     */
    protected $width;

    /**
     * Board constructor
     *
     * @return void
     */
    public function __construct()
    {
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $this->cells[$x][$y] = new Cell();
            }
        }
    }

    /**
     * Get cell
     *
     * @param int $x
     * @param int $y
     * @return null|\App\Objects\Cell
     */
    public function getCell($x, $y)
    {
        return $this->cells[$x][$y] ?? null;
    }

    /**
     * Get height
     *
     * @var int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get width
     *
     * @var int
     */
    public function getWidth()
    {
        return $this->width;
    }
}
