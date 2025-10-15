<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sơ đồ thi đấu - {{ $tournament->name ?? 'Giải đấu' }}</title>
    
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
    
    <style>
        :root {
            --bracket-primary: #21324C;
            --bracket-secondary: #4a5568;
            --bracket-success: #38a169;
            --bracket-warning: #d69e2e;
            --bracket-danger: #e53e3e;
            --bracket-info: #3182ce;
            --bracket-light: #f7fafc;
            --bracket-dark: #2d3748;
        }

        body {
            background: linear-gradient(135deg, #21324C 0%, #2d3748 50%, #1a2a3a 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container-fluid {
            padding: 20px;
        }

        .tournament-header {
            background: linear-gradient(135deg, var(--bracket-primary) 0%, var(--bracket-dark) 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(33, 50, 76, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tournament-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .tournament-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .view-only-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 1rem;
        }

        .tournament-tables {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .round-section {
            margin-bottom: 3rem;
        }

        .round-title {
            background: linear-gradient(135deg, var(--bracket-primary) 0%, var(--bracket-dark) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(33, 50, 76, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background: linear-gradient(135deg, var(--bracket-primary) 0%, var(--bracket-dark) 100%);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .table tbody tr {
            transition: all 0.3s ease;
            background-color: white;
        }

        .table tbody tr:nth-child(even) {
            background-color: var(--bracket-light);
        }

        .table tbody tr:hover {
            background-color: #e6fffa;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #e2e8f0;
            color: var(--bracket-dark);
        }

        .winner-display {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            display: inline-block;
        }

        .text-warning {
            color: var(--bracket-warning) !important;
        }

        .text-success {
            color: var(--bracket-success) !important;
        }

        .text-primary {
            color: var(--bracket-primary) !important;
        }

        .text-muted {
            color: var(--bracket-secondary) !important;
        }

        .text-danger {
            color: var(--bracket-danger) !important;
        }

        .text-info {
            color: var(--bracket-info) !important;
        }

        .table-warning {
            background-color: #fef5e7 !important;
            border-left: 4px solid var(--bracket-warning);
        }

        .table-success {
            background-color: #f0fff4 !important;
            border-left: 4px solid var(--bracket-success);
        }

        .bracket-wrapper {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            margin-bottom: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .bracket-title {
            background: linear-gradient(135deg, var(--bracket-primary) 0%, var(--bracket-dark) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(33, 50, 76, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .elimination-bracket-wrapper {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            margin-bottom: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow-x: auto;
            overflow-y: hidden;
            width: 100%;
            max-width: 100vw;
        }

        .elimination-bracket-container {
            min-width: 800px;
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: var(--bracket-primary) transparent;
        }

        .elimination-bracket-container::-webkit-scrollbar {
            height: 8px;
        }

        .elimination-bracket-container::-webkit-scrollbar-track {
            background: var(--bracket-light);
            border-radius: 4px;
        }

        .elimination-bracket-container::-webkit-scrollbar-thumb {
            background: var(--bracket-primary);
            border-radius: 4px;
        }

        .elimination-bracket-container::-webkit-scrollbar-thumb:hover {
            background: var(--bracket-dark);
        }

        .elimination-bracket-container {
            position: relative;
        }

        .elimination-bracket-container::before {
            content: '← Kéo để xem →';
            position: absolute;
            top: -30px;
            right: 10px;
            background: var(--bracket-primary);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            z-index: 10;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .elimination-bracket-container::before {
                content: '← Vuốt để xem →';
                font-size: 11px;
                padding: 4px 8px;
            }
        }

        .elimination-title {
            background: linear-gradient(135deg, var(--bracket-primary) 0%, var(--bracket-dark) 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(33, 50, 76, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .no-data-message {
            text-align: center;
            padding: 3rem;
            color: var(--bracket-secondary);
        }

        .no-data-message i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .loading-spinner {
            text-align: center;
            padding: 2rem;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: var(--bracket-primary);
            border-width: 0.3rem;
        }

        /* Disable all editing in bracket */
        .jQBracket input[type="text"] {
            pointer-events: none !important;
            background-color: var(--bracket-light) !important;
            color: var(--bracket-secondary) !important;
            cursor: not-allowed !important;
            border: 1px solid #e2e8f0 !important;
        }
        
        .jQBracket input[type="text"]:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        
        .jQBracket .team {
            pointer-events: none !important;
            cursor: default !important;
            color: var(--bracket-dark) !important;
            font-weight: 500 !important;
        }
        
        .jQBracket .team:hover {
            background-color: transparent !important;
        }
        
        .jQBracket .score {
            pointer-events: none !important;
            cursor: default !important;
            color: var(--bracket-primary) !important;
            font-weight: 600 !important;
        }
        
        .jQBracket .score:hover {
            background-color: transparent !important;
        }
        
        .jQBracket .match {
            pointer-events: none !important;
            border-color: #e2e8f0 !important;
        }
        
        .jQBracket .match:hover {
            background-color: transparent !important;
        }

        @media (max-width: 768px) {
            .tournament-title {
                font-size: 2rem;
            }
            
            .tournament-subtitle {
                font-size: 1rem;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
            
            .round-title, .bracket-title, .elimination-title {
                font-size: 1.1rem;
                padding: 0.8rem 1.2rem;
            }
            
            .bracket-wrapper, .elimination-bracket-wrapper {
                padding: 1.5rem;
            }
            
            .elimination-bracket-wrapper {
                padding: 1rem;
                margin: 0 -10px 2rem -10px;
                border-radius: 0;
                box-shadow: none;
                border: none;
            }
            
            .elimination-bracket-container {
                min-width: 600px;
                padding: 0 10px;
                margin: 0 -10px;
            }
            
            .elimination-title {
                margin: 0 -10px 1rem -10px;
                border-radius: 0;
            }
            
            .elimination-bracket-container::before {
                right: 20px;
                top: -25px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Tournament Header -->
        <div class="tournament-header">
            <div class="row align-items-center">
                <div class="col-12 col-md-8">
                    <h1 class="tournament-title">{{ $tournament->name ?? 'Giải đấu' }}</h1>
                    <p class="tournament-subtitle mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        {{ $tournament->start_date ?? 'Chưa xác định' }} - {{ $tournament->end_date ?? 'Chưa xác định' }}
                    </p>
                    <p class="tournament-subtitle mb-0">
                        <i class="fas fa-users me-2"></i>
                        {{ $tournament->number_players ?? 16 }} người chơi
                    </p>
                </div>
                <div class="col-12 col-md-4 text-md-end">
                    <span class="view-only-badge">
                        <i class="fas fa-eye me-2"></i>
                        Chế độ xem
                    </span>
                </div>
            </div>
        </div>

        <!-- Tournament Tables -->
        <div id="tournament-tables" class="tournament-tables" style="display: none;">
            <!-- Round 1 Section -->
            <div id="round1-section" class="round-section">
                <h3 class="round-title">
                    <i class="fas fa-trophy me-2"></i>
                    Vòng 1 - Vòng loại
                </h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Người chơi 1</th>
                                <th>VS</th>
                                <th>Người chơi 2</th>
                                <th>Kết quả</th>
                                <th>Người thắng</th>
                            </tr>
                        </thead>
                        <tbody id="round1-table">
                            <!-- Round 1 matches will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Round 2 Section -->
            <div id="round2-section" class="round-section" style="display: none;">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <h4 class="round-title">
                            <i class="fas fa-crown me-2"></i>
                            Vòng 2 - Nhánh thắng
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Người chơi 1</th>
                                        <th>VS</th>
                                        <th>Người chơi 2</th>
                                        <th>Kết quả</th>
                                        <th>Người thắng</th>
                                    </tr>
                                </thead>
                                <tbody id="round2w-table">
                                    <!-- Round 2 Winners matches will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-4">
                        <h4 class="round-title">
                            <i class="fas fa-heart-broken me-2"></i>
                            Vòng 2 - Nhánh thua
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Người chơi 1</th>
                                        <th>VS</th>
                                        <th>Người chơi 2</th>
                                        <th>Kết quả</th>
                                        <th>Người thắng</th>
                                    </tr>
                                </thead>
                                <tbody id="round2l-table">
                                    <!-- Round 2 Losers matches will be populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Round 3 Section -->
            <div id="round3-section" class="round-section" style="display: none;">
                <h3 class="round-title">
                    <i class="fas fa-medal me-2"></i>
                    Vòng 3 (cơ thủ thắng vòng 2 nhánh thua gặp cơ thủ thua vòng 2 nhánh thắng)
                </h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Người chơi 1</th>
                                <th>VS</th>
                                <th>Người chơi 2</th>
                                <th>Kết quả</th>
                                <th>Người thắng</th>
                            </tr>
                        </thead>
                        <tbody id="round3-table">
                            <!-- Round 3 matches will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Elimination Section -->
            <div id="elimination-section" class="round-section" style="display: none;">
                <h3 class="elimination-title">
                    <i class="fas fa-fire me-2"></i>
                    Vòng loại trực tiếp
                </h3>
                <div class="elimination-bracket-container">
                    <div id="elimination-bracket-wrapper">
                        <!-- Elimination bracket will be populated here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- No Data Message -->
        <div id="no-data-message" class="no-data-message">
            <i class="fas fa-info-circle"></i>
            <h4>Chưa có dữ liệu giải đấu</h4>
            <p>Giải đấu chưa được bắt đầu hoặc chưa có dữ liệu thi đấu.</p>
        </div>

        <!-- Loading Spinner -->
        <div id="loading-spinner" class="loading-spinner" style="display: none;">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Đang tải dữ liệu giải đấu...</p>
        </div>
    </div>

    <script>
        // Global variables
        let tournamentData = null;
        let players = [];
        let tournamentType = 'ranking';

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded - Initializing tournament view');
            
            // Load tournament data
            loadTournamentData();
        });

        /**
         * Load tournament data from database
         */
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
                        tournamentData = result.data.tournament_data;
                        players = result.data.players;
                        tournamentType = result.data.tournament_type || 'ranking';
                        
                        // Restore tournament UI
                        restoreTournamentUI();
                    } else {
                        console.warn('Invalid saved data structure');
                        showNoDataMessage();
                    }
                } else {
                    console.log('No saved tournament data found:', result.message);
                    showNoDataMessage();
                }
            } catch (error) {
                console.error('Error loading tournament data:', error);
                showNoDataMessage();
            }
        }

        /**
         * Restore tournament UI from saved data
         */
        function restoreTournamentUI() {
            console.log('Restoring tournament UI from saved data...');
            
            try {
                // Show tournament tables
                const tournamentTables = document.getElementById('tournament-tables');
                if (tournamentTables) {
                    tournamentTables.style.display = 'block';
                }

                // Hide no data message
                const noDataMessage = document.getElementById('no-data-message');
                if (noDataMessage) {
                    noDataMessage.style.display = 'none';
                }

                // Restore each round
                restoreRound1UI();
                restoreRound2UI();
                restoreRound3UI();
                restoreEliminationUI();

                console.log('Tournament UI restored successfully');
            } catch (error) {
                console.error('Error restoring tournament UI:', error);
                showNoDataMessage();
            }
        }

        /**
         * Restore Round 1 UI
         */
        function restoreRound1UI() {
            if (!tournamentData.round1 || !tournamentData.round1.pairs || tournamentData.round1.pairs.length === 0) {
                return;
            }

            const round1Section = document.getElementById('round1-section');
            if (round1Section) {
                round1Section.style.display = 'block';
            }

            const round1Table = document.getElementById('round1-table');
            if (round1Table) {
                let tableHTML = '';
                tournamentData.round1.pairs.forEach((pair, index) => {
                    const player1 = pair[0] || 'TBD';
                    const player2 = pair[1] || 'TBD';
                    const result = tournamentData.round1.results[index] || [null, null];
                    const winner = getWinnerFromResult(result, player1, player2);
                    
                    tableHTML += `
                        <tr id="round1-match-${index}">
                            <td>${index + 1}</td>
                            <td>${player1}</td>
                            <td>VS</td>
                            <td>${player2}</td>
                            <td>${result[0] !== null && result[1] !== null ? `${result[0]} - ${result[1]}` : 'Chưa có kết quả'}</td>
                            <td class="winner-display ${winner ? 'text-warning fw-bold' : 'text-muted'}">${winner || 'Chưa có kết quả'}</td>
                        </tr>
                    `;
                });
                round1Table.innerHTML = tableHTML;
            }
        }

        /**
         * Restore Round 2 UI
         */
        function restoreRound2UI() {
            if (!tournamentData.round2 || !tournamentData.round2.winners || !tournamentData.round2.winners.pairs || tournamentData.round2.winners.pairs.length === 0) {
                return;
            }

            const round2Section = document.getElementById('round2-section');
            if (round2Section) {
                round2Section.style.display = 'block';
            }

            // Restore Winners Bracket
            const round2wTable = document.getElementById('round2w-table');
            if (round2wTable) {
                let tableHTML = '';
                tournamentData.round2.winners.pairs.forEach((pair, index) => {
                    const player1 = pair[0] || 'TBD';
                    const player2 = pair[1] || 'TBD';
                    const result = tournamentData.round2.winners.results[index] || [null, null];
                    const winner = getWinnerFromResult(result, player1, player2);
                    
                    tableHTML += `
                        <tr id="round2w-match-${index}">
                            <td>${index + 1}</td>
                            <td>${player1}</td>
                            <td>VS</td>
                            <td>${player2}</td>
                            <td>${result[0] !== null && result[1] !== null ? `${result[0]} - ${result[1]}` : 'Chưa có kết quả'}</td>
                            <td class="winner-display ${winner ? 'text-warning fw-bold' : 'text-muted'}">${winner || 'Chưa có kết quả'}</td>
                        </tr>
                    `;
                });
                round2wTable.innerHTML = tableHTML;
            }

            // Restore Losers Bracket
            const round2lTable = document.getElementById('round2l-table');
            if (round2lTable && tournamentData.round2.losers && tournamentData.round2.losers.pairs) {
                let tableHTML = '';
                tournamentData.round2.losers.pairs.forEach((pair, index) => {
                    const player1 = pair[0] || 'TBD';
                    const player2 = pair[1] || 'TBD';
                    const result = tournamentData.round2.losers.results[index] || [null, null];
                    const winner = getWinnerFromResult(result, player1, player2);
                    
                    tableHTML += `
                        <tr id="round2l-match-${index}">
                            <td>${index + 1}</td>
                            <td>${player1}</td>
                            <td>VS</td>
                            <td>${player2}</td>
                            <td>${result[0] !== null && result[1] !== null ? `${result[0]} - ${result[1]}` : 'Chưa có kết quả'}</td>
                            <td class="winner-display ${winner ? 'text-warning fw-bold' : 'text-muted'}">${winner || 'Chưa có kết quả'}</td>
                        </tr>
                    `;
                });
                round2lTable.innerHTML = tableHTML;
            }
        }

        /**
         * Restore Round 3 UI
         */
        function restoreRound3UI() {
            if (!tournamentData.round3 || !tournamentData.round3.pairs || tournamentData.round3.pairs.length === 0) {
                return;
            }

            const round3Section = document.getElementById('round3-section');
            if (round3Section) {
                round3Section.style.display = 'block';
            }

            const round3Table = document.getElementById('round3-table');
            if (round3Table) {
                let tableHTML = '';
                tournamentData.round3.pairs.forEach((pair, index) => {
                    const player1 = pair[0] || 'TBD';
                    const player2 = pair[1] || 'TBD';
                    const result = tournamentData.round3.results[index] || [null, null];
                    const winner = getWinnerFromResult(result, player1, player2);
                    
                    tableHTML += `
                        <tr id="round3-match-${index}">
                            <td>${index + 1}</td>
                            <td>${player1}</td>
                            <td>VS</td>
                            <td>${player2}</td>
                            <td>${result[0] !== null && result[1] !== null ? `${result[0]} - ${result[1]}` : 'Chưa có kết quả'}</td>
                            <td class="winner-display ${winner ? 'text-warning fw-bold' : 'text-muted'}">${winner || 'Chưa có kết quả'}</td>
                        </tr>
                    `;
                });
                round3Table.innerHTML = tableHTML;
            }
        }

        /**
         * Restore Elimination UI
         */
        function restoreEliminationUI() {
            if (!tournamentData.elimination || !tournamentData.elimination.pairs || tournamentData.elimination.pairs.length === 0) {
                return;
            }

            const eliminationSection = document.getElementById('elimination-section');
            if (eliminationSection) {
                eliminationSection.style.display = 'block';
            }

            // Create elimination bracket visualization
            createEliminationBracketVisualization(tournamentData.elimination.pairs, tournamentData.elimination.bracketResults);
        }

        /**
         * Create elimination bracket visualization
         */
        function createEliminationBracketVisualization(eliminationPairs, savedResults = null) {
            console.log('Creating elimination bracket visualization for pairs:', eliminationPairs);
            console.log('Saved results:', savedResults);
            
            const eliminationBracketWrapper = document.getElementById('elimination-bracket-wrapper');
            const eliminationBracketContainer = document.querySelector('.elimination-bracket-container');
            
            if (!eliminationBracketWrapper || !eliminationBracketContainer) {
                console.error('Elimination bracket elements not found');
                return;
            }
            
            // Show elimination bracket wrapper
            eliminationBracketWrapper.style.display = 'block';
            eliminationBracketContainer.style.display = 'block';
            
            // Filter out null players and create teams
            const teams = [];
            eliminationPairs.forEach(pair => {
                const player1 = pair[0] && pair[0] !== 'null' ? pair[0] : 'TBD';
                const player2 = pair[1] && pair[1] !== 'null' ? pair[1] : 'TBD';
                teams.push([player1, player2]);
            });
            
            console.log('Teams for elimination bracket:', teams);
            
            // Create bracket data
            const bracketData = {
                teams: teams,
                results: savedResults || [Array(teams.length).fill([null, null])]
            };
            
            console.log('Initializing bracket with data:', bracketData);
            
            $(eliminationBracketWrapper).bracket({
                init: bracketData,
                save: function(data) {
                    console.log('Elimination bracket data:', data);
                },
                disableToolbar: true,
                disableTeamEdit: true,
                disableEdit: true,
                disableScoreEdit: true,
                readOnly: true,
                teamWidth: 150,
                scoreWidth: 30,
                matchWidth: 60,
                matchHeight: 30,
                roundMargin: 50,
                scoreMargin: 5,
                initCaps: false,
                highlightWinners: true,
                centerConnectors: true,
                dir: 'lr',
                skipConsolationRound: false,
                consolationFinal: false,
                skipSecondaryFinal: false,
                skipGrandFinalComeback: false,
                skipGrandFinal: false,
                grandFinal: 'single'
            });
            
            // Disable all editing after bracket is created
            setTimeout(() => {
                // Disable all input fields
                $(eliminationBracketWrapper).find('input[type="text"]').prop('readonly', true).css({
                    'pointer-events': 'none',
                    'background-color': '#f8f9fa',
                    'color': '#6c757d',
                    'cursor': 'not-allowed'
                });
                
                // Disable all click events
                $(eliminationBracketWrapper).find('.team, .score, .match').off('click').css({
                    'pointer-events': 'none',
                    'cursor': 'default'
                });
                
                // Disable all hover effects
                $(eliminationBracketWrapper).find('.team, .score, .match').off('mouseenter mouseleave');
                
                // Add touch support for mobile scrolling
                addTouchSupport(eliminationBracketContainer);
                
                console.log('Bracket editing completely disabled');
            }, 100);
        }

        /**
         * Add touch support for mobile scrolling
         */
        function addTouchSupport(container) {
            let isScrolling = false;
            let startX = 0;
            let scrollLeft = 0;
            
            // Touch events for mobile
            container.addEventListener('touchstart', (e) => {
                isScrolling = true;
                startX = e.touches[0].pageX - container.offsetLeft;
                scrollLeft = container.scrollLeft;
            });
            
            container.addEventListener('touchmove', (e) => {
                if (!isScrolling) return;
                e.preventDefault();
                const x = e.touches[0].pageX - container.offsetLeft;
                const walk = (x - startX) * 2;
                container.scrollLeft = scrollLeft - walk;
            });
            
            container.addEventListener('touchend', () => {
                isScrolling = false;
            });
            
            // Mouse events for desktop
            container.addEventListener('mousedown', (e) => {
                isScrolling = true;
                startX = e.pageX - container.offsetLeft;
                scrollLeft = container.scrollLeft;
                container.style.cursor = 'grabbing';
            });
            
            container.addEventListener('mousemove', (e) => {
                if (!isScrolling) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const walk = (x - startX) * 2;
                container.scrollLeft = scrollLeft - walk;
            });
            
            container.addEventListener('mouseup', () => {
                isScrolling = false;
                container.style.cursor = 'grab';
            });
            
            container.addEventListener('mouseleave', () => {
                isScrolling = false;
                container.style.cursor = 'grab';
            });
            
            // Set initial cursor
            container.style.cursor = 'grab';
        }

        /**
         * Get winner from result
         */
        function getWinnerFromResult(result, player1, player2) {
            if (!result || result[0] === null || result[1] === null) {
                return null;
            }
            
            if (result[0] > result[1]) {
                return player1;
            } else if (result[1] > result[0]) {
                return player2;
            } else {
                return 'Hòa';
            }
        }

        /**
         * Show no data message
         */
        function showNoDataMessage() {
            const tournamentTables = document.getElementById('tournament-tables');
            if (tournamentTables) {
                tournamentTables.style.display = 'none';
            }

            const noDataMessage = document.getElementById('no-data-message');
            if (noDataMessage) {
                noDataMessage.style.display = 'block';
            }
        }
    </script>
</body>
</html>
