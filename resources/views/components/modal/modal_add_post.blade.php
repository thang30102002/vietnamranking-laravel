{{-- modal add post --}}
<div id="postModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-[90%] sm:w-[40%] p-4">
        <div class="flex justify-center items-center pb-2 relative border-b border-b-[1px] border-gray-500 border-solid">
            <h2 class="text-lg font-semibold">Tạo bài viết</h2>
            <button class="absolute right-2 top-2 text-gray-500 hover:text-gray-700 transition" onclick="closeModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex items-center mt-2 border-b pb-2">
            @php
                $file_name = 'players/' . auth()->user()->player->id . '/' . auth()->user()->player->img;
            @endphp
            @if (Storage::disk('public')->exists($file_name))
                <img src="{{ Storage::url($file_name) }}" alt="Avatar" class="w-10 h-10 rounded-full">
            @else
                <img src="{{ asset('images/players/player.webp') }}" alt="Avatar" class="w-10 h-10 rounded-full">
            @endif
            
            <div class="ml-2">
                <p class="font-semibold">{{auth()->user()->user_role->role_id == 3 ? auth()->user()->player->name : auth()->user()->admin_tournament->name }}</p>
                <p class="text-sm text-gray-500">Công khai</p>
            </div>
        </div>
        <form action="{{route('posts.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-4 border-b pb-2">
                <textarea class="w-full border rounded-lg p-2 focus:outline-none" rows="3" name="content"
                    placeholder="{{ auth()->user()->user_role->role_id == 3 ? auth()->user()->player->name : auth()->user()->admin_tournament->name }} ơi, bạn đang nghĩ gì thế?"></textarea>
            </div>
            <div class="mt-4 border-b pb-2 flex flex-col items-center justify-center text-gray-500 cursor-pointer hover:bg-gray-100 p-4 rounded-lg transition">
                <label for="fileInput" class="flex flex-col items-center justify-center cursor-pointer">
                    <span class="text-lg">+</span>
                    <p>Thêm ảnh/video</p>
                </label>
                <input type="file" id="fileInput" name="files[]" class="hidden" accept="image/*,video/*" multiple>
                <div id="preview" class="mt-2 grid grid-cols-3 gap-2"></div>
            </div>
            <div class="flex justify-between items-center mt-4">
                <button type="button" class="px-4 py-2 bg-gray-300 rounded-lg shadow hover:bg-gray-400 transition" onclick="closeModal()">Đóng</button>
                <button type="submit" class="px-4 py-2 bg-[#21324C] text-white rounded-lg shadow hover:bg-[#21324C] transition">Đăng</button>
            </div>
        </form>

    </div>
</div>
{{-- /////////// --}}