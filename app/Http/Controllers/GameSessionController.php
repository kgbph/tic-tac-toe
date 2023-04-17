<?php

namespace App\Http\Controllers;

use App\Enums\GameSessionStatus;
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
}
