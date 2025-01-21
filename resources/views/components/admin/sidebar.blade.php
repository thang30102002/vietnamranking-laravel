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
                </ul>
            </div>
        </div>
    </div>
</div>
