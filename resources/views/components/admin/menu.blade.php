<div>
    <div class="header">
        <div class="header-left">
            <a href="{{ route('ranking.index') }}" class="logo"> <span class="logoclass">VietNamPool</span> </a>
            <a href="{{ route('ranking.index') }}" class="logo logo-small"></a>
        </div>
        <a href="javascript:void(0);" id="toggle_btn"> <i class="fa fa-bars" aria-hidden="true"></i> </a>
        <a class="mobile_btn" id="mobile_btn"> <i class="fa fa-bars" aria-hidden="true"></i> </a>
        <ul class="nav user-menu">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span
                        class="user-img"></span> </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href={{ route('adminTournament.profile') }}>Hồ sơ</a> <a
                        class="dropdown-item" href="login.html">Đăng xuất</a>
                </div>
            </li>
        </ul>
        <div class="top-nav-search">
            <form>
                <input type="text" class="form-control" placeholder="Search here">
                <button class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
</div>
