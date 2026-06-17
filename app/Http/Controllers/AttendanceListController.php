<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceBreakTime;
use Illuminate\Support\Carbon;
use App\Http\Requests\AttendanceCorrectionRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceCorrection;
use App\Models\AttendanceCorrectionBreakTime;

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
     * 勤怠修正申請の作成
     * 
     * @param AttendanceCorrectionRequest $request
     * 
     * @return redirect
     */    
    public function store(AttendanceCorrectionRequest $request)
    {
        $data = $request->validated();
        
        $attendanceCorrection = AttendanceCorrection::create([
            'user_id' => Auth::id(),
            'attendance_id' => $request->input('id'),
            'corrected_work_date' => $data['work_date'],
            'corrected_clock_in_at' => $data['clock_in_at'],
            'corrected_clock_out_at' => $data['clock_out_at'],
            'status' => '0',
            'remarks' => $data['remarks'],
            'requested_date' => Carbon::today(),
        ]);

        foreach ($data['break_start_at'] as $index => $breakStart) {
            AttendanceCorrectionBreakTime::create([
                'correction_id' => $attendanceCorrection->id,
                'corrected_break_start_at' => $breakStart,
                'corrected_break_end_at' => $data['break_end_at'][$index],
            ]);
        }

        $id = $attendanceCorrection->attendance_id;

        return redirect()->route('attendanceList.show', compact('id'));
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
