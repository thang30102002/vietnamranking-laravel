<div>
    @foreach ($ranks as $rank)
        <input type="radio" id="rank" name="rank" value={{ $rank->id }}
            {{ old('rank') == $rank->id ? 'checked' : '' }}>
        <label class=" text-white" for="rank" required>{{ $rank->name }}</label><br>
    @endforeach
</div>
