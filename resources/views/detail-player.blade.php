<!DOCTYPE html>
<html>

<head>
    <title>Thông tin cơ thủ</title>
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
    @vite('resources/css/app.css')
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

        .w3-white {
            background-color: #E8E8E8 !important;
        }

        .icon {
            color: #21324C !important;
        }

        .color-main {
            color: #fff;
            background-color: #21324C;
        }
    </style>
</head>

<body class="w3-light-grey"
    style="background-color: #21324C!important;background-image: url('../images/background-dots.png');">
    <x-menu />
    <!-- Page Container -->
    <div class="w3-content w3-margin-top" style="max-width:1400px;">

        <!-- The Grid -->
        <div class="w3-row-padding">

            <!-- Left Column -->
            <div class="w3-third">

                <div class="w3-white w3-text-grey w3-card-4">
                    <div class="w3-display-container">
                        <img src="
                        @if ($player->img && file_exists(public_path('images/players/' . $player->img . ''))) {{ asset('images/players/' . $player->img . '') }}
                        @else
                            {{ asset('images/players/player.webp') }} @endif
                        "
                            style="width:100%" alt="Avatar">
                        <div class="w3-display-bottomleft w3-container w3-text-black w-full bg-white text-center ">
                            <h2 class=" text-[1.2rem]">{{ $player->name }}</h2>
                        </div>
                    </div>
                    <div class="w3-containerm text-left p-[10px] text-black">
                        <p class=" text-left">Hạng: <span>{{ $player->player_ranking->ranking->name }}</span>
                        </p>
                        <p class=" text-left">Bảng xếp hạng: Top {{ $top }}
                        </p>
                        <p class=" text-left">Tiền thưởng: {{ $money }}
                        </p>
                        <p class=" text-left">Giới tính: {{ $player->sex }}
                        </p>

                        <p class=" text-left">Số điện thoại:
                            {{ preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $player->phone) }}
                        </p>
                        <hr>

                        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw mr-[5px] icon"></i><span
                                    class=" text-[14px]">Kỹ năng</span></b></p>
                        <p>Độ chính xác</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge color-main" style="width:90%">90%</div>
                        </div>
                        <p>Photography</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge color-main" style="width:80%">
                                <div class="w3-center w3-text-white">80%</div>
                            </div>
                        </div>
                        <p>Illustrator</p>
                        <div class="w3-light-grey w3-round-xlarge w3-small">
                            <div class="w3-container w3-center w3-round-xlarge color-main" style="width:75%">75%</div>
                        </div>
                        <p>Media</p>
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

                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <h2 class="w3-padding-16"><i class="fa fa-trophy mr-[5px]" aria-hidden="true"></i>Thành tích
                    </h2>
                    @foreach ($player->achievement as $achievement)
                        <div class="">
                            <h5 class="w3-opacity py-[5px]">
                                {{-- @dd($player->achievement[1]->tournament_top_money->tournament)
                                @dd($achievement->tournament_top_money->tournament->name) --}}
                                <b>{{ $achievement->tournament_top_money->tournament->name }}</b>
                            </h5>
                            {{-- <h6 class=""><i
                                    class="fa fa-calendar fa-fw w3-margin-righticon"></i>{{ $achievement->tournament_top_money->tournament->start_date }}
                            </h6> --}}
                            @if ($achievement->tournament_top_money->top === 1)
                                <p>Danh hiệu: Quán Quân</p>
                            @elseif ($achievement->tournament_top_money->top === 2)
                                <p>Danh hiệu: Á Quân</p>
                            @else
                                <p>Danh hiệu: Hạng 3</p>
                            @endif
                            {{-- <p>Hạng tham gia giải đấu: 
                                @foreach ($achievement->tournament_top_money->tournament->ranking_tournament as $tournament)
                                    <span>{{ $tournament->ranking->name}}</span>
                                @endforeach    
                            </p>
                            <p>Số lượng cơ thủ: {{ $achievement->tournament_top_money->tournament->number_players }}</p>
                            <p>Địa điểm thi đấu: {{ $achievement->tournament_top_money->tournament->address }}</p>
                            <p>Lệ phí thi đấu: {{ number_format($achievement->tournament_top_money->tournament->fees, 0, ',', '.') . ' VNĐ'  }}</p>
                            <p>Đơn vị tổ chức: {{ $achievement->tournament_top_money->tournament->admin_tournament->name }}</p> --}}
                            <hr>
                        </div>
                    @endforeach

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
