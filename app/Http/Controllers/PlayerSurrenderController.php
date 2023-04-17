<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitiatePlayerSurrenderRequest;

class PlayerSurrenderController extends Controller
{
    /**
     * Initiate player surrender
     *
     * @param \App\Http\Requests\InitiatePlayerSurrenderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(InitiatePlayerSurrenderRequest $request)
    {
        $session = $request->session();

        /** @var \App\Objects\GameSession */
        $game = $session->get('game');

        $board = $game->getBoard();
        $player = $board->getNextPlayer();
        $game = $game->surrender($player);

        $session->put('game', $game);

        return redirect()->route('game-sessions.show');
    }
}
