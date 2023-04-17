@props(['cell', 'disabled'])

<form method="POST" action="{{ route('game-sessions.update') }}">
    @csrf
    @method('put')

    <input type="hidden" name="x" value="{{ $cell->x }}">
    <input type="hidden" name="y" value="{{ $cell->y }}">

    <button type="submit"
        class="w-32 h-32 bg-gray-900 flex justify-center items-center text-3xl text-white font-bold"
        @disabled($disabled)>
        @switch($cell->getPlayer())
            @case(\App\Enums\Player::One)
                {{ __('X') }}
                @break
            @case(\App\Enums\Player::Two)
                {{ __('O') }}
                @break
            @default
                {{ __('') }}
        @endswitch
    </button>
</form>