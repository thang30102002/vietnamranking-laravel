<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
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
        <span class="w3-right w3-opacity">{{ $post->created_at->locale('vi')->diffForHumans() }}</span>
        <a href="{{ route('ranking.detail', $post->user->player->id) }}">
            <h4>{{ $post->user->player->name }}</h4><br>
        </a>
    <a href="{{ route('posts.show', $post->id) }}">
        <hr class="w3-clear">
        <p class="text-black">{{ $post->content }}</p>

        <div class="w3-row-padding flex flex-wrap gap-2 max-w-md mx-auto p-4">
            @if (count($post->post_images) > 0)
                @php
                    $image = $post->post_images[0];
                    $file_name = $post->post_images[0]->image;
                @endphp
                <div class="relative">
                    <img class="m-auto w-full h-auto rounded-lg" src="{{ Storage::url($file_name) }}" alt="Ảnh bài viết">
                </div>
            @endif
        </div>
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
