<div class="w3-container w3-card w3-white w3-round w3-margin relative"><br>
        @php
            $player = $post->user->player;
            $file_name = $player->id && $player->img ? 'players/' . $player->id . '/' . $player->img : null;
        @endphp
        <a href="{{ route('ranking.detail', $post->user->player->id) }}">
            @if ($file_name && Storage::disk('public')->exists($file_name))
                <img src="{{ Storage::url($file_name) }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
            @else
                <img src="{{ asset('images/players/player.webp') }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
            @endif
        </a>
        <div class="w3-right">
            <span class=" mr-3">{{ $post->created_at->locale('vi')->diffForHumans() }}</span>
            @if (auth()->check() && auth()->user()->id == $post->user->id)
                <button onclick="togglePostMenu(event, {{ $post->id }})"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                {{-- modal edit --}}
                <div id="post-menu-{{ $post->id }}" class="absolute right-0 top-12 w-64 shadow-lg bg-white rounded-lg overflow-hidden border-2 border-gray-500 hidden">
                    <ul class="text-sm text-gray-800">
                        <button class="w-full text-left" onclick="openModalEditPost({{$post->id}})"><li class="p-3 hover:bg-gray-100 cursor-pointer">✏️ Chỉnh sửa bài viết</li></button>
                        <button class="w-full text-left" onclick="openModalDeletePost({{$post->id}})"><li class="p-3 hover:bg-gray-100 cursor-pointer">🗑️ Chuyển vào thùng rác <br /></li></button>
                    </ul>
                </div>

                <x-modal.modal_edit_post :post="$post" />
                <x-modal.modal_delete_post :post="$post" />
                {{-- ////// --}}
            @endif
        </div>
        <h4>{{ $post->user->player->name }}</h4><br>
    <a href="{{ route('posts.show', $post->id) }}">
        <hr class="w3-clear">
        <p class="text-black">{{ $post->content }}</p>
        @if (count($post->post_images) > 0)
            @php
                $image = $post->post_images[0];
                $file_name = $post->post_images[0]->image;
            @endphp
            <div class="bg-black mx-2 overflow-hidden aspect-[4/3]">
                <img class="m-auto h-full w-auto" src="{{ Storage::url($file_name) }}" alt="Ảnh bài viết">
            </div>
        @endif
    </a>
    @php
        $liked = auth()->check() && $post->likes->contains('user_id', auth()->id());
    @endphp
    <button type="button" data-post-id="{{ $post->id }}" class="like-btn w3-button w3-margin-bottom mt-2 rounded-3xl bg-gray-200">
        <i class="fa fa-thumbs-up mr-2 {{ $liked ? 'text-blue-500' : '' }}"></i>
        <span id="like-count-{{ $post->id }}" class="like-count">{{ $post->likes->count() }}</span>
    </button> 

    <form action="{{ route('posts.show', ['postId' => $post->id]) }}" method="GET" class="contents">
        @csrf
        <button type="submit" class="w3-button w3-margin-bottom mt-2 rounded-3xl bg-gray-200">
            <i class="fa fa-comment mr-2"></i>
            <span class="like-count">{{ $post->post_comments->count() }}</span>
        </button> 
    </form>
</div>
<script>
   document.addEventListener("click", function (event) {
    // Ẩn tất cả các menu trước khi hiển thị menu mới
    document.querySelectorAll("[id^=post-menu-]").forEach(menu => {
        if (!menu.contains(event.target) && !event.target.closest("button")) {
            menu.classList.add("hidden");
        }
    });
});

function togglePostMenu(event, postId) {
    event.stopPropagation(); // Ngăn sự kiện lan ra ngoài
    let menu = document.getElementById(`post-menu-${postId}`);
    if (menu) {
        menu.classList.toggle("hidden");
    }
}

function openModalEditPost(id) {
    document.getElementById('ModalEditPost-'+id).classList.remove('hidden');
}

function closeModalEditPost(id) {
    document.getElementById('ModalEditPost-'+id).classList.add('hidden');
}

function openModalDeletePost(id) {
    document.getElementById('ModalDeletePost-'+id).classList.remove('hidden');
}

function closeModalDeletePost(id) {
    document.getElementById('ModalDeletePost-'+id).classList.add('hidden');
}

</script>
