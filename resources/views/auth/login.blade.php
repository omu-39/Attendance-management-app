@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="min-h-screen bg-white">
    <x-heading title="ログイン" />

    <form action="/login" method="post" novalidate class="w-[680px] mx-auto">
        @csrf
        <x-form-input label="メールアドレス" name="email" type="email" />
        <x-form-input label="パスワード" name="password" type="password" />

        <button type='submit' class = "w-full text-white bg-[#FF5555] py-[8px] rounded-md text-[24px] font-bold mt-12">
            ログインする
        </button>

        <div class="mt-[20px] text-center">
            <a href="/register" class="text-blue-500 hover:underline">会員登録はこちら</a>
        </div>
    </form>
</div>
@endsection