<div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog top-[5rem]">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chuyển khoản lệ phí</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class=" text-[0.7rem] sm:text-[1rem]">Bạn quét mã để đóng lệ phí thi đấu</p>
                    <p class=" text-[0.7rem] sm:text-[1rem]">Giải đấu: {{ $tournament->name }}</p>
                    <p class=" text-[0.7rem] sm:text-[1rem]">Lệ phí: {{ number_format($tournament->fees, 0, ',', '.') . ' VNĐ' }}</p>
                    <img class=" m-auto"
                        src='https://img.vietqr.io/image/BIDV-12410003157606-print.png?amount={{ $tournament->fees }}&addInfo={{ Auth::user()->player->name }}  {{ $tournament->id }}&accountName=Nguyen Quoc Thang' />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Đã chuyển khoản thành công</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    @if (session('exampleModal'))
        window.onload = function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        };
        @php
            session()->forget('exampleModal');
        @endphp
    @endif
</script>