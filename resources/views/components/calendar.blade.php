@extends('layouts.app')

@section('content')
    <div id="calendar"></div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new Calendar(calendarEl, {
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
