<?php

Course::query()->where('user_id', request()->user()->id)->orderBy("","=", $course->id)-paginate(10);

return view("view.name", ["key"=>$value]);


@foreach ($courses as $course) {
    $course->course
}

Str::words($course->course, 30); // how many words of the string

route("/our_route", $course); // pass var to the thing

$data = $request->validate([
    'note' => ['required','string',''],
])

to_route('course.show', $course)->with('message', 'test was created');