<div class="flex items-center mt-4 border rounded-full p-2 bg-gray-100">
    <form action="{{ route('posts.comment', ['postId' => $post->id]) }}" method="post" class="w-full flex">
        @csrf
        <input type="text" id="commentInput" name="comment" class="flex-1 bg-transparent outline-none text-gray-600" placeholder="Bình luận về bài viết">
        <div class="flex space-x-2 text-gray-500">
            <button id="submitButton" disabled class="p-1 bg-[#21324C] text-white px-3 py-1 rounded-full text-sm opacity-50 cursor-not-allowed">
                Gửi
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        const commentInput = document.getElementById("commentInput");
        const submitButton = document.getElementById("submitButton");

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
