<?php

namespace App\Objects;

use App\Enums\GameSessionStatus;

class GameSession
{
    /**
     * Game board
     *
     * @var \App\Objects\AbstractBoard
     */
    protected $board;

    /** 
     * Game status
     *
     * @var \App\Enums\GameSessionStatus
     */
    protected $status;

    /**
     * Game winner
     *
     * @var null|\App\Enums\Player
     */
    protected $winner;

    /**
     * Class constructor
     *
     * @param \App\Objects\AbstractBoard $board
     * @return void
     */
    public function __construct(AbstractBoard $board)
    {
        $this->board = $board;
        $this->status = GameSessionStatus::Ongoing;
    }

    /**
     * Get the game board object
     *
     * @return \App\Objects\AbstractBoard
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * Get the game status
     *
     * @return \App\Enums\GameSessionStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the game winner
     *
     * @return \App\Enums\Player
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Update game session
     *
     * @param int $x
     * @param int $y
     * @param \App\Enums\Player $player
     * @return self
     */
    public function update($x, $y, $player)
    {
        $this->board->tagCell($x, $y, $player);

        if (
            $this->board->hasColumnStreak($player)
            || $this->board->hasRowStreak($player)
            || $this->board->hasForwardDiagonalStreak($player)
            || $this->board->hasBackwardDiagonalStreak($player)
        ) {
            $this->status = GameSessionStatus::Finished;
            $this->winner = $player;
        }

        if (!$this->board->hasAvailableSpace()) {
            $this->status = GameSessionStatus::Finished;
        }

        return $this;
    }
}
