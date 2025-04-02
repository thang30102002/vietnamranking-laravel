<!-- Trả lời -->
    @php
        $comment_parents = $comment->where('parent_id', $comment->id)->get();
        $id_replies = 'replies-' . $comment->id;
    @endphp
    <div class="ml-10 mt-2 space-y-2 hidden" id="{{$id_replies}}">
        @foreach ($comment_parents as $comment_parent )
            @php
                $file_name = 'players/' . $comment_parent->user->player->id . '/' . $comment_parent->user->player->img;
            @endphp
            <div class="flex items-start space-x-3">
                <a href="{{ route('ranking.detail', $comment->user->player->id) }}">
                    @if (Storage::disk('public')->exists($file_name))
                        <img src="{{ Storage::url($file_name) }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
                    @else
                        <img src="{{ asset('images/players/player.webp') }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
                    @endif
                </a>
                <div>
                    <p class="font-semibold text-gray-600">{{ $comment_parent->user->player->name}}</p>
                    <p class="text-gray-500 bg-gray-200 p-2 rounded-lg">{{ $comment_parent->content}}</p>
                    <div class="flex items-center text-gray-500 text-sm space-x-2">
                        <span>{{ $comment_parent->created_at->locale('vi')->diffForHumans();}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>