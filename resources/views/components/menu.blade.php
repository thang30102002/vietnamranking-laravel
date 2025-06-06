<x-modal-change-password />

<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/flex-slider.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.css') }}">
<link rel="stylesheet" href="{{ asset('css/templatemo-lugx-gaming.css') }}">
<style>
    /* Đảm bảo thẻ a không bị ảnh hưởng bởi các thuộc tính không mong muốn */
a.no-style {
    display: inline!important;  /* Thay display: block thành inline */
    padding-left: 0!important;  /* Xóa padding trái */
    padding-right: 0!important; /* Xóa padding phải */
    border-radius: 0!important; /* Xóa border-radius */
    font-weight: normal!important; /* Xóa font-weight */
    font-size: inherit!important; /* Thừa kế font-size từ cha */
    height: auto!important;  /* Loại bỏ chiều cao cố định */
    line-height: normal!important; /* Thừa kế line-height từ cha */
    text-transform: none!important; /* Loại bỏ việc chuyển đổi kiểu chữ */
    color: inherit!important; /* Thừa kế màu sắc từ cha */
    transition: none!important; /* Tắt hiệu ứng transition */
    border: none!important; /* Loại bỏ border */
    letter-spacing: normal!important; /* Loại bỏ letter-spacing */
}

        .notification-box {
    position: sticky;
    z-index: 99;
    top: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    text-align: center;
    scale: 0.6;
    }
    .notification-bell {
    animation: bell 1s 1s both infinite;
    }
    .notification-bell * {
    display: block;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0px 0px 15px #fff;
    }
    .bell-top {
    width: 6px;
    height: 6px;
    border-radius: 3px 3px 0 0;
    }
    .bell-middle {
    width: 25px;
    height: 25px;
    margin-top: -1px;
    border-radius: 12.5px 12.5px 0 0;
    }
    .bell-bottom {
    position: relative;
    z-index: 0;
    width: 32px;
    height: 2px;
    }
    .bell-bottom::before,
    .bell-bottom::after {
    content: '';
    position: absolute;
    top: -4px;
    }
    .bell-bottom::before {
    left: 1px;
    border-bottom: 4px solid #fff;
    border-right: 0 solid transparent;
    border-left: 4px solid transparent;
    }
    .bell-bottom::after {
    right: 1px;
    border-bottom: 4px solid #fff;
    border-right: 4px solid transparent;
    border-left: 0 solid transparent;
    }
    .bell-rad {
    width: 8px;
    height: 4px;
    margin-top: 2px;
    border-radius: 0 0 4px 4px;
    animation: rad 1s 2s both infinite;
    }
    .notification-count {
    position: absolute;
    z-index: 1;
    top: -6px;
    right: -6px;
    width: 30px;
    height: 30px;
    line-height: 40px;
    font-size: 18px;
    border-radius: 50%;
    background-color: #ff4927;
    color: #fff;
    animation: zoom 3s 3s both infinite;
    }
    @keyframes bell {
    0% { transform: rotate(0); }
    10% { transform: rotate(30deg); }
    20% { transform: rotate(0); }
    80% { transform: rotate(0); }
    90% { transform: rotate(-30deg); }
    100% { transform: rotate(0); }
    }
    @keyframes rad {
    0% { transform: translateX(0); }
    10% { transform: translateX(6px); }
    20% { transform: translateX(0); }
    80% { transform: translateX(0); }
    90% { transform: translateX(-6px); }
    100% { transform: translateX(0); }
    }
    @keyframes zoom {
    0% { opacity: 0; transform: scale(0); }
    10% { opacity: 1; transform: scale(1); }
    50% { opacity: 1; }
    51% { opacity: 0; }
    100% { opacity: 0; }
    }
    @keyframes moon-moving {
    0% {
        transform: translate(-200%, 600%);
    }
    100% {
        transform: translate(800%, -200%);
    }
    }
</style>

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
                        {{-- <li><a class="{{ request()->path() === 'message' ? 'active' : '' }}"
                        href={{ route('message.index') }}>Tin nhắn</a></li> --}}
                        {{-- @if (Auth::check())
                            <li class=" md:hidden"><a class="{{ request()->path() === 'message' ? 'active' : '' }}"
                            href={{ route('message.index') }}>Thông Báo</a></li>
                            <li class=" relative hidden md:block">
                                @php
                                    $notifications = auth()->user()->notifications;
                                    $notification_not_reads = auth()->user()->unreadNotifications;
                                @endphp
                                <button onclick="showNotification()">
                                    <div class="notification-box">
                                        <span class="notification-count">{{ $notification_not_reads->count()}}</span>
                                        <div class="notification-bell">
                                        <span class="bell-top"></span>
                                        <span class="bell-middle"></span>
                                        <span class="bell-bottom"></span>
                                        <span class="bell-rad"></span>
                                        </div>
                                    </div>
                                </button>
                                <div class=" absolute bg-white rounded-lg shadow-lg p-2 hidden notification-list w-[250px] text-[12px]">
                                    <div class=" text-[14px] weight-bold mb-3">
                                        <button id="btn-all-notification" onclick="openNotificationAll()" class="border border-solid border-white rounded-[26px] bg-[#21324C] px-3 text-white">Tất cả</button>
                                        <button id="btn-not-read-notification" onclick="openNotificationNotRead()">Chưa đọc</button>
                                    </div>
                                    <ul id="notification-all" class="overflow-y-auto h-72">
                                        @if ($notifications->count() == 0)
                                            <li class="text-center">Không có thông báo nào</li>
                                        @endif
                                        @foreach ( $notifications as $notification )
                                            <a data-id="{{ $notification->id }}"  class="no-style" href="{{$notification->data['link']}}" ><li style="line-height: normal; " class="leading-[0px] flex">
                                                <div>
                                                    {!! $notification->data['message']!!} <span>{{$notification->created_at->locale('vi')->diffForHumans();}}</span>
                                                </div>    
                                                <div class="{{$notification->read_at != null ? 'hidden   ' : 'content-center'}}"><i class="fa fa-circle text-[#21324C]" aria-hidden="true"></i></div>    
                                            </li><hr></a>
                                        @endforeach
                                    </ul>
                                    <ul id="notification-not-read" class=" hidden">
                                        @if ($notifications->count() == 0)
                                            <li class="text-center">Không có thông báo mới nào</li>
                                        @endif
                                        @foreach ( $notification_not_reads as $notification_not_read )
                                            <a data-id="{{ $notification_not_read->id }}"  class="no-style" href="{{$notification_not_read->data['link']}}" ><li style="line-height: normal; " class="leading-[0px] flex">
                                                <div>
                                                    {!! $notification_not_read->data['message']!!} <span>{{$notification_not_read->created_at->locale('vi')->diffForHumans();}}</span>
                                                </div>    
                                                <div class="{{$notification_not_read->read_at != null ? 'hidden   ' : 'content-center'}}"><i class="fa fa-circle text-[#21324C]" aria-hidden="true"></i></div>    
                                            </li><hr></a>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif --}}
                        @if (Auth::check())
                            <form action={{ route('logout') }} method="post">
                                @csrf
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle sm:text-white" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                                            <li><a class="dropdown-item p-0" style="color: #212529!important; font-weight:500!important;"
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
<script>
    function showNotification() {
        const notificationBox = document.querySelector('.notification-box');
        const notificationList = document.querySelector('.notification-list');

        if (notificationList.style.display === 'block') {
            notificationList.style.display = 'none';
        } else {
            notificationList.style.display = 'block';
        }

        
    }

    function openNotificationNotRead() {
        
        const btnAllNotification = document.getElementById('btn-all-notification');
        const btnNotReadNotification = document.getElementById('btn-not-read-notification');
        const notificationAll = document.getElementById('notification-all');
        const notificationNotRead = document.getElementById('notification-not-read');

        // Kiểm tra xem danh sách "Tất cả thông báo" có đang bị ẩn không
        const isAllHidden = notificationAll.classList.contains('hidden');
        
        if(!isAllHidden) {
            // Hiển thị "Thông báo chưa đọc", ẩn "Tất cả thông báo"
            notificationAll.classList.add('hidden');
            notificationNotRead.classList.remove('hidden');

            // Thêm hiệu ứng button
            btnAllNotification.classList.remove('border', 'border-solid', 'border-white', 'rounded-[26px]', 'bg-[#21324C]', 'px-3', 'text-white');
            btnNotReadNotification.classList.add('border', 'border-solid', 'border-white', 'rounded-[26px]', 'bg-[#21324C]', 'px-3', 'text-white');
        }
    }
    
    function openNotificationAll() {
        const btnAllNotification = document.getElementById('btn-all-notification');
        const btnNotReadNotification = document.getElementById('btn-not-read-notification');
        const notificationAll = document.getElementById('notification-all');
        const notificationNotRead = document.getElementById('notification-not-read');

        // Kiểm tra xem danh sách "Tất cả thông báo" có đang bị ẩn không
        const isAllHidden = notificationAll.classList.contains('hidden');

        if (isAllHidden) {
            // Hiển thị "Tất cả thông báo", ẩn "Thông báo chưa đọc"
            notificationAll.classList.remove('hidden');
            notificationNotRead.classList.add('hidden');
            
            // Xóa hiệu ứng button
            btnNotReadNotification.classList.remove('border', 'border-solid', 'border-white', 'rounded-[26px]', 'bg-[#21324C]', 'px-3', 'text-white');
            btnAllNotification.classList.add('border', 'border-solid', 'border-white', 'rounded-[26px]', 'bg-[#21324C]', 'px-3', 'text-white');
        } 
    }
</script>

<script>
    // function ReadNotification() {
    //     var id = this.getAttribute('data-id');
    //     console.log(id);
        
    //     //call api load các thông báo đã đọc
    //     fetch('{{ route("notifications.markAsRead",['id' => 4]) }}', {
    //         method: "POST",
    //         headers: {
    //             "X-CSRF-TOKEN": "{{ csrf_token() }}",
    //             "Content-Type": "application/json"
    //         },
    //     }).then(response => {
    //         if (response.ok) {
    //             document.querySelector('.notification-count').textContent = "0";
    //         }
    //     }).catch(error => console.error("Lỗi:", error));
        
    // }
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.no-style').forEach(function (element) {
            element.addEventListener('click', function () {
                var id = this.getAttribute('data-id');
                console.log(id);
                
                 //call api load các thông báo đã đọc
                fetch('{{ route("notifications.markAsRead", ["id" => "__id__"]) }}'.replace('__id__', id), {
                method: "POST",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                }).then(response => {
                    if (response.ok) {
                        document.querySelector('.notification-count').textContent = "0";
                    }
                }).catch(error => console.error("Lỗi:", error));
            });
        });
    });

</script>
