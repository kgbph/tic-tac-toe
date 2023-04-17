<?php

namespace App\Http\Controllers;

use App\Enums\GameSessionStatus;
use App\Http\Requests\UpdateGameSessionRequest;
use App\Objects\FourByFourBoard;
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

        $session->put('status', GameSessionStatus::Ongoing->value);
        $session->put('board', new FourByFourBoard());

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

        $status = $session->get('status');
        $board = $session->get('board');

        if (
            $status !== GameSessionStatus::Ongoing->value
            || !($board instanceof \App\Objects\AbstractBoard)
        ) {
            return redirect()->route('home');
        }

        return view('game-sessions.show', compact('board'));
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

        /** @var \App\Objects\AbstractBoard */
        $board = $session->get('board');

        $board = $board->tagCell(
            $request->input('x'),
            $request->input('y'),
            $board->getNextPlayer(),
        );

        $session->put('board', $board);

        return redirect()->route('game-sessions.show');
    }
}
