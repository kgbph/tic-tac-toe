@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('game-sessions.store') }}">
    @csrf
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ __('Start') }}
    </button>
</form>
@endsection