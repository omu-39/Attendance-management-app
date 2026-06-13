<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * 勤怠登録画面の表示
     * 
     * @return view
     */
    public function index()
    {
        $today = Carbon::today()->locale('ja');
        $nowTime = Carbon::now()->format('H:i');
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('work_date', Carbon::today())
            ->first();

        return view('attendance.create', compact('today', 'nowTime', 'attendance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workDate = Carbon::today();
        $clockIn = Carbon::now();

        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            'work_date' => $workDate,
            'clock_in_at' => $clockIn,
        ]);

        return redirect()->route('attendance.index', compact('attendance'));
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
        //
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
