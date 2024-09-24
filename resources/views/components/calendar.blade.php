@extends('layouts.app')

@section('content')
    <div class="items-center justify-center h-1/2">
        <div id="calendar" class="absolute w-5/6"></div>
        <div class="relative inline-block text-left">
            <div>
                <button type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                    id="dropdownMenuButton" aria-expanded="true" aria-haspopup="true">
                    Views
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="dropdownMenuButton">
                <div class="py-1" role="none">
                    <!-- Dropdown Options -->
                    <a href="#" id="dropdown-view-month" class="text-gray-700 block px-4 py-2 text-sm"
                        role="menuitem">Month</a>
                    <a href="#" id="dropdown-view-week" class="text-gray-700 block px-4 py-2 text-sm"
                        role="menuitem">Week</a>
                    <a href="#" id="dropdown-view-day" class="text-gray-700 block px-4 py-2 text-sm"
                        role="menuitem">Day</a>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new window.Calendar(calendarEl, {
                    plugins: [window.timeGridPlugin, window.dayGridPlugin],
                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        left: 'title',
                        right: 'prev,today,next',
                    },
                    views: {
                        week: {
                            titleFormat: {
                                year: 'numeric',
                                month: 'long'
                            },
                            dayHeaderFormat: {
                                weekday: 'short',
                            },
                        },
                    },
                    businessHours: {
                        daysOfWeek: [0, 1, 2, 3, 4, 5, 6], // Sunday - Saterday

                        startTime: '8:00', // a start time (10am in this example)
                        endTime: '20:00', // an end time (6pm in this example)
                    },
                    height: '80%',
                    slotMinTime: '00:00:00',
                    slotMaxTime: '23:59:99',
                    events: @json($events),
                });
                calendar.render();

                document.getElementById('dropdown-view-month').addEventListener('click', function() {
                    calendar.changeView('dayGridMonth');
                });
                document.getElementById('dropdown-view-week').addEventListener('click', function() {
                    calendar.changeView('timeGridWeek');
                });
                document.getElementById('dropdown-view-day').addEventListener('click', function() {
                    calendar.changeView('timeGridDay');
                });
            });
        </script>
    @endpush
@endsection
