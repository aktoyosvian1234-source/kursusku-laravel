<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;


class CourseController extends Controller
{
    /** READ (daftar) */
    public function index()
    {
        $courses = Course::latest()->get();

        $stats = [
            'total'  => $courses->count(),
            'open'   => $courses->where('status', 'open')->count(),
            'draft'  => $courses->where('status', 'draft')->count(),
            'closed' => $courses->where('status', 'closed')->count(),
        ];

        return view('courses.index', compact('courses', 'stats'));
    }

    /** CREATE (form) */
    public function create()
    {
        return view('courses.create');
    }

    /** CREATE (simpan). Data sudah lolos StoreCourseRequest. */
    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil ditambahkan.');
    }

    /** READ (detail). Route model binding: {course} otomatis menjadi objek Course. */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /** UPDATE (form) */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /** UPDATE (simpan). Data sudah lolos UpdateCourseRequest. */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return to_route('courses.show', $course)
            ->with('success', 'Kursus berhasil diperbarui.');
    }

    /** DELETE */
    public function destroy(Course $course)
    {
        $course->delete();

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}