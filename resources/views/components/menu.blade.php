<x-modal-change-password />

<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/flex-slider.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.css') }}">
<link rel="stylesheet" href="{{ asset('css/templatemo-lugx-gaming.css') }}">

<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('ranking.index') }}" class="logo font-semibold text-white text-xl italic">
                        VNPOOL
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav" id="dropdownMenu">
                        <li><a href="{{ route('ranking.index') }}"
                                class="{{ request()->path() === 'home' ? 'active' : '' }}">Trang
                                chủ</a></li>
                        <li><a class="{{ request()->path() === 'ranking' ? 'active' : '' }}" href="/ranking">Bảng xếp
                                hạng</a></li>
                        <li><a class="{{ request()->path() === 'tournament' ? 'active' : '' }}"
                                href={{ route('ranking.tournament') }}>Giải đấu</a></li>
                        <li><a class="{{ request()->path() === 'posts' ? 'active' : '' }}"
                        href={{ route('posts.index') }}>Cộng đồng</a></li>
                        {{-- <li><a class="{{ request()->path() === 'news' ? 'active' : '' }}"
                                href={{ route('news.index') }}>Tin tức</a></li> --}}
                        @if (Auth::check())
                            <form action={{ route('logout') }} method="post">
                                @csrf
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle sm:text-white" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        @if (auth()->user()->user_role->role_id == 3)
                                            {{ auth()->user()->player->name }}
                                        @endif
                                        @if (auth()->user()->user_role->role_id == 2)
                                            {{ auth()->user()->admin_tournament->name }}
                                        @endif
                                    </button>
                                    <ul id="dropdownMenuUser" class="dropdown-menu w-full right-0"
                                        aria-labelledby="dropdownMenuButton1">
                                        @if (auth()->user()->user_role->role_id == 3)
                                            <li><a class="dropdown-item"
                                                    style="color: #000!important; padding:0; font-weight:400;"
                                                    href={{ route('ranking.detail', ['id' => auth()->user()->player->id]) }}>Hồ
                                                    sơ</a>
                                            </li>
                                            <li><button id="btnModalChangePass" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#ChangePassModal" class="dropdown-item p-0"
                                                    aria-hidden="true">Thay
                                                    đổi mật khẩu</button></li>
                                        @endif
                                        @if (auth()->user()->user_role->role_id == 2)
                                            <li><a class="dropdown-item p-0"
                                                    href={{ route('adminTournament.index') }}>Quản
                                                    lý giải
                                                    đấu</a></li>
                                            <li><button id="btnModalChangePass" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#ChangePassModal" class="dropdown-item p-0"
                                                    aria-hidden="true">Thay
                                                    đổi mật khẩu</button></li>
                                        @endif
                                        <li><button class="dropdown-item p-0" href={{ 'logout' }}>Đăng
                                                xuất</button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        @else
                            <li><a href={{ route('login') }}>Đăng nhập</a></li>
                        @endif

                    </ul>
                    <button class='menu-trigger' id="btnShowMenu">
                        <span>Menu</span>
                    </button>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<script>
    const myDiv = document.getElementById("dropdownMenuButton1");
    const listUl = document.getElementById("dropdownMenuUser");


    myDiv.addEventListener("click", function() {
        if (listUl.style.display == "block") {
            listUl.style.display = "none";
        } else {
            listUl.style.display = "block";
        }
    });
</script>
{{-- <script>
    const btn_show_menu = document.getElementById("btnShowMenu");
    const menu = document.getElementById("navbarSupportedContent");

    btn_show_menu.addEventListener("click", function() {
        if (menu.classList.contains("hidden")) {
            menu.classList.remove("hidden");
        } else {
            menu.classList.add("hidden");
        }

    });
</script> --}}

{{-- <script>
    document.getElementById('btnModalChangePass').addEventListener('click', function() {
        const listUl = document.getElementById("dropdownMenu");
        const navDropDown = document.getElementById("navbarSupportedContent");
        navDropDown.classList.add('hidden');
        listUl.style.display = 'none';
    });
</script> --}}
<script>
    const btn_show_menu = document.getElementById("btnShowMenu");
    const drop_down_menu = document.getElementById("dropdownMenu");


    btn_show_menu.addEventListener("click", function() {
        if (drop_down_menu.style.display == "block") {
            drop_down_menu.style.display = "none";
        } else {
            drop_down_menu.style.display = "block";
        }
    });
</script>
