<div class="max-w-md mx-auto  rounded-lg">
    <!-- Bình luận chính -->
    <div class="flex items-start space-x-3">
        @php
            $file_name = 'players/' . $comment->user->player->id . '/' . $comment->user->player->img;
            $comment_parent_id = $comment->where('parent_id', $comment->id)->get();
        @endphp
        <a href="{{ route('ranking.detail', $comment->user->player->id) }}">
            @if (Storage::disk('public')->exists($file_name))
                <img src="{{ Storage::url($file_name) }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
            @else
                <img src="{{ asset('images/players/player.webp') }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
            @endif
        </a>
        <div>
            <a href="{{ route('ranking.detail', $comment->user->player->id) }}">
                <p class="font-semibold text-gray-600">{{$comment->user->player->name}}</p>
            </a>
            <p class="text-gray-500 bg-gray-200 p-2 rounded-lg">{{$comment->content}}</p>
            <div class="flex items-center text-gray-500 text-sm space-x-2">
                <span>{{ $comment->created_at->locale('vi')->diffForHumans();}}</span>
                <span onclick="toggleReply('{{ $comment->id }}')"  class="text-blue-500 cursor-pointer">Phản hồi</span>
            </div>
            <x-post.input-comment-parent  :comment="$comment"/>
        </div>
    </div>
    
    <!-- Xem thêm trả lời -->
    @if ($comment_parent_id->count() > 0)
        <p class="text-blue-500 text-sm mt-2 cursor-pointer" onclick="showCommentParent('{{ $comment->id }}')" >{{$comment_parent_id->count()}} phản hồi</p>
    @endif
    <x-post.list-comment-parent :comment=$comment id="replies-{{ $comment->id }}"/>
</div>
<script>
    function showCommentParent(id) {
        console.log(id);
        var replies = document.getElementById("replies-" + id);
        if (replies.classList.contains("hidden")) {
            replies.classList.remove("hidden");
            this.textContent = "Hide replies";
        } else {
            replies.classList.add("hidden");
            this.textContent = "5 phản hồi";
        }
    }
</script>

<script>
    function toggleReply(id) {
        let input = document.getElementById(id);
        if (input) {
            input.classList.toggle("hidden");
        }
    }
</script>
