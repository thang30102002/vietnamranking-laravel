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
                        <div class=" grid grid-cols-2 w-[50%]">
                            <div>
                                <p>Hạng:</p>
                                <p>Điểm ranking:</p>
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

                <div class="w3-container w3-card w3-white w3-margin-bottom sm:min-h-[355px] overflow-auto">
                    @php
                        $count_registed = 0;
                    @endphp
                    @foreach ($player->player_registed_tournament as $player_registed_tournament)
                        @if ($player_registed_tournament->status == 1)
                            @php
                                $count_registed++;
                            @endphp
                        @endif
                    @endforeach
                    <h2 class="w3-padding-16 text-[14px] sm:text-[18px]"><i class="fa fa-handshake-o mr-2"
                            aria-hidden="true"></i>Các giải đấu đã
                        tham gia - <span> {{ $count_registed }} giải đấu</span>
                    </h2>
                    <table class="table">
                        <thead>
                            <tr class="whitespace-nowrap bg-[#21324c] text-white">
                                <th scope="col ">#</th>
                                <th scope="col ">Tên giải đấu</th>
                                <th scope="col ">Đơn vị tổ chức</th>
                                <th scope="col ">Thời gian tổ chức</th>
                                <th scope="col ">Lệ phí</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($player->player_registed_tournament as $player_registed_tournament)
                                @if ($player_registed_tournament->status == 1)
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
                                    </tr>
                                @endif
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
                        {{ $player_achievements }} giải
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
                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>

    <x-footer />

</body>

</html>
