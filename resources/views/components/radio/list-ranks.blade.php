<div>
    @php
        use App\Models\Ranking;
        $ranks = Ranking::get_all_rankings();
    @endphp
    @foreach ($ranks as $rank)
        @if (in_array($rank->id, [1, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 21]))
            @continue
        @endif
        <input type="radio" id="rank" name="rank" value={{ $rank->id }}
            {{ old('rank') == $rank->id ? 'checked' : '' }}>
        <label class=" text-white" for="rank" required>{{ $rank->name }}</label><br>
    @endforeach
</div>
