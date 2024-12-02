<div class=" hidden fixed inset-0 opacity-45 bg-black" id="bgFilter"></div>
<div id="filter"
    class="bg-[#E8E8E8] p-[15px] border-rad rounded min-w-[20rem] fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 hidden">
    <form action="">
        <h1>Bộ lọc</h1>
        <button class=" absolute top-[8px] right-[15px]" id="closeFilter"><i class="fa fa-times"
                aria-hidden="true"></i></button>
        <hr>
        <label class="pt-[10px] " for="">Tên cơ thủ</label><br>
        <input class="w-full p-1 border border-gray-500" type="text"><br>
        <label class="pt-[10px] " for="">Hạng</label><br>
        <div class=" grid grid-cols-3">
            @foreach ($rankings as $ranking)
                <div>
                    <input type="checkbox" name="" id="">
                    <label class="pt-[10px] " for="">{{ $ranking->name }}</label>
                </div>
            @endforeach
        </div>
        <br>
        <div class=" relative ">
            <button>Huỷ tất cả</button>
            <button class="bg-[#21324C] pt-[5px] pb-[5px] pr-[12px] pl-[12px] text-white rounded absolute right-0">Tìm
                kiếm</button>
        </div>
    </form>

</div>
<script>
    const close_Filter = document.getElementById('closeFilter');
    const filter = document.getElementById('filter');
    const bgFilter = document.getElementById('bgFilter');

    close_Filter.addEventListener('click', function() {
        console.log("asdasd");

        filter.classList.remove('hidden');

    });
</script>
