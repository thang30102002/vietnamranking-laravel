<div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class={{ request()->route()->getName() == 'adminTournament.index' ? 'active' : '' }}> <a
                            href={{ route('adminTournament.index') }}><i class="fa fa-home" aria-hidden="true"></i>
                            <span>Trang chủ</span></a> </li>
                    <li class="list-divider"></li>
                    <li> <a class="{{ request()->route()->getName() == 'adminTournament.showAllTournament' || request()->route()->getName() == 'adminTournament.addtournament' || request()->route()->getName() == 'adminTournament.showEditTournament' || request()->route()->getName() == 'adminTournament.showEditPlayer' ? 'rounded-lg text-white bg-[#009688] shadow-lg opacity-100' : '' }}"
                            href="#"><i class="fa fa-trophy" aria-hidden="true"></i> <span> Giải
                                đấu </span>
                        </a>
                        <ul class="submenu_class" style="display: none;">
                            <li><a href={{ route('adminTournament.showAllTournament') }}> Tất cả giải đấu </a></li>
                            <li><a href={{ route('adminTournament.addtournament') }}> Tạo giải đấu </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
