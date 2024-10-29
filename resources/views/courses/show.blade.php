@extends('layouts.main')

@section('content')
    <div class="fixed inset-0 z-10 flex items-center justify-center p-4 overflow-y-auto" id="headlessui-dialog-panel-:r7:"
        role="dialog" aria-modal="true">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
            {{-- close --}}
            <div class="flex justify-end">
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            {{--  --}}
            <div class="text-center">
                {{--  --}}
                <h3 class="mt-4 text-lg font-medium leading-6 text-gray-900" id="headlessui-dialog-title-:r8:">
                    Reservering
                    voor {{ $course->start_date }} tot {{ $course->end_date }}</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">{{ $course->descripton }}</p>
                </div>
            </div>
            <div class="flex justify-end mt-5 space-x-3 sm:mt-6">
                <button type="button"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Annuleer
                    reservering</button>
                <button type="button"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-transparent rounded-md hover:bg-blue-700">Bevestig
                    reservering</button>
            </div>
        </div>
    </div>
@endsection
