<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flex-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">

    <!--

TemplateMo 589 lugx gaming

https://templatemo.com/tm-589-lugx-gaming

-->
</head>

<body>
    <x-notification />
    <x-menu />

    <div class="main-banner" style="padding-top: 90px!important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="caption header-text">
                        <h6>Chào mừng đến với VietNamPool</h6>
                        <h2>Hệ thống tổ chức giải đấu và xếp hạng cơ thủ billiard hàng đầu Việt Nam!</h2>
                        <p>VietNamPool với sứ mệnh tổ chức và quản lý giải đấu hàng
                            tuần, đảm bảo tính chuyên nghiệp và uy tín cho các giải đấu. VietNamPool còn là hệ thống
                            tính điểm ranking và xếp hạng cơ thủ billiard chuyên nghiệp và nghiệp dư đầu tiên tại Việt
                            Nam.</p>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="right-image">
                        <img src="https://images2.thanhnien.vn/528068263637045248/2024/10/18/463758959947418277417775222465921802320230n-17292766562811842147559.jpg"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="features">
        <div class="container">
            <div class=" grid grid-cols-2 gap-4 sm:grid-cols-4 ">
                <div class="col-lg-3 col-md-6 w-full">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <i class="fa-solid fa-info text-[2rem] text-white"></i>
                            </div>
                            <h4>Giới thiệu</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 w-full">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <i class="fa-solid fa-newspaper text-[2rem] text-white"></i>
                            </div>
                            <h4>Tin tức</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 w-full">
                    <a href="/ranking">
                        <div class="item">
                            <div class="image">
                                <i class="fa-solid fa-ranking-star text-[2rem] text-white"></i>
                            </div>
                            <h4>Bảng xếp hạng</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 w-full">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <i class="fa-solid fa-phone text-[2rem] text-white"></i>
                            </div>
                            <h4>Liên hệ</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Cơ thủ</h6>
                        <h2>Thợ săn tiền thưởng</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="/ranking">Xem bảng xếp hạng</a>
                    </div>
                </div>
                @foreach ($players_top_4 as $player)
                    @php
                        $file_name = 'players/' . $player->id . '/' . $player->img;
                    @endphp
                    <div class="col-lg-3 col-md-6 pl-5 pr-5">
                        <div class="item">
                            <div class="thumb">

                                @if (Storage::disk('public')->exists($file_name))
                                    <a href={{ route('ranking.detail', ['id' => $player->id]) }}><img
                                            src="{{ Storage::url($file_name) }}" alt=""></a>
                                @else
                                    <a href={{ route('ranking.detail', ['id' => $player->id]) }}><img
                                            src="{{ asset('images/players/player.webp') }}" alt=""></a>
                                @endif
                            </div>
                            <div class="down-content">
                                <h4>{{ $player->name }}</h4>
                                <span class="category">Hạng: {{ $player->player_ranking->ranking->name }}</span><br>
                                <span class="category">Tổng tiền thưởng:
                                    {{ number_format($player->player_money->money, 0, ',', '.') . ' VNĐ' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="section most-played">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>GIẢI ĐẤU</h6>
                        <h2>Sắp diễn ra</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="/tournament">Xem tất cả</a>
                    </div>
                </div>
                @if (count($tournaments_apply) == 0)
                    <h1 class=" text-center text-[13px] mt-[60px]">Chưa có giải đấu nào sắp diễn ra</h1>
                @else
                    @foreach ($tournaments_apply as $tournament)
                        <div class=" sm:grid sm:grid-cols-4 sm:gap-4 pl-5 pr-5">
                            <div class="item">
                                <div class="thumb">
                                    <a href="/tournament"><img src="{{ asset('images/bi-a.jpg') }}" alt=""></a>
                                </div>
                                <div class="down-content">
                                    <span class="category">{{ $tournament->admin_tournament->name }}</span>
                                    <h4>{{ $tournament->name }}</h4>
                                    <a href="/tournament">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>

    <div class="section cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="shop">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <h2>Tổ chức và quản lý giải đấu</h2>
                                </div>
                                <p>Bạn có thể tổ chức các giải đấu billiard thuộc hệ thống <em>VietNamPool</em>, thu hút
                                    được sự quan tâm của các cơ thủ trong hệ thống.</p>
                                <div class="main-button">
                                    <a href="/login">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2 align-self-end">
                    <div class="subscribe">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <h2>Đăng ký tham gia giải đấu</h2>
                                </div>
                                <p class=" font-semibold text-base mb-2">Hệ thống VietNamPool là hệ thống quản lý cơ
                                    thủ đầu tiên tại Việt Nam. Các cơ thủ
                                    được xếp hạng theo thành tích đảm bảo tính công bằng khi tham gia các giải đấu trên
                                    hệ thống.</p>
                                <div class="main-button">
                                    <a href="/login">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</body>

</html>
