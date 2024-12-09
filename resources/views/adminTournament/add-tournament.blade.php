<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Thêm giải đấu</title>
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
    @vite('resources/css/app.css')
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
                            <h3 class="page-title mt-5">Thêm giải đấu</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('adminTournament.addtournament') }}" method="POST">
                            @csrf
                            <div class="row formtype">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tên giải đấu</label>
                                        <input class="form-control" type="text" name="name" placeholder="Nhập tên giải đấu"
                                            value="{{ old('name') }}">
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thể loại</label>
                                        <select class="form-control" id="sel1" name="type">
                                            @foreach ($game_types as $game_type)
                                                <option value="{{ $game_type->id }}"
                                                    {{ old('type') == $game_type->id ? 'selected' : '' }}>
                                                    {{ $game_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Số lượng người tham gia</label>
                                        <input class="form-control" type="number" name="number_player" placeholder="Nhập số lượng người tham gia"
                                            value={{ old('number_player') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('number_player')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thời gian bắt đầu</label>
                                        <input class="form-control" type="datetime-local" name="date_start"
                                            value={{ old('date_start') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('date_start')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Địa điểm thi đấu</label>
                                        <input class="form-control" type="text" name="address" placeholder="Nhập địa điểm thi đấu"
                                            value={{ old('address') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lệ phí tham gia</label>
                                        <input class="form-control" type="number" name="fees" placeholder="Nhập lệ phí tham gia"
                                            value={{ old('fees') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('fees')" class="mt-2" />
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tiền thưởng vô địch (VND)</label>
                                        <input class="form-control" type="number" name="money_top_1" placeholder="Nhập số tiền thưởng hạng 1"
                                            value={{ old('money_top_1') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_1')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tiền thưởng á quân (VND)</label>
                                        <input class="form-control" type="number" name="money_top_2" placeholder="Nhập số tiền thưởng hạng 2"
                                            value={{ old('money_top_2') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_2')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tiền thưởng hạng 3 (VND)</label>
                                        <input class="form-control" type="number" name="money_top_3" placeholder="Nhập số tiền thưởng hạng 3"
                                            value={{ old('money_top_3') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('money_top_3')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Hạng người chơi được tham gia</label>
                                        <div class=" grid grid-cols-3">
                                            @foreach ($rankings as $ranking)
                                                <div class=" flex items-baseline space-x-4">
                                                    <input class="" type="checkbox" name="ranking[]"
                                                        value={{ $ranking->id }}
                                                        {{ in_array($ranking->id, old('ranking', [])) ? 'checked' : '' }}>
                                                    <label for="ranking">{{ $ranking->name }}</label><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('ranking')" class="mt-2" />
                                </div>
                            </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit ml-2">Lưu</button>
                <button type="button" class="btn btn-primary buttonedit">Huỷ</button>
                </form>
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
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
</body>

</html>
