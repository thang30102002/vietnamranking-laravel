<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Cập nhật thông tin người chơi</title>
    {{-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> --}}
    <link rel="stylesheet" href="{{ asset('images/adminTournament/favicon.png') }}">

    {{-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">

    {{-- <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    {{-- <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}">
    {{-- <link rel="stylesheet" href="assets/css/feathericon.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">

    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    {{-- <link rel="stylesheet" href="assets/plugins/morris/morris.css"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/adminTournament/morris/morris.css') }}">

    {{-- <link rel="stylesheet" href="assets/css/style.css"> </head> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    </style>
</head>

<body>
    <div class="main-wrapper">
        <x-notification />
        <x-admin-tournament.menu />
        <x-admin-tournament.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="mt-5">
                                <h4 class="card-title float-left mt-2">Cập nhật thông tin người chơi</h4>
                            </div>
                        </div>
                    </div>
                </div>


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
                                    <img src="{{ Storage::url($file_name) }}" alt='Ảnh cơ thủ'>
                                @else
                                    <img src="{{ asset('images/players/player.webp') }}" style="width:100%"
                                        alt="Ảnh cơ thủ">
                                @endif
                                <div
                                    class="w3-display-bottomleft w3-container w3-text-black w-full bg-gray-100 text-center ">
                                    <h2 class=" text-[1.2rem]">{{ $player->name }}</h2>
                                </div>
                            </div>
                            <div class="w3-containerm text-left p-[10px] text-black">
                                <div class=" grid grid-cols-2 ">
                                    <div>
                                        <p>Hạng:</p>
                                        <p>Điểm ranking:</p>
                                        <p>Bảng xếp hạng:</p>
                                        <p>Tiền thưởng:</p>
                                        <p>Giới tính:</p>
                                        <p>Số điện thoại:</p>
                                        <p>Số căn cước công dân:</p>
                                    </div>
                                    <div>
                                        <p>{{ $player->player_ranking->ranking->name }}</p>
                                        <p>{{ $player->point }}</p>
                                        <p>Top {{ $top }}</p>
                                        <p>{{ $money }}</p>
                                        <p>{{ $player->sex }}</p>
                                        <p>{{ preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $player->phone) }}
                                        </p>
                                        <p>{{ $player->cccd }}</p>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <!-- End Left Column -->
                    </div>

                    <!-- Right Column -->
                    <div class="w3-twothird">
                        <div class="w3-container w3-card w3-white w3-margin-bottom sm:min-h-[355px] overflow-auto">
                            <form method="post" enctype="multipart/form-data"
                                action="{{ route('adminTournament.editPlayer', ['id' => $player->id]) }}"
                                class=" py-3">
                                @csrf
                                <div class="">
                                    <div class="form-group">
                                        <label>Ảnh cơ thủ</label>
                                        <input type="file" name="img" value="{{ old('img') }}"
                                            accept="image/*"
                                            class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="File ảnh cơ thủ" />
                                        <div
                                            class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('img')" class="mt-2" />
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label>Căn cước công dân </label>
                                        <input type="text" name="cccd" value="{{ old('cccd') }}"
                                            class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Nhập số căn cước công dân" />
                                        <div
                                            class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('cccd')" class="mt-2" />
                                </div>
                                <button type="submit" class="btn btn-primary buttonedit ml-2">Cập nhật</button>
                            </form>
                        </div>
                        <!-- End Right Column -->
                    </div>

                    <!-- End Grid -->
                </div>

                <!-- End Page Container -->
            </div>

        </div>
    </div>
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    {{-- <script src="assets/js/jquery-3.5.1.min.js"></script> --}}
    <script src="{{ asset('js/adminTournament/jquery-3.5.1.min.js') }}"></script>


    {{-- <script src="assets/js/popper.min.js"></script> --}}
    <script src="{{ asset('js/adminTournament/popper.min.js') }}"></script>
    {{-- <script src="assets/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>

    {{-- <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script> --}}
    <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>

    {{-- <script src="assets/plugins/raphael/raphael.min.js"></script> --}}
    <script src="{{ asset('plugins/adminTournament/raphael/raphael.min.js') }}"></script>

    <script src="assets/plugins/morris/morris.min.js"></script>
    {{-- <script src="assets/js/chart.morris.js"></script> --}}
    <script src="{{ asset('js/adminTournament/chart.morris.js') }}"></script>

    {{-- <script src="assets/js/script.js"></script> --}}
    <script src="{{ asset('js/adminTournament/script.js') }}"></script>
</body>

</html>
