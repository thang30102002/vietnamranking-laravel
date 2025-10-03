@php
    use Carbon\Carbon;
    $today = now();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giải đấu</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/ranking.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    
    <!-- Beautiful Tournament CSS -->
    <link rel="stylesheet" href="{{ asset('css/tournament-beautiful.css') }}">
</head>

<body class="tournament-page w-full">
    <x-notification />
    @isset($tournament_id)
        <x-modal-register-tournament :tournamentid="$tournament_id" />
    @endisset
    <x-menu />
    
    <div class="tournament-content">
        <!-- Beautiful Title -->
        <h1 class="tournament-title-beautiful">Giải đấu</h1>
        
        <!-- Tournament Filters -->
        <div class="tournament-filters">
            <div class="filter-header">
                <h2 class="filter-title">Bộ lọc giải đấu</h2>
                <p class="filter-subtitle">Tìm kiếm và lọc giải đấu theo tiêu chí của bạn</p>
            </div>
            
            <form id="tournamentFilterForm" class="filter-row">
                <div class="filter-group">
                    <label class="filter-label">Tìm kiếm</label>
                    <input type="text" id="searchInput" class="filter-input" placeholder="Nhập tên giải đấu...">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Loại game</label>
                    <select id="gameTypeFilter" class="filter-select">
                        <option value="">Tất cả loại game</option>
                        <option value="9 bi đơn">9 bi đơn</option>
                        <option value="9 bi đôi">9 bi đôi</option>
                        <option value="8 bi đơn">8 bi đơn</option>
                        <option value="8 bi đôi">8 bi đôi</option>
                        <option value="10 bi đơn">10 bi đơn</option>
                        <option value="10 bi đôi">10 bi đôi</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Trạng thái</label>
                    <select id="statusFilter" class="filter-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="upcoming">Sắp diễn ra</option>
                        <option value="ongoing">Đang diễn ra</option>
                        <option value="completed">Đã kết thúc</option>
                    </select>
                </div>
                
                <div class="filter-group filter-actions">
                    <label class="filter-label">&nbsp;</label>
                    <button type="button" id="resetBtn" class="filter-btn btn-reset">
                        <i class="fas fa-undo"></i>
                        Đặt lại
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Tournament Stats -->
        <div class="tournament-stats">
            <div class="stat-card">
                <div class="stat-number">{{ count($tournaments) }}</div>
                <div class="stat-label">Sắp diễn ra</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ count($tournaments_taking_place) }}</div>
                <div class="stat-label">Đang diễn ra</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ count($tournaments_took_place) }}</div>
                <div class="stat-label">Đã kết thúc</div>
            </div>
        </div>
        
        <!-- Upcoming Tournaments -->
        @if (count($tournaments) > 0)
        <div class="tournament-section-beautiful" data-section="upcoming">
            <div class="section-header-beautiful">
                <div class="section-icon-beautiful">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h2 class="section-title-beautiful">Sắp diễn ra</h2>
                <span class="section-count-beautiful">{{ count($tournaments) }}</span>
            </div>
            
            <div class="tournament-grid-beautiful">
                @foreach ($tournaments as $tournament)
                    <x-tournament-card-beautiful :tournament="$tournament" status="upcoming" />
                @endforeach
            </div>
        </div>
        @endif

        <!-- Ongoing Tournaments -->
        @if (count($tournaments_taking_place) > 0)
        <div class="tournament-section-beautiful" data-section="ongoing">
            <div class="section-header-beautiful">
                <div class="section-icon-beautiful">
                    <i class="fas fa-play-circle"></i>
                </div>
                <h2 class="section-title-beautiful">Đang diễn ra</h2>
                <span class="section-count-beautiful">{{ count($tournaments_taking_place) }}</span>
            </div>
            
            <div class="tournament-grid-beautiful">
                @foreach ($tournaments_taking_place as $tournament)
                    <x-tournament-card-beautiful :tournament="$tournament" status="ongoing" />
                @endforeach
            </div>
        </div>
        @endif

        <!-- Completed Tournaments -->
        @if (count($tournaments_took_place) > 0)
        <div class="tournament-section-beautiful" data-section="completed">
            <div class="section-header-beautiful">
                <div class="section-icon-beautiful">
                    <i class="fas fa-trophy"></i>
                </div>
                <h2 class="section-title-beautiful">Đã kết thúc</h2>
                <span class="section-count-beautiful">{{ count($tournaments_took_place) }}</span>
            </div>
            
            <div class="tournament-grid-beautiful">
                @foreach ($tournaments_took_place as $tournament)
                    <x-tournament-card-beautiful :tournament="$tournament" status="completed" />
                @endforeach
            </div>
        </div>
        @endif

        <!-- Empty State -->
        @if (count($tournaments) === 0 && count($tournaments_taking_place) === 0 && count($tournaments_took_place) === 0)
        <div class="empty-state-beautiful">
            <div class="empty-icon-beautiful">
                <i class="fas fa-calendar-times"></i>
            </div>
            <h3 class="empty-title-beautiful">Chưa có giải đấu nào</h3>
            <p class="empty-description-beautiful">
                Hiện tại chưa có giải đấu nào được tổ chức. Hãy quay lại sau để xem các giải đấu mới.
            </p>
        </div>
        @endif
    </div>

    <x-footer />

    <script>
        // Enhanced animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animation on scroll
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

            // Animate tournament cards
            document.querySelectorAll('.tournament-card-beautiful').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Animate stat cards with staggered effect
            document.querySelectorAll('.stat-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Animate section headers
            document.querySelectorAll('.section-header-beautiful').forEach((header, index) => {
                header.style.opacity = '0';
                header.style.transform = 'translateX(-30px)';
                header.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                setTimeout(() => {
                    header.style.opacity = '1';
                    header.style.transform = 'translateX(0)';
                }, 300 + (index * 100));
            });

            // Add hover effects to stat cards
            document.querySelectorAll('.stat-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.05)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add click effects to action buttons
            document.querySelectorAll('.action-btn-beautiful').forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Tournament Filter Functionality
            const searchInput = document.getElementById('searchInput');
            const gameTypeFilter = document.getElementById('gameTypeFilter');
            const statusFilter = document.getElementById('statusFilter');
            const resetBtn = document.getElementById('resetBtn');

            // Filter function
            function filterTournaments() {
                const searchTerm = searchInput.value.toLowerCase();
                const gameType = gameTypeFilter.value;
                const status = statusFilter.value;

                // Debug: Log all available game types in page
                const allGameTypes = document.querySelectorAll('.card-game-type-beautiful');
                const availableGameTypes = Array.from(allGameTypes).map(el => el.textContent.trim());
                console.log('Available game names in page:', [...new Set(availableGameTypes)]);

                console.log('Filtering with:', { searchTerm, gameType, status });

                // Get all tournament cards
                const allCards = document.querySelectorAll('.tournament-card-beautiful');
                const allSections = document.querySelectorAll('.tournament-section-beautiful');

                let visibleCount = 0;

                allSections.forEach(section => {
                    const sectionCards = section.querySelectorAll('.tournament-card-beautiful');
                    let sectionVisibleCount = 0;

                    sectionCards.forEach(card => {
                        const title = card.querySelector('.card-title-beautiful').textContent.toLowerCase();
                        const gameTypeElement = card.querySelector('.card-game-type-beautiful');
                        const gameTypeText = gameTypeElement ? gameTypeElement.textContent.toLowerCase().trim() : '';
                        const cardStatus = card.getAttribute('data-status') || section.getAttribute('data-section');

                        // Debug logging
                        console.log('Card:', {
                            title: title,
                            gameTypeText: gameTypeText,
                            cardStatus: cardStatus,
                            selectedGameType: gameType.toLowerCase().trim()
                        });

                        let showCard = true;

                        // Search filter
                        if (searchTerm && !title.includes(searchTerm)) {
                            showCard = false;
                            console.log('Hidden by search:', title);
                        }

                        // Game type filter - exact text matching
                        if (gameType) {
                            const selectedGameType = gameType.toLowerCase().trim();
                            const cardGameTypeClean = gameTypeText.replace(/^[🎮🎯]*\s*/, '').trim().toLowerCase();
                            
                            console.log('Game type comparison:', {
                                selected: selectedGameType,
                                original: gameTypeText,
                                cleaned: cardGameTypeClean,
                                match: cardGameTypeClean === selectedGameType
                            });
                            
                            if (cardGameTypeClean !== selectedGameType) {
                                showCard = false;
                                console.log('Hidden by game type - no match:', cardGameTypeClean, '≠', selectedGameType);
                            }
                        }

                        // Status filter
                        if (status && cardStatus !== status) {
                            showCard = false;
                            console.log('Hidden by status:', cardStatus, 'vs', status);
                        }

                        if (showCard) {
                            card.style.display = 'block';
                            sectionVisibleCount++;
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Show/hide section based on visible cards
                    if (sectionVisibleCount > 0) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });

                // Update stats
                updateStats();
            }

            // Update stats function
            function updateStats() {
                // Get counts for each section
                const upcomingSection = document.querySelector('[data-section="upcoming"]');
                const ongoingSection = document.querySelector('[data-section="ongoing"]');
                const completedSection = document.querySelector('[data-section="completed"]');

                const upcomingCount = upcomingSection ? 
                    upcomingSection.querySelectorAll('.tournament-card-beautiful:not([style*="display: none"])').length : 0;
                const ongoingCount = ongoingSection ? 
                    ongoingSection.querySelectorAll('.tournament-card-beautiful:not([style*="display: none"])').length : 0;
                const completedCount = completedSection ? 
                    completedSection.querySelectorAll('.tournament-card-beautiful:not([style*="display: none"])').length : 0;

                // Update each stat card separately
                const statCards = document.querySelectorAll('.stat-card');
                if (statCards.length >= 3) {
                    statCards[0].querySelector('.stat-number').textContent = upcomingCount;
                    statCards[1].querySelector('.stat-number').textContent = ongoingCount;
                    statCards[2].querySelector('.stat-number').textContent = completedCount;
                }

                // Update section count badges
                if (upcomingSection) {
                    const upcomingBadge = upcomingSection.querySelector('.section-count-beautiful');
                    if (upcomingBadge) upcomingBadge.textContent = upcomingCount;
                }
                if (ongoingSection) {
                    const ongoingBadge = ongoingSection.querySelector('.section-count-beautiful');
                    if (ongoingBadge) ongoingBadge.textContent = ongoingCount;
                }
                if (completedSection) {
                    const completedBadge = completedSection.querySelector('.section-count-beautiful');
                    if (completedBadge) completedBadge.textContent = completedCount;
                }
            }

            // Reset function
            function resetFilters() {
                searchInput.value = '';
                gameTypeFilter.value = '';
                statusFilter.value = '';

                // Show all cards and sections
                document.querySelectorAll('.tournament-card-beautiful').forEach(card => {
                    card.style.display = 'block';
                });
                document.querySelectorAll('.tournament-section-beautiful').forEach(section => {
                    section.style.display = 'block';
                });

                // Reset stats to original values
                resetStats();
            }

            // Reset stats function to show original counts
            function resetStats() {
                const upcomingSection = document.querySelector('[data-section="upcoming"]');
                const ongoingSection = document.querySelector('[data-section="ongoing"]');
                const completedSection = document.querySelector('[data-section="completed"]');

                if (upcomingSection && ongoingSection && completedSection) {
                    const upcomingCount = upcomingSection.querySelectorAll('.tournament-card-beautiful').length;
                    const ongoingCount = ongoingSection.querySelectorAll('.tournament-card-beautiful').length;
                    const completedCount = completedSection.querySelectorAll('.tournament-card-beautiful').length;

                    const statCards = document.querySelectorAll('.stat-card');
                    if (statCards.length >= 3) {
                        statCards[0].querySelector('.stat-number').textContent = upcomingCount;
                        statCards[1].querySelector('.stat-number').textContent = ongoingCount;
                        statCards[2].querySelector('.stat-number').textContent = completedCount;
                    }

                    // Reset section count badges
                    const upcomingBadge = upcomingSection.querySelector('.section-count-beautiful');
                    if (upcomingBadge) upcomingBadge.textContent = upcomingCount;
                    
                    const ongoingBadge = ongoingSection.querySelector('.section-count-beautiful');
                    if (ongoingBadge) ongoingBadge.textContent = ongoingCount;
                    
                    const completedBadge = completedSection.querySelector('.section-count-beautiful');
                    if (completedBadge) completedBadge.textContent = completedCount;
                }
            }

            // Event listeners
            resetBtn.addEventListener('click', resetFilters);

            // Real-time search
            searchInput.addEventListener('input', function() {
                if (this.value.length >= 2 || this.value.length === 0) {
                    filterTournaments();
                }
            });

            // Filter on select change
            gameTypeFilter.addEventListener('change', filterTournaments);
            statusFilter.addEventListener('change', filterTournaments);

            // Smooth scroll to sections
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Initialize stats display
            updateStats();

            // Add loading states
            const loadingElements = document.querySelectorAll('.loading');
            loadingElements.forEach(element => {
                element.style.animation = 'pulse 2s infinite';
            });
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .action-btn-beautiful {
                position: relative;
                overflow: hidden;
            }
            
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
