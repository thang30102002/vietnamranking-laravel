<nav class="navbar navbar-expand-lg navbar-light bg-light menu">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">VietNam Ranking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/ranking">Bảng xếp hạng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Giải đấu</a>
                </li>
            </ul>
            @if (Auth::check())
                <form action={{ route('logout') }} method="post">
                    @csrf
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            @if (auth()->user()->user_role->role_id == 3)
                                {{ auth()->user()->player->name }}
                            @endif
                            @if (auth()->user()->user_role->role_id == 2)
                                {{ auth()->user()->admin_tournament->name }}
                            @endif
                        </button>
                        <ul id="dropdownMenu" class="dropdown-menu w-full" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                            <li><button class="dropdown-item" href={{ 'logout' }}>Đăng xuất</button></li>
                            {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        </ul>
                    </div>
                </form>
            @else
                <a style="    background-color: #2;
    /* background-color: #21324c; */
    padding: padd;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    color: #000;
    text-decoration: none;
    /* color: #fff; */
    border-style: solid;
    border-width: 1px;
    margin-right: 10px;"
                    href={{ route('login') }}>Đăng nhập</a>
                <a style="background-color: #2;
    background-color: #21324c;
    padding: padd;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: #fff;"
                    href={{ route('register') }}>Đăng ký</a>
            @endif
        </div>
    </div>
</nav>
<script>
    const myDiv = document.getElementById("dropdownMenuButton1");
    const listUl = document.getElementById("dropdownMenu");


    myDiv.addEventListener("click", function() {
        if (listUl.style.display == "block") {
            listUl.style.display = "none";
        } else {
            listUl.style.display = "block";
        }
    });
</script>
