<header class="bg-black w-full h-[70px] flex items-center justify-between px-[25px]">
    <div class="w-1/5 flex items-center h-full">
        <a href="/">
            <img src="/images/COACHTECHヘッダーロゴ.png" alt="COACHTECHロゴ" class="w-full">
        </a>
    </div>

    <nav class="w-1/5">
        <ul class="flex justify-end space-x-6 text-[20px]">
            <li>
                @if (Auth::check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white hover:underline">
                        ログアウト
                    </button>
                </form>
                @else
                <a href="/login" class="text-white hover:underline">
                    ログイン
                </a>
                @endif
            </li>
            <li><a href="" class="text-white hover:underline">test</a></li>
            <li><a href="" class="text-white hover:underline">test</a></li>
        </ul>
    </nav>

</header>