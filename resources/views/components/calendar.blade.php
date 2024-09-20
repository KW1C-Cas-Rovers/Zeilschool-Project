@extends('layouts.app')

@section('content')
    <div id="calendar"></div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridWeek',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '19:00:00',
                    events: @json($events),
                });
                calendar.render();
            });
        </script>
    @endpush
@endsection
