@props(['cell'])

<form method="POST" action="{{ route('game-sessions.update') }}">
    @csrf
    @method('put')

    <input type="hidden" name="x" value="{{ $cell->x }}">
    <input type="hidden" name="y" value="{{ $cell->y }}">
    <input type="hidden" name="player" value="1">

    <button type="submit"
        class="w-32 h-32 bg-gray-900 flex justify-center items-center text-3xl text-white font-bold">
        @switch($cell->getPlayer())
            @case(1)
                {{ __('X') }}
                @break
            @case(2)
                {{ __('O') }}
                @break
            @default
                {{ __('') }}
        @endswitch
    </button>
</form>