@extends('layouts.main')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex flex-col w-10/12 my-6 bg-white border rounded-lg shadow-sm md:flex-row border-slate-200">
            <div class="relative p-2.5 md:w-2/5 shrink-0 overflow-hidden">
                <img src="{{ $boat->image }}" alt="card-image" class="object-cover w-full h-full rounded-md md:rounded-lg" />
            </div>
            <div class="p-6">
                <div>
                    <h4 class="flex items-center justify-between mb-2 mr-3 text-xl font-semibold text-slate-800">
                        <p>{{ $boat->name }}</p>
                        <a href="{{ route('courses') }}" title="Back">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </h4>
                </div>
                <p class="mb-8 font-light leading-normal text-slate-600">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Unde eligendi consequuntur expedita sit eum
                    odio
                    voluptatem velit aliquam exercitationem nulla consectetur labore iste sunt, sequi corporis ex itaque
                    suscipit aut maxime quidem! Laboriosam possimus aliquam explicabo libero fugit officia. Omnis, nisi
                    sequi
                    dolorum velit hic beatae corrupti odit labore officiis, minus dolor fugiat! Recusandae asperiores a
                    earum,
                    eius est placeat! Laudantium obcaecati culpa, ea nostrum ipsam sapiente consequuntur amet ab, modi
                    excepturi
                    pariatur omnis at eaque nesciunt quod sit voluptas numquam reprehenderit magnam! Quas commodi eum
                    temporibus
                    sed quisquam rem ex, perferendis natus illum corporis ducimus recusandae qui enim ullam!
                </p>
                <div>
                    <a href="#" class="flex items-center text-sm font-semibold text-slate-800 hover:underline">
                        Reserve course
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
