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
     * Last player
     *
     * @var int
     */
    protected $lastPlayer = 0;

    /**
     * Board constructor
     *
     * @return void
     */
    public function __construct()
    {
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $this->cells[$x][$y] = new Cell($x, $y);
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
     * Tag cell
     *
     * @param int $x
     * @param int $y
     * @param int $player
     * @return self
     */
    public function tagCell($x, $y, $player)
    {
        $cell = $this->getCell($x, $y);

        if ($cell instanceof \App\Objects\Cell) {
            $cell = $cell->setPlayer($player);

            $this->cells[$x][$y] = $cell;
            $this->lastPlayer = $player;
        }

        return $this;
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

    /**
     * Get next player
     *
     * @var int
     */
    public function getNextPlayer()
    {
        $max = (int) config('game.max_players');

        $nextPlayer = $this->lastPlayer + 1;
        if ($nextPlayer > $max) {
            $nextPlayer = 1;
        }

        return $nextPlayer;
    }
}
