@props(['cell'])

<button type="button" class="bg-gray-900 w-32 h-32 flex justify-center items-center text-3xl text-white font-bold">
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