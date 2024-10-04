@extends('layouts.main')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex flex-col w-10/12 my-6 bg-white border rounded-lg shadow-sm md:flex-row border-slate-200">

            <!-- Image Section -->
            <div class="relative p-2.5 md:w-2/5 shrink-0 overflow-hidden">
                <img src="{{ $boat->image_url }}" alt="{{ $boat->name }}"
                    class="object-cover w-full h-full rounded-md md:rounded-lg" />
            </div>

            <!-- Content Section -->
            <div class="w-full p-6 md:w-3/5">
                <div class="flex items-center justify-between mb-4 mr-3">
                    <!-- Boat Name -->
                    <h4 class="text-xl font-semibold text-slate-800">{{ $boat->name }}</h4>

                    <!-- Back Button (X) -->
                    <a href="{{ route('boats.index') }}" title="Back" class="text-slate-800 hover:text-red-500">
                        <i class="text-2xl fa-solid fa-xmark"></i>
                    </a>
                </div>

                <!-- Boat Details -->
                <p>Niveau: {{ $boat->level_name }}</p>
                <p>Minimale bezetting: {{ $boat->min_cap }}
                    @if ($boat->min_cap == 1)
                        persoon
                    @else
                        personen
                    @endif
                </p>
                <p>Maximale capaciteit: {{ $boat->max_cap }}</p>

                <!-- Reserve Button -->
                <div>
                    @auth
                        <a href="{{ route('calendar', ['boat_id' => $boat->id]) }}"
                            class="flex items-center mt-4 text-sm font-semibold text-slate-800 hover:underline">
                            Reserveer deze boot
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login', ['boat_id' => $boat->id]) }}"
                            class="flex items-center mt-4 text-sm font-semibold text-slate-800 hover:underline">
                            Reserveer deze boot
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>


                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
