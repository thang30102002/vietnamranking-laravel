<div>
    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog h-full content-center">
            <div class="modal-content w-[302px] sm:w-full m-auto h-[70%] sm:h-auto">
                <div class="modal-header">
                    <h1 class="modal-title font-bold" id="exampleModalLabel">Bộ lọc</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body max-h-[500px] overflow-y-auto">
                    <form action={{ route('ranking.ranking') }} method="GET" id="filterForm">
                        @csrf
                        <label class=" pb-2 font-medium text-m" for="name">Tên cơ thủ</label><br>
                        <input name="name" id="name"
                            class="w-full pt-[10px] pb-[10px] pl-[16px] pr-[16px] mb-[16px] rounded-lg border border-gray-500"
                            placeholder="Nhập tên cơ thủ" value="{{ request()->input('name') }}" type="text"><br>

                        <label class="pb-2 font-medium text-m" for="phone">Số điện thoại</label><br>
                        <input name="phone" id="phone"
                            class="w-full pt-[10px] pb-[10px] pl-[16px] pr-[16px] mb-[16px] rounded-lg border border-gray-500"
                            placeholder="Nhập số điện thoại cơ thủ" value="{{ request()->input('phone') }}"
                            type="text"><br>

                        <label class="pb-2 font-medium text-m" for="sex">Giới tính</label><br>
                        <div class=" mb-[16px]">
                            <div class=" grid grid-cols-3 w-[75%]">
                                <div>
                                    <input type="radio" id="all" name="sex" value="all" checked
                                        {{ in_array('all', (array) request()->input('sex', [])) ? 'checked' : '' }}>
                                    <label for="all">Tất cả</label>
                                </div>
                                <div>
                                    <input type="radio" id="male" name="sex" value="Nam" class=""
                                        {{ in_array('Nam', (array) request()->input('sex', [])) ? 'checked' : '' }}>
                                    <label for="male">Nam</label>
                                </div>
                                <div>
                                    <input type="radio" id="female" name="sex" value="Nữ"
                                        {{ in_array('Nữ', (array) request()->input('sex', [])) ? 'checked' : '' }}>
                                    <label for="female">Nữ</label>
                                </div>
                            </div>
                        </div>
                        <label class="pb-2 font-medium" for="">Hạng</label><br>
                        <div class=" grid grid-cols-3 gap-3">
                            @foreach ($rankings as $ranking)
                                <div class=" bg-[#F4F4F5] p-2 rounded-lg">
                                    <input class=" mr-1" type="checkbox" name="rankings[]"
                                        id="ranking_{{ $ranking->id }}" value="{{ $ranking->id }}"
                                        {{ in_array($ranking->id, (array) request()->input('rankings', [])) ? 'checked' : '' }}>
                                    <label class=""
                                        for="ranking_{{ $ranking->id }}">{{ $ranking->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                </div>
                <div class="modal-footer relative min-h-[55px]">
                    <button id="clearAll" type="button" class=" absolute left-3">Làm mới</button>
                    <button type="submit"
                        class="bg-[#21324C] py-[10px] px-[16px] text-white rounded absolute right-5">Áp dụng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('clearAll').addEventListener('click', function() {
        // Reset các input text
        document.getElementById('name').value = '';
        document.getElementById('phone').value = '';

        // Reset radio button về mặc định
        document.getElementById("all").checked = true;

        // Lấy tất cả checkbox và bỏ chọn
        const checkboxes = document.querySelectorAll("#filterForm input[type='checkbox']");
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
    });
</script>
