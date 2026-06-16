@extends('layouts.app')

@section('title', '勤怠詳細')

@section('content')
    <div class="w-[900px] mx-auto pt-20">
        <h1 class="font-bold text-[30px] pl-4 border-l-8 border-black">勤怠詳細</h1>

        <form action="" method="post">
            @csrf
            <table class="mt-8 w-full bg-white text-[16px] font-bold text-center rounded-xl tracking-widest">
                <tr class="h-10">
                    <th>名前</th>
                    <td>{{ $attendance->getUserName() }}</td>
                </tr>
                <tr>
                    <th>日付</th>
                    <td>{{ $attendance->work_date?->isoFormat('YYYY年') }}</td>
                    <td>{{ $attendance->work_date?->isoFormat('MM/DD(ddd)') }}</td>
                </tr>
                <tr>
                    <th>出勤・退勤</th>
                    <td>{{ $attendance->clock_in_at }}</td>
                    <span>～</span>
                    <td>{{ $attendance->clock_out_at }}</td>
                </tr>
                @foreach ($breakTimes as $breakTime)
                <tr>
                    <th>休憩</th>
                    <td>{{ $breakTime->break_start_at }}</td>
                    <span>～</span>
                    <td>{{ $breakTime->break_end_at }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>備考</th>
                    <td><textarea name="remarks" id="remarks"></textarea></td>
                </tr>
            </table>
        </form>
    </div>
@endsection