@extends('layouts.main')

@section('content')
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>

    <div class="flex flex-wrap justify-center">
        @foreach ($boats as $boat)
            <div class="flex flex-col items-center m-4 card">
                <div class="mb-4 card-image">
                    <img src="{{ $boat->image }}" class="object-cover h-62 card-img-top">
                </div>
                <div class="flex flex-col items-start">
                    <h5 class="text-lg font-bold text-center card-title">{{ $boat->name }}</h5>
                    <p class="">Level: {{ $boat->level_name }}</p>
                    <p class="">Min Capacity: {{ $boat->min_cap }}</p>
                    <p class="">Max Capacity: {{ $boat->max_cap }}</p>
                    @auth
                        <a href="{{ url('/reserve') }}/{{ $boat->id }}"
                            class="px-4 py-2 mt-2 text-white bg-blue-500 rounded card-button reserve-button">
                            Reserve
                        </a>
                    @else
                        <a href="{{ route('login') }}?redirect={{ url('/reserve') }}/{{ $boat->id }}"
                            class="px-4 py-2 mt-2 text-white bg-blue-500 rounded card-button reserve-button">
                            Reserve
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@endsection
