<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $game = session('game');

        return $game instanceof \App\Objects\GameSession
            && $game->getStatus() === \App\Enums\GameSessionStatus::Ongoing;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        /** @var \App\Objects\GameSession */
        $game = session('game');

        $board = $game->getBoard();

        return [
            'x' => ['required', 'integer', 'max:' . $board->getWidth()],
            'y' => ['required', 'integer', 'max:' . $board->getHeight()],
        ];
    }
}
