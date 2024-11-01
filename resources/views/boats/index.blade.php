@extends('layouts.main') {{-- Extends the main layout template --}}

@section('content')
    <div class="flex flex-wrap justify-center">
        {{-- Loop through each boat in the collection --}}
        @foreach ($boats as $boat)
            <div class="flex flex-col items-center m-4 card w-72">
                {{-- Boat image container with a hover effect --}}
                <div class="relative w-full h-48 mb-4 card-image">
                    <img src="{{ $boat->image }}" class="object-cover w-full h-full rounded-t-lg"> {{-- Boat image --}}
                    {{-- Link overlay for more information on hover --}}
                    <a href="{{ route('boats.show', $boat->id) }}"
                        class="absolute inset-0 flex items-center justify-center font-semibold text-white transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 hover:opacity-100">
                        meer informatie
                    </a>
                </div>

                {{-- Boat details --}}
                <div class="flex flex-col items-start mb-8">
                    <h5 class="text-lg font-bold text-center card-title">{{ $boat->name }}</h5> {{-- Boat name --}}
                    <p class="">Niveau: {{ $boat->level_name }}</p> {{-- Boat level --}}
                    <p class="">
                        Minimale bezetting: {{ $boat->min_cap }}
                        {{-- Singular or plural for minimum capacity --}}
                        @if ($boat->min_cap == 1)
                            persoon
                        @else
                            personen
                        @endif
                    </p>

                    <p class="">Maximale capaciteit: {{ $boat->max_cap }}</p> {{-- Maximum capacity --}}

                    {{-- Reservation button, shown only to authenticated users --}}
                    @auth
                        <a href="{{ route('calendar', ['boat_id' => $boat->id]) }}"
                            class="px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-700 card-button reserve-button">
                            Reserveer
                        </a>
                        {{-- Redirects non-authenticated users to login --}}
                    @else
                        <a href="{{ route('login', ['boat_id' => $boat->id]) }}"
                            class="px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-700 card-button reserve-button">
                            Reserveer
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@endsection
