@extends('layouts.app')

@section('content')
<div class="grid grid-cols-{{ $board->getWidth() }} gap-2 bg-gray-800 p-4">
    @for ($x = 0; $x < $board->getWidth(); $x++)
        @for ($y = 0; $y < $board->getHeight(); $y++)
            <x-cell :cell="$board->getCell($x, $y)" />
        @endfor
    @endfor
</div>
@endsection