<?php
namespace App\Http\Controllers;

use App\Models\Courses;
use App\Http\Requests\StoreCoursesRequest;
use App\Http\Requests\UpdateCoursesRequest;

class CoursesController extends Controller
{
    public function index()
    {
        return view('course.index', ['courses' => Courses::all()]);
    }

    public function trashed()
    {
        $courses = Courses::onlyTrashed()->get();
        return view('courses.trashed', ['courses' => $courses]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCoursesRequest $request)
    {
        Courses::create($request->validated());
        return redirect()->route('courses.index');
    }

    public function show(Courses $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Courses $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCoursesRequest $request, Courses $course)
    {
        $course->update($request->validated());
        return redirect()->route('courses.index');
    }

    public function trash($id)
    {
        Courses::destroy($id);
        return redirect()->route('courses.index');
    }

    public function destroy($id)
    {
        $course = Courses::withTrashed()->where('id', $id)->first();
        $course->forceDelete();
        return redirect()->route('courses.trashed');
    }

    public function restore($id)
    {
        $course = Courses::withTrashed()->where('id', $id)->first();
        $course->restore();
        return redirect()->route('courses.trashed');
    }
}
