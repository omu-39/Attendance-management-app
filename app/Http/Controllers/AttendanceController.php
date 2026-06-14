<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\AttendanceBreakTime;

class AttendanceController extends Controller
{
    /**
     * 勤怠登録画面の表示
     * 
     * @return view
     */
    public function index()
    {
        $today = Carbon::today();
        $nowTime = Carbon::now()->format('H:i');
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('work_date', $today)
            ->first();

        $status = $attendance?->getStatus() ?? 'off';

        return view('attendance.create', compact('today', 'nowTime', 'status', 'attendance'));
    }

    /**
     * 出勤日時の保存処理
     * 
     * 出勤ボタンが押された時の時間を保存
     * 
     * @return redirect
     */
    public function clockIn()
    {
        $today = Carbon::today();
        $nowTime = Carbon::now();

        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            'work_date' => $today,
            'clock_in_at' => $nowTime,
        ]);

        return redirect()->route('attendance.index', compact('attendance'));
    }

    /**
     * 退勤日時の保存処理
     * 
     * 退勤ボタンが押された時の時間を保存
     * 
     * @return redirect
     */
    public function clockOut(Attendance $attendance)
    {
        $nowTime = Carbon::now();

        $attendance->update([
            'clock_out_at' => $nowTime,
        ]);

        return redirect()->route('attendance.index', compact('attendance'));
    }

    /**
     * 休憩に入った時間の保存処理
     * 
     * 休憩入ボタンが押された時の時間を保存
     * 
     * @return redirect
     */
    public function breakStart(Attendance $attendance)
    {
        $nowTime = Carbon::now();
        
        AttendanceBreakTime::Create([
            'attendance_id' => $attendance->id,
            'break_start_at' => $nowTime,
        ]);

        return redirect()->route('attendance.index', compact('attendance'));
    }

    /**
     * 休憩から戻った時間の保存処理
     * 
     * 休憩戻ボタンが押された時の時間を保存
     * 
     * @return redirect
     */
    public function breakEnd(Attendance $attendance)
    {
        $nowTime = Carbon::now();

        $breakTime = $attendance->breakTimes()->whereNull('break_end_at')->firstOrFail();
        $breakTime->update([
            'break_end_at' => $nowTime,
        ]);

        return redirect()->route('attendance.index', compact('attendance'));
    }
}