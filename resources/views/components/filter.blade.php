<div class=" hidden fixed inset-0 opacity-45 bg-black" id="bgFilter"></div>
<div id="filter"
    class="bg-[#E8E8E8] p-[15px] border-rad rounded min-w-[20rem] fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hidden">
    <h1 class="mb-[5px]">Bộ lọc</h1>
    <button class=" absolute top-[0px] p-[8px] right-[15px]" id="closeFilter"><i class="fa fa-times"
            aria-hidden="true"></i></button>
    <hr>
    <form action={{ route('ranking.ranking') }} method="GET">
        {{-- @csrf --}}
        <label class="pt-[10px] " for="name">Tên cơ thủ</label><br>
        <input name="name" id="name" class="w-full p-1 border border-gray-500"
            value="{{ request()->input('name') }}" type="text"><br>

        <label class="pt-[10px] " for="sex">Giới tính</label><br>
        <div class=" grid gap-2 grid-cols-2">
            <div>
                <input type="checkbox" name="sex[]" value="Nam" id="male"
                    {{ in_array('Nam', (array) request()->input('sex', [])) ? 'checked' : '' }}>
                <label class="pt-[10px] " for="male">Nam</label>
            </div>
            <div>
                <input type="checkbox" name="sex[]" value="Nữ" id="female"
                    {{ in_array('Nữ', (array) request()->input('sex', [])) ? 'checked' : '' }}>
                <label class="pt-[10px] " for="female">Nữ</label><br>
            </div>
        </div>

        <label class="pt-[10px] " for="">Hạng</label><br>
        <div class=" grid grid-cols-3">
            @foreach ($rankings as $ranking)
                <div>
                    <input type="checkbox" name="rankings[]" id="ranking_{{ $ranking->id }}"
                        value="{{ $ranking->id }}"
                        {{ in_array($ranking->id, (array) request()->input('rankings', [])) ? 'checked' : '' }}>
                    <label class="pt-[10px] " for="ranking_{{ $ranking->id }}">{{ $ranking->name }}</label>
                </div>
            @endforeach
        </div>
        <br>
        <div class=" relative ">
            <button id="clearAll" type="button">Huỷ tất cả</button>
            <button type="submit"
                class="bg-[#21324C] pt-[5px] pb-[5px] pr-[12px] pl-[12px] text-white rounded absolute right-0">Tìm
                kiếm</button>
        </div>
    </form>

</div>

<script>
    document.getElementById('clearAll').addEventListener('click', function() {
        // Reset các input text
        document.getElementById('name').value = '';

        // Reset tất cả các checkbox
        let checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    });
</script>
