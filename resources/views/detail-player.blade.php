@php
    use App\Models\Player;
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Thông tin cơ thủ</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">

    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Roboto", sans-serif
        }



        .icon {
            color: #21324C !important;
        }

        .color-main {
            color: #fff;
            background-color: #21324C;
        }
        .navMenu {
            }

            .navMenu a {
            text-decoration: none;
            font-size: 1.2em;
            font-weight: 500;
            display: inline-block;
            width: 80px;
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            }

            .navMenu a:hover {
            color: burlywood;
            }

            .navMenu .dot {
            width: 6px;
            height: 6px;
            background: burlywood;
            border-radius: 50%;
            opacity: 0;
            -webkit-transform: translateX(30px);
            transform: translateX(30px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            }

            .navMenu a:nth-child(1):hover ~ .dot {
            -webkit-transform: translateX(30px);
            transform: translateX(30px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }

            .navMenu a:nth-child(2):hover ~ .dot {
            -webkit-transform: translateX(110px);
            transform: translateX(110px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }

            .navMenu a:nth-child(3):hover ~ .dot {
            -webkit-transform: translateX(200px);
            transform: translateX(200px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }

            .navMenu a:nth-child(4):hover ~ .dot {
            -webkit-transform: translateX(285px);
            transform: translateX(285px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }

    </style>
</head>

<body class="w3-light-grey"
    style="background-color: #21324C!important;background-image: url('../images/background-dots.png');">
    <x-menu />
    <x-notification />
    <!-- Page Container -->
    <div class="w3-content mt-[90px]" style="max-width:1400px;">
        <nav class="navMenu text-[12px] pl-5 mb-4">
            <a class=" text-white" href="{{ route('posts.getPlayerPost', ['id' => $player->user->id]) }}">Bài viết</a>
            <a class="border-b border-solid border-b-[burlywood] text-[burlywood]" href="#">Hồ sơ</a>
            <div class="dot"></div>
        </nav>
        <!-- The Grid -->
        <div class="w3-row-padding">
            <!-- Left Column -->
            <div class="w3-third">
                <div class="w3-white w3-text-grey w3-card-4">
                    <div class="w3-display-container">
                        @php
                            $file_name = 'players/' . $player->id . '/' . $player->img;
                        @endphp
                        @if (Storage::disk('public')->exists($file_name))
                            <img class="img-player p-[5px] overflow-hidden" src="{{ Storage::url($file_name) }}"
                                alt='Ảnh cơ thủ'>
                        @else
                            <img class="img-player p-[5px] overflow-hidden"
                                src="{{ asset('images/players/player.webp') }}" style="width:100%" alt="Ảnh cơ thủ">
                        @endif
                        <div class="w3-display-bottomleft w3-container w3-text-black w-full bg-gray-100 text-center ">
                            <h2 class=" text-[1.2rem]">{{ $player->name }}</h2>
                        </div>
                    </div>
                    <div class="w3-containerm text-left p-[10px] text-black">
                        <div class=" grid grid-cols-2 ">
                            <div>
                                <p>Hạng:</p>
                                <p>Point:</p>
                                <p>Bảng xếp hạng:</p>
                                <p>Tiền thưởng:</p>
                                <p>Giới tính:</p>
                                <p>Số điện thoại:</p>
                            </div>
                            <div>
                                <p>{{ $player->player_ranking->ranking->name }}</p>
                                <p>{{ $player->point }}</p>
                                <p>Top {{ $top }}</p>
                                <p>{{ $money }}</p>
                                <p>{{ $player->sex }}</p>
                                <p>{{ preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $player->phone) }}</p>
                            </div>
                        </div>
                        <hr>
                        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw mr-[5px] icon"></i><span
                                    class=" text-[14px]">Kỹ năng</span></b></p>
                        <p>Độ chính xác bi đơn</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge color-main" style="width:90%">90%</div>
                        </div>
                        <p>Kỹ năng giải hình</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge color-main" style="width:80%">
                                <div class="w3-center w3-text-white">80%</div>
                            </div>
                        </div>
                        <p>Kỹ năng nhảy bi</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge color-main" style="width:75%">75%</div>
                        </div>
                        <p>Kỹ năng thủ bi</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge color-main" style="width:50%">50%</div>
                        </div>
                        <br>
                    </div>
                </div><br>
                <!-- End Left Column -->
            </div>
            <!-- Right Column -->
            <div class="w3-twothird">

                <div class="w3-container w3-card w3-white w3-margin-bottom sm:min-h-[355px] overflow-auto">
                    @php
                        $count_registed = 0;
                    @endphp
                    @foreach ($player->player_registed_tournament as $player_registed_tournament)
                        @php
                            $count_registed++;
                        @endphp
                    @endforeach
                    <h2 class="w3-padding-16 text-[14px] sm:text-[18px]"><i
                            class="fa-solid fa-calendar-days mr-2"></i>Các
                        giải đấu đã đăng ký - <span> {{ $count_registed }} giải
                            đấu</span>
                    </h2>
                    <table class="table">
                        <thead>
                            <tr class="whitespace-nowrap bg-[#21324c] text-white">
                                <th scope="col ">#</th>
                                <th scope="col ">Tên giải đấu</th>
                                <th scope="col ">Đơn vị tổ chức</th>
                                <th scope="col ">Thời gian tổ chức</th>
                                <th scope="col ">Lệ phí</th>
                                <th scope="col ">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($count_registed === 0)
                                <tr class="whitespace-nowrap">
                                    <td colspan="6" class="text-center">Chưa đăng ký giải đấu nào</td>
                                </tr>
                            @endif
                            @foreach ($player->player_registed_tournament as $player_registed_tournament)
                                <tr class="whitespace-nowrap">
                                    <th scope="row">1</th>
                                    <td class="">{{ $player_registed_tournament->tournament->name }}</td>
                                    <td class="">
                                        {{ $player_registed_tournament->tournament->admin_tournament->name }}</td>
                                    <td class="">{{ $player_registed_tournament->tournament->start_date }}
                                    </td>
                                    <td class="">
                                        {{ number_format($player_registed_tournament->tournament->fees, 0, ',', '.') . ' VNĐ' }}
                                    </td>
                                    @if ($player_registed_tournament->status === 1)
                                        <td class=" text-green-500">Thành công</td>
                                    @else
                                        <td class=" text-orange-400">Đang phê duyệt</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                @php
                    $player_achievements = 0;
                @endphp
                @foreach ($player->achievement as $achievement)
                    @php
                        $player_achievements++;
                    @endphp
                @endforeach
                <div class="w3-container w3-card w3-white w3-margin-bottom sm:min-h-[355px] overflow-auto">
                    <h2 class="w3-padding-16 text-[14px] sm:text-[18px]"><i class="fa fa-trophy mr-2"
                            aria-hidden="true"></i>Thành tích -
                        {{ $player_achievements }} thành tích
                    </h2>
                    <table class="table">
                        <thead>
                            <tr class="whitespace-nowrap bg-[#21324c] text-white">
                                <th scope="col">ID</th>
                                <th scope="col">Tên giải đấu</th>
                                <th scope="col">Giải</th>
                                <th scope="col">Tiền thưởng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($player_achievements === 0)
                                <tr class="whitespace-nowrap">
                                    <td colspan="4" class="text-center">Chưa có thành tích nào</td>
                                </tr>
                            @endif

                            @foreach ($player->achievement as $achievement)
                                <tr class="whitespace-nowrap">
                                    <th scope="row">1</th>
                                    <td>{{ $achievement->tournament_top_money->tournament->name }}</td>
                                    </td>
                                    @if ($achievement->tournament_top_money->top == 1)
                                        <td>Quán quân</td>
                                    @elseif ($achievement->tournament_top_money->top == 2)
                                        <td>Á quân</td>
                                    @else
                                        <td>Hạng 3</td>
                                    @endif
                                    <td>{{ number_format($achievement->tournament_top_money->money, 0, ',', '.') . ' VNĐ' }}
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="w3-container w3-card w3-white w3-margin-bottom sm:min-h-[355px] overflow-auto">
                    <h2 class="w3-padding-16 text-[14px] sm:text-[18px]"><i class="fa fa-handshake-o mr-2"
                            aria-hidden="true"></i>Các trận đấu đã tham gia - <span> {{ count($matches) }} trận
                            đấu</span>
                    </h2>
                    <table class="table">
                        <thead>
                            <tr class="whitespace-nowrap bg-[#21324c] text-white">
                                <th scope="col ">ID</th>
                                <th scope="col ">Tên giải đấu</th>
                                <th scope="col ">Vòng đấu</th>
                                <th scope="col ">Bàn thi đấu</th>
                                <th scope="col ">Cơ thủ 1</th>
                                <th scope="col ">Cơ thủ 2</th>
                                <th scope="col ">Cơ thủ chiến thắng</th>
                                <th scope="col ">Tỉ số</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($matches) === 0)
                                <tr class="whitespace-nowrap">
                                    <td colspan="8" class="text-center">Chưa tham gia trận đấu nào</td>
                                </tr>
                            @endif
                            @foreach ($matches as $match)
                                <tr class="whitespace-nowrap">
                                    <th scope="row">{{ $match->id }}</th>
                                    <td class="">{{ $match->tournament->name }}</td>
                                    <td class="">
                                        Vòng {{ $match->round }}</td>
                                    <td class="">Bàn {{ $match->location }}
                                    </td>
                                    <td class="">
                                        {{ Player::find($match->player_id_1)->name }}
                                    </td>
                                    <td class="">
                                        {{ Player::find($match->player_id_2)->name }}
                                    </td>
                                    <td class="">
                                        {{ $match->player_id_win != null ? Player::find($match->player_id_win)->name : 'chưa kết thúc' }}
                                    </td>
                                    <td class="">
                                        {{ $match->point_1 }} - {{ $match->point_2 }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>

    <x-footer />

</body>

</html>
