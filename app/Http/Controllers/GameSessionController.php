<?php

namespace App\Http\Controllers;

use App\Enums\GameSessionStatus;
use App\Http\Requests\UpdateGameSessionRequest;
use App\Objects\FourByFourBoard;
use App\Objects\GameSession;
use Illuminate\Http\Request;

class GameSessionController extends Controller
{
    /**
     * Start game session
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $session = $request->session();

        $board = new FourByFourBoard();
        $game = new GameSession($board);

        $session->put('game', $game);

        return redirect()->route('game-sessions.show');
    }

    /**
     * Show game session
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $session = $request->session();
        $game = $session->get('game');

        if (!$game instanceof GameSession) {
            return redirect()->route('home');
        }

        $board = $game->getBoard();
        $status = $game->getStatus();
        $winner = $game->getWinner();

        if ($status === GameSessionStatus::Finished) {
            $message = __('The game resulted in a draw.');

            if ($winner) {
                $message = __('Player :winner has won the game.', [
                    'winner' => $winner->value,
                ]);
            }

            session()->flash('success', $message);
        }

        return view('game-sessions.show', compact('board', 'game', 'status'));
    }

    /**
     * Update game session
     *
     * @param \App\Http\Requests\UpdateGameSessionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGameSessionRequest $request)
    {
        $session = $request->session();

        /** @var \App\Objects\GameSession */
        $game = $session->get('game');

        $board = $game->getBoard();

        $game = $game->update(
            $request->input('x'),
            $request->input('y'),
            $board->getNextPlayer(),
        );

        $session->put('game', $game);

        return redirect()->route('game-sessions.show');
    }
}
