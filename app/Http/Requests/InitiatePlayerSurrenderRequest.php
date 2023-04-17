<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitiatePlayerSurrenderRequest extends FormRequest
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
        return [];
    }
}
