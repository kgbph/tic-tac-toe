@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="bg-green-500 text-white px-6 py-4 border-0 rounded relative mb-4">
    <span class="inline-block align-middle">
        {{ session('success') }}

        <form method="POST" action="{{ route('game-sessions.store') }}"
            class="absolute top-0 bottom-0 right-0 px-4 py-4">
            @csrf

            <button type="submit">
                {{ __('Restart?') }}
            </button>
        </form>
    </span>
</div>
@endif

<div class="grid grid-cols-{{ $board->getWidth() }} gap-2 bg-gray-800 p-4">
    @for ($x = 0; $x < $board->getWidth(); $x++)
        @for ($y = 0; $y < $board->getHeight(); $y++)
            @php
                $cell = $board->getCell($x, $y);
                $disabled = $cell->getPlayer() || $status === \App\Enums\GameSessionStatus::Finished;
            @endphp

            <x-cell :cell="$cell" :disabled="$disabled" />
        @endfor
    @endfor
</div>
@endsection