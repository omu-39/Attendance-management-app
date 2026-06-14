@extends('layouts.app')

@section('title', '勤怠登録')

@section('content')
    <div class="w-[900px] mx-auto pt-20">
        <h1 class="font-bold text-[30px] pl-4 border-l-8 border-black">勤怠一覧</h1>

        <div class="flex justify-between bg-white rounded-xl px-6 h-[60px] text-[18px] text-[#737373] font-bold">
            <button id="prev-btn" class="flex items-center">
                <div class="h-4 pr-2"><img src="/images/arrow.svg" alt="←" class="w-full h-full"></div>
                前月
            </button>
            <div class="flex items-center">
                <div class="pr-2">
                    <img src="/images/calender.svg" alt="calender">
                </div>
                <span class="text-[20px] text-black">{{ $month }}</span>
            </div>
            <button id="prev-btn" class="flex items-center">
                翌月
                <div class="h-4 pl-2"><img src="/images/arrow.svg" alt="←" class="w-full h-full rotate-180"></div>
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>日付</th>
                    <th>出勤</th>
                    <th>退勤</th>
                    <th>休憩</th>
                    <th>合計</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->work_date }}</td>
                    <td>{{ $attendance->clock_in_at }}</td>
                    <td>{{ $attendance->clock_out_at }}</td>
                    <td>{{ $attendance->clock_in_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

