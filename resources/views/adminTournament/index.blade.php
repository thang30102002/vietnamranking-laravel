﻿<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Quản lý giải đấu</title>
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

<body>
    <div class="main-wrapper">
        <x-admin-tournament.menu />
        <x-admin-tournament.sidebar />
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <h3 class="page-title mt-3">Xin chào {{ $admin_tournament->name }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Trang chủ</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" grid grid-cols-3 gap-4">
                    <div class="">
                        <div class="card board1 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">236</h3>
                                        <h6 class="text-muted pt-3">Người tham gia</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user-plus">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="8.5" cy="7" r="4"></circle>
                                                <line x1="20" y1="8" x2="20" y2="14">
                                                </line>
                                                <line x1="23" y1="11" x2="17" y2="11">
                                                </line>
                                            </svg></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card board1 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">180</h3>
                                        <h6 class="text-muted pt-3">Tổng tiền thưởng</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-dollar-sign">
                                                <line x1="12" y1="1" x2="12" y2="23">
                                                </line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card board1 fill">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <div>
                                        <h3 class="card_widget_header">{{ count($admin_tournament->tournament)}}</h3>
                                        <h6 class="text-muted pt-3">Tổng giải đấu</h6>
                                    </div>
                                    <div class="ml-auto mt-md-3 mt-lg-0"> <span class="opacity-7 text-muted"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewbox="0 0 24 24" fill="none" stroke="#009688" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-file-plus">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                </path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="12" y1="18" x2="12" y2="12">
                                                </line>
                                                <line x1="9" y1="15" x2="15" y2="15">
                                                </line>
                                            </svg></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card card-table flex-fill">
                            <div class="card-header">
                                <h4 class="card-title float-left mt-2">Booking</h4>
                                <button type="button" class="btn btn-primary float-right veiwbutton">Veiw
                                    All</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center">
                                        <thead>
                                            <tr>
                                                <th>Booking ID</th>
                                                <th>Name</th>
                                                <th>Email ID</th>
                                                <th>Aadhar Number</th>
                                                <th class="text-center">Room Type</th>
                                                <th class="text-right">Number</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>BKG-0001</div>
                                                </td>
                                                <td class="text-nowrap">Tommy Bernal</td>
                                                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="3743585a5a4e55524559565b77524f565a475b521954585a">[email&#160;protected]</a>
                                                </td>
                                                <td>12414786454545</td>
                                                <td class="text-center">Double</td>
                                                <td class="text-right">
                                                    <div>631-254-6480</div>
                                                </td>
                                                <td class="text-center"> <span
                                                        class="badge badge-pill bg-success inv-badge">INACTIVE</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>BKG-0002</div>
                                                </td>
                                                <td class="text-nowrap">Ellen Thill</td>
                                                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="89fbe0eae1e8fbedebfbe6ebfafdc9ecf1e8e4f9e5eca7eae6e4">[email&#160;protected]</a>
                                                </td>
                                                <td>5456223232322</td>
                                                <td class="text-center">Double</td>
                                                <td class="text-right">
                                                    <div>830-468-1042</div>
                                                </td>
                                                <td class="text-center"> <span
                                                        class="badge badge-pill bg-success inv-badge">INACTIVE</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>BKG-0003</div>
                                                </td>
                                                <td class="text-nowrap">Corina Kelsey</td>
                                                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="76131a1a1318021e1f1a1a36130e171b061a135815191b">[email&#160;protected]</a>
                                                </td>
                                                <td>454543232625</td>
                                                <td class="text-center">Single</td>
                                                <td class="text-right">
                                                    <div>508-335-5531</div>
                                                </td>
                                                <td class="text-center"> <span
                                                        class="badge badge-pill bg-success inv-badge">INACTIVE</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>BKG-0004</div>
                                                </td>
                                                <td class="text-nowrap">Carolyn Lane</td>
                                                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="50333f22393e313b353c23352910373d31393c7e333f3d">[email&#160;protected]</a>
                                                </td>
                                                <td>2368989562621</td>
                                                <td class="text-center">Double</td>
                                                <td class="text-right">
                                                    <div>262-260-1170</div>
                                                </td>
                                                <td class="text-center"> <span
                                                        class="badge badge-pill bg-success inv-badge">INACTIVE</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div>BKG-0005</div>
                                                </td>
                                                <td class="text-nowrap">Denise</td>
                                                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="1c7f7d6e73706572707d72795c7b717d7570327f7371">[email&#160;protected]</a>
                                                </td>
                                                <td>3245455582287</td>
                                                <td class="text-center">Single</td>
                                                <td class="text-right">
                                                    <div>570-458-0070</div>
                                                </td>
                                                <td class="text-center"> <span
                                                        class="badge badge-pill bg-success inv-badge">INACTIVE</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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