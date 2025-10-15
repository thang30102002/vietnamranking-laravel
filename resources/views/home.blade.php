<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VietNamPool - Hệ thống quản lý giải đấu billiard hàng đầu Việt Nam</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">

    <style>
        :root {
            --primary-color: #21324C;
            --secondary-color: #2d3748;
            --accent-color: #38a169;
            --warning-color: #d69e2e;
            --danger-color: #e53e3e;
            --light-color: #f7fafc;
            --dark-color: #1a202c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            color: white;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0.9;
            color: white;
        }

        .hero-description {
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            opacity: 0.8;
            line-height: 1.8;
            color: white;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-hero-primary {
            background: #2d7d32;
            color: white;
            border-color: #2d7d32;
        }

        .btn-hero-primary:hover {
            background: transparent;
            color: #2d7d32;
            border-color: #2d7d32;
            transform: translateY(-2px);
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            border-color: white;
        }

        .btn-hero-secondary:hover {
            background: white;
            color: #21324C;
            transform: translateY(-2px);
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: var(--light-color);
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #21324C, #2d3748);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1a202c;
        }

        .feature-description {
            color: #4a5568;
            line-height: 1.6;
        }

        /* Tournament Management Section */
        .tournament-management {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
        }

        .tournament-management::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        }

        .management-content {
            position: relative;
            z-index: 2;
        }

        .management-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: white;
        }

        .management-subtitle {
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 3rem;
            opacity: 0.9;
            color: white;
        }

        .management-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .management-image-section {
            margin: 4rem 0;
            text-align: center;
        }

        .management-image-container {
            position: relative;
            display: inline-block;
            max-width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 2rem;
        }

        .management-image {
            width: 100%;
            max-width: 800px;
            height: auto;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .management-image:hover {
            transform: scale(1.02);
        }

        .management-image-caption {
            margin-top: 1.5rem;
            font-size: 1.1rem;
            opacity: 0.9;
            color: white;
            font-style: italic;
        }

        .management-image-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(45, 125, 50, 0.9);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .management-feature {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .management-feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .management-feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: white;
        }

        .management-feature-description {
            opacity: 0.9;
            line-height: 1.6;
            color: white;
        }

        /* Players Section */
        .players-section {
            padding: 100px 0;
            background: white;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: #1a202c;
        }

        .section-subtitle {
            font-size: 1.2rem;
            text-align: center;
            color: #4a5568;
            margin-bottom: 3rem;
        }

        .player-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }

        .player-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .player-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.5rem;
            border: 4px solid #2d7d32;
        }

        .player-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1a202c;
        }

        .player-rank {
            color: #2d7d32;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .player-money {
            color: #d97706;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Tournaments Section */
        .tournaments-section {
            padding: 100px 0;
            background: var(--light-color);
        }

        .tournament-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }

        .tournament-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .tournament-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }

        .tournament-organizer {
            color: #21324C;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .tournament-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1a202c;
        }

        .tournament-btn {
            background: #2d7d32;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .tournament-btn:hover {
            background: #1b5e20;
            color: white;
            transform: translateY(-2px);
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .cta-card {
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 3rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
        }

        .cta-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            color: white;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
            
            .management-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .feature-card,
            .player-card,
            .tournament-card {
                padding: 1.5rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .management-image-container {
                padding: 1rem;
                margin: 0 1rem;
            }
            
            .management-image {
                max-width: 100%;
            }
            
            .management-image-badge {
                top: 0.5rem;
                right: 0.5rem;
                font-size: 0.8rem;
                padding: 0.3rem 0.8rem;
            }
            
            .management-image-caption {
                font-size: 1rem;
                margin-top: 1rem;
            }
        }

        /* Animation */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 1.5rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }
    </style>
</head>

<body>
    <x-notification />
    <x-menu />

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-right">
                        <h1 class="hero-title">VietNamPool</h1>
                        <h2 class="hero-subtitle">Hệ thống quản lý giải đấu billiard hàng đầu Việt Nam</h2>
                        <p class="hero-description">
                            VietNamPool với sứ mệnh tổ chức và quản lý giải đấu hàng tuần, đảm bảo tính chuyên nghiệp và uy tín cho các giải đấu. 
                            VietNamPool còn là hệ thống tính điểm ranking và xếp hạng cơ thủ billiard chuyên nghiệp và nghiệp dư đầu tiên tại Việt Nam.
                        </p>
                        <div class="hero-buttons">
                            <a href="/ranking" class="btn-hero btn-hero-primary">
                                <i class="fas fa-trophy"></i>
                                Xem bảng xếp hạng
                            </a>
                            <a href="/tournament" class="btn-hero btn-hero-secondary">
                                <i class="fas fa-calendar-alt"></i>
                                Giải đấu
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-left">
                        <img src="https://images2.thanhnien.vn/528068263637045248/2024/10/18/463758959947418277417775222465921802320230n-17292766562811842147559.jpg"
                             alt="VietNamPool" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
    </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h4 class="feature-title">Giới thiệu</h4>
                        <p class="feature-description">Tìm hiểu về hệ thống VietNamPool và các tính năng nổi bật</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h4 class="feature-title">Tin tức</h4>
                        <p class="feature-description">Cập nhật tin tức mới nhất về billiard và giải đấu</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4 class="feature-title">Bảng xếp hạng</h4>
                        <p class="feature-description">Xem thứ hạng và thành tích của các cơ thủ</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h4 class="feature-title">Liên hệ</h4>
                        <p class="feature-description">Liên hệ với chúng tôi để được hỗ trợ</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tournament Management Section -->
    <section class="tournament-management">
        <div class="container">
            <div class="management-content">
                <h2 class="management-title" data-aos="fade-up">Quản lý giải đấu tự động</h2>
                <p class="management-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Hệ thống tự động sắp xếp bảng đấu và nhánh đấu thông minh
                </p>
                
                <!-- Tournament Bracket Image -->
                <div class="management-image-section" data-aos="fade-up" data-aos-delay="150">
                    <div class="management-image-container">
                        <div class="management-image-badge">
                            <i class="fas fa-eye"></i>
                            Xem trực tiếp
                        </div>
                        <img src="{{ asset('images/bracket-tournament.png') }}" 
                             alt="Giao diện quản lý giải đấu tự động" 
                             class="management-image">
                        <p class="management-image-caption">
                            Giao diện quản lý giải đấu với bảng đấu tự động và nhánh đấu thông minh
                        </p>
                    </div>
                </div>

                <div class="management-features">
                    <div class="management-feature" data-aos="fade-up" data-aos-delay="200">
                        <div class="management-feature-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h4 class="management-feature-title">Tự động sắp xếp bảng đấu</h4>
                        <p class="management-feature-description">
                            Hệ thống tự động tạo bảng đấu dựa trên số lượng người chơi và thể thức thi đấu, 
                            đảm bảo tính công bằng và chuyên nghiệp.
                        </p>
                    </div>
                    
                    <div class="management-feature" data-aos="fade-up" data-aos-delay="300">
                        <div class="management-feature-icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <h4 class="management-feature-title">Nhánh đấu thông minh</h4>
                        <p class="management-feature-description">
                            Tự động tạo nhánh thắng và nhánh thua, quản lý vòng loại trực tiếp một cách chuyên nghiệp 
                            và dễ dàng theo dõi.
                        </p>
                    </div>
                    
                    <div class="management-feature" data-aos="fade-up" data-aos-delay="400">
                        <div class="management-feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="management-feature-title">Theo dõi kết quả real-time</h4>
                        <p class="management-feature-description">
                            Cập nhật kết quả trực tiếp, tự động tính toán và cập nhật bảng xếp hạng 
                            ngay sau mỗi trận đấu.
                        </p>
                    </div>
                    
                    <div class="management-feature" data-aos="fade-up" data-aos-delay="500">
                        <div class="management-feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="management-feature-title">Tối ưu cho mobile</h4>
                        <p class="management-feature-description">
                            Giao diện thân thiện với thiết bị di động, dễ dàng quản lý và theo dõi 
                            giải đấu mọi lúc mọi nơi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Players Section -->
    <section class="players-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Thợ săn tiền thưởng</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Top cơ thủ xuất sắc nhất</p>
            
            <div class="row">
                @foreach ($players_top_4 as $index => $player)
                    @php
                        $file_name = 'players/' . $player->id . '/' . $player->img;
                    @endphp
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="player-card">
                                @if (Storage::disk('public')->exists($file_name))
                                <img src="{{ Storage::url($file_name) }}" alt="{{ $player->name }}" class="player-avatar">
                                @else
                                <img src="{{ asset('images/players/player.webp') }}" alt="{{ $player->name }}" class="player-avatar">
                                @endif
                            <h4 class="player-name">{{ $player->name }}</h4>
                            <div class="player-rank">Hạng: {{ $player->player_ranking->ranking->name }}</div>
                            <div class="player-money">
                                Tổng tiền thưởng: {{ number_format($player->player_money->money, 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="500">
                <a href="/ranking" class="btn-hero btn-hero-primary">
                    <i class="fas fa-trophy"></i>
                    Xem bảng xếp hạng đầy đủ
                </a>
            </div>
        </div>
    </section>

    <!-- Tournaments Section -->
    <section class="tournaments-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Giải đấu sắp diễn ra</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Tham gia các giải đấu hấp dẫn</p>
            
            @if (count($tournaments_apply) == 0)
                <div class="text-center py-5" data-aos="fade-up">
                    <i class="fas fa-calendar-times text-muted" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                    <h4 class="text-muted">Chưa có giải đấu nào sắp diễn ra</h4>
                    <p class="text-muted">Hãy quay lại sau để xem các giải đấu mới!</p>
                </div>
                @else
                <div class="row">
                    @foreach ($tournaments_apply as $index => $tournament)
                        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="tournament-card">
                                <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $tournament->name }}" class="tournament-image">
                                <div class="tournament-organizer">{{ $tournament->admin_tournament->name }}</div>
                                <h4 class="tournament-name">{{ $tournament->name }}</h4>
                                <a href="/tournament" class="tournament-btn">
                                    <i class="fas fa-user-plus"></i>
                                    Đăng ký tham gia
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            
            <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="500">
                <a href="/tournament" class="btn-hero btn-hero-primary">
                    <i class="fas fa-calendar-alt"></i>
                    Xem tất cả giải đấu
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-card" data-aos="fade-up">
                        <h2 class="cta-title">Tham gia cộng đồng VietNamPool</h2>
                        <p class="cta-description">
                            Hệ thống VietNamPool là hệ thống quản lý cơ thủ đầu tiên tại Việt Nam. 
                            Các cơ thủ được xếp hạng theo thành tích đảm bảo tính công bằng khi tham gia các giải đấu trên hệ thống.
                        </p>
                        <div class="cta-buttons">
                            <a href="/login" class="btn-hero btn-hero-primary">
                                <i class="fas fa-user-plus"></i>
                                Đăng ký ngay
                            </a>
                            <a href="/login" class="btn-hero btn-hero-secondary">
                                <i class="fas fa-trophy"></i>
                                Tổ chức giải đấu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.main-nav');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>