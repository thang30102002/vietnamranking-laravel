<div id="{{$comment->id}}" class="hidden flex items-center m rounded-full p-2 bg-gray-100">
    <form action="{{route('posts.comment',['postId'=>$comment->post->id])}}" method="post" class="w-full flex">
        @csrf
        <input type="hidden" name="parent_id" value="{{$comment->id}}">
        <input type="text" id="commentInputParent{{$comment->id}}" name="comment" style="width: inherit;" class="bg-transparent outline-none text-gray-600" placeholder="Trả lời">
        <div class="flex space-x-2 text-gray-500">
            <button id="submitButtonParent{{$comment->id}}" disabled class="p-1 bg-[#21324C] text-white px-3 py-1 rounded-full text-sm opacity-50 cursor-not-allowed">
                Gửi
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let commentId = @json($comment->id);
        const commentInput = document.getElementById(`commentInputParent${commentId}`);
        const submitButton = document.getElementById(`submitButtonParent${commentId}`);

        commentInput.addEventListener("input", function() {
            if (commentInput.value.trim() !== "") {
                submitButton.removeAttribute("disabled");
                submitButton.classList.remove("opacity-50", "cursor-not-allowed");
            } else {
                submitButton.setAttribute("disabled", "true");
                submitButton.classList.add("opacity-50", "cursor-not-allowed");
            }
        });
    });
</script>