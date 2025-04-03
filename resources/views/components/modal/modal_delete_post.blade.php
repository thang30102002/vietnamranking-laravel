{{-- modal add post --}}
@php
    $idModal = "ModalDeletePost-".$post->id;
@endphp
<div id="{{$idModal}}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-[90%] sm:w-[40%] p-4">
        <div class="flex justify-center items-center pb-2 relative border-b border-b-[1px] border-gray-500 border-solid">
            <h2 class="text-lg font-semibold">Tạo bài viết</h2>
            <button class="absolute right-2 top-2 text-gray-500 hover:text-gray-700 transition" onclick="closeModalDeletePost({{$post->id}})">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form action="{{route('posts.delete',['postId'=>$post->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class=" text-center p-8">Bạn có đồng ý xoá bài viết?</h2>
            <div class="flex justify-between items-center mt-4">
                <button type="button" class="px-4 py-2 bg-gray-300 rounded-lg shadow hover:bg-gray-400 transition" onclick="closeModalDeletePost({{$post->id}})">Đóng</button>
                <button type="submit" class="px-4 py-2 bg-[#21324C] text-white rounded-lg shadow hover:bg-[#21324C] transition">Xoá</button>
            </div>
        </form>

    </div>
</div>
