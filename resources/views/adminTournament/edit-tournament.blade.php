<!DOCTYPE html>
<html lang="en">

<head>
    @php
        use App\Models\Player;
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Chỉnh sửa giải đấu</title>
    <meta name="description" content="Cập nhật thông tin giải đấu pool Vietnam">
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    
    <!-- Font Awesome - Latest Version -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Bootstrap CSS -->
    <link rel='preload' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' as='style' onload='this.onload=null;this.rel='stylesheet'>
    <noscript><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'></noscript>
    
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    {{-- <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{ asset('plugins/adminTournament/morris/morris.css') }}">

    {{-- <link rel="stylesheet" href="assets/css/style.css"> </head> --}}
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tab Styles */
        .nav-tabs .nav-link {
            border: none;
            border-radius: 8px 8px 0 0;
            background: rgba(255, 255, 255, 0.7);
            color: #6c757d;
            font-weight: 600;
            padding: 12px 20px;
            margin-right: 4px;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: #495057;
        }
        
        .nav-tabs .nav-link.active {
            background: white;
            color: #2563eb;
            border-bottom: 3px solid #2563eb;
            font-weight: 700;
        }
        
        .tab-content {
            border-radius: 0 0 16px 16px;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 16px 16px 0 0;
            padding: 1.25rem 1.5rem;
        }
        
        .badge {
            font-size: 0.75em;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }
        
        /* Money Input Styling */
        .money-input {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            text-align: right;
            font-size: 1.1rem;
        }
        
        .money-input:focus {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .input-group-text {
            font-weight: 600;
            border-radius: 0;
        }
        
        .input-group .form-control {
            border-left: none;
            border-right: none;
        }
        
        .input-group .form-control:focus {
            border-left: none;
            border-right: none;
        }
        
        .money-input::placeholder {
            font-family: inherit;
            font-weight: normal;
            text-align: left;
        }
        
        /* Font Awesome Backup */
        .fas, .fa-trophy, .fa-sitemap, .fa-edit, .fa-users, .fa-medal, .fa-cog, .fa-user-plus, .fa-crown, .fa-award, .fa-medal, .fa-save, .fa-plus, .fa-search, .fa-sync-alt, .fa-trophy {
            font-family: "Font Awesome 6 Free", "Font Awesome 6 Pro", "Font Awesome 6 Brands", sans-serif !important;
            font-weight: 900 !important;
            font-style: normal !important;
            font-variant: normal !important;
            text-rendering: auto !important;
            line-height: 1 !important;
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
        
        /* Fix menu overlap */
        .page-wrapper .content {
            margin-top: 80px !important;
            z-index: 1;
            position: relative;
        }
        
        .content .d-flex {
            margin-top: 20px;
        }
        
        /* Mobile responsive */
        @media (max-width: 768px) {
            .page-wrapper .content {
                margin-top: 60px !important;
                padding: 1rem !important;
            }
            
            .content .d-flex {
                margin-top: 15px;
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
            }
            
            .content .d-flex .btn {
                width: 100%;
            }
        }
    </style>
    <style>
        .bracket {
            display: grid;
            grid-template-columns: repeat(9, 1fr);
            /* grid-template-rows: repeat(94, 8px); */
            grid-gap: 2px 6px;
            grid-auto-flow: column;
            margin: 20px auto;
            width: 1200px;
            overflow-y: scroll;

            @media (min-width:1400px) {
                grid-template-columns: repeat(11, 1fr);
                width: 1400px;
            }
        }

        .region {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* grid-template-rows: repeat(46, 8px); */
            grid-gap: 2px 6px;
            grid-auto-flow: column;
        }

        .region-1 {
            grid-column: 1 / span 4;
            grid-row: 1 / span 47;
        }

        .final-four {
            grid-column: 4 / span 3;
            grid-row: 45 / span 6;

            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(6, 8px);
            grid-gap: 2px 6px;
            grid-auto-flow: column;

            @media (min-width:1400px) {
                grid-column: 5 / span 3;
            }
        }

        .region-2 {
            grid-column: 1 / span 4;
            grid-row: 49 / span 47
        }

        .region-3 {
            grid-column: -5 / span 4;
            grid-row: 1 / span 47;
        }

        .region-4 {
            grid-column: -5 / span 4;
            grid-row: 49 / span 47
        }


        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .team {
            background-color: white;
            font-size: 11px;
            height: 18px;
            line-height: 18px;
            padding: 0 5px;
        }

        .team-top {
            margin-bottom: 2px;
        }

        .winner {
            background-color: #005eb8;
            color: white;
        }

        .matchup {
            grid-column: span 1;
            grid-row: span 4;
            box-shadow: 1px 1px 10px rgba(0, 0, 0, .5);
        }

        .matchup-1,
        .matchup-9 {
            grid-column: span 1;
            grid-row: span 4;
        }

        .matchup-2,
        .matchup-10 {
            grid-row: 7 / span 4;
        }

        .matchup-3,
        .matchup-11 {
            grid-row: 13 / span 4;
        }

        .matchup-4,
        .matchup-12 {
            grid-row: 19 / span 4;
        }

        .matchup-5,
        .matchup-13 {
            grid-row: 25 / span 4;
        }

        .matchup-6,
        .matchup-14 {
            grid-row: 31 / span 4;
        }

        .matchup-7,
        .matchup-15 {
            grid-row: 37 / span 4;
        }

        .matchup-8,
        .matchup-16 {
            grid-row: 43 / span 4;
        }

        .matchup-17,
        .matchup-25 {
            grid-column: -2/span 1;
            grid-row: 1/span 4;
        }

        .matchup-18,
        .matchup-26 {
            grid-column: -2/span 1;
            grid-row: 7/span 4;
        }

        .matchup-19,
        .matchup-27 {
            grid-column: -2/span 1;
            grid-row: 13/span 4;
        }

        .matchup-20,
        .matchup-28 {
            grid-column: -2/span 1;
            grid-row: 19/span 4;
        }

        .matchup-21,
        .matchup-29 {
            grid-column: -2/span 1;
            grid-row: 25/span 4;
        }

        .matchup-22,
        .matchup-30 {
            grid-column: -2/span 1;
            grid-row: 31/span 4;
        }

        .matchup-23,
        .matchup-31 {
            grid-column: -2/span 1;
            grid-row: 37/span 4;
        }

        .matchup-24,
        .matchup-32 {
            grid-column: -2/span 1;
            grid-row: 43/span 4;
        }

        .matchup-33,
        .matchup-37 {
            grid-column: 2 / span 1;
            grid-row: 4 / span 4;
        }

        .matchup-34,
        .matchup-38 {
            grid-column: 2 / span 1;
            grid-row: 16 / span 4;
        }

        .matchup-35,
        .matchup-39 {
            grid-column: 2 / span 1;
            grid-row: 28 / span 4;
        }

        .matchup-36,
        .matchup-40 {
            grid-column: 2 / span 1;
            grid-row: 40 / span 4;
        }

        .matchup-41,
        .matchup-45 {
            grid-column: -3 / span 1;
            grid-row: 4 / span 4;
        }

        .matchup-42,
        .matchup-46 {
            grid-column: -3 / span 1;
            grid-row: 16 / span 4;
        }

        .matchup-43,
        .matchup-47 {
            grid-column: -3 / span 1;
            grid-row: 28 / span 4;
        }

        .matchup-44,
        .matchup-48 {
            grid-column: -3 / span 1;
            grid-row: 40 / span 4;
        }

        .matchup-49,
        .matchup-51 {
            grid-column: 3 / span 1;
            grid-row: 10 / span 4;
        }

        .matchup-50,
        .matchup-52 {
            grid-column: 3 / span 1;
            grid-row: 34 / span 4;
        }

        .matchup-53,
        .matchup-55 {
            grid-column: -4 / span 1;
            grid-row: 10 / span 4;
        }

        .matchup-54,
        .matchup-56 {
            grid-column: -4 / span 1;
            grid-row: 34 / span 4;
        }

        .matchup-57,
        .matchup-58 {
            grid-column: 4 / span 1;
            grid-row: 22 / span 4;
        }

        .matchup-59,
        .matchup-60 {
            grid-column: -5 / span 1;
            grid-row: 22 / span 4;
        }

        .matchup-61 {
            grid-column: 1 / span 1;
            grid-row: 2/ span 4;
        }

        .matchup-62 {
            grid-column: 3 / span 1;
            grid-row: 2/ span 4;
        }

        .championship {
            grid-column: 2 / span 1;
            grid-row: 1/ span 4;

            .team {
                height: 28px;
                line-height: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        <x-notification />
        <x-admin-tournament.menu />
        <x-admin-tournament.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid w-[95%] bg-white m-auto p-4">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4 mt-5 pt-3">
                    <h3 class="page-title mb-0">
                        <i class="fas fa-trophy text-warning me-2"></i>
                        Quản lý giải đấu: {{ $tournament->name }}
                    </h3>
                    <a href="{{ route('adminTournament.bracket', ['id_tournament' => $tournament->id]) }}" 
                       class="btn btn-primary">
                        <i class="fas fa-sitemap me-2"></i>
                        Sơ đồ nhánh thi đấu
                    </a>
                </div>

                <!-- Bootstrap Tabs -->
                <ul class="nav nav-tabs nav-justified" id="tournamentTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit-tournament" 
                                type="button" role="tab" aria-controls="edit-tournament" aria-selected="true">
                            <i class="fas fa-edit me-2"></i>
                            Chỉnh sửa giải đấu
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="players-tab" data-bs-toggle="tab" data-bs-target="#player-management" 
                                type="button" role="tab" aria-controls="player-management" aria-selected="false">
                            <i class="fas fa-users me-2"></i>
                            Danh sách người chơi đã đăng ký
                            @if(count($player_registed) > 0)
                                <span class="badge bg-primary ms-2">{{ count($player_registed) }}</span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="winners-tab" data-bs-toggle="tab" data-bs-target="#winners-management" 
                                type="button" role="tab" aria-controls="winners-management" aria-selected="false">
                            <i class="fas fa-medal me-2"></i>
                            Danh sách người chơi đạt giải
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-4" id="tournamentTabContent">
                    <!-- Tab 1: Chỉnh sửa giải đấu -->
                    <div class="tab-pane fade show active" id="edit-tournament" role="tabpanel" aria-labelledby="edit-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-cog text-primary me-2"></i>
                                    Thông tin giải đấu
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('adminTournament.editTournament', ['id' => $tournament->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Tên giải đấu</label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="Nhập tên giải đấu" value="{{ $tournament->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Thể loại</label>
                                            <select class="form-control" name="type">
                                                @foreach ($game_types as $game_type)
                                                    <option value="{{ $game_type->id }}"
                                                        {{ $tournament->tournament_game_type->game_type_id == $game_type->id ? 'selected' : '' }}>
                                                        {{ $game_type->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                                        </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Số lượng người tham gia</label><br />
                                        <select class="form-control" name="number_player">
                                            <option value="16"
                                                {{ $tournament->number_players == 16 ? 'selected' : '' }}>
                                                16</option>
                                            <option value="32"
                                                {{ $tournament->number_players == 32 ? 'selected' : '' }}>
                                                32</option>
                                            <option value="64"
                                                {{ $tournament->number_players == 64 ? 'selected' : '' }}>
                                                64</option>
                                            <option value="128"
                                                {{ $tournament->number_players == 128 ? 'selected' : '' }}>
                                                128</option>
                                            <option value="256"
                                                {{ $tournament->number_players == 256 ? 'selected' : '' }}>
                                                256</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('number_player')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thời gian bắt đầu</label>
                                        <input class="form-control" type="datetime-local" name="date_start"
                                            value={{ \Carbon\Carbon::parse($tournament->start_date)->format('Y-m-d\TH:i') }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('date_start')" class="mt-2" />
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Địa điểm thi đấu</label>
                                        <input class="form-control" type="text" name="address"
                                            placeholder="Nhập địa điểm thi đấu" value="{{ $tournament->address }}" />
                                        {{-- <textarea name="address" rows="5">{{ $tournament->address }}</textarea> --}}
                                    </div>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-money-bill-wave text-success me-1"></i>
                                                Lệ phí tham gia (VND)
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-coins"></i>
                                                </span>
                                                <input class="form-control money-input" 
                                                       type="text" 
                                                       name="fees"
                                                       id="fees"
                                                       placeholder="Nhập lệ phí tham gia..." 
                                                       value="{{ number_format($tournament->fees, 0, ',', '.') }}"
                                                       data-original-value="{{ $tournament->fees }}">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Ví dụ: 100.000 VND
                                            </small>
                                            <x-input-error :messages="$errors->get('fees')" class="mt-2" />
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-crown text-warning me-1"></i>
                                                Tiền thưởng vô địch (VND)
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-dark">
                                                    <i class="fas fa-trophy"></i>
                                                </span>
                                                <input class="form-control money-input" 
                                                       type="text" 
                                                       name="money_top_1"
                                                       id="money_top_1"
                                                       placeholder="Nhập số tiền thưởng hạng 1..." 
                                                       value="{{ number_format($tournament->tournament_top_money[0]->money, 0, ',', '.') }}"
                                                       data-original-value="{{ $tournament->tournament_top_money[0]->money }}">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Ví dụ: 5.000.000 VND
                                            </small>
                                            <x-input-error :messages="$errors->get('money_top_1')" class="mt-2" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-award text-secondary me-1"></i>
                                                Tiền thưởng á quân (VND)
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-secondary text-white">
                                                    <i class="fas fa-medal"></i>
                                                </span>
                                                <input class="form-control money-input" 
                                                       type="text" 
                                                       name="money_top_2"
                                                       id="money_top_2"
                                                       placeholder="Nhập số tiền thưởng hạng 2..." 
                                                       value="{{ number_format($tournament->tournament_top_money[1]->money, 0, ',', '.') }}"
                                                       data-original-value="{{ $tournament->tournament_top_money[1]->money }}">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Ví dụ: 3.000.000 VND
                                            </small>
                                            <x-input-error :messages="$errors->get('money_top_2')" class="mt-2" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-medal text-warning me-1"></i>
                                                Tiền thưởng hạng 3 (VND)
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-dark">
                                                    <i class="fas fa-medal"></i>
                                                </span>
                                                <input class="form-control money-input" 
                                                       type="text" 
                                                       name="money_top_3"
                                                       id="money_top_3"
                                                       placeholder="Nhập số tiền thưởng hạng 3..." 
                                                       value="{{ number_format($tournament->tournament_top_money[2]->money, 0, ',', '.') }}"
                                                       data-original-value="{{ $tournament->tournament_top_money[2]->money }}">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Ví dụ: 1.000.000 VND
                                            </small>
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
                                                        {{ in_array($ranking->id, $ranking_tournaments) ? 'checked' : '' }}>
                                                    <label for="ranking">{{ $ranking->name }}</label><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('ranking')" class="mt-2" />
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Trạng thái giải đấu</label>
                                        <select class="form-control" id="sel1" name="tournament_end">
                                            <option value="0"
                                                {{ $tournament->tournament_end == 0 ? 'selected' : '' }}>
                                                Chưa bắt đầu</option>
                                            <option value="1"
                                                {{ $tournament->tournament_end == 1 ? 'selected' : '' }}>
                                                Đang diễn ra</option>
                                            <option value="2"
                                                {{ $tournament->tournament_end == 2 ? 'selected' : '' }}>
                                                Đã kết thúc</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('tournament_end')" class="mt-2" />
                                </div>
                                    </div>

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>
                                            Lưu thông tin giải đấu
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Quản lý người chơi -->
                    <div class="tab-pane fade" id="player-management" role="tabpanel" aria-labelledby="players-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user-plus text-success me-2"></i>
                                    Quản lý người chơi
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Add Player Form -->
                                <form method="POST" action="{{ route('adminTournament.addPlayerRegister', ['id_tournament' => $tournament->id]) }}">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-md-8">
                                            <label class="form-label">Thêm người chơi</label>
                                            <input type="text" id="addPLayer" name="email" 
                                                placeholder="Nhập email người chơi để thêm vào giải đấu..." 
                                                class="form-control" required />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">&nbsp;</label>
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="fas fa-plus me-2"></i>
                                                Thêm người chơi
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Players List -->
                                <form action="{{ route('adminTournament.updatePlayerRegisted', ['id' => $tournament->id]) }}" method="POST">
                                    @csrf
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            Danh sách người chơi đã đăng ký: {{ count($player_registed) }} người
                                        </h6>
                                        <div class="col-md-4">
                                            <input type="text" id="searchInput" placeholder="Tìm kiếm người chơi..."
                                                class="form-control" oninput="searchTable()" />
                                        </div>
                                    </div>
                                    @if (count($player_registed) == 0)
                                        <div class="text-center py-5">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Chưa có người chơi nào đăng ký giải đấu</h5>
                                        </div>
                                    @else
                                        <div class="table-responsive" style="max-height: 500px;">
                                            <table class="table table-hover" id="dataTable">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Tên</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Số điện thoại</th>
                                                        <th scope="col">Hạng</th>
                                                        <th scope="col">Giới tính</th>
                                                        <th scope="col">Trạng thái</th>
                                                        <th scope="col">Thao tác</th>
                                                    </tr>
                                                </thead>
                                <tbody>
                                    @php
                                        $stt = 1;
                                    @endphp
                                    @foreach ($player_registed as $player)
                                                        <tr class="{{ $player->status == 0 ? 'table-warning' : '' }}">
                                            <th scope="row">{{ $stt }}</th>
                                            <td>{{ $player->player->name }}</td>
                                            <td>{{ $player->player->user->email }}</td>
                                            <td>{{ $player->player->phone }}
                                            </td>
                                                            <td><span class="badge bg-primary">{{ $player->player->player_ranking->ranking->name }}</span></td>
                                            <td>{{ $player->player->sex }}</td>
                                            <input type="hidden" name="player_id[]" value="{{ $player->player->id }}">
                                                            <td>
                                                                <select class="form-select form-select-sm" name="status[]">
                                                                    <option value="0" {{ $player->status == 0 ? 'selected' : '' }}>Chờ xét duyệt</option>
                                                                    <option value="1" {{ ($player->status == 1 || $player->status == 2) ? 'selected' : '' }}>Thành công</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('adminTournament.showEditPlayer', ['id' => $player->player->id]) }}"
                                                                   class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-edit"></i>
                                                                    Cập nhật
                                                                </a>
                                                            </td>
                                        </tr>
                                        @php
                                            $stt++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                                            </table>
                                        </div>
                                    @endif

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-sync-alt me-2"></i>
                                            Cập nhật trạng thái người chơi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Quản lý người chơi đạt giải -->
                    <div class="tab-pane fade" id="winners-management" role="tabpanel" aria-labelledby="winners-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-medal text-warning me-2"></i>
                                    Danh sách người chơi đạt giải
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('adminTournament.updatePlayerWin', ['id' => $tournament->id]) }}" method="POST">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-crown text-warning me-1"></i>
                                                Quán quân
                                            </label>
                                            <input type="email" name="top1"
                                                {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                                value="{{ count($tournament->tournament_top_money[0]->achievements) != 0 ? $tournament->tournament_top_money[0]->achievements[0]->player->user->email : '' }}"
                                                class="search-input form-control" 
                                                placeholder="Nhập email người tham gia" />
                                            <div class="search-results mt-2 bg-white border rounded shadow-sm d-none"></div>
                                            <x-input-error :messages="$errors->get('top1')" class="mt-2" />
                                            <small class="text-muted {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[0]->achievements) == 0 ? 'text-danger' : 'd-none' }}">
                                                Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.
                                            </small>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-award text-secondary me-1"></i>
                                                Á quân
                                            </label>
                                            <input type="email" name="top2"
                                                {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                                value="{{ count($tournament->tournament_top_money[1]->achievements) != 0 ? $tournament->tournament_top_money[1]->achievements[0]->player->user->email : '' }}"
                                                class="search-input form-control" 
                                                placeholder="Nhập email người tham gia" />
                                            <div class="search-results mt-2 bg-white border rounded shadow-sm d-none"></div>
                                            <x-input-error :messages="$errors->get('top2')" class="mt-2" />
                                            <small class="text-muted {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[1]->achievements) == 0 ? 'text-danger' : 'd-none' }}">
                                                Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.
                                            </small>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-medal text-warning me-1"></i>
                                                Hạng 3
                                            </label>
                                            <input type="email" name="top3[]"
                                                {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                                value="{{ count($tournament->tournament_top_money[2]->achievements) != 0 ? $tournament->tournament_top_money[2]->achievements[0]->player->user->email : '' }}"
                                                class="search-input form-control" 
                                                placeholder="Nhập email người tham gia" />
                                            <div class="search-results mt-2 bg-white border rounded shadow-sm d-none"></div>
                                            <x-input-error :messages="$errors->get('top3.0')" class="mt-2" />
                                            <small class="text-muted {{ $tournament->tournament_end == 2 && count($tournament->tournament_top_money[2]->achievements) == 0 ? 'text-danger' : 'd-none' }}">
                                                Vui lòng cập nhật giải thưởng khi trận đấu kết thúc.
                                            </small>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-medal text-warning me-1"></i>
                                                Hạng 3 (thứ 2)
                                            </label>
                                            <input type="email" name="top3[]"
                                                {{ $tournament->tournament_end != 2 ? 'disabled' : '' }}
                                                value="{{ count($tournament->tournament_top_money[2]->achievements) > 1 ? $tournament->tournament_top_money[2]->achievements[1]->player->user->email : '' }}"
                                                class="search-input form-control" 
                                                placeholder="Nhập email người tham gia" />
                                            <div class="search-results mt-2 bg-white border rounded shadow-sm d-none"></div>
                                            <x-input-error :messages="$errors->get('top3.1')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-trophy me-2"></i>
                                            Cập nhật người chơi đạt giải
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_match" class="modal fade    " role="dialog" tabindex="-1" role="dialog"
        aria-labelledby="deleteMatchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center"> <img class=" m-auto"
                        src="{{ asset('images/adminTournament/sent.png') }}" alt="" width="50"
                        height="46">
                    <h3 class="delete_class">Bạn đồng ý xoá trận đấu<span id="tournamentName"></span>?</h3>
                    <div class="m-t-20 flex relative"> <a href="#" class="btn btn-white"
                            data-dismiss="modal">Huỷ</a>
                        <form action="{{ route('adminTournament.deleteMatch') }}" method="POST">
                            @csrf
                            <input type="hidden" id="matchId" name="match_id" value="">
                            <button type="submit" class="btn btn-danger absolute right-[10px]">Xoá</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/js/script.js"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });
    </script>
    @if (session('scroll_to_input'))
        <script>
            console.log('asdfasdf');
            
            window.onload = function() {
                const input = document.getElementById("addPLayer");
                if (input) {
                    input.scrollIntoView({ behavior: "smooth", block: "center" });
                    input.focus();
                }
            };
        </script>
    @endif
</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    // Font Awesome Check
    document.addEventListener('DOMContentLoaded', function() {
        const fasIcons = document.querySelectorAll('.fas');
        fasIcons.forEach(function(icon) {
            if (!icon.style.fontFamily.includes('Font Awesome')) {
                icon.style.fontFamily = '"Font Awesome 6 Free", sans-serif';
                icon.style.fontWeight = '900';
            }
        });
        
        console.log('FontAwesome icons loaded:', fasIcons.length);
        
        // Money Input Formatting
        const moneyInputs = document.querySelectorAll('.money-input');
        moneyInputs.forEach(function(input) {
            // Format on input
            input.addEventListener('input', function() {
                formatMoneyInput(this);
            });
            
            // Format on focus
            input.addEventListener('focus', function() {
                if (this.value === '') {
                    this.placeholder = 'Nhập số tiền...';
                }
            });
            
            // Store original value on blur
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.value = this.getAttribute('data-original-value') || '';
                    formatMoneyInput(this);
                }
            });
            
            // Format on paste
            input.addEventListener('paste', function(e) {
                setTimeout(() => {
                    formatMoneyInput(this);
                }, 10);
            });
        });
        
        function formatMoneyInput(input) {
            let value = input.value.replace(/[^\d]/g, ''); // Remove non-digits
            
            if (value === '') {
                input.value = '';
                return;
            }
            
            // Format with dots as thousands separators
            let formattedValue = parseInt(value).toLocaleString('vi-VN');
            input.value = formattedValue;
            
            // Add visual feedback
            input.style.color = '#28a745';
            setTimeout(() => {
                input.style.color = '';
            }, 1000);
        }
        
        // Form submission handler for money inputs
        const forms = document.querySelectorAll('form');
        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const moneyInputs = form.querySelectorAll('.money-input');
                moneyInputs.forEach(function(input) {
                    // Convert formatted value back to number for submission
                    let numericValue = input.value.replace(/[^\d]/g, '');
                    input.value = numericValue;
                });
            });
        });
        
        // Bootstrap Tab Fix
        const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabLinks.forEach(function(tabLink) {
            tabLink.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                tabLinks.forEach(function(link) {
                    link.classList.remove('active');
                    link.setAttribute('aria-selected', 'false');
                });
                
                // Hide all tab panes
                tabPanes.forEach(function(pane) {
                    pane.classList.remove('show', 'active');
                });
                
                // Add active class to clicked tab
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
                
                // Show corresponding tab pane
                const targetPane = document.querySelector(this.getAttribute('data-bs-target'));
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }
                
                console.log('Tab switched to:', this.getAttribute('data-bs-target'));
            });
        });
    });

    const openFilter = document.getElementById('openFilter');
    const filter = document.getElementById('filter');
    const bgFilter = document.getElementById('bgFilter');
    const close_Filter = document.getElementById('closeFilter');

    if (openFilter && filter && bgFilter && close_Filter) {
        openFilter.addEventListener('click', function() {
            filter.classList.remove('hidden');
            bgFilter.classList.remove('hidden');
        });
        close_Filter.addEventListener('click', function() {
            filter.classList.add('hidden');
            bgFilter.classList.add('hidden');
        });
    }
</script>

<script>
    function formatMoney(input) {
        // Loại bỏ ký tự không phải số
        let value = input.value.replace(/[^0-9]/g, '');
        // Định dạng thành tiền tệ Việt Nam
        input.value = new Intl.NumberFormat('vi-VN').format(value);
    }
</script>

<script>
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('dataTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Bỏ qua hàng tiêu đề
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].textContent || cells[j].innerText;
                if (cellText.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }
</script>
<script>
    @php
        $emails = [];
        foreach ($tournament->player_registed_tournament as $played) {
            if ($played->status == 1) {
                $emails[] = $played->player->user->email;
            }
        }
    @endphp
    // Mảng chứa dữ liệu email từ PHP (hoặc dữ liệu bạn muốn tìm kiếm)
    const searchData = <?php echo json_encode($emails); ?>;

    // Lấy tất cả các ô input có class là 'search-input'
    const searchInputs = document.querySelectorAll('.search-input');

    searchInputs.forEach(searchInput => {
        const searchResults = searchInput.nextElementSibling; // Lấy thẻ div chứa kết quả tìm kiếm

        // Function để render các kết quả tìm kiếm
        function renderSearchResults(filteredData) {
            // Xóa kết quả cũ
            searchResults.innerHTML = '';

            // Nếu không có kết quả tìm kiếm, hiển thị thông báo "No results"
            if (filteredData.length === 0) {
                searchResults.innerHTML = `<div class="p-3 text-gray-500">Không tìm thấy người chơi</div>`;
                searchResults.classList.remove('hidden');
                return;
            }

            // Duyệt qua mảng dữ liệu và hiển thị mỗi kết quả
            filteredData.forEach(result => {
                const resultItem = document.createElement('div');
                resultItem.classList.add('p-3', 'border-t', 'border-gray-200', 'hover:bg-gray-50',
                    'cursor-pointer');
                resultItem.textContent = result;

                // Thêm sự kiện click vào mỗi kết quả
                resultItem.addEventListener('click', function() {
                    // Khi click vào kết quả, tự động điền vào input
                    searchInput.value = result;

                    // Ẩn kết quả sau khi chọn
                    searchResults.classList.add('hidden');
                });

                // Thêm phần tử kết quả vào danh sách
                searchResults.appendChild(resultItem);
            });

            // Hiển thị kết quả tìm kiếm
            searchResults.classList.remove('hidden');
        }

        // Sự kiện input để lọc dữ liệu
        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            const filteredData = searchData.filter(item =>
                item.toLowerCase().includes(query)
            );
            renderSearchResults(filteredData);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#delete_match').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Nút kích hoạt modal
            var matchId = button.data('id'); // Lấy ID giải đấu

            // Cập nhật nội dung modal
            var modal = $(this);
            modal.find('#matchId').val(matchId);
        });
    });
</script>
//hodel khi thêm cơ thủ



</html>
