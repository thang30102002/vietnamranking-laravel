<div>
    <!-- Modal -->
    <div class="modal fade" id="ChangePassModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog h-full content-center w-[302px] sm:w-full m-auto">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-[15px] sm:text-[19px]" id="exampleModalLabel">Thay đổi mật khẩu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body max-h-[500px] overflow-y-auto text-[13px] sm:text-[18px]">
                    <form method="POST" action="{{ route('ranking.change_password')}}" >
                        @csrf
                        <div class="col-md-4 mb-3 w-full">
                            <div class="form-group">
                                <label>Mật khẩu mới</label>
                                <input class="form-control" type="password" name="password"
                                    placeholder="Nhập mật khẩu mới" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="col-md-4 w-full">
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Nhập lại mật khẩu mới" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-[#21324C] text-white">Cập nhật</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
