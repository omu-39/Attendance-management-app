@extends('layouts.app')

@section('title', '勤怠登録')

@section('content')
        <div class="w-full text-center">
            <p class="text-[18px] text-[#696969] font-bold bg-gray-300 rounded-full w-24 mx-auto mt-32">
                勤務外
            </p>
            <p class="mt-6 text-[36px]">
                {{ $today->isoFormat('YYYY年M月DD日(ddd)') }}
            </p>
            <p class="font-bold text-[80px]">
                {{ $nowTime }}
            </p>

            @if( !$attendance || !$attendance->isClockedIn() )
            <form action="" method="POST">
                @csrf
                <button type="submit" class="text-white font-bold text-[32px] bg-black w-40 h-14 rounded-xl mt-20">
                    出勤
                </button>
            </form>
            @endif

            @if( $attendance->isClockedIn() )
            <div class="flex gap-16 justify-center">
                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="text-white font-bold text-[32px] bg-black w-40 h-14 rounded-xl mt-20">
                        退勤
                    </button>
                </form>
                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="text-black font-bold text-[32px] bg-white w-40 h-14 rounded-xl mt-20">
                        休憩入
                    </button>
                </form>
            </div>
            @endif
            
        </div>
@endsection