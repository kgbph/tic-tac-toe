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

        return view('game-sessions.show');
    }
}
