@extends('layouts.main')

@section('content')
    <div class="m-10 max-w-sm border border-gray-200 rounded-lg shadow bg-[#93D694]">
        <div class="card-image">
            <img src="{{ $boat->image }}" class="card-img-top">
        </div>
        <div class="">
            <h5 class="card-title">{{ $boat->name }}</h5>
            <p class="card-text">Level: {{ $boat->level_name }}</p>
            <p class="card-text">Min Capacity: {{ $boat->min_cap }}</p>
            <p class="card-text">Max Capacity: {{ $boat->max_cap }}</p>
            <p class="card-text">Boat ID: {{ $boat->id }}</p>
        </div>
    </div>
    <div>

    </div>
@endsection
