<div>
    <input type="radio" id="player" name="user_type" value="2" {{ old('user_type') == '2' ? 'checked' : '' }} checked>
    <label class=" text-white" for="player">Cơ thủ</label><br>
    <input type="radio" id="adminTournament" name="user_type" value="1" {{ old('user_type') == '1' ? 'checked' : '' }}>
    <label class="text-white" for="adminTournament">Đơn vị tổ chức giải </label><br>
</div>
