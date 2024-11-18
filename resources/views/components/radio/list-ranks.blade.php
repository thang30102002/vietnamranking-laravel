<div>
    @foreach ($ranks as $rank)
        <input type="radio" id="rank" name="rank" value={{$rank->name}} {{ old('rank') == $rank->name ? 'checked' : '' }}>
        <label class=" text-white" for="rank" required>{{ $rank->name }}</label><br>
    @endforeach
</div>
