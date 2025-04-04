<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cộng đồng</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/ranking.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        .navMenu {
            }

            .navMenu a {
            text-decoration: none;
            font-size: 1.2em;
            font-weight: 500;
            display: inline-block;
            width: 80px;
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            }

            .navMenu a:hover {
            color: burlywood;
            }

            .navMenu .dot {
            width: 6px;
            height: 6px;
            background: burlywood;
            border-radius: 50%;
            opacity: 0;
            -webkit-transform: translateX(30px);
            transform: translateX(30px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            }

            .navMenu a:nth-child(1):hover ~ .dot {
            -webkit-transform: translateX(30px);
            transform: translateX(30px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }

            .navMenu a:nth-child(2):hover ~ .dot {
            -webkit-transform: translateX(110px);
            transform: translateX(110px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }

            .navMenu a:nth-child(3):hover ~ .dot {
            -webkit-transform: translateX(200px);
            transform: translateX(200px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }

            .navMenu a:nth-child(4):hover ~ .dot {
            -webkit-transform: translateX(285px);
            transform: translateX(285px);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            opacity: 1;
            }
    </style>
</head>

<body class=" m-auto w-full">
    <x-menu />
    <x-notification />
    
    <!-- Page Container -->
    <div class="w3-content" style="max-width:1400px;margin-top:80px">    
        <nav class="navMenu text-[12px] pl-5">
            <a class="border-b border-solid border-b-[burlywood] text-[burlywood]" href="{{ route('posts.getPlayerPost', ['id' => $user->id]) }}">Bài viết</a>
            <a class=" text-white" href="{{ route('ranking.detail', ['id' => $user->player->id]) }}">Hồ sơ</a>
            <div class="dot"></div>
        </nav>
        <!-- Middle Column -->
        <div class="m7 sm:w-[50%] m-auto">
             {{-- list post  --}}
             @if ($posts->count() == 0)
                <div class="  bg-[#21324C] w-full h-[500px] flex items-center justify-center"> 
                    <p class="text-white">Chưa có bài viết nào</p>
                </div>
             @endif
            @foreach ($posts as $post)
                <x-post.single-post :post="$post"/>
            @endforeach
            {{ $posts->links() }}
            {{-- //// --}}
        <!-- End Middle Column -->
        </div>
        <!-- Right Column -->
        {{-- <div class="w3-col m2">
        <div class="w3-card w3-round w3-white w3-center">
            <div class="w3-container">
            <p>Upcoming Events:</p>
            <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
            <p><strong>Holiday</strong></p>
            <p>Friday 15:00</p>
            <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
            </div>
        </div>
        <br>
        
        <div class="w3-card w3-round w3-white w3-center">
            <div class="w3-container">
            <p>Friend Request</p>
            <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
            <span>Jane Doe</span>
            <div class="w3-row w3-opacity">
                <div class="w3-half">
                <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
                </div>
                <div class="w3-half">
                <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            </div>
        </div>
        <br>
        
        <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
            <p>ADS</p>
        </div>
        <br>
        
        <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
            <p><i class="fa fa-bug w3-xxlarge"></i></p>
        </div> --}}
        
        <!-- End Right Column -->
        </div>
        
    <!-- End Grid -->
    </div>
    
    <!-- End Page Container -->
    </div>
    <br>

    <script>
    // Accordion
    function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
    }

    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
    }
    </script>
    <x-modal.modal_add_post />
    <x-footer />
</body>

<script>
    const openFilter = document.getElementById('openFilter');
    const filter = document.getElementById('filter');
    const bgFilter = document.getElementById('bgFilter');
    const close_Filter = document.getElementById('closeFilter');

    openFilter.addEventListener('click', function() {
        filter.classList.remove('hidden');
        bgFilter.classList.remove('hidden');
    });
    close_Filter.addEventListener('click', function() {
        filter.classList.add('hidden');
        bgFilter.classList.add('hidden');
    });
</script>
<script>
     function openModal() {
        document.getElementById('postModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('postModal').classList.add('hidden');
        resetForm();
    }

    function resetForm() {
        console.log("Resetting form data");
        document.querySelector('textarea').value = '';
        document.getElementById('fileInput').value = '';
        document.getElementById('preview').innerHTML = '';
    }

    document.getElementById('fileInput').addEventListener('change', function(event) {
        console.log("Files selected:", event.target.files);
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const element = file.type.startsWith('image') ? document.createElement('img') : document.createElement('video');
                element.src = e.target.result;
                element.classList.add('w-20', 'h-20', 'object-cover', 'rounded-lg', 'border');
                if (file.type.startsWith('video')) {
                    element.controls = true;
                }
                preview.appendChild(element);
                console.log("Preview added for:", file.name);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

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
