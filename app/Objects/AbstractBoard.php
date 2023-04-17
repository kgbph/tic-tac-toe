<?php

namespace App\Objects;

use App\Enums\Player;

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
     * @var \App\Enums\Player
     */
    protected $lastPlayer;

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
     * @param \App\Enums\Player $player
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
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get last player
     *
     * @return \App\Enums\Player
     */
    public function getLastPlayer()
    {
        return $this->lastPlayer;
    }

    /**
     * Get next player
     *
     * @return \App\Enums\Player
     */
    public function getNextPlayer()
    {
        return match ($this->lastPlayer) {
            Player::One => Player::Two,
            Player::Two => Player::One,
            default => Player::One,
        };
    }

    /**
     * Check if has column streak
     *
     * @param \App\Enums\Player $player
     * @return bool
     */
    public function hasColumnStreak($player)
    {
        $width = $this->getWidth();
        $height = $this->getHeight();

        for ($x = 0; $x < $width; $x++) {
            $streak = 0;

            for ($y = 0; $y < $height; $y++) {
                $cell = $this->getCell($x, $y);
                if (
                    $cell instanceof \App\Objects\Cell
                    && $cell->getPlayer() === $player
                ) {
                    $streak++;
                }
            }

            if ($streak === $height) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if has row streak
     *
     * @param \App\Enums\Player $player
     * @return bool
     */
    public function hasRowStreak($player)
    {
        $width = $this->getWidth();
        $height = $this->getHeight();

        for ($y = 0; $y < $height; $y++) {
            $streak = 0;

            for ($x = 0; $x < $width; $x++) {
                $cell = $this->getCell($x, $y);
                if (
                    $cell instanceof \App\Objects\Cell
                    && $cell->getPlayer() === $player
                ) {
                    $streak++;
                }
            }

            if ($streak === $width) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if has forward diagonal streak
     *
     * @param \App\Enums\Player $player
     * @return bool
     */
    public function hasForwardDiagonalStreak($player)
    {
        $width = $this->getWidth();
        $height = $this->getHeight();

        if ($width === $height) {
            $streak = 0;

            for ($x = 0; $x < $width; $x++) {
                $cell = $this->getCell($x, $x);
                if (
                    $cell instanceof \App\Objects\Cell
                    && $cell->getPlayer() === $player
                ) {
                    $streak++;
                }
            }

            if ($streak === $width) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if has backward diagonal streak
     *
     * @param \App\Enums\Player $player
     * @return bool
     */
    public function hasBackwardDiagonalStreak($player)
    {
        $width = $this->getWidth();
        $height = $this->getHeight();

        if ($width === $height) {
            $streak = 0;

            for ($x = 0; $x < $width; $x++) {
                $cell = $this->getCell($x, $width - $x - 1);
                if (
                    $cell instanceof \App\Objects\Cell
                    && $cell->getPlayer() === $player
                ) {
                    $streak++;
                }
            }

            if ($streak === $width) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if has available space
     *
     * @return bool
     */
    public function hasAvailableSpace()
    {
        $width = $this->getWidth();
        $height = $this->getHeight();

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $cell = $this->getCell($x, $y);
                if (
                    $cell instanceof \App\Objects\Cell
                    && $cell->getPlayer() === null
                ) {
                    return true;
                }
            }
        }

        return false;
    }
}
