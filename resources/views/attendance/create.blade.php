@extends('layouts.app')

@section('title', '勤怠登録')

@section('content')
    <div class="text-center pt-32">
        <p class="text-[18px] text-[#696969] font-bold bg-gray-300 rounded-full w-24 mx-auto">
            勤務外
        </p>
        <p class="mt-6 text-[36px]">
            {{ $today->isoFormat('YYYY年M月DD日(ddd)') }}
        </p>
        <p class="font-bold text-[80px]">
            {{ $nowTime }}
        </p>

        @if( $status === 'off' )
        <form action="{{ route('attendance.clockIn') }}" method="POST">
            @csrf
            <button type="submit" class="text-white font-bold text-[32px] bg-black w-40 h-14 rounded-xl mt-20">
                出勤
            </button>
        </form>
        @endif

        @if( $status === 'working' )
        <div class="flex gap-16 justify-center">
            <form action="{{ route('attendance.clockOut', $attendance) }}" method="POST">
                @csrf
                <button type="submit" class="text-white font-bold text-[32px] bg-black w-40 h-14 rounded-xl mt-20">
                    退勤
                </button>
            </form>
            <form action="{{ route('attendance.breakStart', $attendance) }}" method="POST">
                @csrf
                <button type="submit" class="text-black font-bold text-[32px] bg-white w-40 h-14 rounded-xl mt-20">
                    休憩入
                </button>
            </form>
        </div>
        @endif

        @if( $status === 'breaking' )
        <form action="{{ route('attendance.breakEnd', $attendance) }}" method="POST">
            @csrf
            <button type="submit" class="text-black font-bold text-[32px] bg-white w-40 h-14 rounded-xl mt-20">
                休憩戻
            </button>
        </form>
        @endif

        @if ($status === 'done')
        <p class="text-[32px] font-bold mt-16">お疲れさまでした。</p>
        @endif
    </div>
@endsection