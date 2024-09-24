<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CalendarController extends Controller
{
    public function __invoke()
    {
        $events = [];

        $courses = Course::all();

        foreach ($courses as $course) {
            $events[] = [
                'title' => $course->name,
                'start' => $course->start_date,
                'end' => $course->end_date,
            ];
        }

        return view('components.calendar', compact('events'));
    }
}
