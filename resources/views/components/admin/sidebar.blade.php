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
                    <li class={{ request()->route()->getName() == 'adminTournament.index' ? 'active' : '' }}> <a
                            href={{ route('admin.showAdminTournament') }}><i class="fa fa-user" aria-hidden="true"></i>
                            <span>Quản lý đơn vị tổ chức</span></a> </li>
                    <li class="list-divider"></li>
                    <li> <a class="{{ request()->route()->getName() == 'admin.news.dashboard' || request()->route()->getName() == 'admin.news.index' || request()->route()->getName() == 'admin.news.create' || request()->route()->getName() == 'admin.news.edit' || request()->route()->getName() == 'admin.categories.index' || request()->route()->getName() == 'admin.categories.create' || request()->route()->getName() == 'admin.categories.edit' ? 'rounded-lg text-white bg-[#009688] shadow-lg opacity-100' : '' }}"
                            href="#"><i class="fa-solid fa-newspaper"></i><span> Quản lý tin tức </span>
                        </a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href={{ route('admin.news.dashboard') }}> Dashboard </a></li>
                            <li><a href={{ route('admin.news.index') }}> Tất cả bài viết </a></li>
                            <li><a href={{ route('admin.news.create') }}> Tạo bài viết </a></li>
                            <li><a href={{ route('admin.categories.index') }}> Quản lý danh mục </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
