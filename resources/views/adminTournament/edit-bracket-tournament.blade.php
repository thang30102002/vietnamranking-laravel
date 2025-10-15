<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bảng đấu - {{ $tournament->name ?? 'Giải đấu' }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- jQuery Bracket CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.css" />
    
    <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Mermaid -->
    <script src="https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.min.js"></script>

  <style>
        :root {
            --bracket-primary: #2563eb;
            --bracket-secondary: #64748b;
            --bracket-success: #10b981;
            --bracket-warning: #f59e0b;
            --bracket-danger: #ef4444;
            --bracket-bg: #f8fafc;
            --bracket-card: #ffffff;
            --bracket-border: #e2e8f0;
            --bracket-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
        }

        .bracket-container {
            background: var(--bracket-card);
            border-radius: 20px;
            box-shadow: var(--bracket-shadow);
            margin: 20px;
            padding: 30px;
            min-height: calc(100vh - 40px);
        }

        .bracket-header {
            background: linear-gradient(135deg, var(--bracket-primary) 0%, #1d4ed8 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }

        .bracket-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .bracket-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .setup-section {
            background: var(--bracket-bg);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border: 2px solid var(--bracket-border);
        }

        .setup-title {
            color: var(--bracket-primary);
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid var(--bracket-border);
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--bracket-primary);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .btn {
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--bracket-primary) 0%, #1d4ed8 100%);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--bracket-success) 0%, #059669 100%);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            border: none;
        }

        .flex-fill {
            min-width: 0;
        }

        .gap-2 {
            gap: 0.5rem !important;
        }

        .player-input-group {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border: 2px solid var(--bracket-border);
            transition: all 0.3s ease;
            height: 100%;
        }

        .player-input-group:hover {
            border-color: var(--bracket-primary);
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.1);
        }

        .player-input-group label {
            color: var(--bracket-secondary);
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .player-input-group .form-select {
            width: 100%;
        }

        .error-message {
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
        }

        .tournament-section {
            background: var(--bracket-bg);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border: 2px solid var(--bracket-border);
        }

        .round-title {
            color: var(--bracket-primary);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

    #bracket-wrapper {
            width: 100%;
            height: 80vh;
            overflow: auto;
  transform-origin: top left;
  transition: transform 0.2s ease;
  cursor: grab;
  position: relative;
            background: white;
            border-radius: 15px;
            box-shadow: var(--bracket-shadow);
            padding: 20px;
}

    #bracket-wrapper:active {
      cursor: grabbing;
    }

        .controls-panel {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--bracket-shadow);
            border: 2px solid var(--bracket-border);
        }

        .control-btn {
            margin: 5px;
            min-width: 120px;
        }

        .zoom-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .zoom-slider {
            flex: 1;
            max-width: 200px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-ready {
            background: linear-gradient(135deg, var(--bracket-success) 0%, #059669 100%);
            color: white;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
        }

        /* Mobile Responsive Design */
        @media (max-width: 768px) {
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                font-size: 14px;
            }
            
            .bracket-container {
                margin: 5px;
                padding: 15px;
                border-radius: 15px;
                min-height: calc(100vh - 10px);
            }
            
            .bracket-header {
                padding: 20px 15px;
                margin-bottom: 20px;
                border-radius: 12px;
            }
            
            .bracket-title {
                font-size: 1.5rem;
                margin-bottom: 8px;
                line-height: 1.3;
            }
            
            .bracket-subtitle {
                font-size: 0.9rem;
                line-height: 1.4;
            }
            
            .setup-section {
                padding: 20px 15px;
                margin-bottom: 20px;
                border-radius: 12px;
            }
            
            .setup-title {
                font-size: 1.1rem;
                margin-bottom: 15px;
            }
            
            .form-control, .form-select {
                padding: 10px 12px;
                font-size: 14px;
                border-radius: 8px;
            }
            
            .btn {
                padding: 10px 16px;
                font-size: 14px;
                border-radius: 8px;
                width: 100%;
                margin-bottom: 10px;
            }
            
            .btn-sm {
                padding: 6px 12px;
                font-size: 12px;
            }
            
            .control-btn {
                min-width: 80px;
                font-size: 12px;
                padding: 8px 12px;
            }
            
            .player-input-group {
                padding: 12px;
                margin-bottom: 12px;
            }
            
            .player-input-group label {
                font-size: 13px;
                margin-bottom: 6px;
            }
            
            .tournament-section {
                padding: 15px;
                margin-bottom: 20px;
                border-radius: 12px;
            }
            
            .round-title {
                font-size: 1.2rem;
                padding: 12px;
                margin-bottom: 15px;
            }
            
            /* Table responsive */
            .table-responsive {
                font-size: 12px;
            }
            
            .table th {
                padding: 8px 4px;
                font-size: 11px;
                line-height: 1.2;
            }
            
            .table td {
                padding: 8px 4px;
                font-size: 12px;
                line-height: 1.3;
            }
            
            .table td strong {
                font-size: 12px;
                font-weight: 600;
            }
            
            /* Score inputs */
            .score-input {
                width: 50px !important;
                padding: 4px 6px !important;
                font-size: 12px !important;
                text-align: center;
            }
            
            /* Winner display */
            .winner-display {
                font-size: 11px;
                font-weight: 600;
            }
            
            /* Debug section */
            .alert {
                padding: 12px;
                font-size: 12px;
                margin-bottom: 15px;
            }
            
            .alert h6 {
                font-size: 13px;
                margin-bottom: 8px;
            }
            
            .alert small {
                font-size: 10px;
            }
            
            /* Zoom controls */
            .zoom-controls {
                flex-direction: column;
                gap: 8px;
                margin-bottom: 12px;
            }
            
            .zoom-slider {
                max-width: 100%;
                margin: 5px 0;
            }
            
            .status-badge {
                padding: 6px 12px;
                font-size: 11px;
                border-radius: 15px;
            }
            
            /* Controls panel */
            .controls-panel {
                padding: 15px;
                margin-bottom: 15px;
            }
            
            .controls-panel .row {
                margin: 0;
            }
            
            .controls-panel .col-md-4 {
                margin-bottom: 10px;
            }
            
            /* Bracket wrapper */
            #bracket-wrapper {
                height: 60vh;
                padding: 15px;
                margin: 15px 0;
            }
            
            #elimination-bracket-wrapper {
                padding: 15px;
                margin: 15px 0;
            }
            
            /* Loading spinner */
            .loading-spinner {
                padding: 15px;
            }
            
            .spinner-border {
                width: 2rem;
                height: 2rem;
            }
            
            /* Form layout */
            .row {
                margin: 0 -5px;
            }
            
            .col-md-6, .col-lg-4 {
                padding: 0 5px;
                margin-bottom: 10px;
            }
            
            /* Player names form */
            #player-names-form {
                margin-top: 15px;
            }
            
            #player-names-list .col-md-6 {
                margin-bottom: 10px;
            }
            
            /* Error messages */
            .error-message {
                font-size: 10px;
                margin-top: 3px;
            }
            
            /* Tournament winner announcement */
            .alert-success h2 {
                font-size: 1.3rem;
                margin-bottom: 10px;
            }
            
            .alert-success h1 {
                font-size: 2rem;
                margin-bottom: 10px;
            }
            
            .alert-success .lead {
                font-size: 14px;
            }
            
            /* Button groups */
            .btn-group {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-group .btn {
                margin-bottom: 5px;
                border-radius: 6px;
            }
            
            /* Debug buttons */
            .alert-info .btn {
                width: auto;
                margin: 2px;
                padding: 6px 10px;
                font-size: 11px;
            }
            
            /* Responsive text */
            .text-center {
                text-align: center !important;
            }
            
            .text-end {
                text-align: center !important;
            }
            
            /* Hide some elements on mobile */
            .d-none-mobile {
                display: none !important;
            }
            
            /* Show mobile-specific elements */
            .d-mobile {
                display: block !important;
            }
            
            /* Compact spacing */
            .mb-3 {
                margin-bottom: 0.75rem !important;
            }
            
            .mt-3 {
                margin-top: 0.75rem !important;
            }
            
            .me-2 {
                margin-right: 0.25rem !important;
            }
            
            .me-3 {
                margin-right: 0.5rem !important;
            }
        }
        
        /* Extra small devices */
        @media (max-width: 480px) {
            .bracket-container {
                margin: 2px;
                padding: 10px;
            }
            
            .bracket-title {
                font-size: 1.3rem;
            }
            
            .bracket-subtitle {
                font-size: 0.8rem;
            }
            
            .setup-title {
                font-size: 1rem;
            }
            
            .round-title {
                font-size: 1.1rem;
                padding: 10px;
            }
            
            .table th {
                font-size: 10px;
                padding: 6px 2px;
            }
            
            .table td {
                font-size: 11px;
                padding: 6px 2px;
            }
            
            .score-input {
                width: 45px !important;
                padding: 3px 4px !important;
                font-size: 11px !important;
            }
            
            .btn-sm {
                padding: 4px 8px;
                font-size: 10px;
            }
            
            .winner-display {
                font-size: 10px;
            }
            
            .alert {
                padding: 10px;
                font-size: 11px;
            }
            
            .player-input-group {
                padding: 10px;
            }
            
            .player-input-group label {
                font-size: 12px;
            }
        }
        
        /* Touch-friendly improvements */
        @media (max-width: 768px) {
            /* Larger touch targets */
            .btn {
                min-height: 44px;
                touch-action: manipulation;
            }
            
            .form-control, .form-select {
                min-height: 44px;
                touch-action: manipulation;
            }
            
            .score-input {
                min-height: 36px;
                touch-action: manipulation;
            }
            
            /* Better spacing for touch */
            .table td {
                min-height: 44px;
                vertical-align: middle;
            }
            
            /* Horizontal scroll for tables */
            .table-responsive {
                -webkit-overflow-scrolling: touch;
                border: none;
            }
            
            /* Better button spacing */
            .btn-group .btn {
                margin-bottom: 8px;
            }
            
            /* Improved form layout */
            .player-input-group {
                min-height: 80px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            
            /* Better text wrapping */
            .table td strong {
                word-break: break-word;
                hyphens: auto;
            }
            
            /* Improved bracket visualization */
            #bracket-wrapper, #elimination-bracket-wrapper {
                -webkit-overflow-scrolling: touch;
                touch-action: pan-x pan-y;
            }
            
            /* Better zoom controls */
            .zoom-slider {
                -webkit-appearance: none;
                appearance: none;
                height: 6px;
                background: #ddd;
                border-radius: 3px;
                outline: none;
            }
            
            .zoom-slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 20px;
                height: 20px;
                background: var(--bracket-primary);
                border-radius: 50%;
                cursor: pointer;
            }
            
            .zoom-slider::-moz-range-thumb {
                width: 20px;
                height: 20px;
                background: var(--bracket-primary);
                border-radius: 50%;
                cursor: pointer;
                border: none;
            }
        }
        
        /* Landscape orientation adjustments */
        @media (max-width: 768px) and (orientation: landscape) {
            .bracket-container {
                margin: 2px;
                padding: 8px;
            }
            
            .bracket-header {
                padding: 15px 10px;
                margin-bottom: 15px;
            }
            
            .bracket-title {
                font-size: 1.2rem;
            }
            
            .setup-section {
                padding: 15px 10px;
                margin-bottom: 15px;
            }
            
            .tournament-section {
                padding: 10px;
                margin-bottom: 15px;
            }
            
            .round-title {
                font-size: 1rem;
                padding: 8px;
                margin-bottom: 10px;
            }
            
            .table th {
                font-size: 9px;
                padding: 4px 2px;
            }
            
            .table td {
                font-size: 10px;
                padding: 4px 2px;
            }
            
            .score-input {
                width: 40px !important;
                padding: 2px 3px !important;
                font-size: 10px !important;
            }
            
            .btn-sm {
                padding: 3px 6px;
                font-size: 9px;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .bracket-wrapper {
            overflow: auto;
            transform-origin: top left;
            transition: transform 0.3s ease;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
        }
        
        #elimination-bracket-wrapper {
            overflow: auto;
            transform-origin: top left;
            transition: transform 0.3s ease;
            border: 2px solid #007bff;
            border-radius: 10px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
        }

        .slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        /* Tournament type selection styles */
        .form-check-input:checked {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        
        .form-check-label {
            cursor: pointer;
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .form-check-input:checked + .form-check-label {
            border-color: #ffc107;
            background-color: #fff3cd;
        }
  </style>
</head>
<body>
    <div class="bracket-container fade-in">
        <!-- Header Section -->
        <div class="bracket-header">
            <h1 class="bracket-title">
                <i class="fas fa-trophy me-3"></i>
                {{ $tournament->name ?? 'Bảng đấu giải đấu' }}
            </h1>
            <p class="bracket-subtitle">
                <i class="fas fa-calendar-alt me-2"></i>
                Quản lý và theo dõi tiến trình giải đấu
            </p>
        </div>

        <!-- Setup Section -->
        <div class="setup-section slide-in">
            <h3 class="setup-title">
                <i class="fas fa-cog me-2"></i>
                Thiết lập giải đấu
            </h3>
            
            <!-- Tournament Type Selection -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold">
                        <i class="fas fa-trophy me-2"></i>
                        Loại giải đấu
                    </label>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tournament-type" id="ranking-tournament" value="ranking" checked>
                                <label class="form-check-label" for="ranking-tournament">
                                    <i class="fas fa-star text-warning me-2"></i>
                                    <strong>Giải đấu tự do</strong>
                                    <br>
                                    <small class="text-muted">Nhập tên cơ thủ thủ công, không tính điểm ranking vietnampool</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tournament-type" id="free-tournament" value="free">
                                <label class="form-check-label" for="free-tournament">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Giải đấu tính điểm ranking vietnampool</strong>
                                    <br>
                                    <small class="text-muted">Chọn cơ thủ từ danh sách đã đăng ký, tính điểm ranking vietnampool</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tournament Info Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Thông tin giải đấu
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <label for="player-count" class="form-label fw-bold">
                                        <i class="fas fa-users me-1"></i>
                                        Số lượng người chơi
                                    </label>
                                    <div class="form-control-plaintext bg-light p-3 rounded">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users me-2 text-primary"></i>
                                            <span class="fw-bold fs-5">{{ $tournament->number_players ?? 16 }} người chơi</span>
                                            <small class="text-muted ms-2">(Số lượng cố định của giải đấu)</small>
                                        </div>
                                    </div>
                                    <input type="hidden" id="player-count" value="{{ $tournament->number_players ?? 16 }}">
                                </div>
                                <div class="col-12 col-md-6 d-flex align-items-end">
                                    <div class="w-100">
                                        <small class="text-muted d-block mb-2">Quản lý danh sách cơ thủ</small>
                                        <div class="d-flex gap-2">
                                            <button id="setup-names" class="btn btn-primary flex-fill">
                                                <i class="fas fa-edit me-2"></i>
                                                Chọn cơ thủ
                                            </button>
                                            <button id="shuffle-players-btn" class="btn btn-warning flex-fill">
                                                <i class="fas fa-random me-2"></i>
                                                Đảo ngẫu nhiên
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Player Names Form -->
            <form id="player-names-form" style="display:none;" class="mt-4">
                <div class="card border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-users me-2"></i>
                            Danh sách cơ thủ tham gia
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row" id="player-names-list"></div>
                        <div class="text-center mt-4">
                            <button type="submit" id="tournament-start-btn" class="btn btn-success btn-lg">
                                <i class="fas fa-play me-2"></i>
                                Bắt đầu giải đấu
                            </button>
                        </div>
                    </div>
                </div>
            </form>
</div>

        <!-- Controls Panel -->
        <div class="controls-panel slide-in" id="controls-panel" style="display: none;">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 mb-3 mb-md-0">
                    <div class="zoom-controls">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-search-minus text-muted me-2"></i>
                            <span class="badge bg-primary me-2" id="zoom-value">100%</span>
                            <i class="fas fa-search-plus text-muted ms-2"></i>
                        </div>
                        <input type="range" class="form-range zoom-slider" id="zoom-slider" min="0.5" max="2" step="0.1" value="1">
                    </div>
                </div>
                <div class="col-12 col-md-3 text-center mb-3 mb-md-0">
                    <div class="btn-group w-100" role="group">
                        <button type="button" class="btn btn-outline-primary control-btn" id="zoom-fit">
                            <i class="fas fa-expand me-1"></i>
                            <span class="d-none d-sm-inline">Vừa màn hình</span>
                            <span class="d-sm-none">Fit</span>
                        </button>
                        <button type="button" class="btn btn-outline-primary control-btn" id="zoom-reset">
                            <i class="fas fa-undo me-1"></i>
                            <span class="d-none d-sm-inline">Đặt lại</span>
                            <span class="d-sm-none">Reset</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-3 text-center mb-3 mb-md-0">
                    <button type="button" class="btn btn-outline-danger w-100 control-btn" id="clear-saved-data-btn" onclick="confirmClearSavedData()">
                        <i class="fas fa-trash-alt me-1"></i>
                        <span class="d-none d-sm-inline">Xóa dữ liệu đã lưu</span>
                        <span class="d-sm-none">Clear</span>
                    </button>
                </div>
                <div class="col-12 col-md-3 text-center text-md-end">
                    <span class="status-badge status-ready" id="tournament-status">
                        <i class="fas fa-clock me-1"></i>
                        Sẵn sàng
                    </span>
                </div>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-spinner" id="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <p class="mt-3 text-muted">Đang tạo bảng đấu...</p>
        </div>

        <!-- Tournament Sections -->
        <div id="tournament-tables" style="display: none;">
            <div class="tournament-section">
                <h3 class="round-title">
                    <i class="fas fa-trophy me-2"></i>
                    Vòng 1
                </h3>
  <div id="round1-table"></div>
            </div>
            
  <div id="round2-section" style="display:none;">
                <div class="tournament-section">
                    <h3 class="round-title">
                        <i class="fas fa-medal me-2"></i>
                        Vòng 2 - Nhánh thắng
                    </h3>
    <div id="round2w-table"></div>
                </div>
                <div class="tournament-section">
                    <h3 class="round-title">
                        <i class="fas fa-medal me-2"></i>
                        Vòng 2 - Nhánh thua
                    </h3>
    <div id="round2l-table"></div>
  </div>
            </div>
            
  <div id="round3-section" style="display:none;">
                <div class="tournament-section">
                    <h3 class="round-title">
                        <i class="fas fa-crown me-2"></i>
                        Vòng 3
                    </h3>
    <div id="round3-table"></div>
  </div>
            </div>
            
  <div id="elimination-section" style="display:none;">
                <div class="tournament-section">
                    <h3 class="round-title">
                        <i class="fas fa-star me-2"></i>
                        Vòng loại trực tiếp
                    </h3>
    <div id="elimination-bracket-wrapper"></div>
  </div>
            </div>
            
  <div id="mermaid-section" style="display:none;">
                <div class="tournament-section">
                    <h3 class="round-title">
                        <i class="fas fa-project-diagram me-2"></i>
                        Sơ đồ giải đấu
                    </h3>
    <div class="mermaid" id="mermaid-diagram"></div>
  </div>
</div>
        </div>
</div>

<script>
// Global variables
let players = [];
let defaultPlayerCount = 32;
let playersList = {!! json_encode($players) !!};

// Debug playersList
console.log('Initial playersList:', playersList);
console.log('Type of playersList:', typeof playersList);

// Ensure playersList is an array
if (!Array.isArray(playersList)) {
    console.warn('playersList is not an array, converting...');
    if (playersList === null || playersList === undefined) {
        playersList = [];
    } else if (typeof playersList === 'string') {
        try {
            playersList = JSON.parse(playersList);
        } catch (e) {
            playersList = [];
        }
    } else {
        playersList = [];
    }
}

console.log('Final playersList:', playersList);

// Global tournament variables
var tournamentPlayerCount = {!! json_encode($tournament->number_players ?? 16) !!};
var databasePlayers = {!! json_encode($players ?? []) !!};
var tournamentType = 'ranking'; // Default tournament type

// Tournament creation functions
let tournamentData = {
    round1: {
        pairs: [],
        results: [],
        winners: [],
        losers: []
    },
    round2: {
        winners: {
            pairs: [],
            results: [],
            winners: [],
            losers: []
        },
        losers: {
            pairs: [],
            results: [],
            winners: [],
            losers: []
        }
    },
    round3: {
        pairs: [], // Winners from round2 losers vs Losers from round2 winners
        results: [],
        winners: [],
        losers: []
    },
    elimination: {
        pairs: [], // Final elimination round
        results: [],
        winners: [],
        losers: [],
        bracketWinners: [], // Winners from bracket visualization
        bracketResults: [] // Full bracket results for all rounds
    },
    finalElimination: {
        pairs: [], // Ultimate final elimination round
        results: [],
        winners: [],
        losers: []
    }
};

/**
 * Calculate the nearest power of 2 (upward) for bracket size
 * Example: 14 players -> 16, 10 players -> 16, 5 players -> 8
 */
function getRequiredBracketSize(playerCount) {
    if (playerCount <= 0) return 2;
    if (playerCount <= 2) return 2;
    if (playerCount <= 4) return 4;
    if (playerCount <= 8) return 8;
    if (playerCount <= 16) return 16;
    if (playerCount <= 32) return 32;
    return 64; // Maximum supported
}

/**
 * Normalize players array to ensure bracket size is power of 2
 * Adds "BYE" slots if needed
 */
function normalizePlayersForBracket(players) {
    // Filter out null/empty players
    const validPlayers = players.filter(player => player && player !== 'null' && player !== '');
    console.log('Valid players:', validPlayers.length, validPlayers);
    
    // Calculate required bracket size
    const requiredSize = getRequiredBracketSize(validPlayers.length);
    console.log(`Player count: ${validPlayers.length}, Required bracket size: ${requiredSize}`);
    
    // Create normalized array with BYE slots
    const normalizedPlayers = [...validPlayers];
    
    // Add BYE slots to reach required size
    const byeCount = requiredSize - validPlayers.length;
    while (normalizedPlayers.length < requiredSize) {
        normalizedPlayers.push('BYE');
    }
    
    // Show notification if BYE slots were added
    if (byeCount > 0) {
        console.log(`Added ${byeCount} BYE slots to reach bracket size of ${requiredSize}`);
        showNotification(
            `Giải đấu có ${validPlayers.length} cơ thủ, đã thêm ${byeCount} slot BYE để đủ ${requiredSize} người (chuẩn bracket)`, 
            'info'
        );
    }
    
    console.log('Normalized players:', normalizedPlayers);
    return normalizedPlayers;
}

async function createTournamentTables(players, count) {
    console.log('Creating tournament tables for', players.length, 'players');
    
    // Normalize players to ensure bracket size is power of 2
    const normalizedPlayers = normalizePlayersForBracket(players);
    console.log('Using normalized players:', normalizedPlayers);
    
    // Create round 1 pairs
    const round1Pairs = [];
    for (let i = 0; i < normalizedPlayers.length; i += 2) {
        const player1 = normalizedPlayers[i];
        const player2 = normalizedPlayers[i + 1];
        round1Pairs.push([player1, player2]);
    }
    
    console.log('Round 1 pairs:', round1Pairs);
    
    // Store tournament data
    tournamentData.round1.pairs = round1Pairs;
    tournamentData.round1.results = Array(round1Pairs.length).fill([null, null]);
    tournamentData.round1.winners = [];
    tournamentData.round1.losers = [];
    
    // Auto-process BYE matches after creating tournament
    setTimeout(() => {
        autoProcessBYEMatches();
    }, 500);
    
    // Create round 1 table
    const round1Table = document.getElementById('round1-table');
    if (round1Table) {
        let tableHTML = `
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Người chơi 1</th>
                            <th>VS</th>
                            <th>Người chơi 2</th>
                            <th>Kết quả</th>
                            <th>Người thắng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        round1Pairs.forEach((pair, index) => {
            const [player1, player2] = pair;
            const isBYEMatch = (player1 === 'BYE' || player2 === 'BYE');
            const rowClass = isBYEMatch ? 'table-info' : '';
            const player1Display = player1 === 'BYE' ? '<em class="text-muted">BYE</em>' : `<strong>${player1}</strong>`;
            const player2Display = player2 === 'BYE' ? '<em class="text-muted">BYE</em>' : `<strong>${player2}</strong>`;
            const buttonText = isBYEMatch ? '<i class="fas fa-forward"></i> Tự động' : '<i class="fas fa-save"></i> Cập nhật';
            const buttonClass = isBYEMatch ? 'btn btn-sm btn-info' : 'btn btn-sm btn-primary';
            
            tableHTML += `
                <tr id="round1-match-${index}" class="${rowClass}">
                    <td>${index + 1}</td>
                    <td>${player1Display}</td>
                    <td class="text-center">VS</td>
                    <td>${player2Display}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="1" style="width: 60px;" placeholder="0" min="0" ${isBYEMatch ? 'disabled' : ''}>
                            <span class="align-self-center">-</span>
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="2" style="width: 60px;" placeholder="0" min="0" ${isBYEMatch ? 'disabled' : ''}>
                        </div>
                    </td>
                    <td>
                        <span class="winner-display" id="winner-${index}">Chưa có kết quả</span>
                    </td>
                    <td>
                        <button class="${buttonClass}" onclick="updateMatchResult(${index}, 'round1')">
                            ${buttonText}
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableHTML += `
                    </tbody>
                </table>
            </div>
        `;
        
        round1Table.innerHTML = tableHTML;
        console.log('Round 1 table created');
        
        // Add event listeners for score inputs
        addScoreInputListeners();
    }
    
    // Show round 2 section if we have enough players
    if (round1Pairs.length > 1) {
        const round2Section = document.getElementById('round2-section');
        if (round2Section) {
            round2Section.style.display = 'block';
            createRound2Tables(round1Pairs);
        }
    }
}

function addScoreInputListeners() {
    // Add event listeners to all score inputs
    document.querySelectorAll('.score-input').forEach(input => {
        input.addEventListener('input', function() {
            const matchIndex = this.dataset.match;
            const playerIndex = this.dataset.player;
            console.log(`Score updated: Match ${matchIndex}, Player ${playerIndex}, Score: ${this.value}`);
            
            // Don't auto-update winner display - wait for "Cập nhật" button click
            // This ensures winner display only changes when "Cập nhật" is clicked
        });
    });
}

function updateWinnerDisplay(matchIndex) {
    // This function is now only used for manual updates, not auto-updates
    // The actual winner display update happens in updateMatchResult()
    console.log('updateWinnerDisplay called for match', matchIndex);
    
    const matchInputs = document.querySelectorAll(`input[data-match="${matchIndex}"]`);
    const player1Score = parseInt(matchInputs[0].value) || 0;
    const player2Score = parseInt(matchInputs[1].value) || 0;
    
    const winnerDisplay = document.getElementById(`winner-${matchIndex}`);
    const matchRow = document.getElementById(`round1-match-${matchIndex}`);
    
    // Only update if both scores are entered and valid
    if (player1Score > 0 && player2Score > 0) {
        if (player1Score > player2Score) {
            winnerDisplay.textContent = tournamentData.round1.pairs[matchIndex][0];
            winnerDisplay.className = 'winner-display text-success fw-bold';
            matchRow.className = 'table-success';
        } else if (player2Score > player1Score) {
            winnerDisplay.textContent = tournamentData.round1.pairs[matchIndex][1];
            winnerDisplay.className = 'winner-display text-success fw-bold';
            matchRow.className = 'table-success';
        } else if (player1Score === player2Score) {
            winnerDisplay.textContent = 'Hòa';
            winnerDisplay.className = 'winner-display text-warning fw-bold';
            matchRow.className = 'table-warning';
        }
    } else {
        // Don't change display if scores are not complete
        winnerDisplay.textContent = 'Chưa có kết quả';
        winnerDisplay.className = 'winner-display text-muted';
        matchRow.className = '';
    }
}

function createRound2Tables(round1Pairs) {
    console.log('Creating round 2 tables');
    
    // Create winners bracket
    const round2wTable = document.getElementById('round2w-table');
    if (round2wTable) {
        let tableHTML = `
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Người chơi 1</th>
                            <th>VS</th>
                            <th>Người chơi 2</th>
                            <th>Kết quả</th>
                            <th>Người thắng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        // Create winners bracket pairs - will be updated when round 1 results are in
        const winnersPairs = [];
        for (let i = 0; i < round1Pairs.length; i += 2) {
            const pair1 = round1Pairs[i];
            const pair2 = round1Pairs[i + 1];
            if (pair2) {
                winnersPairs.push([`Winner ${i + 1}`, `Winner ${i + 2}`]);
            }
        }
        
        // Store winners bracket data
        tournamentData.round2.winners.pairs = winnersPairs;
        tournamentData.round2.winners.results = Array(winnersPairs.length).fill([null, null]);
        tournamentData.round2.winners.winners = [];
        tournamentData.round2.winners.losers = [];
        
        winnersPairs.forEach((pair, index) => {
            const [player1, player2] = pair;
            tableHTML += `
                <tr id="round2w-match-${index}">
                    <td>${index + 1}</td>
                    <td><strong>${player1}</strong></td>
                    <td class="text-center">VS</td>
                    <td><strong>${player2}</strong></td>
                    <td>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="1" data-round="2w" style="width: 60px;" placeholder="0" min="0">
                            <span class="align-self-center">-</span>
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="2" data-round="2w" style="width: 60px;" placeholder="0" min="0">
                        </div>
                    </td>
                    <td>
                        <span class="winner-display" id="winner-2w-${index}">Chưa có kết quả</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success" onclick="updateMatchResult(${index}, 'round2w')">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableHTML += `
                    </tbody>
                </table>
            </div>
        `;
        
        round2wTable.innerHTML = tableHTML;
        console.log('Round 2 winners table created');
        
        // Add event listeners for score inputs
        addScoreInputListeners();
    }
    
    // Create losers bracket
    const round2lTable = document.getElementById('round2l-table');
    if (round2lTable) {
        let tableHTML = `
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-danger">
                        <tr>
                            <th>#</th>
                            <th>Người chơi 1</th>
                            <th>VS</th>
                            <th>Người chơi 2</th>
                            <th>Kết quả</th>
                            <th>Người thắng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        // Create losers bracket pairs - will be updated when round 1 results are in
        const losersPairs = [];
        for (let i = 0; i < round1Pairs.length; i += 2) {
            const pair1 = round1Pairs[i];
            const pair2 = round1Pairs[i + 1];
            if (pair2) {
                losersPairs.push([`Loser ${i + 1}`, `Loser ${i + 2}`]);
            }
        }
        
        // Store losers bracket data
        tournamentData.round2.losers.pairs = losersPairs;
        tournamentData.round2.losers.results = Array(losersPairs.length).fill([null, null]);
        tournamentData.round2.losers.winners = [];
        tournamentData.round2.losers.losers = [];
        
        losersPairs.forEach((pair, index) => {
            const [player1, player2] = pair;
            tableHTML += `
                <tr id="round2l-match-${index}">
                    <td>${index + 1}</td>
                    <td><strong>${player1}</strong></td>
                    <td class="text-center">VS</td>
                    <td><strong>${player2}</strong></td>
                    <td>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="1" data-round="2l" style="width: 60px;" placeholder="0" min="0">
                            <span class="align-self-center">-</span>
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="2" data-round="2l" style="width: 60px;" placeholder="0" min="0">
                        </div>
                    </td>
                    <td>
                        <span class="winner-display" id="winner-2l-${index}">Chưa có kết quả</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="updateMatchResult(${index}, 'round2l')">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableHTML += `
                    </tbody>
                </table>
            </div>
        `;
        
        round2lTable.innerHTML = tableHTML;
        console.log('Round 2 losers table created');
        
        // Add event listeners for score inputs
        addScoreInputListeners();
    }
}

function createBracketVisualization(players) {
    console.log('Creating bracket visualization for', players.length, 'players');
    
    const bracketWrapper = document.getElementById('bracket-wrapper');
    if (!bracketWrapper) {
        console.error('Bracket wrapper not found');
        return;
    }
    
    // Filter valid players
    const validPlayers = players.filter(player => player && player !== 'null' && player !== '');
    
    // Create bracket data
    const teams = [];
    for (let i = 0; i < validPlayers.length; i += 2) {
        const player1 = validPlayers[i] || 'null';
        const player2 = validPlayers[i + 1] || 'null';
        teams.push([player1, player2]);
    }
    
    // Initialize bracket
    if (typeof $ !== 'undefined' && $.fn.bracket) {
        try {
            bracketWrapper.innerHTML = ''; // Clear previous content
            
            const bracketData = {
                teams: teams,
        results: [
                    Array(teams.length).fill([null, null])
                ]
            };
            
            $(bracketWrapper).bracket({
                init: bracketData,
                save: function(data) {
                    console.log('Bracket data saved:', data);
                },
                disableToolbar: false,
                disableTeamEdit: false
            });
            
            console.log('Bracket visualization created successfully');
        } catch (error) {
            console.error('Error creating bracket visualization:', error);
            bracketWrapper.innerHTML = `
                <div class="alert alert-warning">
                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Không thể tạo sơ đồ bracket</h5>
                    <p>Lỗi: ${error.message}</p>
                    <p>Số lượng người chơi: ${validPlayers.length}</p>
                </div>
            `;
        }
    } else {
        console.error('jQuery Bracket plugin not loaded');
        bracketWrapper.innerHTML = `
            <div class="alert alert-danger">
                <h5><i class="fas fa-exclamation-triangle me-2"></i>Plugin Bracket không được tải</h5>
                <p>Vui lòng tải lại trang để sử dụng tính năng bracket.</p>
            </div>
        `;
    }
}

// Match result update function

/**
 * Render player name inputs for ranking tournament (manual input only)
 */
function renderRankingPlayerNameInputs(count) {
    console.log('Rendering ranking player name inputs for', count, 'players');
    
    const playerNamesList = document.getElementById('player-names-list');
    if (!playerNamesList) {
        console.error('Player names list element not found!');
        return;
    }
    
    let html = '';
    for (let i = 0; i < count; i++) {
        html += `<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="player-input-group">
                <label class="form-label">
                    <i class="fas fa-user me-1"></i>
                    <span class="d-none d-sm-inline">Người chơi ${i+1}</span>
                    <span class="d-sm-none">P${i+1}</span>
                </label>
                <input type="text" class="form-control player-name-input" data-idx="${i}" placeholder="Nhập tên người chơi" required>
                <span class="error-message text-danger small" id="error-${i}" style="display: none;"></span>
            </div>
        </div>`;
    }
    
    playerNamesList.innerHTML = html;
    console.log('Ranking player name inputs rendered');
    
    // Add event listeners for name changes
    addPlayerNameChangeListeners();
}

/**
 * Add event listeners for player name changes
 */
function addPlayerNameChangeListeners() {
    console.log('Adding player name change listeners');
    
    const playerInputs = document.querySelectorAll('.player-name-input');
    playerInputs.forEach((input, index) => {
        input.addEventListener('input', function() {
            console.log(`Player ${index + 1} name changed to:`, this.value);
            updatePlayerNameInTournamentData(index, this.value);
        });
        
        input.addEventListener('change', function() {
            console.log(`Player ${index + 1} name changed to:`, this.value);
            updatePlayerNameInTournamentData(index, this.value);
        });
    });
    
    console.log('Player name change listeners added');
}

/**
 * Update player name in tournament data and all rounds
 */
async function updatePlayerNameInTournamentData(playerIndex, newName) {
    console.log(`Updating player ${playerIndex + 1} name to: ${newName}`);
    
    // Validate inputs
    if (typeof playerIndex !== 'number' || playerIndex < 0) {
        console.error('Invalid player index:', playerIndex);
        return;
    }
    
    if (typeof newName !== 'string') {
        console.error('Invalid new name:', newName);
        return;
    }
    
    // Initialize players array if not exists
    if (!players) {
        players = [];
    }
    
    // Ensure players array has enough length
    while (players.length <= playerIndex) {
        players.push('');
    }
    
    // Update global players array
    const oldName = players[playerIndex];
    players[playerIndex] = newName;
    console.log(`Updated players array: ${oldName} -> ${newName}`);
    
    // Only update tournament rounds if we have a valid old name
    if (oldName && oldName !== newName) {
        updatePlayerNameInAllRounds(oldName, newName);
    }
    
    // Save updated data
    await saveTournamentData();
}

/**
 * Update player name in all tournament rounds
 */
function updatePlayerNameInAllRounds(oldName, newName) {
    console.log(`Updating player name in all rounds: ${oldName} -> ${newName}`);
    
    // Validate tournament data exists
    if (!tournamentData) {
        console.warn('Tournament data not initialized');
        return;
    }
    
    // Update Round 1
    if (tournamentData.round1 && tournamentData.round1.pairs) {
        tournamentData.round1.pairs.forEach(pair => {
            if (pair && pair.length >= 2) {
                if (pair[0] === oldName) pair[0] = newName;
                if (pair[1] === oldName) pair[1] = newName;
            }
        });
    }
    
    // Update Round 2 Winners
    if (tournamentData.round2 && tournamentData.round2.winners && tournamentData.round2.winners.pairs) {
        tournamentData.round2.winners.pairs.forEach(pair => {
            if (pair && pair.length >= 2) {
                if (pair[0] === oldName) pair[0] = newName;
                if (pair[1] === oldName) pair[1] = newName;
            }
        });
    }
    
    // Update Round 2 Losers
    if (tournamentData.round2 && tournamentData.round2.losers && tournamentData.round2.losers.pairs) {
        tournamentData.round2.losers.pairs.forEach(pair => {
            if (pair && pair.length >= 2) {
                if (pair[0] === oldName) pair[0] = newName;
                if (pair[1] === oldName) pair[1] = newName;
            }
        });
    }
    
    // Update Round 3
    if (tournamentData.round3 && tournamentData.round3.pairs) {
        tournamentData.round3.pairs.forEach(pair => {
            if (pair && pair.length >= 2) {
                if (pair[0] === oldName) pair[0] = newName;
                if (pair[1] === oldName) pair[1] = newName;
            }
        });
    }
    
    // Update Elimination
    if (tournamentData.elimination && tournamentData.elimination.pairs) {
        tournamentData.elimination.pairs.forEach(pair => {
            if (pair && pair.length >= 2) {
                if (pair[0] === oldName) pair[0] = newName;
                if (pair[1] === oldName) pair[1] = newName;
            }
        });
    }
    
    // Update Final Elimination
    if (tournamentData.finalElimination && tournamentData.finalElimination.pairs) {
        tournamentData.finalElimination.pairs.forEach(pair => {
            if (pair && pair.length >= 2) {
                if (pair[0] === oldName) pair[0] = newName;
                if (pair[1] === oldName) pair[1] = newName;
            }
        });
    }
    
    // Update UI displays
    updatePlayerNameInUI(oldName, newName);
    
    console.log('Player name updated in all tournament rounds');
}

/**
 * Update player name in UI displays
 */
function updatePlayerNameInUI(oldName, newName) {
    console.log(`Updating player name in UI: ${oldName} -> ${newName}`);
    
    // Validate inputs
    if (!oldName || !newName || oldName === newName) {
        console.log('No UI update needed');
        return;
    }
    
    try {
        // Update only specific tournament table elements
        updateTournamentTableDisplays();
        
        // Update winner displays in tournament tables
        updateWinnerDisplays(oldName, newName);
        
        // Update player names in specific table cells only
        updatePlayerNamesInTableCells(oldName, newName);
        
        // Update elimination bracket visualization
        updateEliminationBracketPlayerNames(oldName, newName);
        
        // Update Round 3 table if it exists
        updateRound3PlayerNames(oldName, newName);
        
        console.log('Player name updated in UI');
    } catch (error) {
        console.error('Error updating player name in UI:', error);
    }
}

/**
 * Add event listeners for name changes in elimination bracket
 */
function addEliminationBracketNameChangeListeners() {
    console.log('Adding elimination bracket name change listeners');
    
    try {
        // Clean up existing observer if any
        if (window.eliminationBracketObserver) {
            window.eliminationBracketObserver.disconnect();
        }
        
        // Clean up existing periodic check if any
        if (window.eliminationBracketCheckInterval) {
            clearInterval(window.eliminationBracketCheckInterval);
        }
        
        // Listen for changes in team names within the bracket
        const bracketContainer = document.getElementById('elimination-bracket-wrapper');
        if (bracketContainer) {
            // Use a more comprehensive approach to detect changes
            const observer = new MutationObserver(function(mutations) {
                let hasChanges = false;
                
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList' || mutation.type === 'characterData' || mutation.type === 'attributes') {
                        hasChanges = true;
                    }
                });
                
                if (hasChanges) {
                    // Debounce the update to avoid too many calls
                    clearTimeout(window.eliminationBracketUpdateTimeout);
                    window.eliminationBracketUpdateTimeout = setTimeout(function() {
                        updateEliminationBracketFromUI();
                    }, 300);
                }
            });
            
            // Start observing with more comprehensive options
            observer.observe(bracketContainer, {
                childList: true,
                subtree: true,
                characterData: true,
                attributes: true,
                attributeOldValue: true,
                characterDataOldValue: true
            });
            
            // Also add direct event listeners to team elements
            setTimeout(function() {
                const teamElements = bracketContainer.querySelectorAll('.team');
                teamElements.forEach(function(teamElement) {
                    if (teamElement) {
                        // Add input event listener for direct editing
                        teamElement.addEventListener('input', function() {
                            console.log('Team name changed via input event');
                            updateEliminationBracketFromUI();
                        });
                        
                        // Add blur event listener for when editing is finished
                        teamElement.addEventListener('blur', function() {
                            console.log('Team name editing finished');
                            updateEliminationBracketFromUI();
                        });
                        
                        // Add keyup event listener for real-time changes
                        teamElement.addEventListener('keyup', function() {
                            console.log('Team name changed via keyup event');
                            updateEliminationBracketFromUI();
                        });
                    }
                });
            }, 1000); // Wait for bracket to be fully rendered
            
            // Start periodic checking for changes
            startEliminationBracketPeriodicCheck();
            
            // Store observer for cleanup
            window.eliminationBracketObserver = observer;
        }
        
        console.log('Elimination bracket name change listeners added');
    } catch (error) {
        console.error('Error adding elimination bracket name change listeners:', error);
    }
}

/**
 * Start periodic checking for elimination bracket changes
 */
function startEliminationBracketPeriodicCheck() {
    console.log('Starting periodic check for elimination bracket changes');
    
    // Clear existing interval if any
    if (window.eliminationBracketCheckInterval) {
        clearInterval(window.eliminationBracketCheckInterval);
    }
    
    // Store current state for comparison
    let lastKnownState = null;
    
    // Check every 2 seconds
    window.eliminationBracketCheckInterval = setInterval(function() {
        try {
            if (window.eliminationBracket && window.eliminationBracket.getData) {
                const currentData = window.eliminationBracket.getData();
                
                if (currentData && currentData.teams) {
                    const currentState = JSON.stringify(currentData.teams);
                    
                    if (lastKnownState && lastKnownState !== currentState) {
                        console.log('Periodic check detected elimination bracket changes');
                        updateEliminationBracketFromUI();
                    }
                    
                    lastKnownState = currentState;
                }
            }
        } catch (error) {
            console.error('Error in periodic elimination bracket check:', error);
        }
    }, 2000);
    
    console.log('Periodic elimination bracket check started');
}

/**
 * Update elimination bracket data from UI changes
 */
async function updateEliminationBracketFromUI() {
    console.log('Updating elimination bracket from UI changes');
    
    try {
        if (window.eliminationBracket && window.eliminationBracket.getData) {
            const currentData = window.eliminationBracket.getData();
            
            if (currentData && currentData.teams) {
                // Update tournament data with current team names
                const newPairs = [];
                for (let i = 0; i < currentData.teams.length; i += 2) {
                    const player1 = currentData.teams[i] || 'null';
                    const player2 = currentData.teams[i + 1] || 'null';
                    newPairs.push([player1, player2]);
                }
                
                // Check if pairs actually changed
                let pairsChanged = false;
                if (newPairs.length !== tournamentData.elimination.pairs.length) {
                    pairsChanged = true;
                } else {
                    for (let i = 0; i < newPairs.length; i++) {
                        if (newPairs[i][0] !== tournamentData.elimination.pairs[i][0] ||
                            newPairs[i][1] !== tournamentData.elimination.pairs[i][1]) {
                            pairsChanged = true;
                            break;
                        }
                    }
                }
                
                if (pairsChanged) {
                    // Update tournament data
                    tournamentData.elimination.pairs = newPairs;
                    
                    // Update players array if needed
                    newPairs.forEach(pair => {
                        pair.forEach(player => {
                            if (player && player !== 'null' && player !== 'TBD' && !players.includes(player)) {
                                players.push(player);
                            }
                        });
                    });
                    
                    // Save the updated data
                    await saveTournamentData();
                    
                    console.log('Elimination bracket data updated from UI:', newPairs);
                }
            }
        }
    } catch (error) {
        console.error('Error updating elimination bracket from UI:', error);
    }
}

/**
 * Update player names in Round 3 table
 */
function updateRound3PlayerNames(oldName, newName) {
    console.log(`Updating Round 3 player names: ${oldName} -> ${newName}`);
    
    try {
        // Update tournament data first
        if (tournamentData && tournamentData.round3 && tournamentData.round3.pairs) {
            tournamentData.round3.pairs.forEach(pair => {
                if (pair && pair.length >= 2) {
                    if (pair[0] === oldName) pair[0] = newName;
                    if (pair[1] === oldName) pair[1] = newName;
                }
            });
        }
        
        // Update Round 3 table display
        const round3Table = document.getElementById('round3-table');
        if (round3Table && tournamentData && tournamentData.round3 && tournamentData.round3.pairs) {
            tournamentData.round3.pairs.forEach((pair, index) => {
                if (pair && pair.length >= 2) {
                    const matchRow = document.getElementById(`round3-match-${index}`);
                    if (matchRow) {
                        const player1Cell = matchRow.querySelector('td:nth-child(2) strong');
                        const player2Cell = matchRow.querySelector('td:nth-child(4) strong');
                        
                        if (player1Cell) player1Cell.textContent = pair[0] || '';
                        if (player2Cell) player2Cell.textContent = pair[1] || '';
                    }
                }
            });
        }
        
        console.log('Round 3 player names updated');
    } catch (error) {
        console.error('Error updating Round 3 player names:', error);
    }
}

/**
 * Update player names in elimination bracket visualization
 */
function updateEliminationBracketPlayerNames(oldName, newName) {
    console.log(`Updating elimination bracket player names: ${oldName} -> ${newName}`);
    
    try {
        // Update tournament data first
        if (tournamentData && tournamentData.elimination && tournamentData.elimination.pairs) {
            tournamentData.elimination.pairs.forEach(pair => {
                if (pair && pair.length >= 2) {
                    if (pair[0] === oldName) pair[0] = newName;
                    if (pair[1] === oldName) pair[1] = newName;
                }
            });
        }
        
        // Update the bracket visualization if it exists
        const bracketContainer = document.getElementById('elimination-bracket-wrapper');
        if (bracketContainer && window.eliminationBracket) {
            // Get current bracket data
            const currentData = window.eliminationBracket.getData();
            
            // Update team names in the data
            if (currentData && currentData.teams) {
                currentData.teams.forEach((team, index) => {
                    if (team === oldName) {
                        currentData.teams[index] = newName;
                    }
                });
            }
            
            // Recreate the bracket with updated data
            window.eliminationBracket = $(bracketContainer).bracket({
                init: currentData,
                save: updateEliminationBracketData,
                disableToolbar: true
            });
            
            // Add event listeners for name changes in elimination bracket
            addEliminationBracketNameChangeListeners();
        }
        
        console.log('Elimination bracket player names updated');
    } catch (error) {
        console.error('Error updating elimination bracket player names:', error);
    }
}

/**
 * Update player names in specific table cells only
 */
function updatePlayerNamesInTableCells(oldName, newName) {
    console.log(`Updating player names in table cells: ${oldName} -> ${newName}`);
    
    try {
        // Update only strong elements within table cells
        const playerNameElements = document.querySelectorAll('table strong');
        playerNameElements.forEach(element => {
            if (element && element.textContent && element.textContent.trim() === oldName) {
                element.textContent = newName;
            }
        });
        
        console.log('Player names in table cells updated');
    } catch (error) {
        console.error('Error updating player names in table cells:', error);
    }
}

/**
 * Update winner displays in tournament tables
 */
function updateWinnerDisplays(oldName, newName) {
    console.log(`Updating winner displays: ${oldName} -> ${newName}`);
    
    try {
        // Update Round 1 winner displays
        const round1WinnerDisplays = document.querySelectorAll('#round1-table .winner-display');
        round1WinnerDisplays.forEach(display => {
            if (display && display.textContent && display.textContent.includes(oldName)) {
                display.textContent = display.textContent.replace(oldName, newName);
            }
        });
        
        // Update Round 2 Winners winner displays
        const round2wWinnerDisplays = document.querySelectorAll('#round2w-table .winner-display');
        round2wWinnerDisplays.forEach(display => {
            if (display && display.textContent && display.textContent.includes(oldName)) {
                display.textContent = display.textContent.replace(oldName, newName);
            }
        });
        
        // Update Round 2 Losers winner displays
        const round2lWinnerDisplays = document.querySelectorAll('#round2l-table .winner-display');
        round2lWinnerDisplays.forEach(display => {
            if (display && display.textContent && display.textContent.includes(oldName)) {
                display.textContent = display.textContent.replace(oldName, newName);
            }
        });
        
        // Update Round 3 winner displays
        const round3WinnerDisplays = document.querySelectorAll('#round3-table .winner-display');
        round3WinnerDisplays.forEach(display => {
            if (display && display.textContent && display.textContent.includes(oldName)) {
                display.textContent = display.textContent.replace(oldName, newName);
            }
        });
        
        console.log('Winner displays updated');
    } catch (error) {
        console.error('Error updating winner displays:', error);
    }
}

/**
 * Update tournament table displays
 */
function updateTournamentTableDisplays() {
    console.log('Updating tournament table displays');
    
    try {
        // Update Round 1 table player names only
        if (tournamentData && tournamentData.round1 && tournamentData.round1.pairs) {
            tournamentData.round1.pairs.forEach((pair, index) => {
                if (pair && pair.length >= 2) {
                    const matchRow = document.getElementById(`round1-match-${index}`);
                    if (matchRow) {
                        const player1Cell = matchRow.querySelector('td:nth-child(2) strong');
                        const player2Cell = matchRow.querySelector('td:nth-child(4) strong');
                        
                        if (player1Cell) player1Cell.textContent = pair[0] || '';
                        if (player2Cell) player2Cell.textContent = pair[1] || '';
                    }
                }
            });
        }
    
        // Update Round 2 Winners table
        if (tournamentData.round2 && tournamentData.round2.winners && tournamentData.round2.winners.pairs) {
            tournamentData.round2.winners.pairs.forEach((pair, index) => {
                if (pair && pair.length >= 2) {
                    const matchRow = document.getElementById(`round2w-match-${index}`);
                    if (matchRow) {
                        const player1Cell = matchRow.querySelector('td:nth-child(2) strong');
                        const player2Cell = matchRow.querySelector('td:nth-child(4) strong');
                        
                        if (player1Cell) player1Cell.textContent = pair[0] || '';
                        if (player2Cell) player2Cell.textContent = pair[1] || '';
                    }
                }
            });
        }
        
        // Update Round 2 Losers table
        if (tournamentData.round2 && tournamentData.round2.losers && tournamentData.round2.losers.pairs) {
            tournamentData.round2.losers.pairs.forEach((pair, index) => {
                if (pair && pair.length >= 2) {
                    const matchRow = document.getElementById(`round2l-match-${index}`);
                    if (matchRow) {
                        const player1Cell = matchRow.querySelector('td:nth-child(2) strong');
                        const player2Cell = matchRow.querySelector('td:nth-child(4) strong');
                        
                        if (player1Cell) player1Cell.textContent = pair[0] || '';
                        if (player2Cell) player2Cell.textContent = pair[1] || '';
                    }
                }
            });
        }
        
        // Update Round 3 table
        if (tournamentData.round3 && tournamentData.round3.pairs) {
            tournamentData.round3.pairs.forEach((pair, index) => {
                if (pair && pair.length >= 2) {
                    const matchRow = document.getElementById(`round3-match-${index}`);
                    if (matchRow) {
                        const player1Cell = matchRow.querySelector('td:nth-child(2) strong');
                        const player2Cell = matchRow.querySelector('td:nth-child(4) strong');
                        
                        if (player1Cell) player1Cell.textContent = pair[0] || '';
                        if (player2Cell) player2Cell.textContent = pair[1] || '';
                    }
                }
            });
        }
        
        console.log('Tournament table displays updated');
    } catch (error) {
        console.error('Error updating tournament table displays:', error);
    }
}

/**
 * Restore player names in form inputs
 */
function restorePlayerNamesInForm(playerNames) {
    console.log('Restoring player names in form:', playerNames);
    
    const playerInputs = document.querySelectorAll('.player-name-input');
    console.log('Found player inputs:', playerInputs.length);
    
    playerInputs.forEach((input, index) => {
        if (index < playerNames.length && playerNames[index]) {
            if (input.tagName === 'INPUT') {
                // Text input for ranking tournament
                input.value = playerNames[index];
                console.log(`Restored text input ${index + 1}: ${playerNames[index]}`);
            } else if (input.tagName === 'SELECT') {
                // Select input for free tournament
                // Find the option with matching text or value
                const options = input.querySelectorAll('option');
                let found = false;
                
                options.forEach(option => {
                    if (option.textContent === playerNames[index] || option.value === playerNames[index]) {
                        input.value = option.value;
                        found = true;
                        console.log(`Restored select input ${index + 1}: ${playerNames[index]} (value: ${option.value})`);
                    }
                });
                
                if (!found) {
                    // If not found in options, set as custom value
                    input.value = playerNames[index];
                    console.log(`Set custom value for select input ${index + 1}: ${playerNames[index]}`);
                }
            }
        }
    });
    
    console.log('Player names restored in form');
}

/**
 * Update UI based on tournament type selection
 */
function updateTournamentTypeUI(tournamentType) {
    console.log('Updating UI for tournament type:', tournamentType);
    
    const setupNamesBtn = document.getElementById('setup-names');
    const playerNamesForm = document.getElementById('player-names-form');
    const playerNamesList = document.getElementById('player-names-list');
    
    if (tournamentType === 'ranking') {
        // Ranking tournament - manual player input for ranking
        console.log('Setting up ranking tournament');
        if (setupNamesBtn) {
            setupNamesBtn.innerHTML = '<i class="fas fa-star me-2"></i>Nhập cơ thủ cho giải đấu tự do';
            setupNamesBtn.className = 'btn btn-warning w-100';
        }
        
        // Clear any existing form
        if (playerNamesForm) {
            playerNamesForm.style.display = 'none';
        }
        if (playerNamesList) {
            playerNamesList.innerHTML = '';
        }
        
    } else if (tournamentType === 'free') {
        // Free tournament - manual player input
        console.log('Setting up free tournament');
        if (setupNamesBtn) {
            setupNamesBtn.innerHTML = '<i class="fas fa-users me-2"></i>Chọn cơ thủ từ danh sách';
            setupNamesBtn.className = 'btn btn-primary w-100';
        }
        
        // Clear any existing form
        if (playerNamesForm) {
            playerNamesForm.style.display = 'none';
        }
        if (playerNamesList) {
            playerNamesList.innerHTML = '';
        }
    }
}

/**
 * Check if tournament has already started and update UI accordingly
 */
async function checkTournamentStatus() {
    console.log('Checking tournament status...');
    
    // Check if there's saved tournament data
    const savedData = await loadTournamentData();
    if (savedData && savedData.tournamentData) {
        const hasRound1Data = savedData.tournamentData.round1 && 
                              savedData.tournamentData.round1.pairs && 
                              savedData.tournamentData.round1.pairs.length > 0;
        
        if (hasRound1Data) {
            console.log('Tournament has already started, updating UI...');
            updateTournamentButtonForRestart();
            return true;
        }
    }
    
    console.log('Tournament has not started yet');
    return false;
}

/**
 * Update tournament button for restart scenario
 */
function updateTournamentButtonForRestart() {
    const startBtn = document.getElementById('tournament-start-btn');
    if (startBtn) {
        startBtn.innerHTML = '<i class="fas fa-redo me-2"></i>Bắt đầu lại giải đấu';
        startBtn.className = 'btn btn-warning btn-lg';
        startBtn.type = 'button'; // Change from submit to button
        startBtn.onclick = function(e) {
            e.preventDefault();
            confirmRestartTournament();
        };
        console.log('Tournament button updated for restart');
    }
}

/**
 * Confirm and restart tournament
 */
function confirmRestartTournament() {
    if (confirm('Bạn có chắc chắn muốn bắt đầu lại giải đấu?\n\nTất cả dữ liệu trận đấu hiện tại sẽ bị xóa và tạo lại từ đầu.')) {
        console.log('User confirmed tournament restart');
        restartTournament();
    } else {
        console.log('User cancelled tournament restart');
    }
}

/**
 * Restart tournament by clearing all data and resetting UI
 */
function restartTournament() {
    console.log('Restarting tournament...');
    
    try {
        // Clear saved tournament data from localStorage
        const storageKey = getTournamentStorageKey();
        localStorage.removeItem(storageKey);
        console.log('Saved tournament data cleared from localStorage');
        
        // Reset tournament data
        tournamentData = {
            round1: { pairs: [], results: [], winners: [], losers: [] },
            round2: {
                winners: { pairs: [], results: [], winners: [], losers: [] },
                losers: { pairs: [], results: [], winners: [], losers: [] }
            },
            round3: { pairs: [], results: [], winners: [], losers: [] },
            elimination: { pairs: [], results: [], winners: [], losers: [], bracketWinners: [], bracketResults: [] },
            finalElimination: { pairs: [], results: [], winners: [], losers: [] }
        };
        players = [];
        tournamentType = 'ranking'; // Reset to default tournament type
        
        // Reset tournament type selection
        const rankingRadio = document.querySelector('input[name="tournament-type"][value="ranking"]');
        if (rankingRadio) {
            rankingRadio.checked = true;
            updateTournamentTypeUI('ranking');
        }
        
        // Hide all tournament sections
        document.getElementById('tournament-tables').style.display = 'none';
        document.getElementById('round2-section').style.display = 'none';
        document.getElementById('round3-section').style.display = 'none';
        document.getElementById('elimination-section').style.display = 'none';
        
        // Reset button to original state
        const startBtn = document.getElementById('tournament-start-btn');
        if (startBtn) {
            startBtn.innerHTML = '<i class="fas fa-play me-2"></i>Bắt đầu giải đấu';
            startBtn.className = 'btn btn-success btn-lg';
            startBtn.onclick = null; // Remove custom onclick
            startBtn.type = 'submit'; // Restore submit type
            startBtn.disabled = false; // Ensure button is enabled
        }
        
        // Hide controls panel
        const controlsPanel = document.getElementById('controls-panel');
        if (controlsPanel) {
            controlsPanel.style.display = 'none';
        }
        
        // Hide player names form initially (user needs to click "Danh sách cơ thủ")
        const playerNamesForm = document.getElementById('player-names-form');
        if (playerNamesForm) {
            playerNamesForm.style.display = 'none';
        }
        
        // Clear any existing player names list
        const playerNamesList = document.getElementById('player-names-list');
        if (playerNamesList) {
            playerNamesList.innerHTML = '';
        }
        
        // Ensure setup-names button is visible and functional
        const setupNamesBtn = document.getElementById('setup-names');
        if (setupNamesBtn) {
            setupNamesBtn.style.display = 'block';
            setupNamesBtn.disabled = false;
        }
        
        // Update save indicator
        updateSaveIndicator('cleared');
        
        // Show success message
        showNotification('Giải đấu đã được reset. Bạn có thể bắt đầu lại!', 'success');
        
        console.log('Tournament restarted successfully');
        
    } catch (error) {
        console.error('Error restarting tournament:', error);
        showNotification('Có lỗi khi restart giải đấu: ' + error.message, 'error');
    }
}

/**
 * Auto-process all BYE matches in the tournament
 * This function runs after tournament creation to automatically advance players facing BYE
 */
function autoProcessBYEMatches() {
    console.log('Auto-processing BYE matches...');
    
    let byeCount = 0;
    
    // Process Round 1 BYE matches
    if (tournamentData.round1.pairs) {
        tournamentData.round1.pairs.forEach((pair, index) => {
            if (pair[0] === 'BYE' || pair[1] === 'BYE') {
                console.log(`Processing BYE match in Round 1, match ${index}`);
                updateMatchResult(index, 'round1');
                byeCount++;
            }
        });
    }
    
    if (byeCount > 0) {
        console.log(`Processed ${byeCount} BYE matches automatically`);
        showNotification(`Đã tự động xử lý ${byeCount} trận đấu có BYE`, 'info');
    }
}

async function updateMatchResult(matchIndex, bracket = 'round1') {
    console.log(`Updating match result for match ${matchIndex} in ${bracket} bracket`);
    
    let matchInputs, winnerDisplay, matchRow, pairs, results;
    
    if (bracket === 'round1') {
        matchInputs = document.querySelectorAll(`input[data-match="${matchIndex}"]`);
        winnerDisplay = document.getElementById(`winner-${matchIndex}`);
        matchRow = document.getElementById(`round1-match-${matchIndex}`);
        pairs = tournamentData.round1.pairs;
        results = tournamentData.round1.results;
    } else if (bracket === 'round2w') {
        matchInputs = document.querySelectorAll(`input[data-match="${matchIndex}"][data-round="2w"]`);
        winnerDisplay = document.getElementById(`winner-2w-${matchIndex}`);
        matchRow = document.getElementById(`round2w-match-${matchIndex}`);
        pairs = tournamentData.round2.winners.pairs;
        results = tournamentData.round2.winners.results;
    } else if (bracket === 'round2l') {
        matchInputs = document.querySelectorAll(`input[data-match="${matchIndex}"][data-round="2l"]`);
        winnerDisplay = document.getElementById(`winner-2l-${matchIndex}`);
        matchRow = document.getElementById(`round2l-match-${matchIndex}`);
        pairs = tournamentData.round2.losers.pairs;
        results = tournamentData.round2.losers.results;
    } else if (bracket === 'round3') {
        matchInputs = document.querySelectorAll(`input[data-match="${matchIndex}"][data-round="3"]`);
        winnerDisplay = document.getElementById(`winner-3-${matchIndex}`);
        matchRow = document.getElementById(`round3-match-${matchIndex}`);
        pairs = tournamentData.round3.pairs;
        results = tournamentData.round3.results;
    } else if (bracket === 'elimination') {
        matchInputs = document.querySelectorAll(`input[data-match="${matchIndex}"][data-round="elimination"]`);
        winnerDisplay = document.getElementById(`winner-elimination-${matchIndex}`);
        matchRow = document.getElementById(`elimination-match-${matchIndex}`);
        pairs = tournamentData.elimination.pairs;
        results = tournamentData.elimination.results;
    } else if (bracket === 'final-elimination') {
        matchInputs = document.querySelectorAll(`input[data-match="${matchIndex}"][data-round="final-elimination"]`);
        winnerDisplay = document.getElementById(`winner-final-elimination-${matchIndex}`);
        matchRow = document.getElementById(`final-elimination-match-${matchIndex}`);
        pairs = tournamentData.finalElimination ? tournamentData.finalElimination.pairs : [];
        results = tournamentData.finalElimination ? tournamentData.finalElimination.results : [];
    }
    
    if (!matchInputs || matchInputs.length < 2) {
        console.error('Match inputs not found');
        return;
    }
    
    // Check if either player is BYE - auto-win for opponent
    const player1 = pairs[matchIndex][0];
    const player2 = pairs[matchIndex][1];
    
    if (player1 === 'BYE' || player2 === 'BYE') {
        console.log('BYE match detected:', player1, 'vs', player2);
        
        let winner, loser;
        if (player1 === 'BYE') {
            winner = player2;
            loser = player1;
            results[matchIndex] = [0, 1]; // Auto-score: 0-1
        } else {
            winner = player1;
            loser = player2;
            results[matchIndex] = [1, 0]; // Auto-score: 1-0
        }
        
        winnerDisplay.textContent = winner + ' (BYE)';
        winnerDisplay.className = 'winner-display text-info fw-bold';
        matchRow.className = 'table-info';
        
        console.log(`BYE result: Winner: ${winner}, Loser: ${loser}`);
        
        // Auto-update next rounds based on current bracket
        if (bracket === 'round1') {
            await updateRound2Brackets(matchIndex, winner, loser);
        } else if (bracket === 'round2w' || bracket === 'round2l') {
            await checkAndCreateAdvancedRounds();
        } else if (bracket === 'round3') {
            await updateEliminationFromRound3(matchIndex, winner, null);
        } else if (bracket === 'elimination') {
            await updateEliminationBracketVisualization();
            await checkAndCreateAdvancedRounds();
        }
        
        // Auto-save tournament data
        await saveTournamentData();
        
        showNotification(`${winner} tự động thắng (đối thủ BYE)`, 'info');
        return;
    }
    
    const player1Score = parseInt(matchInputs[0].value) || 0;
    const player2Score = parseInt(matchInputs[1].value) || 0;
    
    console.log(`Scores: Player 1: ${player1Score}, Player 2: ${player2Score}`);
    
    // For round3, store the old winner BEFORE updating results
    let oldWinner = null;
    if (bracket === 'round3') {
        const oldResult = results[matchIndex];
        if (oldResult && oldResult[0] !== null && oldResult[1] !== null) {
            if (oldResult[0] > oldResult[1]) {
                oldWinner = pairs[matchIndex][0];
            } else if (oldResult[1] > oldResult[0]) {
                oldWinner = pairs[matchIndex][1];
            }
        }
        console.log('Old winner before update:', oldWinner);
    }
    
    // Update tournament data
    results[matchIndex] = [player1Score, player2Score];
    
    let winner, loser;
    if (player1Score > player2Score) {
        winner = pairs[matchIndex][0];
        loser = pairs[matchIndex][1];
        winnerDisplay.textContent = winner;
        winnerDisplay.className = 'winner-display text-success fw-bold';
        matchRow.className = 'table-success';
    } else if (player2Score > player1Score) {
        winner = pairs[matchIndex][1];
        loser = pairs[matchIndex][0];
        winnerDisplay.textContent = winner;
        winnerDisplay.className = 'winner-display text-success fw-bold';
        matchRow.className = 'table-success';
    } else if (player1Score === player2Score && player1Score > 0) {
        winner = 'Hòa';
        loser = 'Hòa';
        winnerDisplay.textContent = 'Hòa';
        winnerDisplay.className = 'winner-display text-warning fw-bold';
        matchRow.className = 'table-warning';
    } else {
        winnerDisplay.textContent = 'Chưa có kết quả';
        winnerDisplay.className = 'winner-display text-muted';
        matchRow.className = '';
        alert('Vui lòng nhập điểm số cho cả hai người chơi!');
        return;
    }
    
    console.log(`Winner: ${winner}, Loser: ${loser}`);
    
    // Auto-update next rounds based on current bracket
    if (bracket === 'round1') {
        await updateRound2Brackets(matchIndex, winner, loser);
    } else if (bracket === 'round2w' || bracket === 'round2l') {
        // Check if we can create advanced rounds after round 2
        await checkAndCreateAdvancedRounds();
    } else if (bracket === 'round3') {
        // Round 3 winners go to elimination round
        await updateEliminationFromRound3(matchIndex, winner, oldWinner);
    } else if (bracket === 'elimination') {
        // Update elimination bracket visualization
        await updateEliminationBracketVisualization();
        // Check if we can create advanced rounds after elimination
        await checkAndCreateAdvancedRounds();
    } else if (bracket === 'final-elimination') {
        // Final elimination round - this is the ultimate final round
        console.log('Final elimination round completed - tournament finished!');
        announceTournamentWinner(winner);
    }
    
    // Auto-save tournament data to localStorage
    await saveTournamentData();
    
    alert(`Cập nhật kết quả trận đấu ${matchIndex + 1} thành công!\nNgười thắng: ${winner}`);
}

async function updateEliminationFromRound3(matchIndex, winner, oldWinner = null) {
    console.log(`Updating elimination round from round 3 match ${matchIndex}: Winner: ${winner}`);
    console.log('Old winner from round 3 match:', oldWinner);
    console.log('New winner from round 3 match:', winner);
    
    // Remove old winner from elimination round if exists and is different from new winner
    if (oldWinner && oldWinner !== winner && oldWinner !== 'Hòa') {
        await removePlayerFromEliminationRound(oldWinner);
        console.log('Removed old winner from elimination round:', oldWinner);
    }
    
    // Get all round 3 winners
    const round3Winners = [];
    const round3WinnersMapping = {}; // Track which match each winner came from
    tournamentData.round3.results.forEach((result, index) => {
        if (result[0] !== null && result[1] !== null) {
            let matchWinner = null;
            if (result[0] > result[1]) {
                matchWinner = tournamentData.round3.pairs[index][0];
            } else if (result[1] > result[0]) {
                matchWinner = tournamentData.round3.pairs[index][1];
            }
            
            if (matchWinner && matchWinner !== 'Hòa') {
                round3Winners.push(matchWinner);
                round3WinnersMapping[matchWinner] = index; // Track match index
            }
        }
    });
    
    console.log('Round 3 winners:', round3Winners);
    console.log('Round 3 winners mapping:', round3WinnersMapping);
    
    // Get elimination round winners
    const eliminationWinners = [];
    tournamentData.elimination.results.forEach((result, index) => {
        if (result[0] !== null && result[1] !== null) {
            if (result[0] > result[1]) {
                eliminationWinners.push(tournamentData.elimination.pairs[index][0]);
            } else if (result[1] > result[0]) {
                eliminationWinners.push(tournamentData.elimination.pairs[index][1]);
            }
        }
    });
    
    console.log('Elimination round winners:', eliminationWinners);
    
    // Add round 3 winners to elimination round
    if (round3Winners.length > 0) {
        await updateEliminationRoundWithRound3Winners(round3Winners, round3WinnersMapping);
    }
    
    // Note: Final elimination is now handled directly in the bracket visualization
    // All rounds are managed through the elimination bracket
}

async function removePlayerFromEliminationRound(playerToRemove) {
    console.log('Removing player from elimination round:', playerToRemove);
    
    const eliminationPairs = tournamentData.elimination.pairs;
    let removed = false;
    let removedPairIndex = -1;
    
    // Search for the player in elimination pairs and remove them
    for (let i = 0; i < eliminationPairs.length; i++) {
        if (eliminationPairs[i][0] === playerToRemove) {
            eliminationPairs[i][0] = 'null';
            removed = true;
            removedPairIndex = i;
            console.log(`Removed ${playerToRemove} from elimination pair ${i}, position 0`);
            break;
        } else if (eliminationPairs[i][1] === playerToRemove) {
            eliminationPairs[i][1] = 'null';
            removed = true;
            removedPairIndex = i;
            console.log(`Removed ${playerToRemove} from elimination pair ${i}, position 1`);
            break;
        }
    }
    
    if (removed && removedPairIndex !== -1) {
        // Reset the result for this pair since one player was removed
        if (tournamentData.elimination.results[removedPairIndex]) {
            tournamentData.elimination.results[removedPairIndex] = [null, null];
            console.log(`Reset elimination result for pair ${removedPairIndex}`);
        }
        
        // Update the elimination bracket to reflect the changes
        updateEliminationBracket(eliminationPairs);
    }
    
    return removed;
}

async function updateEliminationRoundWithRound3Winners(round3Winners, round3WinnersMapping = {}) {
    console.log('Adding Round 3 winners to elimination round:', round3Winners);
    console.log('With mapping:', round3WinnersMapping);
    
    // Get current elimination pairs
    const currentEliminationPairs = tournamentData.elimination.pairs;
    
    // Initialize mapping storage if not exists
    if (!tournamentData.round3ToEliminationMapping) {
        tournamentData.round3ToEliminationMapping = {};
    }
    
    // Add round 3 winners to elimination pairs
    round3Winners.forEach((winner, index) => {
        const round3MatchIndex = round3WinnersMapping[winner];
        
        // Check if this winner already has a slot assigned
        let existingSlot = tournamentData.round3ToEliminationMapping[round3MatchIndex];
        
        if (existingSlot !== undefined) {
            // Update existing slot
            const [pairIndex, position] = existingSlot;
            if (currentEliminationPairs[pairIndex]) {
                currentEliminationPairs[pairIndex][position] = winner;
                console.log(`Updated winner ${winner} in existing slot: pair ${pairIndex}, position ${position}`);
                return;
            }
        }
        
        // Find empty slot or create new pair
        let added = false;
        for (let i = 0; i < currentEliminationPairs.length; i++) {
            if (currentEliminationPairs[i][0] === 'null' || currentEliminationPairs[i][0] === '') {
                currentEliminationPairs[i][0] = winner;
                tournamentData.round3ToEliminationMapping[round3MatchIndex] = [i, 0];
                added = true;
                console.log(`Added winner ${winner} to pair ${i}, position 0`);
                break;
            } else if (currentEliminationPairs[i][1] === 'null' || currentEliminationPairs[i][1] === '') {
                currentEliminationPairs[i][1] = winner;
                tournamentData.round3ToEliminationMapping[round3MatchIndex] = [i, 1];
                added = true;
                console.log(`Added winner ${winner} to pair ${i}, position 1`);
                break;
            }
        }
        
        // If no empty slot found, create new pair
        if (!added) {
            const newPairIndex = currentEliminationPairs.length;
            currentEliminationPairs.push([winner, 'null']);
            tournamentData.round3ToEliminationMapping[round3MatchIndex] = [newPairIndex, 0];
            console.log(`Created new pair ${newPairIndex} for winner ${winner}`);
        }
    });
    
    console.log('Updated elimination pairs:', currentEliminationPairs);
    console.log('Round 3 to Elimination mapping:', tournamentData.round3ToEliminationMapping);
    
    // Update elimination bracket
    await updateEliminationBracket(currentEliminationPairs);
}

async function updateEliminationBracket(eliminationPairs) {
    console.log('Updating elimination bracket with pairs:', eliminationPairs);
    
    // Update tournament data
    tournamentData.elimination.pairs = eliminationPairs;
    tournamentData.elimination.results = Array(eliminationPairs.length).fill([null, null]);
    
    // Show elimination section
    const eliminationSection = document.getElementById('elimination-section');
    if (eliminationSection) {
        eliminationSection.style.display = 'block';
    }
    
    // Update bracket visualization for elimination round
    await createEliminationBracketVisualization(eliminationPairs);
    
    console.log('Elimination bracket updated');
}

async function createEliminationBracketVisualization(eliminationPairs, savedResults = null) {
    console.log('Creating elimination bracket visualization for pairs:', eliminationPairs);
    console.log('Saved results:', savedResults);
    
    const eliminationBracketWrapper = document.getElementById('elimination-bracket-wrapper');
    if (!eliminationBracketWrapper) {
        console.error('Elimination bracket wrapper element not found');
        return;
    }
    
    // Show elimination bracket wrapper
    eliminationBracketWrapper.style.display = 'block';
    
    // Filter out null players and create teams
    const teams = [];
    eliminationPairs.forEach(pair => {
        const player1 = pair[0] && pair[0] !== 'null' ? pair[0] : 'TBD';
        const player2 = pair[1] && pair[1] !== 'null' ? pair[1] : 'TBD';
        teams.push([player1, player2]);
    });
    
    console.log('Elimination teams:', teams);
    
    // Use saved results if available, otherwise create empty results
    let bracketResults;
    if (savedResults && Array.isArray(savedResults) && savedResults.length > 0) {
        console.log('Using saved results for bracket');
        bracketResults = savedResults;
    } else if (tournamentData.elimination.results && tournamentData.elimination.results.length > 0) {
        console.log('Using tournament data results for bracket');
        // Create results structure for bracket plugin
        // The bracket plugin expects results in rounds format
        bracketResults = [tournamentData.elimination.results];
    } else {
        console.log('Creating new empty results');
        bracketResults = [Array(teams.length).fill([null, null])];
    }
    
    console.log('Bracket results to use:', bracketResults);
    
    // Initialize bracket using jQuery Bracket plugin
    if (typeof $ !== 'undefined' && $.fn.bracket) {
        try {
            eliminationBracketWrapper.innerHTML = ''; // Clear previous content
            
            const bracketData = {
                teams: teams,
                results: bracketResults
            };
            
            console.log('Initializing bracket with data:', bracketData);
            
            $(eliminationBracketWrapper).bracket({
                init: bracketData,
                save: async function(data) {
                    console.log('Elimination bracket data saved:', data);
                    // Update tournament data with bracket results
                    updateEliminationBracketData(data);
                    // Auto-save to localStorage
                    await saveTournamentData();
                },
                disableToolbar: false,
                disableTeamEdit: false,
                teamWidth: 150,
                scoreWidth: 30,
                matchWidth: 60,
                roundMargin: 50,
                bracketMargin: 50
            });
            
            // Add event listeners for name changes in elimination bracket
            addEliminationBracketNameChangeListeners();
            
            console.log('Elimination bracket visualization created successfully');
            
        } catch (error) {
            console.error('Error creating elimination bracket visualization:', error);
            eliminationBracketWrapper.innerHTML = `
                <div class="alert alert-warning">
                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Không thể tạo sơ đồ bracket</h5>
                    <p>Lỗi: ${error.message}</p>
                    <p>Số lượng người chơi: ${teams.length}</p>
                </div>
            `;
        }
    } else {
        console.error('jQuery Bracket plugin not loaded');
        eliminationBracketWrapper.innerHTML = `
            <div class="alert alert-danger">
                <h5><i class="fas fa-exclamation-triangle me-2"></i>Plugin Bracket không được tải</h5>
                <p>Vui lòng tải lại trang để sử dụng tính năng bracket.</p>
            </div>
        `;
    }
}

function updateEliminationBracketData(bracketData) {
    console.log('Updating elimination bracket data:', bracketData);
    
    // Save all results to tournament data
    if (bracketData.results && bracketData.results.length > 0) {
        // Store the complete results structure
        tournamentData.elimination.bracketResults = bracketData.results;
        
        // Also store first round results for compatibility
        if (bracketData.results[0]) {
            tournamentData.elimination.results = bracketData.results[0];
        }
        
        console.log('Saved elimination results:', tournamentData.elimination.results);
        console.log('Saved full bracket results:', tournamentData.elimination.bracketResults);
    }
    
    // Extract winners from bracket data
    const winners = [];
    if (bracketData.results && bracketData.results.length > 0) {
        const finalResults = bracketData.results[bracketData.results.length - 1];
        finalResults.forEach((result, index) => {
            if (result && result[0] !== null && result[1] !== null) {
                if (result[0] > result[1]) {
                    winners.push(bracketData.teams[index][0]);
                } else if (result[1] > result[0]) {
                    winners.push(bracketData.teams[index][1]);
                }
            }
        });
    }
    
    console.log('Elimination bracket winners:', winners);
    
    // Update tournament data
    tournamentData.elimination.bracketWinners = winners;
    
    // Check if we have a final winner
    if (winners.length === 1) {
        console.log('🏆 TOURNAMENT WINNER:', winners[0]);
        announceTournamentWinner(winners[0]);
    }
}

function addEliminationBracketCSS() {
    // Check if CSS already added
    if (document.getElementById('elimination-bracket-css')) {
        return;
    }
    
    const style = document.createElement('style');
    style.id = 'elimination-bracket-css';
    style.textContent = `
        .elimination-bracket-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .bracket-tree {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 400px;
            overflow-x: auto;
        }
        
        .bracket-level {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            min-height: 300px;
            flex: 1;
            margin: 0 10px;
        }
        
        .bracket-match {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .bracket-match:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .bracket-match.first-level {
            border-left: 4px solid #28a745;
        }
        
        .bracket-match.final-match {
            border: 3px solid #ffc107;
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        }
        
        .match-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .player-slot {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 8px 12px;
            min-width: 120px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .player-slot:hover {
            background: #e9ecef;
            border-color: #007bff;
        }
        
        .player-name {
            font-weight: 600;
            color: #495057;
        }
        
        .vs-divider {
            font-weight: bold;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .champion-crown {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ffc107;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        .champion-crown i {
            color: #fff;
            font-size: 14px;
        }
        
        .level-0 .bracket-match {
            border-left: 4px solid #28a745;
        }
        
        .level-1 .bracket-match {
            border-left: 4px solid #17a2b8;
        }
        
        .level-2 .bracket-match {
            border-left: 4px solid #6f42c1;
        }
        
        .level-3 .bracket-match {
            border-left: 4px solid #fd7e14;
        }
        
        .player-slot.winner {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        
        .player-slot.loser {
            background: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
        
        @media (max-width: 768px) {
            .bracket-tree {
                flex-direction: column;
                align-items: center;
            }
            
            .bracket-level {
                flex-direction: row;
                min-height: auto;
                margin: 10px 0;
            }
            
            .bracket-match {
                margin: 5px;
                padding: 10px;
            }
            
            .player-slot {
                min-width: 100px;
                padding: 6px 10px;
            }
        }
    `;
    
    document.head.appendChild(style);
    console.log('Elimination bracket CSS added');
}

async function updateEliminationBracketVisualization() {
    console.log('Updating elimination bracket visualization...');
    
    const eliminationBracketWrapper = document.getElementById('elimination-bracket-wrapper');
    if (!eliminationBracketWrapper) {
        console.error('Elimination bracket wrapper element not found');
        return;
    }
    
    // Get current elimination pairs
    const eliminationPairs = tournamentData.elimination.pairs;
    const eliminationResults = tournamentData.elimination.results;
    
    console.log('Current elimination pairs:', eliminationPairs);
    console.log('Current elimination results:', eliminationResults);
    
    // Filter out null players and create teams
    const teams = [];
    eliminationPairs.forEach(pair => {
        const player1 = pair[0] && pair[0] !== 'null' ? pair[0] : 'TBD';
        const player2 = pair[1] && pair[1] !== 'null' ? pair[1] : 'TBD';
        teams.push([player1, player2]);
    });
    
    // Create results array from elimination results
    const results = [];
    if (eliminationResults.length > 0) {
        results.push(eliminationResults);
    } else {
        results.push(Array(teams.length).fill([null, null]));
    }
    
    const bracketData = {
        teams: teams,
        results: results
    };
    
    console.log('Updated bracket data:', bracketData);
    
    // Recreate bracket with updated data
    if (typeof $ !== 'undefined' && $.fn.bracket) {
        try {
            eliminationBracketWrapper.innerHTML = ''; // Clear previous content
            
            $(eliminationBracketWrapper).bracket({
                init: bracketData,
                save: function(data) {
                    console.log('Elimination bracket data saved:', data);
                    updateEliminationBracketData(data);
                },
                disableToolbar: false,
                disableTeamEdit: false,
                teamWidth: 150,
                scoreWidth: 30,
                matchWidth: 60,
                roundMargin: 50,
                bracketMargin: 50
            });
            
            // Add event listeners for name changes in elimination bracket
            addEliminationBracketNameChangeListeners();
            
            console.log('Elimination bracket visualization updated successfully');
            
        } catch (error) {
            console.error('Error updating elimination bracket visualization:', error);
        }
    }
}

// Final elimination is now handled directly in the bracket visualization
// No separate function needed

async function updateRound2Brackets(matchIndex, winner, loser) {
    console.log(`Updating round 2 brackets for match ${matchIndex}: Winner: ${winner}, Loser: ${loser}`);
    
    // Don't propagate BYE to next rounds
    if (winner === 'BYE') {
        console.log('Winner is BYE, skipping round 2 update');
        return;
    }
    
    // Update winners bracket
    const winnersTable = document.getElementById('round2w-table');
    if (winnersTable) {
        // Find the corresponding match in winners bracket
        const winnersMatchIndex = Math.floor(matchIndex / 2);
        const winnersMatchRow = document.getElementById(`round2w-match-${winnersMatchIndex}`);
        
        if (winnersMatchRow) {
            // Update player names in winners bracket
            const player1Cell = winnersMatchRow.querySelector('td:nth-child(2) strong');
            const player2Cell = winnersMatchRow.querySelector('td:nth-child(4) strong');
            
            if (matchIndex % 2 === 0) {
                // First match of the pair
                player1Cell.textContent = winner;
                tournamentData.round2.winners.pairs[winnersMatchIndex][0] = winner;
            } else {
                // Second match of the pair
                player2Cell.textContent = winner;
                tournamentData.round2.winners.pairs[winnersMatchIndex][1] = winner;
            }
            
            console.log(`Updated winners bracket match ${winnersMatchIndex}`);
        }
    }
    
    // Update losers bracket (only if loser is not BYE)
    if (loser !== 'BYE') {
        const losersTable = document.getElementById('round2l-table');
        if (losersTable) {
            // Find the corresponding match in losers bracket
            const losersMatchIndex = Math.floor(matchIndex / 2);
            const losersMatchRow = document.getElementById(`round2l-match-${losersMatchIndex}`);
            
            if (losersMatchRow) {
                // Update player names in losers bracket
                const player1Cell = losersMatchRow.querySelector('td:nth-child(2) strong');
                const player2Cell = losersMatchRow.querySelector('td:nth-child(4) strong');
                
                if (matchIndex % 2 === 0) {
                    // First match of the pair
                    player1Cell.textContent = loser;
                    tournamentData.round2.losers.pairs[losersMatchIndex][0] = loser;
                } else {
                    // Second match of the pair
                    player2Cell.textContent = loser;
                    tournamentData.round2.losers.pairs[losersMatchIndex][1] = loser;
                }
                
                console.log(`Updated losers bracket match ${losersMatchIndex}`);
            }
        }
    } else {
        console.log('Loser is BYE, skipping losers bracket update');
    }
    
    // Check if we can create round 3 and elimination rounds
    await checkAndCreateAdvancedRounds();
    
    // Update bracket visualization
    updateBracketVisualization();
}

async function checkAndCreateAdvancedRounds() {
    console.log('Checking if we can create advanced rounds...');
    
    // Check if round 2 winners bracket has results
    const round2wResults = tournamentData.round2.winners.results;
    const round2lResults = tournamentData.round2.losers.results;
    
    let round2wWinners = [];
    let round2wLosers = [];
    let round2lWinners = [];
    
    // Collect winners and losers from round 2 winners bracket
    round2wResults.forEach((result, index) => {
        if (result[0] !== null && result[1] !== null) {
            if (result[0] > result[1]) {
                round2wWinners.push(tournamentData.round2.winners.pairs[index][0]);
                round2wLosers.push(tournamentData.round2.winners.pairs[index][1]);
            } else if (result[1] > result[0]) {
                round2wWinners.push(tournamentData.round2.winners.pairs[index][1]);
                round2wLosers.push(tournamentData.round2.winners.pairs[index][0]);
            }
        }
    });
    
    // Collect winners from round 2 losers bracket
    round2lResults.forEach((result, index) => {
        if (result[0] !== null && result[1] !== null) {
            if (result[0] > result[1]) {
                round2lWinners.push(tournamentData.round2.losers.pairs[index][0]);
            } else if (result[1] > result[0]) {
                round2lWinners.push(tournamentData.round2.losers.pairs[index][1]);
            }
        }
    });
    
    console.log('Round 2 Winners Bracket - Winners:', round2wWinners);
    console.log('Round 2 Winners Bracket - Losers:', round2wLosers);
    console.log('Round 2 Losers Bracket - Winners:', round2lWinners);
    
    // Create or Update Round 3 if we have enough players
    if (round2wLosers.length > 0 && round2lWinners.length > 0) {
        // Check if Round 3 already exists
        if (tournamentData.round3.pairs.length > 0) {
            console.log('Round 3 already exists, updating players...');
            updateRound3Players(round2wLosers, round2lWinners);
        } else {
            console.log('Creating new Round 3...');
            createRound3(round2wLosers, round2lWinners);
        }
    }
    
    // Create or Update Elimination Round if we have winners from round 2 winners bracket
    if (round2wWinners.length > 0) {
        // Check if Elimination Round already exists
        if (tournamentData.elimination.pairs.length > 0) {
            console.log('Elimination Round already exists, updating players...');
            updateEliminationPlayers(round2wWinners);
        } else {
            console.log('Creating new Elimination Round...');
            await createEliminationRound(round2wWinners);
        }
    }
}

/**
 * Update Round 3 players when Round 2 results change
 * This function dynamically updates player names in existing Round 3 matches
 */
async function updateRound3Players(round2wLosers, round2lWinners) {
    console.log('Updating Round 3 players...');
    console.log('New Round 2 Winners Bracket Losers:', round2wLosers);
    console.log('New Round 2 Losers Bracket Winners:', round2lWinners);
    
    // Track old winners that need to be removed from elimination round
    const oldRound3Winners = [];
    tournamentData.round3.results.forEach((result, index) => {
        if (result[0] !== null && result[1] !== null) {
            let winner = null;
            if (result[0] > result[1]) {
                winner = tournamentData.round3.pairs[index][0];
            } else if (result[1] > result[0]) {
                winner = tournamentData.round3.pairs[index][1];
            }
            if (winner && winner !== 'Hòa') {
                oldRound3Winners.push({
                    matchIndex: index,
                    winner: winner
                });
            }
        }
    });
    
    // Update round 3 pairs with new players
    const maxPairs = Math.max(round2wLosers.length, round2lWinners.length);
    let playersChanged = false;
    
    for (let i = 0; i < maxPairs; i++) {
        const player1 = round2wLosers[i] || 'null';
        const player2 = round2lWinners[i] || 'null';
        
        // Update tournament data
        if (tournamentData.round3.pairs[i]) {
            const oldPair = [...tournamentData.round3.pairs[i]];
            tournamentData.round3.pairs[i] = [player1, player2];
            
            // Update UI if the pair changed
            if (oldPair[0] !== player1 || oldPair[1] !== player2) {
                console.log(`Updating Round 3 match ${i}: [${oldPair[0]}, ${oldPair[1]}] -> [${player1}, ${player2}]`);
                playersChanged = true;
                
                // Update player names in the table
                const matchRow = document.getElementById(`round3-match-${i}`);
                if (matchRow) {
                    const player1Cell = matchRow.querySelector('td:nth-child(2) strong');
                    const player2Cell = matchRow.querySelector('td:nth-child(4) strong');
                    
                    if (player1Cell) player1Cell.textContent = player1;
                    if (player2Cell) player2Cell.textContent = player2;
                    
                    // Check if this match had a result
                    const hadResult = tournamentData.round3.results[i][0] !== null && 
                                     tournamentData.round3.results[i][1] !== null;
                    
                    if (hadResult) {
                        // Find and remove old winner from elimination round
                        const oldWinnerData = oldRound3Winners.find(w => w.matchIndex === i);
                        if (oldWinnerData) {
                            console.log(`Removing old Round 3 winner from elimination: ${oldWinnerData.winner}`);
                            await removePlayerFromEliminationRound(oldWinnerData.winner);
                        }
                    }
                    
                    // Reset results for this match since players changed
                    tournamentData.round3.results[i] = [null, null];
                    
                    // Reset score inputs
                    const scoreInputs = matchRow.querySelectorAll('input[data-round="3"]');
                    scoreInputs.forEach(input => input.value = '');
                    
                    // Reset winner display
                    const winnerDisplay = document.getElementById(`winner-3-${i}`);
                    if (winnerDisplay) {
                        winnerDisplay.textContent = 'Chưa có kết quả';
                        winnerDisplay.className = 'winner-display text-muted';
                    }
                    
                    // Reset row styling
                    matchRow.className = '';
                }
            }
        }
    }
    
    if (playersChanged) {
        console.log('Round 3 players updated successfully');
        showNotification('Cơ thủ trong Vòng 3 đã được cập nhật do thay đổi kết quả Vòng 2', 'info');
    }
    
    // Save updated tournament data
    await saveTournamentData();
}

function createRound3(round2wLosers, round2lWinners) {
    console.log('Creating Round 3...');
    console.log('Round 2 Winners Bracket Losers:', round2wLosers);
    console.log('Round 2 Losers Bracket Winners:', round2lWinners);
    
    // Create round 3 pairs
    const round3Pairs = [];
    const maxPairs = Math.max(round2wLosers.length, round2lWinners.length);
    
    for (let i = 0; i < maxPairs; i++) {
        const player1 = round2wLosers[i] || 'null';
        const player2 = round2lWinners[i] || 'null';
        round3Pairs.push([player1, player2]);
    }
    
    console.log('Round 3 pairs:', round3Pairs);
    
    // Store round 3 data
    tournamentData.round3.pairs = round3Pairs;
    tournamentData.round3.results = Array(round3Pairs.length).fill([null, null]);
    tournamentData.round3.winners = [];
    tournamentData.round3.losers = [];
    
    // Create round 3 table
    const round3Table = document.getElementById('round3-table');
    if (round3Table) {
        let tableHTML = `
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>#</th>
                            <th>Người chơi 1<br><small class="text-muted">(Thua vòng 2 nhánh thắng)</small></th>
                            <th>VS</th>
                            <th>Người chơi 2<br><small class="text-muted">(Thắng vòng 2 nhánh thua)</small></th>
                            <th>Kết quả</th>
                            <th>Người thắng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        round3Pairs.forEach((pair, index) => {
            const [player1, player2] = pair;
            tableHTML += `
                <tr id="round3-match-${index}">
                    <td>${index + 1}</td>
                    <td><strong>${player1}</strong></td>
                    <td class="text-center">VS</td>
                    <td><strong>${player2}</strong></td>
                    <td>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="1" data-round="3" style="width: 60px;" placeholder="0" min="0">
                            <span class="align-self-center">-</span>
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="2" data-round="3" style="width: 60px;" placeholder="0" min="0">
                        </div>
                    </td>
                    <td>
                        <span class="winner-display" id="winner-3-${index}">Chưa có kết quả</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="updateMatchResult(${index}, 'round3')">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableHTML += `
                    </tbody>
                </table>
            </div>
        `;
        
        round3Table.innerHTML = tableHTML;
        console.log('Round 3 table created');
        
        // Show round 3 section
        const round3Section = document.getElementById('round3-section');
        if (round3Section) {
            round3Section.style.display = 'block';
        }
        
        // Add event listeners for score inputs
        addScoreInputListeners();
    }
}

/**
 * Update Elimination Round players when Round 2 Winners results change
 * This function dynamically updates player names in existing Elimination matches
 */
async function updateEliminationPlayers(round2wWinners) {
    console.log('Updating Elimination Round players...');
    console.log('New Round 2 Winners Bracket Winners:', round2wWinners);
    
    // Create new elimination pairs
    const newEliminationPairs = [];
    for (let i = 0; i < round2wWinners.length; i += 2) {
        const player1 = round2wWinners[i] || 'null';
        const player2 = round2wWinners[i + 1] || 'null';
        if (player2) {
            newEliminationPairs.push([player1, player2]);
        }
    }
    
    console.log('New elimination pairs:', newEliminationPairs);
    console.log('Old elimination pairs:', tournamentData.elimination.pairs);
    
    // Check if pairs changed
    let pairsChanged = false;
    if (newEliminationPairs.length !== tournamentData.elimination.pairs.length) {
        pairsChanged = true;
    } else {
        for (let i = 0; i < newEliminationPairs.length; i++) {
            if (newEliminationPairs[i][0] !== tournamentData.elimination.pairs[i][0] ||
                newEliminationPairs[i][1] !== tournamentData.elimination.pairs[i][1]) {
                pairsChanged = true;
                break;
            }
        }
    }
    
    if (pairsChanged) {
        console.log('Elimination pairs changed, updating...');
        
        // Update tournament data
        tournamentData.elimination.pairs = newEliminationPairs;
        tournamentData.elimination.results = Array(newEliminationPairs.length).fill([null, null]);
        tournamentData.elimination.winners = [];
        tournamentData.elimination.losers = [];
        tournamentData.elimination.bracketResults = [];
        
        // Update bracket visualization
        createEliminationBracketVisualization(newEliminationPairs);
        
        console.log('Elimination Round players updated successfully');
        showNotification('Cơ thủ trong Vòng Loại Trực Tiếp đã được cập nhật do thay đổi kết quả Vòng 2', 'info');
        
        // Save updated tournament data
        await saveTournamentData();
    } else {
        console.log('Elimination pairs unchanged, no update needed');
    }
}

async function createEliminationRound(round2wWinners) {
    console.log('Creating Elimination Round...');
    console.log('Round 2 Winners Bracket Winners:', round2wWinners);
    
    // Create elimination pairs
    const eliminationPairs = [];
    for (let i = 0; i < round2wWinners.length; i += 2) {
        const player1 = round2wWinners[i] || 'null';
        const player2 = round2wWinners[i + 1] || 'null';
        if (player2) {
            eliminationPairs.push([player1, player2]);
        }
    }
    
    console.log('Elimination pairs:', eliminationPairs);
    
    // Store elimination data
    tournamentData.elimination.pairs = eliminationPairs;
    tournamentData.elimination.results = Array(eliminationPairs.length).fill([null, null]);
    tournamentData.elimination.winners = [];
    tournamentData.elimination.losers = [];
    
    // Show elimination section
    const eliminationSection = document.getElementById('elimination-section');
    if (eliminationSection) {
        eliminationSection.style.display = 'block';
    }
    
    // Create bracket visualization for elimination round
    await createEliminationBracketVisualization(eliminationPairs);
    
    console.log('Elimination bracket created');
}


function updateBracketVisualization() {
    console.log('Updating bracket visualization...');
    
    const bracketWrapper = document.getElementById('bracket-wrapper');
    if (!bracketWrapper || typeof $ === 'undefined' || !$.fn.bracket) {
        console.log('Bracket visualization not available');
        return;
    }
    
    try {
        // Get current winners and losers
        const winners = [];
        const losers = [];
        
        // Collect winners from round 1
        tournamentData.round1.results.forEach((result, index) => {
            if (result[0] !== null && result[1] !== null) {
                if (result[0] > result[1]) {
                    winners.push(tournamentData.round1.pairs[index][0]);
                    losers.push(tournamentData.round1.pairs[index][1]);
                } else if (result[1] > result[0]) {
                    winners.push(tournamentData.round1.pairs[index][1]);
                    losers.push(tournamentData.round1.pairs[index][0]);
                }
            }
        });
        
        console.log('Current winners:', winners);
        console.log('Current losers:', losers);
        
        // Update bracket data
        const teams = [];
        for (let i = 0; i < winners.length; i += 2) {
            const player1 = winners[i] || 'null';
            const player2 = winners[i + 1] || 'null';
            teams.push([player1, player2]);
        }
        
        const bracketData = {
            teams: teams,
            results: [
                Array(teams.length).fill([null, null])
            ]
        };
        
        // Clear and recreate bracket
        bracketWrapper.innerHTML = '';
        $(bracketWrapper).bracket({
            init: bracketData,
            save: function(data) {
                console.log('Bracket data saved:', data);
            },
            disableToolbar: false,
            disableTeamEdit: false
        });
        
        console.log('Bracket visualization updated successfully');
        
    } catch (error) {
        console.error('Error updating bracket visualization:', error);
    }
}

// Auto-fill function for smart player selection
function autoFillPlayers(count) {
    console.log('Auto-filling players for count:', count);
    
    if (!playersList || playersList.length === 0) {
        console.log('No players available, all slots will be "null"');
        return;
    }
    
    const selects = document.querySelectorAll('.player-name-input');
    const usedPlayers = new Set();
    
    selects.forEach((select, index) => {
        if (index < playersList.length) {
            // Try to assign available players first
            const playerName = playersList[index];
            let playerValue = '';
            
            if (typeof playerName === 'string') {
                playerValue = playerName;
            } else if (typeof playerName === 'object' && playerName !== null) {
                playerValue = playerName.name || playerName.player_name || playerName.username || JSON.stringify(playerName);
            } else {
                playerValue = String(playerName);
            }
            
            // Check if this player is already used
            if (!usedPlayers.has(playerValue)) {
                select.value = playerValue;
                usedPlayers.add(playerValue);
                console.log(`Auto-assigned player "${playerValue}" to slot ${index + 1}`);
            } else {
                // Player already used, select "null"
                select.value = 'null';
                console.log(`Player "${playerValue}" already used, assigned "null" to slot ${index + 1}`);
            }
        } else {
            // No more players available, select "null"
            select.value = 'null';
            console.log(`No more players available, assigned "null" to slot ${index + 1}`);
        }
    });
    
    // Trigger duplicate check
    checkDuplicatePlayers();
}

/**
 * Shuffle players randomly
 */
function shufflePlayers() {
    console.log('Shuffling players...');
    
    // Get all player name inputs
    const playerInputs = document.querySelectorAll('.player-name-input');
    if (playerInputs.length === 0) {
        console.log('No player inputs found');
        alert('Vui lòng nhập danh sách cơ thủ trước!');
        return;
    }
    
    // Get current values
    const currentValues = Array.from(playerInputs).map(input => input.value);
    console.log('Current values:', currentValues);
    
    // Filter out empty values and null
    const validValues = currentValues.filter(value => value && value !== 'null' && value.trim() !== '');
    console.log('Valid values:', validValues);
    
    if (validValues.length === 0) {
        console.log('No valid players to shuffle');
        alert('Không có người chơi hợp lệ để xáo trộn!');
        return;
    }
    
    // Shuffle the valid values using Fisher-Yates algorithm
    for (let i = validValues.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [validValues[i], validValues[j]] = [validValues[j], validValues[i]];
    }
    
    console.log('Shuffled values:', validValues);
    
    // Fill the inputs with shuffled values
    let validIndex = 0;
    playerInputs.forEach((input, index) => {
        if (input.value && input.value !== 'null' && input.value.trim() !== '') {
            input.value = validValues[validIndex];
            validIndex++;
        }
    });
    
    // Trigger duplicate check
    checkDuplicatePlayers();
    
    // Show notification with animation
    showNotification('🎲 Đã xáo trộn danh sách người chơi ngẫu nhiên!', 'success');
    
    // Add visual feedback to the shuffle button
    const shuffleBtn = document.getElementById('shuffle-players-btn');
    if (shuffleBtn) {
        shuffleBtn.innerHTML = '<i class="fas fa-check me-2"></i>Đã xáo trộn!';
        shuffleBtn.classList.remove('btn-warning');
        shuffleBtn.classList.add('btn-success');
        
        // Reset button after 2 seconds
        setTimeout(() => {
            shuffleBtn.innerHTML = '<i class="fas fa-random me-2"></i>Đảo ngẫu nhiên';
            shuffleBtn.classList.remove('btn-success');
            shuffleBtn.classList.add('btn-warning');
        }, 2000);
    }
    
    console.log('Players shuffled successfully');
}

// Player input functions
function renderPlayerNameInputs(count) {
    console.log('Rendering player name inputs for count:', count);
    console.log('Available players:', playersList);
    
    // Validate count
    if (!count || count < 1) {
        console.error('Invalid count:', count);
        alert('Số lượng người chơi không hợp lệ!');
        return;
    }
    
    // Ensure playersList is valid
    if (!Array.isArray(playersList)) {
        console.warn('playersList is not an array, using empty array');
        playersList = [];
    }
    
  let html = '';
  for (let i = 0; i < count; i++) {
    let options = '<option value="">Chọn người chơi</option>';
    options += '<option value="null">null</option>';
    
    // Determine default selection
    let defaultSelected = '';
    let hasPlayers = playersList && playersList.length > 0;
    
    if (hasPlayers && i < playersList.length) {
      // If we have players and current index is within range, select the player
      defaultSelected = 'selected';
    } else {
      // Otherwise, select "null" by default
      defaultSelected = 'selected';
    }
        
    if (hasPlayers) {
    options += playersList.map((name, index) => {
        // Handle different data types
        let playerName = '';
        if (typeof name === 'string') {
          playerName = name;
        } else if (typeof name === 'object' && name !== null) {
          // If it's an object, try to get name property
          playerName = name.name || name.player_name || name.username || JSON.stringify(name);
        } else {
          playerName = String(name);
        }
        
      let selected = (index === i) ? 'selected' : '';
        return `<option value="${playerName}" ${selected}>${playerName}</option>`;
    }).join('');
    }
    
    // Add null option with proper selection
    if (!hasPlayers || i >= playersList.length) {
      options = options.replace('<option value="null">null</option>', `<option value="null" ${defaultSelected}>null</option>`);
    }
        
    html += `<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
      <div class="player-input-group">
        <label class="form-label">
          <i class="fas fa-user me-1"></i>
          <span class="d-none d-sm-inline">Người chơi ${i+1}</span>
          <span class="d-sm-none">P${i+1}</span>
        </label>
        <select class="form-select player-name-input" data-idx="${i}" required>
          ${options}
        </select>
        <span class="error-message text-danger small" id="error-${i}" style="display: none;"></span>
      </div>
    </div>`;
  }
    
    // Check if container exists
    const container = document.getElementById('player-names-list');
    if (!container) {
        console.error('Container player-names-list not found!');
        alert('Không tìm thấy container để hiển thị form!');
        return;
    }
    
    container.innerHTML = html;
    console.log('Player inputs rendered successfully');
    
    // Add event listeners for each select and auto-select best available option
  document.querySelectorAll('.player-name-input').forEach((select, index) => {
        // Auto-select best available option
        const options = Array.from(select.options);
        let bestOption = null;
        
        // Priority: 1. Available player, 2. null, 3. empty
        for (let option of options) {
            if (option.value && option.value !== '' && option.value !== 'null') {
                bestOption = option.value;
                break;
            }
        }
        
        if (!bestOption) {
            // If no player available, select "null"
            const nullOption = select.querySelector('option[value="null"]');
            if (nullOption) {
                bestOption = 'null';
            }
        }
        
        if (bestOption) {
            select.value = bestOption;
            console.log(`Auto-selected "${bestOption}" for player ${index + 1}`);
        }
        
    select.addEventListener('change', function() {
            console.log(`Player ${index + 1} changed to:`, this.value);
      checkDuplicatePlayers();
    });
  });
    
    // Auto-fill players after rendering
    setTimeout(() => {
        autoFillPlayers(count);
    }, 50);
    
    // Add event listeners for name changes
    addPlayerNameChangeListeners();
}

function checkDuplicatePlayers() {
    console.log('Checking for duplicate players...');
    
  let selects = document.querySelectorAll('.player-name-input');
    console.log('Found selects:', selects.length);
    
    if (selects.length === 0) {
        console.warn('No player selects found');
        return;
    }
    
  let selectedValues = Array.from(selects).map(select => select.value);
    console.log('Selected values:', selectedValues);
  
    // Hide all error messages first
  document.querySelectorAll('.error-message').forEach(span => {
    span.style.display = 'none';
  });
  
    // Check for duplicates, ignore 'null' and empty
  selects.forEach((select, index) => {
    let currentValue = select.value;
    if (currentValue !== '' && currentValue !== 'null') {
            let duplicates = selectedValues.filter((value, idx) => 
                value === currentValue && idx !== index && value !== 'null' && value !== ''
            );
            
            console.log(`Player ${index + 1} (${currentValue}) has ${duplicates.length} duplicates`);
            
      if (duplicates.length > 0) {
                const errorElement = document.getElementById(`error-${index}`);
                if (errorElement) {
                    errorElement.textContent = 'Người chơi đã được chọn';
                    errorElement.style.display = 'block';
                }
      }
    }
  });
    
    console.log('Duplicate check completed');
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Initializing bracket UI');
    
    // Tournament type selection
    const tournamentTypeRadios = document.querySelectorAll('input[name="tournament-type"]');
    tournamentTypeRadios.forEach(radio => {
        radio.addEventListener('change', async function() {
            console.log('Tournament type changed to:', this.value);
            tournamentType = this.value;
            updateTournamentTypeUI(this.value);
            // Save tournament type when changed
            await saveTournamentData();
        });
    });
    
    // Initialize with default tournament type (ranking)
    updateTournamentTypeUI('ranking');
    
    // Setup names button
    const setupNamesBtn = document.getElementById('setup-names');
    if (setupNamesBtn) {
        setupNamesBtn.addEventListener('click', function() {
            console.log('Setup names button clicked');
            
            // Get tournament type
            const selectedType = document.querySelector('input[name="tournament-type"]:checked');
            if (!selectedType) {
                alert('Vui lòng chọn loại giải đấu!');
                return;
            }
            
            const tournamentType = selectedType.value;
            console.log('Tournament type:', tournamentType);
            
            // Get player count from tournament data
            const countElement = document.getElementById('player-count');
            if (!countElement) {
                console.error('Player count element not found!');
                alert('Không tìm thấy thông tin số lượng người chơi của giải đấu!');
                return;
            }
            
            let count = +countElement.value;
            console.log('Player count:', count);
            
            // Validate count
            if (!count || count < 1 || count > 128) {
                console.error('Invalid count:', count);
                alert('Số lượng người chơi phải từ 1 đến 128!');
                return;
            }
            
            try {
                if (tournamentType === 'ranking') {
                    // Ranking tournament - use manual input without database players
                    console.log('Setting up ranking tournament with manual input');
                    renderRankingPlayerNameInputs(count);
                } else if (tournamentType === 'free') {
                    // Free tournament - use manual input with database players
                    console.log('Setting up free tournament with manual input');
                    renderPlayerNameInputs(count);
                }
                
                const formElement = document.getElementById('player-names-form');
                if (!formElement) {
                    console.error('Player names form element not found!');
                    alert('Không tìm thấy form nhập tên người chơi!');
                    return;
                }
                
                formElement.style.display = '';
                console.log('Player names form displayed successfully');
                
                // Scroll to form
                formElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
            } catch (error) {
                console.error('Error in setup-names click:', error);
                alert('Có lỗi xảy ra khi tạo form nhập tên người chơi: ' + error.message);
            }
        });
    }
    
    // Shuffle players button
    const shufflePlayersBtn = document.getElementById('shuffle-players-btn');
    if (shufflePlayersBtn) {
        shufflePlayersBtn.addEventListener('click', function() {
            console.log('Shuffle players button clicked');
            shufflePlayers();
        });
    }
    
    // Debug button event listeners
    const testPlayerInputsBtn = document.getElementById('test-player-inputs-btn');
    const logPlayersListBtn = document.getElementById('log-players-list-btn');
    const testFormSubmitBtn = document.getElementById('test-form-submit-btn');
    const autoFillPlayersBtn = document.getElementById('auto-fill-players-btn');
    const testTournamentCreationBtn = document.getElementById('test-tournament-creation-btn');
    const testBracketUpdateBtn = document.getElementById('test-bracket-update-btn');
    const testFullTournamentBtn = document.getElementById('test-full-tournament-btn');
    
    if (testPlayerInputsBtn) {
        testPlayerInputsBtn.addEventListener('click', function() {
            console.log('=== TESTING PLAYER INPUTS ===');
            console.log('1. Players list:', playersList);
            console.log('2. Players list type:', typeof playersList);
            console.log('3. Players list length:', playersList ? playersList.length : 'N/A');
            console.log('4. Player count element:', document.getElementById('player-count'));
            console.log('5. Tournament player count:', tournamentPlayerCount);
            console.log('6. Setup names button:', document.getElementById('setup-names'));
            console.log('7. Player names form:', document.getElementById('player-names-form'));
            console.log('8. Player names list container:', document.getElementById('player-names-list'));
            
            // Test render function with tournament count
            try {
                console.log('9. Testing renderPlayerNameInputs with tournament count...');
                renderPlayerNameInputs(tournamentPlayerCount);
                console.log('10. Render test successful');
            } catch (error) {
                console.error('11. Render test failed:', error);
            }
            
            console.log('=== END TEST ===');
        });
    }
    
    if (logPlayersListBtn) {
        logPlayersListBtn.addEventListener('click', function() {
            console.log('Players List:', playersList);
            console.log('Players List Type:', typeof playersList);
            console.log('Players List Length:', playersList ? playersList.length : 'N/A');
            if (Array.isArray(playersList)) {
                console.log('Players List Items:', playersList.map((item, index) => `${index}: ${item} (${typeof item})`));
            }
        });
    }
    
    if (testFormSubmitBtn) {
        testFormSubmitBtn.addEventListener('click', function() {
            console.log('=== TESTING FORM SUBMIT ===');
            
            const playerForm = document.getElementById('player-names-form');
            console.log('1. Form element:', playerForm);
            
            if (!playerForm) {
                console.error('Form not found!');
                alert('Form không tồn tại!');
                return;
            }
            
            const nameInputs = document.querySelectorAll('.player-name-input');
            console.log('2. Name inputs found:', nameInputs.length);
            
            if (nameInputs.length === 0) {
                console.error('No player inputs found!');
                alert('Không có input người chơi nào! Vui lòng click "Nhập tên người chơi" trước.');
                return;
            }
            
            // Test form submission
            console.log('3. Triggering form submit...');
            const submitEvent = new Event('submit', { bubbles: true, cancelable: true });
            playerForm.dispatchEvent(submitEvent);
            
            // Also test button click directly
            console.log('4. Testing button click directly...');
            const submitBtn = playerForm.querySelector('button[type="submit"]');
            if (submitBtn) {
                console.log('Submit button found:', submitBtn);
                submitBtn.click();
            } else {
                console.error('Submit button not found!');
            }
            
            console.log('=== END FORM SUBMIT TEST ===');
        });
    }
    
    if (autoFillPlayersBtn) {
        autoFillPlayersBtn.addEventListener('click', function() {
            console.log('Auto-fill players button clicked');
            
            const countElement = document.getElementById('player-count');
            if (!countElement) {
                console.error('Player count element not found!');
                alert('Không tìm thấy thông tin số lượng người chơi của giải đấu!');
                return;
            }
            
            let count = +countElement.value;
            console.log('Auto-filling for count:', count);
            
            // Check if form is already rendered
            const nameInputs = document.querySelectorAll('.player-name-input');
            if (nameInputs.length === 0) {
                console.log('Form not rendered yet, rendering first...');
                renderPlayerNameInputs(count);
                
                // Wait for form to be rendered, then auto-fill
                setTimeout(() => {
                    autoFillPlayers(count);
                }, 100);
            } else {
                console.log('Form already rendered, auto-filling...');
                autoFillPlayers(count);
            }
        });
    }
    
    if (testTournamentCreationBtn) {
        testTournamentCreationBtn.addEventListener('click', function() {
            console.log('=== TESTING TOURNAMENT CREATION ===');
            
            // Create test players
            const testPlayers = ['Player 1', 'Player 2', 'Player 3', 'Player 4', 'Player 5', 'Player 6', 'Player 7', 'Player 8'];
            console.log('Test players:', testPlayers);
            
            // Test tournament creation
            try {
                console.log('1. Testing createTournamentTables...');
                createTournamentTables(testPlayers, testPlayers.length);
                
                console.log('2. Testing createBracketVisualization...');
                createBracketVisualization(testPlayers);
                
                console.log('3. Showing tournament sections...');
                const tournamentTables = document.getElementById('tournament-tables');
                if (tournamentTables) {
                    tournamentTables.style.display = 'block';
                }
                
                const bracketWrapper = document.getElementById('bracket-wrapper');
                if (bracketWrapper) {
                    bracketWrapper.style.display = 'block';
                }
                
                console.log('Tournament creation test completed successfully');
                alert('Test tournament creation thành công! Kiểm tra các bảng đấu và bracket.');
                
            } catch (error) {
                console.error('Tournament creation test failed:', error);
                alert('Test tournament creation thất bại: ' + error.message);
            }
            
            console.log('=== END TOURNAMENT CREATION TEST ===');
        });
    }
    
    if (testBracketUpdateBtn) {
        testBracketUpdateBtn.addEventListener('click', function() {
            console.log('=== TESTING BRACKET UPDATE ===');
            
            // Simulate some match results
            if (tournamentData.round1.pairs.length > 0) {
                console.log('1. Simulating round 1 match results...');
                
                // Simulate results for first few matches
                const testResults = [
                    [3, 1], // Player 1 wins
                    [2, 4], // Player 2 wins
                    [5, 3], // Player 1 wins
                    [1, 2]  // Player 2 wins
                ];
                
                testResults.forEach((result, index) => {
                    if (index < tournamentData.round1.pairs.length) {
                        console.log(`Simulating match ${index + 1}: ${result[0]} - ${result[1]}`);
                        
                        // Update tournament data
                        tournamentData.round1.results[index] = result;
                        
                        // Update UI
                        const matchInputs = document.querySelectorAll(`input[data-match="${index}"]`);
                        if (matchInputs.length >= 2) {
                            matchInputs[0].value = result[0];
                            matchInputs[1].value = result[1];
                            
                            // Trigger winner display update
                            updateWinnerDisplay(index);
                            
                            // Trigger bracket update
                            const winner = result[0] > result[1] ? 
                                tournamentData.round1.pairs[index][0] : 
                                tournamentData.round1.pairs[index][1];
                            const loser = result[0] > result[1] ? 
                                tournamentData.round1.pairs[index][1] : 
                                tournamentData.round1.pairs[index][0];
                            
                            updateRound2Brackets(index, winner, loser);
                        }
                    }
                });
                
                console.log('2. Tournament data after simulation:', tournamentData);
                alert('Test bracket update hoàn thành! Kiểm tra các nhánh thắng và thua đã được cập nhật.');
                
            } else {
                console.log('No tournament data available. Please create tournament first.');
                alert('Chưa có dữ liệu tournament. Vui lòng tạo tournament trước.');
            }
            
            console.log('=== END BRACKET UPDATE TEST ===');
        });
    }
    
    if (testFullTournamentBtn) {
        testFullTournamentBtn.addEventListener('click', function() {
            console.log('=== TESTING FULL TOURNAMENT ===');
            
            // Create test tournament with 8 players
            const testPlayers = ['Player 1', 'Player 2', 'Player 3', 'Player 4', 'Player 5', 'Player 6', 'Player 7', 'Player 8'];
            console.log('Creating tournament with players:', testPlayers);
            
            try {
                // Step 1: Create tournament
                console.log('Step 1: Creating tournament...');
                createTournamentTables(testPlayers, testPlayers.length);
                
                // Step 2: Simulate Round 1 results
                console.log('Step 2: Simulating Round 1...');
                const round1Results = [
                    [3, 1], // Player 1 beats Player 2
                    [2, 4], // Player 4 beats Player 3
                    [5, 3], // Player 5 beats Player 6
                    [1, 2]  // Player 8 beats Player 7
                ];
                
                round1Results.forEach((result, index) => {
                    if (index < tournamentData.round1.pairs.length) {
                        tournamentData.round1.results[index] = result;
                        const matchInputs = document.querySelectorAll(`input[data-match="${index}"]`);
                        if (matchInputs.length >= 2) {
                            matchInputs[0].value = result[0];
                            matchInputs[1].value = result[1];
                            updateWinnerDisplay(index);
                            
                            const winner = result[0] > result[1] ? 
                                tournamentData.round1.pairs[index][0] : 
                                tournamentData.round1.pairs[index][1];
                            const loser = result[0] > result[1] ? 
                                tournamentData.round1.pairs[index][1] : 
                                tournamentData.round1.pairs[index][0];
                            
                            updateRound2Brackets(index, winner, loser);
                        }
                    }
                });
                
                // Step 3: Simulate Round 2 results
                setTimeout(() => {
                    console.log('Step 3: Simulating Round 2...');
                    
                    // Round 2 Winners Bracket
                    const round2wResults = [
                        [4, 2], // Player 1 beats Player 4
                        [3, 1]  // Player 5 beats Player 8
                    ];
                    
                    round2wResults.forEach((result, index) => {
                        if (index < tournamentData.round2.winners.pairs.length) {
                            tournamentData.round2.winners.results[index] = result;
                            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="2w"]`);
                            if (matchInputs.length >= 2) {
                                matchInputs[0].value = result[0];
                                matchInputs[1].value = result[1];
                                updateMatchResult(index, 'round2w');
                            }
                        }
                    });
                    
                    // Round 2 Losers Bracket
                    const round2lResults = [
                        [2, 1], // Player 2 beats Player 3
                        [3, 2]  // Player 6 beats Player 7
                    ];
                    
                    round2lResults.forEach((result, index) => {
                        if (index < tournamentData.round2.losers.pairs.length) {
                            tournamentData.round2.losers.results[index] = result;
                            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="2l"]`);
                            if (matchInputs.length >= 2) {
                                matchInputs[0].value = result[0];
                                matchInputs[1].value = result[1];
                                updateMatchResult(index, 'round2l');
                            }
                        }
                    });
                    
                }, 1000);
                
                // Step 4: Simulate Round 3 and Elimination
                setTimeout(() => {
                    console.log('Step 4: Simulating Round 3 and Elimination...');
                    
                    // Round 3
                    const round3Results = [
                        [3, 2] // Player 4 beats Player 2
                    ];
                    
                    round3Results.forEach((result, index) => {
                        if (index < tournamentData.round3.pairs.length) {
                            tournamentData.round3.results[index] = result;
                            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="3"]`);
                            if (matchInputs.length >= 2) {
                                matchInputs[0].value = result[0];
                                matchInputs[1].value = result[1];
                                updateMatchResult(index, 'round3');
                            }
                        }
                    });
                    
                    // Elimination Round
                    const eliminationResults = [
                        [4, 3] // Player 1 beats Player 5
                    ];
                    
                    eliminationResults.forEach((result, index) => {
                        if (index < tournamentData.elimination.pairs.length) {
                            tournamentData.elimination.results[index] = result;
                            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="elimination"]`);
                            if (matchInputs.length >= 2) {
                                matchInputs[0].value = result[0];
                                matchInputs[1].value = result[1];
                                updateMatchResult(index, 'elimination');
                            }
                        }
                    });
                    
                }, 2000);
                
                // Step 5: Simulate Final Elimination
                setTimeout(() => {
                    console.log('Step 5: Simulating Final Elimination...');
                    
                    const finalResults = [
                        [5, 3] // Player 1 beats Player 4 (Final Winner!)
                    ];
                    
                    finalResults.forEach((result, index) => {
                        if (index < tournamentData.finalElimination.pairs.length) {
                            tournamentData.finalElimination.results[index] = result;
                            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="final-elimination"]`);
                            if (matchInputs.length >= 2) {
                                matchInputs[0].value = result[0];
                                matchInputs[1].value = result[1];
                                updateMatchResult(index, 'final-elimination');
                            }
                        }
                    });
                    
                }, 3000);
                
                console.log('Full tournament test completed!');
                alert('Test full tournament hoàn thành! Tournament sẽ tự động chạy qua tất cả các vòng.');
                
            } catch (error) {
                console.error('Full tournament test failed:', error);
                alert('Test full tournament thất bại: ' + error.message);
            }
            
            console.log('=== END FULL TOURNAMENT TEST ===');
        });
    }
    
    // Form submission
    const playerForm = document.getElementById('player-names-form');
    if (playerForm) {
        console.log('Form found, adding submit listener');
        playerForm.addEventListener('submit', async function(e) {
  e.preventDefault();
            console.log('Form submitted - preventDefault called');
            
            // Get form data
  let count = +document.getElementById('player-count').value;
  let nameInputs = document.querySelectorAll('.player-name-input');
  players = Array.from(nameInputs).map(input => input.value);
  
            console.log('Form data:', {
                count: count,
                players: players,
                nameInputsLength: nameInputs.length
            });
            
            // Validate form
            if (nameInputs.length === 0) {
                console.error('No player inputs found');
                alert('Không tìm thấy form nhập tên người chơi! Vui lòng click "Nhập tên người chơi" trước.');
                return;
            }
            
            // Validate count matches tournament requirement
            if (count !== tournamentPlayerCount) {
                console.error('Count mismatch:', count, 'vs tournament:', tournamentPlayerCount);
                alert(`Số lượng người chơi phải là ${tournamentPlayerCount} theo quy định của giải đấu!`);
                return;
            }
            
            // Check for duplicates
  let duplicates = players.filter((item, index) => players.indexOf(item) !== index && item !== '' && item !== 'null');
  if (duplicates.length > 0) {
                console.warn('Duplicate players found:', duplicates);
    alert('Có tên người chơi bị chọn trùng: ' + [...new Set(duplicates)].join(', '));
    return;
  }
  
            // Check for empty slots
  if (players.some(name => name === '')) {
                console.warn('Empty slots found');
    alert('Vui lòng chọn đầy đủ người chơi cho tất cả các slot!');
    return;
  }
  
  if (players.length < count) {
                console.warn('Not enough players selected');
                alert('Số lượng người chơi được chọn không đủ!');
                return;
            }
            
            console.log('Form validation passed, starting tournament...');
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tạo giải đấu...';
                submitBtn.disabled = true;
            }
            
            // Show loading spinner
            const loadingSpinner = document.getElementById('loading-spinner');
            if (loadingSpinner) {
                loadingSpinner.style.display = 'block';
            }
            
            // Show controls panel
            const controlsPanel = document.getElementById('controls-panel');
            if (controlsPanel) {
                setTimeout(() => {
                    controlsPanel.style.display = 'block';
                    controlsPanel.classList.add('slide-in');
                }, 1000);
            }
            
            // Create tournament tables with actual data
            setTimeout(async () => {
                console.log('Creating tournament tables...');
                await createTournamentTables(players, count);
                
                // Show tournament tables
                const tournamentTables = document.getElementById('tournament-tables');
                if (tournamentTables) {
                    tournamentTables.style.display = 'block';
                    tournamentTables.classList.add('slide-in');
                }
                
                // Show bracket wrapper
                const bracketWrapper = document.getElementById('bracket-wrapper');
                if (bracketWrapper) {
                    bracketWrapper.style.display = 'block';
                    createBracketVisualization(players);
                }
                
                // Save initial tournament data
                await saveTournamentData();
                
                // Update button to show restart option since tournament has started
                updateTournamentButtonForRestart();
                
                showNotification('Giải đấu đã được tạo và lưu tự động!', 'success');
                
            }, 1500);
            
            // Success message
            setTimeout(() => {
                // Reset button
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-play me-2"></i>Bắt đầu giải đấu';
                    submitBtn.disabled = false;
                }
                
                // Hide loading spinner
                if (loadingSpinner) {
                    loadingSpinner.style.display = 'none';
                }
            }, 3000);
            
        });
    } else {
        console.error('Player form not found!');
    }
    
    console.log('Bracket UI initialized successfully');
});

// LocalStorage Functions for Tournament Data Persistence
function getTournamentStorageKey() {
    var tournamentId = {!! json_encode($tournament->id ?? 'default') !!};
    return `tournament_data_${tournamentId}`;
}

async function saveTournamentData() {
    try {
        const dataToSave = {
            tournament_id: {{ $tournament->id }},
            tournament_data: tournamentData,
            players: players,
            tournament_type: tournamentType,
            status: 'active'
        };
        
        const response = await fetch('/api/tournament-data/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify(dataToSave)
        });
        
        const result = await response.json();
        
        if (result.success) {
            console.log('Tournament data saved to database:', result.data);
            updateSaveIndicator('saved');
            return true;
        } else {
            console.error('Failed to save tournament data:', result.message);
            updateSaveIndicator('error');
            return false;
        }
    } catch (error) {
        console.error('Error saving tournament data:', error);
        updateSaveIndicator('error');
        return false;
    }
}

async function loadTournamentData() {
    try {
        const response = await fetch(`/api/tournament-data/get/{{ $tournament->id }}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            console.log('Loaded tournament data from database:', result.data);
            
            // Validate data structure
            if (result.data.tournament_data && result.data.players) {
                return {
                    tournamentData: result.data.tournament_data,
                    players: result.data.players,
                    tournamentType: result.data.tournament_type,
                    status: result.data.status,
                    last_updated: result.data.last_updated,
                    created_at: result.data.created_at,
                    updated_at: result.data.updated_at
                };
            } else {
                console.warn('Invalid saved data structure');
                return null;
            }
        } else {
            console.log('No saved tournament data found:', result.message);
            return null;
        }
    } catch (error) {
        console.error('Error loading tournament data:', error);
        return null;
    }
}

async function clearSavedTournamentData() {
    try {
        const response = await fetch(`/api/tournament-data/delete/{{ $tournament->id }}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            console.log('Saved tournament data cleared from database');
        } else {
            console.warn('Failed to clear tournament data from database:', result.message);
        }
        
        // Reset tournament data
        tournamentData = {
            round1: { pairs: [], results: [], winners: [], losers: [] },
            round2: {
                winners: { pairs: [], results: [], winners: [], losers: [] },
                losers: { pairs: [], results: [], winners: [], losers: [] }
            },
            round3: { pairs: [], results: [], winners: [], losers: [] },
            elimination: { pairs: [], results: [], winners: [], losers: [], bracketWinners: [], bracketResults: [] },
            finalElimination: { pairs: [], results: [], winners: [], losers: [] }
        };
        players = [];
        
        // Hide all tournament sections
        document.getElementById('tournament-tables').style.display = 'none';
        document.getElementById('round2-section').style.display = 'none';
        document.getElementById('round3-section').style.display = 'none';
        document.getElementById('elimination-section').style.display = 'none';
        
        updateSaveIndicator('cleared');
        alert('Dữ liệu giải đấu đã được xóa. Vui lòng tạo giải đấu mới.');
        
        return true;
    } catch (error) {
        console.error('Error clearing tournament data:', error);
        return false;
    }
}

async function restoreTournamentUI(savedData) {
    console.log('Restoring tournament UI from saved data...');
    
    try {
        // Validate saved data
        if (!savedData || !savedData.tournamentData || !savedData.players) {
            console.error('Invalid saved data structure');
            return false;
        }
        
        // Restore global variables
        tournamentData = savedData.tournamentData;
        players = savedData.players;
        tournamentType = savedData.tournamentType || 'ranking';
        
        console.log('Restored tournament data:', tournamentData);
        console.log('Restored players:', players);
        console.log('Restored tournament type:', tournamentType);
        
        // Restore tournament type selection
        const selectedRadio = document.querySelector(`input[name="tournament-type"][value="${tournamentType}"]`);
        if (selectedRadio) {
            selectedRadio.checked = true;
            updateTournamentTypeUI(tournamentType);
        }
        
        // Restore player names in form if they exist
        if (players && players.length > 0) {
            // Show the player names form
            const playerNamesForm = document.getElementById('player-names-form');
            if (playerNamesForm) {
                playerNamesForm.style.display = 'block';
            }
            
            // Recreate the form with the correct tournament type
            if (tournamentType === 'ranking') {
                renderRankingPlayerNameInputs(players.length);
            } else if (tournamentType === 'free') {
                renderPlayerNameInputs(players.length);
            }
            
            // Restore player names in the form
            setTimeout(() => {
                restorePlayerNamesInForm(players);
            }, 100);
        }
        
        // Create tournament tables from saved data if they don't exist
        if (tournamentData.round1.pairs.length > 0) {
            console.log('Creating tournament tables from saved data...');
            await createTournamentTablesFromSavedData();
        }
        
        // Show tournament tables
        const tournamentTables = document.getElementById('tournament-tables');
        if (tournamentTables) {
            tournamentTables.style.display = 'block';
        }
        
        // Show controls panel
        const controlsPanel = document.getElementById('controls-panel');
        if (controlsPanel) {
            controlsPanel.style.display = 'block';
        }
        
        // Restore Round 1
        if (tournamentData.round1.pairs.length > 0) {
            restoreRound1UI();
        }
        
        // Update button to show restart option since tournament has data
        updateTournamentButtonForRestart();
        
        // Restore Round 2 - Need to rebuild tables first to update player names
        if (tournamentData.round2.winners.pairs.length > 0 || tournamentData.round2.losers.pairs.length > 0) {
            console.log('Rebuilding Round 2 tables...');
            rebuildRound2Tables();
            document.getElementById('round2-section').style.display = 'block';
            restoreRound2UI();
        }
        
        // Restore Round 3 - Need to recreate table first
        if (tournamentData.round3.pairs.length > 0) {
            console.log('Recreating Round 3 table...');
            rebuildRound3Table();
            document.getElementById('round3-section').style.display = 'block';
            restoreRound3UI();
        }
        
        // Restore Elimination - Recreate bracket visualization
        if (tournamentData.elimination.pairs.length > 0) {
            console.log('Recreating Elimination bracket...');
            rebuildEliminationBracket();
            document.getElementById('elimination-section').style.display = 'block';
        }
        
        // Note: Final elimination is now handled directly in the bracket visualization
        
        console.log('Tournament UI restored successfully');
        updateSaveIndicator('loaded');
        
        // Update button to show restart option since tournament has data
        updateTournamentButtonForRestart();
        
        // Show success message
        showNotification('Dữ liệu giải đấu đã được khôi phục thành công!', 'success');
        
        return true;
    } catch (error) {
        console.error('Error restoring tournament UI:', error);
        showNotification('Có lỗi khi khôi phục dữ liệu: ' + error.message, 'error');
        return false;
    }
}

function rebuildRound2Tables() {
    console.log('Rebuilding Round 2 tables from saved data...');
    
    // Rebuild Winners Bracket
    const round2wPairs = tournamentData.round2.winners.pairs;
    const round2wTable = document.getElementById('round2w-table');
    
    if (round2wTable && round2wPairs && round2wPairs.length > 0) {
        let tableHTML = `
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Người chơi 1</th>
                            <th>VS</th>
                            <th>Người chơi 2</th>
                            <th>Kết quả</th>
                            <th>Người thắng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        round2wPairs.forEach((pair, index) => {
            const [player1, player2] = pair;
            tableHTML += `
                <tr id="round2w-match-${index}">
                    <td>${index + 1}</td>
                    <td><strong>${player1}</strong></td>
                    <td class="text-center">VS</td>
                    <td><strong>${player2}</strong></td>
                    <td>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="1" data-round="2w" style="width: 60px;" placeholder="0" min="0">
                            <span class="align-self-center">-</span>
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="2" data-round="2w" style="width: 60px;" placeholder="0" min="0">
                        </div>
                    </td>
                    <td>
                        <span class="winner-display" id="winner-2w-${index}">Chưa có kết quả</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success" onclick="updateMatchResult(${index}, 'round2w')">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableHTML += `
                    </tbody>
                </table>
            </div>
        `;
        
        round2wTable.innerHTML = tableHTML;
        console.log('Round 2 Winners table rebuilt successfully');
    }
    
    // Rebuild Losers Bracket
    const round2lPairs = tournamentData.round2.losers.pairs;
    const round2lTable = document.getElementById('round2l-table');
    
    if (round2lTable && round2lPairs && round2lPairs.length > 0) {
        let tableHTML = `
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-danger">
                        <tr>
                            <th>#</th>
                            <th>Người chơi 1</th>
                            <th>VS</th>
                            <th>Người chơi 2</th>
                            <th>Kết quả</th>
                            <th>Người thắng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        round2lPairs.forEach((pair, index) => {
            const [player1, player2] = pair;
            tableHTML += `
                <tr id="round2l-match-${index}">
                    <td>${index + 1}</td>
                    <td><strong>${player1}</strong></td>
                    <td class="text-center">VS</td>
                    <td><strong>${player2}</strong></td>
                    <td>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="1" data-round="2l" style="width: 60px;" placeholder="0" min="0">
                            <span class="align-self-center">-</span>
                            <input type="number" class="form-control form-control-sm score-input" 
                                   data-match="${index}" data-player="2" data-round="2l" style="width: 60px;" placeholder="0" min="0">
                        </div>
                    </td>
                    <td>
                        <span class="winner-display" id="winner-2l-${index}">Chưa có kết quả</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="updateMatchResult(${index}, 'round2l')">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableHTML += `
                    </tbody>
                </table>
            </div>
        `;
        
        round2lTable.innerHTML = tableHTML;
        console.log('Round 2 Losers table rebuilt successfully');
    }
    
    // Add event listeners for score inputs
    addScoreInputListeners();
}

function rebuildRound3Table() {
    console.log('Rebuilding Round 3 table from saved data...');
    
    const round3Pairs = tournamentData.round3.pairs;
    const round3Table = document.getElementById('round3-table');
    
    if (!round3Table || !round3Pairs || round3Pairs.length === 0) {
        console.error('Cannot rebuild Round 3 table - missing data or element');
        return;
    }
    
    let tableHTML = `
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>Người chơi 1<br><small class="text-muted">(Thua vòng 2 nhánh thắng)</small></th>
                        <th>VS</th>
                        <th>Người chơi 2<br><small class="text-muted">(Thắng vòng 2 nhánh thua)</small></th>
                        <th>Kết quả</th>
                        <th>Người thắng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
    `;
    
    round3Pairs.forEach((pair, index) => {
        const [player1, player2] = pair;
        tableHTML += `
            <tr id="round3-match-${index}">
                <td>${index + 1}</td>
                <td><strong>${player1}</strong></td>
                <td class="text-center">VS</td>
                <td><strong>${player2}</strong></td>
                <td>
                    <div class="d-flex gap-2">
                        <input type="number" class="form-control form-control-sm score-input" 
                               data-match="${index}" data-player="1" data-round="3" style="width: 60px;" placeholder="0" min="0">
                        <span class="align-self-center">-</span>
                        <input type="number" class="form-control form-control-sm score-input" 
                               data-match="${index}" data-player="2" data-round="3" style="width: 60px;" placeholder="0" min="0">
                    </div>
                </td>
                <td>
                    <span class="winner-display" id="winner-3-${index}">Chưa có kết quả</span>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="updateMatchResult(${index}, 'round3')">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                </td>
            </tr>
        `;
    });
    
    tableHTML += `
                </tbody>
            </table>
        </div>
    `;
    
    round3Table.innerHTML = tableHTML;
    addScoreInputListeners();
    console.log('Round 3 table rebuilt successfully');
}

function rebuildEliminationBracket() {
    console.log('Rebuilding Elimination bracket from saved data...');
    
    const eliminationPairs = tournamentData.elimination.pairs;
    
    if (!eliminationPairs || eliminationPairs.length === 0) {
        console.error('Cannot rebuild Elimination bracket - missing data');
        return;
    }
    
    // Get saved results if available
    const savedResults = tournamentData.elimination.bracketResults || null;
    console.log('Rebuilding with saved results:', savedResults);
    
    // Recreate bracket visualization with saved results
    createEliminationBracketVisualization(eliminationPairs, savedResults);
    
    console.log('Elimination bracket rebuilt successfully');
}

// Final elimination table function removed - now handled in bracket visualization

function restoreRound1UI() {
    console.log('Restoring Round 1 UI...');
    
    tournamentData.round1.pairs.forEach((pair, index) => {
        const result = tournamentData.round1.results[index];
        if (result && result[0] !== null && result[1] !== null) {
            // Restore scores
            const matchInputs = document.querySelectorAll(`input[data-match="${index}"]`);
            if (matchInputs.length >= 2) {
                matchInputs[0].value = result[0];
                matchInputs[1].value = result[1];
            }
            
            // Restore winner display
            const winnerDisplay = document.getElementById(`winner-${index}`);
            const matchRow = document.getElementById(`round1-match-${index}`);
            
            if (result[0] > result[1]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[0];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            } else if (result[1] > result[0]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[1];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            }
        }
    });
}

function restoreRound2UI() {
    console.log('Restoring Round 2 UI...');
    
    // Restore Winners Bracket
    tournamentData.round2.winners.results.forEach((result, index) => {
        if (result && result[0] !== null && result[1] !== null) {
            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="2w"]`);
            if (matchInputs.length >= 2) {
                matchInputs[0].value = result[0];
                matchInputs[1].value = result[1];
            }
            
            const pair = tournamentData.round2.winners.pairs[index];
            const winnerDisplay = document.getElementById(`winner-2w-${index}`);
            const matchRow = document.getElementById(`round2w-match-${index}`);
            
            if (result[0] > result[1]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[0];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            } else if (result[1] > result[0]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[1];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            }
        }
    });
    
    // Restore Losers Bracket
    tournamentData.round2.losers.results.forEach((result, index) => {
        if (result && result[0] !== null && result[1] !== null) {
            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="2l"]`);
            if (matchInputs.length >= 2) {
                matchInputs[0].value = result[0];
                matchInputs[1].value = result[1];
            }
            
            const pair = tournamentData.round2.losers.pairs[index];
            const winnerDisplay = document.getElementById(`winner-2l-${index}`);
            const matchRow = document.getElementById(`round2l-match-${index}`);
            
            if (result[0] > result[1]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[0];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            } else if (result[1] > result[0]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[1];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            }
        }
    });
}

function restoreRound3UI() {
    console.log('Restoring Round 3 UI...');
    
    tournamentData.round3.results.forEach((result, index) => {
        if (result && result[0] !== null && result[1] !== null) {
            const matchInputs = document.querySelectorAll(`input[data-match="${index}"][data-round="3"]`);
            if (matchInputs.length >= 2) {
                matchInputs[0].value = result[0];
                matchInputs[1].value = result[1];
            }
            
            const pair = tournamentData.round3.pairs[index];
            const winnerDisplay = document.getElementById(`winner-3-${index}`);
            const matchRow = document.getElementById(`round3-match-${index}`);
            
            if (result[0] > result[1]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[0];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            } else if (result[1] > result[0]) {
                if (winnerDisplay) {
                    winnerDisplay.textContent = pair[1];
                    winnerDisplay.className = 'winner-display text-success fw-bold';
                }
                if (matchRow) matchRow.className = 'table-success';
            }
        }
    });
}

// Elimination UI restore functions removed - now handled by bracket visualization

function updateSaveIndicator(status) {
    const statusBadge = document.getElementById('tournament-status');
    if (!statusBadge) return;
    
    switch(status) {
        case 'saved':
            statusBadge.innerHTML = '<i class="fas fa-check-circle me-1"></i>Đã lưu';
            statusBadge.className = 'status-badge status-ready';
            break;
        case 'loaded':
            statusBadge.innerHTML = '<i class="fas fa-cloud-download-alt me-1"></i>Đã tải';
            statusBadge.className = 'status-badge bg-info text-white';
            break;
        case 'error':
            statusBadge.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i>Lỗi lưu';
            statusBadge.className = 'status-badge bg-danger text-white';
            break;
        case 'cleared':
            statusBadge.innerHTML = '<i class="fas fa-trash me-1"></i>Đã xóa';
            statusBadge.className = 'status-badge bg-warning text-dark';
            break;
        default:
            statusBadge.innerHTML = '<i class="fas fa-clock me-1"></i>Sẵn sàng';
            statusBadge.className = 'status-badge status-ready';
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 400px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

async function confirmClearSavedData() {
    if (confirm('⚠️ CẢNH BÁO: Bạn có chắc chắn muốn xóa toàn bộ dữ liệu giải đấu đã lưu?\n\nHành động này KHÔNG THỂ hoàn tác!')) {
        if (confirm('Bạn có THỰC SỰ chắc chắn không? Tất cả kết quả trận đấu sẽ bị xóa vĩnh viễn!')) {
            const result = await clearSavedTournamentData();
            if (result) {
                showNotification('Dữ liệu giải đấu đã được xóa thành công!', 'warning');
                
                // Reload page after 2 seconds
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                showNotification('Có lỗi khi xóa dữ liệu!', 'danger');
            }
        }
    }
}

// Initialize bracket functionality
async function initializeBracketFunctionality() {
    console.log('Initializing bracket functionality...');
    
    var api_url = {!! json_encode(env('APP_URL')) !!};
    var bracket_data = {!! json_encode($bracket_data) !!};
    var bracketData = null;
    
    try {
        if (bracket_data && bracket_data !== 'null' && bracket_data !== '') {
            bracketData = JSON.parse(bracket_data);
        }
    } catch (e) {
        console.error('Error parsing bracket_data:', e);
        bracketData = null;
    }
    
    var tournamentId = {!! json_encode($tournament->id) !!};
    var teamsFromPHP = {!! json_encode($teams) !!};
    
    if(teamsFromPHP == null || teamsFromPHP === 'null') {
        teamsFromPHP = [['player 1', 'player 2']];
    }
    
    // Set the player count from tournament data
    console.log('Tournament player count:', tournamentPlayerCount);
    const playerCountElement = document.getElementById('player-count');
    if (playerCountElement) {
        playerCountElement.value = tournamentPlayerCount;
        console.log('Set player count to:', tournamentPlayerCount);
    }
    
    // Check if tournament has already started
    await checkTournamentStatus();
    
    // Try to load saved tournament data
    const savedData = await loadTournamentData();
    if (savedData) {
        console.log('Found saved tournament data, attempting to restore...');
        
        // Check if tournament has already started
        const hasStarted = await checkTournamentStatus();
        
        if (hasStarted) {
            // Tournament has started, ask if user wants to restore or restart
            if (confirm('Tìm thấy dữ liệu giải đấu đã lưu. Bạn có muốn khôi phục không?\n\nChọn "OK" để khôi phục, "Cancel" để bắt đầu lại.')) {
                console.log('User chose to restore tournament data');
                // Restore data directly without creating new tables
                const restoreResult = await restoreTournamentUI(savedData);
                console.log('Restore result:', restoreResult);
            } else {
                console.log('User chose to restart tournament');
                // Clear saved data and restart
                await clearSavedTournamentData();
            }
        } else {
            // Tournament hasn't started yet, restore data silently
            console.log('Tournament not started yet, restoring data silently');
            // Restore data directly without creating new tables
            const restoreResult = await restoreTournamentUI(savedData);
            console.log('Restore result:', restoreResult);
        }
    }
    
    console.log('Bracket functionality initialized');
}

/**
 * Restore Round 1 winner displays from saved data
 */
function restoreRound1WinnerDisplays() {
    console.log('Restoring Round 1 winner displays...');
    
    try {
        tournamentData.round1.pairs.forEach((pair, index) => {
            const result = tournamentData.round1.results[index];
            if (result && result[0] !== null && result[1] !== null) {
                const winnerDisplay = document.getElementById(`winner-${index}`);
                const matchRow = document.getElementById(`round1-match-${index}`);
                
                if (result[0] > result[1]) {
                    if (winnerDisplay) {
                        winnerDisplay.textContent = pair[0];
                        winnerDisplay.className = 'winner-display text-success fw-bold';
                    }
                    if (matchRow) matchRow.className = 'table-success';
                } else if (result[1] > result[0]) {
                    if (winnerDisplay) {
                        winnerDisplay.textContent = pair[1];
                        winnerDisplay.className = 'winner-display text-success fw-bold';
                    }
                    if (matchRow) matchRow.className = 'table-success';
                }
            }
        });
        
        console.log('Round 1 winner displays restored');
    } catch (error) {
        console.error('Error restoring Round 1 winner displays:', error);
    }
}

/**
 * Create tournament tables from saved data without overwriting tournament data
 */
async function createTournamentTablesFromSavedData() {
    console.log('Creating tournament tables from saved data...');
    
    try {
        // Create Round 1 table from saved data
        const round1Table = document.getElementById('round1-table');
        if (round1Table && tournamentData.round1.pairs.length > 0) {
            let tableHTML = `
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Người chơi 1</th>
                                <th>VS</th>
                                <th>Người chơi 2</th>
                                <th>Kết quả</th>
                                <th>Người thắng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
            `;
            
            tournamentData.round1.pairs.forEach((pair, index) => {
                const [player1, player2] = pair;
                const isBYEMatch = (player1 === 'BYE' || player2 === 'BYE');
                const rowClass = isBYEMatch ? 'table-info' : '';
                const player1Display = player1 === 'BYE' ? '<em class="text-muted">BYE</em>' : `<strong>${player1}</strong>`;
                const player2Display = player2 === 'BYE' ? '<em class="text-muted">BYE</em>' : `<strong>${player2}</strong>`;
                const buttonText = isBYEMatch ? '<i class="fas fa-forward"></i> Tự động' : '<i class="fas fa-save"></i> Cập nhật';
                const buttonClass = isBYEMatch ? 'btn btn-sm btn-info' : 'btn btn-sm btn-primary';
                
                // Get saved scores
                const savedResult = tournamentData.round1.results[index];
                const score1 = savedResult ? savedResult[0] || '' : '';
                const score2 = savedResult ? savedResult[1] || '' : '';
                
                tableHTML += `
                    <tr id="round1-match-${index}" class="${rowClass}">
                        <td>${index + 1}</td>
                        <td>${player1Display}</td>
                        <td class="text-center">VS</td>
                        <td>${player2Display}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <input type="number" class="form-control form-control-sm score-input" 
                                       data-match="${index}" data-player="1" style="width: 60px;" placeholder="0" min="0" 
                                       ${isBYEMatch ? 'disabled' : ''} value="${score1}">
                                <span class="align-self-center">-</span>
                                <input type="number" class="form-control form-control-sm score-input" 
                                       data-match="${index}" data-player="2" style="width: 60px;" placeholder="0" min="0" 
                                       ${isBYEMatch ? 'disabled' : ''} value="${score2}">
                            </div>
                        </td>
                        <td>
                            <span class="winner-display" id="winner-${index}">Chưa có kết quả</span>
                        </td>
                        <td>
                            <button class="${buttonClass}" onclick="updateMatchResult(${index}, 'round1')">
                                ${buttonText}
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            tableHTML += `
                        </tbody>
                    </table>
                </div>
            `;
            
            round1Table.innerHTML = tableHTML;
            
            // Add score input listeners
            addScoreInputListeners();
            
            // Restore winner displays after table is created
            setTimeout(() => {
                restoreRound1WinnerDisplays();
            }, 100);
            
            console.log('Round 1 table created from saved data');
        }
        
        console.log('Tournament tables created from saved data successfully');
    } catch (error) {
        console.error('Error creating tournament tables from saved data:', error);
    }
}

// Initialize bracket functionality after DOM is ready
setTimeout(() => {
    try {
        initializeBracketFunctionality();
    } catch (error) {
        console.error('Error initializing bracket functionality:', error);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger mt-3';
        errorDiv.innerHTML = `
            <h5><i class="fas fa-exclamation-triangle me-2"></i>Lỗi khởi tạo bảng đấu</h5>
            <p>Có lỗi xảy ra khi khởi tạo bảng đấu. Vui lòng tải lại trang hoặc liên hệ quản trị viên.</p>
            <small>Chi tiết lỗi: ${error.message}</small>
        `;
        document.querySelector('.bracket-container').appendChild(errorDiv);
    }
}, 100);

console.log('Bracket page loaded successfully');
  </script>

</body>
</html>