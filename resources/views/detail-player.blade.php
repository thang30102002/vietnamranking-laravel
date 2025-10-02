@php
    use App\Models\Player;
@endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cơ thủ - {{ $player->name }}</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    
    <!-- Original CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flex-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-lugx-gaming.css') }}">
    
    <!-- Hero Fix CSS -->
    <link rel="stylesheet" href="{{ asset('css/hero-fix.css') }}">
    
    <!-- Detail Player Fix CSS -->
    <link rel="stylesheet" href="{{ asset('css/detail-player-fix.css') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#21324C',
                        'secondary': '#F4A261',
                        'accent': '#E76F51',
                        'dark': '#264653',
                        'light': '#F1FAEE'
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #21324C 0%, #264653 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .skill-bar {
            background: linear-gradient(90deg, #F4A261 0%, #E76F51 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stats-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <x-menu />
    <x-notification />
    
    <!-- Hero Section -->
    <div class="relative pt-20 pb-16">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-block relative">
                    @php
                        $file_name = 'players/' . $player->id . '/' . $player->img;
                    @endphp
                    @if (Storage::disk('public')->exists($file_name))
                        <img class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-2xl object-cover" 
                             src="{{ Storage::url($file_name) }}" alt="{{ $player->name }}">
                    @else
                        <img class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-2xl object-cover" 
                             src="{{ asset('images/players/player.webp') }}" alt="{{ $player->name }}">
                    @endif
                    <div class="absolute -bottom-2 -right-2 bg-secondary text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg shadow-lg">
                        #{{ $top }}
                    </div>
                </div>
                <h1 class="mt-6 text-4xl sm:text-5xl font-bold text-white">{{ $player->name }}</h1>
                <p class="mt-2 text-xl text-gray-200">{{ $player->player_ranking->ranking->name }} • {{ $player->point }} điểm</p>
                <div class="mt-4 flex justify-center space-x-4 text-white">
                    <span class="hero-badge-solid px-4 py-2 rounded-full text-sm font-medium">
                        <i class="fas fa-trophy mr-2"></i>{{ $money }}
                    </span>
                    <span class="hero-badge-solid px-4 py-2 rounded-full text-sm font-medium">
                        <i class="fas fa-phone mr-2"></i>{{ preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $player->phone) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column - Player Info & Skills -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Player Stats Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 card-hover animate-fade-in">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-line text-primary mr-3"></i>
                        Thống kê
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Hạng hiện tại</span>
                            <span class="text-primary font-bold">{{ $player->player_ranking->ranking->name }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Điểm số</span>
                            <span class="text-primary font-bold">{{ $player->point }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Xếp hạng</span>
                            <span class="text-primary font-bold">Top {{ $top }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Giới tính</span>
                            <span class="text-primary font-bold">{{ $player->sex }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600 font-medium">Tổng tiền thưởng</span>
                            <span class="text-secondary font-bold">{{ $money }}</span>
                        </div>
                    </div>
                </div>

                <!-- Skills Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6 card-hover animate-fade-in">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-star text-secondary mr-3"></i>
                        Kỹ năng
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Độ chính xác bi đơn</span>
                                <span class="text-sm font-bold text-primary">90%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="skill-bar h-2 rounded-full" style="width: 90%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Kỹ năng giải hình</span>
                                <span class="text-sm font-bold text-primary">80%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="skill-bar h-2 rounded-full" style="width: 80%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Kỹ năng nhảy bi</span>
                                <span class="text-sm font-bold text-primary">75%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="skill-bar h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Kỹ năng thủ bi</span>
                                <span class="text-sm font-bold text-primary">50%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="skill-bar h-2 rounded-full" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Tournaments, Achievements, Matches -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Tournaments Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover animate-fade-in">
                    <div class="bg-gradient-to-r from-primary to-dark p-6">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-calendar-days mr-3"></i>
                            Giải đấu đã tham gia
                            @php
                                $count_registed = count($player->player_registed_tournament);
                            @endphp
                            <span class="ml-auto hero-badge-solid px-3 py-1 rounded-full text-sm">{{ $count_registed }} giải</span>
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($count_registed === 0)
                            <div class="text-center py-12 text-gray-500">
                                <i class="fas fa-calendar-times text-4xl mb-4"></i>
                                <p>Chưa tham gia giải đấu nào</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Giải đấu</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Tổ chức</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Ngày</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Lệ phí</th>
                                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($player->player_registed_tournament as $player_registed_tournament)
                                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                <td class="py-3 px-4 font-medium text-gray-900">{{ $player_registed_tournament->tournament->name }}</td>
                                                <td class="py-3 px-4 text-gray-600">{{ $player_registed_tournament->tournament->admin_tournament->name }}</td>
                                                <td class="py-3 px-4 text-gray-600">{{ date('d/m/Y', strtotime($player_registed_tournament->tournament->start_date)) }}</td>
                                                <td class="py-3 px-4 text-gray-600">{{ number_format($player_registed_tournament->tournament->fees, 0, ',', '.') }} VNĐ</td>
                                                <td class="py-3 px-4">
                                                    @if ($player_registed_tournament->status === 1)
                                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Thành công</span>
                                                    @else
                                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">Đang phê duyệt</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Achievements Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover animate-fade-in">
                    <div class="bg-gradient-to-r from-secondary to-accent p-6">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-trophy mr-3"></i>
                            Thành tích
                            @php
                                $player_achievements = count($player->achievement);
                            @endphp
                            <span class="ml-auto hero-badge-solid px-3 py-1 rounded-full text-sm">{{ $player_achievements }} giải</span>
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($player_achievements === 0)
                            <div class="text-center py-12 text-gray-500">
                                <i class="fas fa-trophy text-4xl mb-4 text-gray-300"></i>
                                <p>Chưa có thành tích nào</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($player->achievement as $achievement)
                                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-xl border border-yellow-200">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="font-semibold text-gray-800">{{ $achievement->tournament_top_money->tournament->name }}</h4>
                                                <p class="text-sm text-gray-600">
                                                    @if ($achievement->tournament_top_money->top == 1)
                                                        <span class="text-yellow-600 font-medium">🥇 Quán quân</span>
                                                    @elseif ($achievement->tournament_top_money->top == 2)
                                                        <span class="text-gray-600 font-medium">🥈 Á quân</span>
                                                    @else
                                                        <span class="text-orange-600 font-medium">🥉 Hạng 3</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-secondary">{{ number_format($achievement->tournament_top_money->money, 0, ',', '.') }} VNĐ</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Matches Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover animate-fade-in">
                    <div class="bg-gradient-to-r from-dark to-primary p-6">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-handshake mr-3"></i>
                            Trận đấu đã tham gia
                            <span class="ml-auto hero-badge-solid px-3 py-1 rounded-full text-sm">{{ count($matches) }} trận</span>
                        </h3>
                    </div>
                    <div class="p-6">
                        @if (count($matches) === 0)
                            <div class="text-center py-12 text-gray-500">
                                <i class="fas fa-handshake text-4xl mb-4 text-gray-300"></i>
                                <p>Chưa tham gia trận đấu nào</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach ($matches as $match)
                                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="font-semibold text-gray-800">{{ $match->tournament->name }}</h4>
                                            <span class="bg-primary text-white px-2 py-1 rounded-full text-xs">Vòng {{ $match->round }}</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p class="text-gray-600">Bàn thi đấu: <span class="font-medium">Bàn {{ $match->location }}</span></p>
                                                <p class="text-gray-600">Cơ thủ 1: <span class="font-medium">{{ Player::find($match->player_id_1)->name }}</span></p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600">Cơ thủ 2: <span class="font-medium">{{ Player::find($match->player_id_2)->name }}</span></p>
                                                <p class="text-gray-600">Tỉ số: <span class="font-medium text-primary">{{ $match->point_1 }} - {{ $match->point_2 }}</span></p>
                                            </div>
                                        </div>
                                        @if ($match->player_id_win != null)
                                            <div class="mt-2 pt-2 border-t border-gray-200">
                                                <p class="text-sm text-gray-600">
                                                    Người thắng: <span class="font-bold text-green-600">{{ Player::find($match->player_id_win)->name }}</span>
                                                </p>
                                            </div>
                                        @else
                                            <div class="mt-2 pt-2 border-t border-gray-200">
                                                <p class="text-sm text-gray-500">Trận đấu chưa kết thúc</p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <!-- Smooth scrolling and animations -->
    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.card-hover').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>
