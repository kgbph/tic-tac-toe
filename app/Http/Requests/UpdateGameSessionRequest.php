<?php

namespace App\Http\Requests;

use App\Enums\GameSessionStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGameSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $status = session('status');
        $board = session('board');

        return $status === GameSessionStatus::Ongoing->value
            && $board instanceof \App\Objects\AbstractBoard;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        /** @var \App\Objects\AbstractBoard */
        $board = session('board');

        return [
            'x' => ['required', 'integer', 'max:' . $board->getWidth()],
            'y' => ['required', 'integer', 'max:' . $board->getHeight()],
        ];
    }
}
