@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="w-5/6">
            <div class="fc-calendar">
                <!-- Calendar Header -->
                <div class="flex items-center justify-between px-2 py-4 md:px-4">
                    <h2 class="text-lg font-semibold text-gray-900" id="calendar-title"></h2>
                    <div class="flex items-center space-x-4">
                        <div
                            class="flex text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm">
                            <button id="prev-button" class="text-gray-500 hover:bg-gray-100 px-2 py-[6px] rounded-l-md">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button id="today-button" class="font-medium text-black hover:bg-gray-100 px-2 py[6px]">
                                Today
                            </button>
                            <button id="next-button" class="px-2 py-3 text-gray-500 rounded-r-md hover:bg-gray-100">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Dropdown -->
                        <div class="relative inline-block text-left">
                            <button type="button"
                                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-black bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100"
                                id="dropdownMenuButton" aria-expanded="true" aria-haspopup="true">
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="dropdownMenu"
                                class="absolute right-0 z-50 hidden w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="dropdownMenuButton">
                                <div class="py-1" role="none">
                                    <a href="#" id="dropdown-view-month" class="block px-4 py-2 text-sm text-gray-700"
                                        role="menuitem">Month</a>
                                    <a href="#" id="dropdown-view-week" class="block px-4 py-2 text-sm text-gray-700"
                                        role="menuitem">Week</a>
                                    <a href="#" id="dropdown-view-day" class="block px-4 py-2 text-sm text-gray-700"
                                        role="menuitem">Day</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar -->
                <div id="calendar" class="overflow-hidden bg-white rounded-lg shadow"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var dropdownMenuButton = document.getElementById('dropdownMenuButton');
                var dropdownMenu = document.getElementById('dropdownMenu');

                var svgIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="inline-block w-3 h-3 mt-1 ml-2 text-gray-500 transition-transform duration-300">
            <path fill="currentColor" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
        </svg>`;

                var calendar = new window.Calendar(calendarEl, {
                    plugins: [window.timeGridPlugin, window.dayGridPlugin],
                    initialView: 'timeGridWeek',
                    allDaySlot: false,
                    headerToolbar: false, // Disable default toolbar
                    views: {
                        week: {
                            titleFormat: {
                                year: 'numeric',
                                month: 'long' // Only display month and year
                            },
                            dayHeaderContent: (args) => {
                                const day = args.date.toLocaleDateString('en-US', {
                                    weekday: 'short'
                                });
                                const dayNumber = args.date.getDate();
                                return {
                                    html: `<span class="fc-daygrid-day">${day}</span> <span class="fc-daygrid-daynumber">${dayNumber}</span>`
                                };
                            }
                        }
                    },
                    businessHours: {
                        daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
                        startTime: '08:00',
                        endTime: '18:00',
                    },
                    height: 530,
                    slotMinTime: '00:00:00',
                    slotMaxTime: '23:59:59',
                    scrollTime: '07:30:00',
                    events: @json($events),

                    // This function is called every time the view is set
                    datesSet: function(info) {
                        document.getElementById('calendar-title').textContent = info.view.title;

                        // Update the dropdown label to reflect the current view
                        updateDropdownLabel(info.view.type);
                    }
                });
                calendar.render();

                // Event listeners for custom buttons
                document.getElementById('prev-button').addEventListener('click', function() {
                    calendar.prev();
                });

                document.getElementById('next-button').addEventListener('click', function() {
                    calendar.next();
                });

                document.getElementById('today-button').addEventListener('click', function() {
                    calendar.today();
                });

                // Dropdown toggle functionality
                dropdownMenuButton.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');
                    // Toggle the rotate-180 class for the flip animation
                    dropdownMenuButton.querySelector('svg').classList.toggle('rotate-180');
                });

                document.addEventListener('click', function(e) {
                    if (!dropdownMenuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.add('hidden');
                        // Ensure the icon returns to the original position when clicking outside
                        dropdownMenuButton.querySelector('svg').classList.remove('rotate-180');
                    }
                });

                // View change handlers
                document.getElementById('dropdown-view-month').addEventListener('click', function() {
                    calendar.changeView('dayGridMonth');
                    dropdownMenu.classList.add('hidden');
                });

                document.getElementById('dropdown-view-week').addEventListener('click', function() {
                    calendar.changeView('timeGridWeek');
                    dropdownMenu.classList.add('hidden');
                });

                document.getElementById('dropdown-view-day').addEventListener('click', function() {
                    calendar.changeView('timeGridDay');
                    dropdownMenu.classList.add('hidden');
                });

                // Function to update the dropdown button label
                function updateDropdownLabel(viewType) {
                    switch (viewType) {
                        case 'dayGridMonth':
                            dropdownMenuButton.innerHTML = 'Month View' + svgIcon;
                            break;
                        case 'timeGridWeek':
                            dropdownMenuButton.innerHTML = 'Week View' + svgIcon;
                            break;
                        case 'timeGridDay':
                            dropdownMenuButton.innerHTML = 'Day View' + svgIcon;
                            break;
                        default:
                            dropdownMenuButton.innerHTML = 'View' + svgIcon;
                    }
                }

                // Set the initial dropdown label based on the initial view
                updateDropdownLabel(calendar.view.type);
            });
        </script>
    @endpush
@endsection
