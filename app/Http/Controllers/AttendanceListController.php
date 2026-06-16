<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceBreakTime;
use Illuminate\Support\Carbon;

class AttendanceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = Carbon::now()->format('Y/m');
        $attendances = Attendance::with('attendanceBreakTimes', 'user')
            ->whereMonth('work_date', now()->month)
            ->get();

        return view('attendance.index', compact('month', 'attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);
        $breakTimes = AttendanceBreakTime::where('attendance_id', $id)->get();
        return view('attendance.show', compact('attendance', 'breakTimes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
