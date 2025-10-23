@php
    $user = $comment->user;
    $roleId = optional($user->user_role)->role_id ?? null;
    $displayName = $user->name ?? 'Người dùng';
    if ($roleId == 3 && optional($user->player)->name) {
        $displayName = $user->player->name;
    } elseif ($roleId == 2 && optional($user->admin_tournament)->name) {
        $displayName = $user->admin_tournament->name;
    } elseif ($roleId == 1) {
        $displayName = 'vietnampool';
    }
@endphp

<div class="comment-item" style="border-left: 2px solid #eee; padding-left: 12px; margin-top: 12px;">
    <div style="font-weight: 600;">{{ $displayName }}</div>
    <div style="font-size: 0.9rem; color:#666;">{{ $comment->created_at->diffForHumans() }}</div>
    <div style="margin-top: 6px; white-space: pre-line;">{{ $comment->content }}</div>
    @auth
    <button class="btn btn-sm btn-link toggle-reply" data-target="#reply-form-{{ $comment->id }}">Trả lời</button>
    <form id="reply-form-{{ $comment->id }}" class="reply-form" action="{{ route('news.comment', $news->slug) }}" method="POST" style="display:none; margin-top: 8px;">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <div class="mb-2">
            <textarea name="content" class="form-control" rows="2" placeholder="Viết phản hồi..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Gửi phản hồi</button>
    </form>
    @endauth

    @if($comment->children && $comment->children->count())
        <div class="comment-children" style="margin-left: 12px;">
            @foreach($comment->children as $child)
                @include('news.partials.comment', ['comment' => $child, 'news' => $news])
            @endforeach
        </div>
    @endif
</div>


