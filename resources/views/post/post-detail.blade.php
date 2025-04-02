@php
    use App\Models\Player;
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Thông tin bài viết</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">

    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Roboto", sans-serif
        }



        .icon {
            color: #21324C !important;
        }

        .color-main {
            color: #fff;
            background-color: #21324C;
        }
    </style>
</head>

<body class="w3-light-grey"style="background-color: #21324C!important;background-image: url('../images/background-dots.png');">
    <x-menu />
    <x-notification />
    <!-- Page Container -->
    <div class="w3-content mt-[90px]" style="max-width:1400px;">
        <!-- The Grid -->
        <div class="w-[90%] sm:w-[70%] grid m-auto gap-2 sm:grid-cols-2">
            <!-- Left Column -->
            <div class="">
                <div class="w3-container d-flex flex-column w3-card w3-white w3-round h-full"><br>
                    <div class="">
                    @php
                        $player = $post->user->player;
                        $file_name = 'players/' . $player->id . '/' . auth()->user()->player->img;
                    @endphp
                    <a href="{{ route('ranking.detail', $post->user->player->id) }}">
                        @if (Storage::disk('public')->exists($file_name))
                            <img src="{{ Storage::url($file_name) }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
                        @else
                            <img src="{{ asset('images/players/player.webp') }}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:30px">
                        @endif
                    </a>
                    <span class="w3-right w3-opacity">{{ $post->created_at->locale('vi')->diffForHumans();}}</span>
                    <a href="{{ route('ranking.detail', $post->user->player->id) }}">
                        <h4>{{ $post->user->player->name}}</h4><br>
                    </a>
                    <hr class="w3-clear">
                    </div>
                    <div class="flex-1">
                    <p class=" text-black">{{ $post->content}}</p>
                        @foreach ($post->post_images as $image)
                            @php
                                $file_name = $image->image;
                            @endphp
                            @if (Storage::disk('public')->exists($file_name))
                            <div class="w3-row-padding bg-black mx-2 overflow-hidden aspect-[4/3]">
                                <img class=" m-auto h-full w-auto" src="{{ Storage::url($file_name) }}" alt='Ảnh bài viết'>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @php
                        $liked = auth()->check() && $post->likes->contains('user_id', auth()->id());
                    @endphp
                    <div>
                        <button type="button" data-post-id="{{ $post->id }}" class="like-btn w3-button  w3-margin-bottom mt-2 rounded-3xl bg-gray-200"><i class="fa fa-thumbs-up mr-2 {{ $liked ? 'text-blue-500' : '' }}"></i><span id="like-count-{{ $post->id }}" class="like-count">{{ $post->likes->count() }}</span></button> 
                        <button type="button" class="w3-button  w3-margin-bottom mt-2 rounded-3xl bg-gray-200"><i class="fa fa-comment mr-2"></i><span class="like-count">{{ $post->post_comments->count() }}</span></button> 
                    </div>
                </div>
                <!-- End Left Column -->
            </div>
            <!-- Right Column -->
            <div class="">
                <div class="w3-twothird bg-white rounded-sm p-2">
                    <div class="overflow-y-scroll h-[400px]">
                        @if ($comments->count() == 0)
                            <span class=" text-center block text-gray-400">Chưa có bình luận nào</span>
                        @endif
                        @foreach ($comments as $comment)
                            <x-post.single-comment :comment=$comment/>
                        @endforeach
                    </div>
                    <div>
                        <x-post.input-comment :post=$post/>
                    </div>
                <!-- End Grid -->
                </div>
            </div>

        <!-- End Page Container -->
    </div>

    <x-footer />

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $(document).on("click", ".like-btn", function(event) {
        let button = $(this);
        let postId = button.data("post-id");

        let likeCountElement = button.find(".like-count"); 

        $.ajax({
            url: "/like/" + postId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                
                if (response.status === "success") {
                    let icon = button.find("i");
                    likeCountElement.text(response.likeCount);

                    if (response.liked) {
                        icon.addClass("text-blue-500");
                    } else {
                        icon.removeClass("text-blue-500");
                    }
                }
            },
            
            error: function(xhr) {
                console.log("Lỗi: " + xhr.responseText);
            }
        });
    });
});

</script>

</html>
