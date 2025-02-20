<div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class={{ request()->route()->getName() == 'adminTournament.index' ? 'active' : '' }}> <a
                            href={{ route('admin.index') }}><i class="fa fa-home" aria-hidden="true"></i>
                            <span>Trang chủ</span></a> </li>
                    <li class="list-divider"></li>
                    <li class={{ request()->route()->getName() == 'adminTournament.index' ? 'active' : '' }}> <a
                            href={{ route('admin.showUser') }}><i class="fa fa-user" aria-hidden="true"></i>
                            <span>Quản lý cơ thủ</span></a> </li>
                    <li class="list-divider"></li>
                    <li> <a class="{{ request()->route()->getName() == 'adminTournament.showAllTournament' || request()->route()->getName() == 'adminTournament.addtournament' || request()->route()->getName() == 'adminTournament.showEditTournament' || request()->route()->getName() == 'adminTournament.showEditPlayer' ? 'rounded-lg text-white bg-[#009688] shadow-lg opacity-100' : '' }}"
                            href="#"><i class="fa-solid fa-newspaper"></i><span> Tin tức </span>
                        </a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href={{ route('news.showAll') }}> Tất cả bài viết </a></li>
                            <li><a href={{ route('news.showCreate') }}> Tạo bài viết </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
