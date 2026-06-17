@extends('layouts.app')

@section('title', '勤怠詳細')

@section('content')
    <div class="w-[900px] mx-auto pt-20">
        <h1 class="font-bold text-[30px] pl-4 border-l-8 border-black">勤怠詳細</h1>

        <form action="" method="post">
            @csrf
            <table class="mt-8 w-full bg-white text-[16px] font-bold text-center rounded-xl tracking-widest table-fixed">
                <colgroup>
                    <col class="w-[200px]">
                    <col>
                    <col class="w-[20px]">
                    <col >
                </colgroup>
                <tr class="table-row">
                    <th class="table-heading">名前</th>
                    <td>{{ $attendance->user->name }}</td>
                </tr>
                <tr class="table-row">
                    <th class="table-heading">日付</th>
                    <td>{{ $attendance->work_date?->isoFormat('YYYY年') }}</td>
                    <td></td>
                    <td>{{ $attendance->work_date?->isoFormat('MM/DD(ddd)') }}</td>
                </tr>
                <tr class="table-row">
                    <th class="table-heading">出勤・退勤</th>
                    <td><input type="time" name="clock_in_time" class="input-time" value={{ $attendance->clock_in_at?->isoFormat('HH:mm') }}></td>
                    <td>～</td>
                    <td><input type="time" name="clock_out_time" class="input-time" value={{ $attendance->clock_out_at?->isoFormat('HH:mm') }}></td>
                </tr>
                @foreach ($breakTimes as $breakTime)
                <tr class="table-row">
                    <th class="table-heading">休憩{{ $loop->iteration === 1 ? '' : $loop->iteration }}</th>
                    <td><input type="time" name="break_start_time" class="input-time" value={{ $breakTime->break_start_at?->isoFormat('HH:mm') }}></td>
                    <td>～</td>
                    <td><input type="time" name="break_end_time" class="input-time" value={{ $breakTime->break_end_at?->isoFormat('HH:mm') }}></td>
                </tr>
                @endforeach
                <tr class="table-row">
                    <th class="table-heading">休憩{{ $breakTimes->count() === 1 ? 2 : $breakTimes->count() + 1 }}</th>
                    <td><input type="time" name="break_start_time" class="input-time"></td>
                    <td>～</td>
                    <td><input type="time" name="break_end_time" class="input-time"></td>
                </tr>
                <tr class="h-32">
                    <th class="table-heading">備考</th>
                    <td colspan="3" class="px-[120px]"><textarea name="remarks" id="remarks" class="w-full resize-none border-2 border-[##E1E1E1] rounded-md h-full"></textarea></td>
                </tr>
            </table>
            <button type="submit" class="bg-black font-bold text-[20px] text-white w-[130px] py-2 rounded-md mt-8 block ml-auto">修正</button>

            <input type="hidden" name="name" value={{ $attendance->user->name }}>
            <input type="hidden" name="date" value={{ $attendance->work_date }}>
        </form>
    </div>
@endsection