@php
    use Carbon\Carbon;
    $today = now();
@endphp

<div class="tournament-card" data-tournament-id="{{ $tournament->id }}">
    <div class="card-header">
        <div class="card-status status-{{ $status }}">
            @if($status === 'upcoming')
                Sắp diễn ra
            @elseif($status === 'ongoing')
                Đang diễn ra
            @else
                Đã kết thúc
            @endif
        </div>
        
        <h3 class="card-title">{{ $tournament->name }}</h3>
        
        <div class="card-game-type">
            <i class="fas fa-gamepad"></i>
            {{ $tournament->tournament_game_type->game_type->name }}
        </div>
    </div>
    
    <div class="card-body">
        <!-- Tournament Info -->
        <div class="card-info">
            <div class="info-item">
                <span class="info-label">Ngày bắt đầu</span>
                <span class="info-value">
                    {{ Carbon::parse($tournament->start_date)->locale('vi')->isoFormat('DD/MM/YYYY') }}
                </span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Giờ bắt đầu</span>
                <span class="info-value">
                    {{ Carbon::parse($tournament->start_date)->locale('vi')->isoFormat('HH:mm') }}
                </span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Địa điểm</span>
                <span class="info-value">{{ $tournament->address }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Số người chơi</span>
                <span class="info-value highlight">{{ $tournament->number_players }}</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Lệ phí</span>
                <span class="info-value highlight">
                    {{ number_format($tournament->fees, 0, ',', '.') }} VNĐ
                </span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Hạng</span>
                <span class="info-value">
                    @foreach ($tournament->ranking_tournament as $ranking_tournament)
                        {{ $ranking_tournament->ranking->name }}
                        @if (!$loop->last), @endif
                    @endforeach
                </span>
            </div>
        </div>
        
        <!-- Prize Pool -->
        @if(count($tournament->tournament_top_money) > 0)
        <div class="prize-pool">
            <div class="prize-title">Giải thưởng</div>
            <div class="prize-list">
                @if(isset($tournament->tournament_top_money[0]))
                <div class="prize-item">
                    <div class="prize-rank">🥇 Quán quân</div>
                    <div class="prize-amount first">
                        {{ number_format($tournament->tournament_top_money[0]->money, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                @endif
                
                @if(isset($tournament->tournament_top_money[1]))
                <div class="prize-item">
                    <div class="prize-rank">🥈 Á quân</div>
                    <div class="prize-amount">
                        {{ number_format($tournament->tournament_top_money[1]->money, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                @endif
                
                @if(isset($tournament->tournament_top_money[2]))
                <div class="prize-item">
                    <div class="prize-rank">🥉 Giải 3</div>
                    <div class="prize-amount">
                        {{ number_format($tournament->tournament_top_money[2]->money, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
        
        <!-- Organizer Info -->
        <div class="organizer-info">
            <div class="organizer-avatar">
                {{ substr($tournament->admin_tournament->name, 0, 1) }}
            </div>
            <div class="organizer-details">
                <h4>{{ $tournament->admin_tournament->name }}</h4>
                <p>{{ preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $tournament->admin_tournament->phone) }}</p>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="card-actions">
            @if($tournament->start_date > $today)
                <a href="{{ route('ranking.register_tournament', ['tournament_id' => $tournament->id]) }}" 
                   class="action-btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    Đăng ký
                </a>
            @else
                <a href="{{ route('ranking.tournament_bracket', ['tournamentId' => $tournament->id]) }}" 
                   class="action-btn btn-primary">
                    <i class="fas fa-sitemap"></i>
                    Xem kết quả
                </a>
            @endif
            
            <a href="{{ route('ranking.tournament_bracket', ['tournamentId' => $tournament->id]) }}" 
               class="action-btn btn-secondary">
                <i class="fas fa-eye"></i>
                Chi tiết
            </a>
        </div>
    </div>
</div>
