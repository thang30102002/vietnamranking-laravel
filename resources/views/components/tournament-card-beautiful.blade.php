@php
    use Carbon\Carbon;
    $today = now();
@endphp

<div class="tournament-card-beautiful" data-tournament-id="{{ $tournament->id }}" data-status="{{ $status }}">
    <div class="card-header-beautiful">
        <div class="card-header-top-beautiful">
            <div class="card-title-section">
                <h3 class="card-title-beautiful">{{ $tournament->name }}</h3>
                <div class="card-game-type-beautiful">
                    <i class="fas fa-gamepad"></i>
                    {{ $tournament->tournament_game_type->game_type->name }}
                </div>
            </div>
            
            <div class="card-status-badge status-{{ $status }}-beautiful">
                @if($status === 'upcoming')
                    <i class="fas fa-calendar-alt"></i>
                    <span>Sắp diễn ra</span>
                @elseif($status === 'ongoing')
                    <i class="fas fa-play-circle"></i>
                    <span>Đang diễn ra</span>
                @else
                    <i class="fas fa-trophy"></i>
                    <span>Đã kết thúc</span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="card-body-beautiful">
        <!-- Tournament Info -->
        <div class="card-info-beautiful">
            <div class="info-item-beautiful">
                <span class="info-label-beautiful">Ngày bắt đầu</span>
                <span class="info-value-beautiful">
                    {{ Carbon::parse($tournament->start_date)->locale('vi')->isoFormat('DD/MM/YYYY') }}
                </span>
            </div>
            
            <div class="info-item-beautiful">
                <span class="info-label-beautiful">Giờ bắt đầu</span>
                <span class="info-value-beautiful">
                    {{ Carbon::parse($tournament->start_date)->locale('vi')->isoFormat('HH:mm') }}
                </span>
            </div>
            
            <div class="info-item-beautiful">
                <span class="info-label-beautiful">Địa điểm</span>
                <span class="info-value-beautiful">{{ $tournament->address }}</span>
            </div>
            
            <div class="info-item-beautiful">
                <span class="info-label-beautiful">Số người chơi</span>
                <span class="info-value-beautiful highlight">{{ $tournament->number_players }}</span>
            </div>
            
            <div class="info-item-beautiful">
                <span class="info-label-beautiful">Lệ phí</span>
                <span class="info-value-beautiful highlight">
                    {{ number_format($tournament->fees, 0, ',', '.') }} VNĐ
                </span>
            </div>
            
            <div class="info-item-beautiful">
                <span class="info-label-beautiful">Hạng</span>
                <span class="info-value-beautiful">
                    @foreach ($tournament->ranking_tournament as $ranking_tournament)
                        {{ $ranking_tournament->ranking->name }}
                        @if (!$loop->last), @endif
                    @endforeach
                </span>
            </div>
        </div>
        
        <!-- Prize Pool -->
        @if(count($tournament->tournament_top_money) > 0)
        <div class="prize-pool-beautiful">
            <div class="prize-title-beautiful">Giải thưởng</div>
            <div class="prize-list-beautiful">
                @if(isset($tournament->tournament_top_money[0]))
                <div class="prize-item-beautiful">
                    <div class="prize-rank-beautiful">🥇 Quán quân</div>
                    <div class="prize-amount-beautiful first">
                        {{ number_format($tournament->tournament_top_money[0]->money, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                @endif
                
                @if(isset($tournament->tournament_top_money[1]))
                <div class="prize-item-beautiful">
                    <div class="prize-rank-beautiful">🥈 Á quân</div>
                    <div class="prize-amount-beautiful">
                        {{ number_format($tournament->tournament_top_money[1]->money, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                @endif
                
                @if(isset($tournament->tournament_top_money[2]))
                <div class="prize-item-beautiful">
                    <div class="prize-rank-beautiful">🥉 Giải 3</div>
                    <div class="prize-amount-beautiful">
                        {{ number_format($tournament->tournament_top_money[2]->money, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
        
        <!-- Organizer Info -->
        <div class="organizer-info-beautiful">
            <div class="organizer-avatar-beautiful">
                {{ substr($tournament->admin_tournament->name, 0, 1) }}
            </div>
            <div class="organizer-details-beautiful">
                <h4>{{ $tournament->admin_tournament->name }}</h4>
                <p>{{ preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $tournament->admin_tournament->phone) }}</p>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="card-actions-beautiful">
            @if($tournament->start_date > $today)
                <a href="{{ route('ranking.register_tournament', ['tournament_id' => $tournament->id]) }}" 
                   class="action-btn-beautiful btn-primary-beautiful">
                    <i class="fas fa-user-plus"></i>
                    Đăng ký
                </a>
            @else
                <a href="{{ route('ranking.tournament_bracket', ['tournamentId' => $tournament->id]) }}" 
                   class="action-btn-beautiful btn-primary-beautiful">
                    <i class="fas fa-sitemap"></i>
                    Xem kết quả
                </a>
            @endif
            
            <a href="{{ route('ranking.tournament_bracket', ['tournamentId' => $tournament->id]) }}" 
               class="action-btn-beautiful btn-secondary-beautiful">
                <i class="fas fa-eye"></i>
                Chi tiết
            </a>
        </div>
    </div>
</div>
