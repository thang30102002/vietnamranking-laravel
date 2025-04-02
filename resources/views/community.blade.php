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
    </style>
</head>

<body class=" m-auto w-full">
    <x-menu />
    <x-notification />
    
    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
    <!-- The Grid -->
    {{-- <div class="w3-row"> --}}
        <!-- Left Column -->
        {{-- <div class="w3-col m3"> --}}
        <!-- Profile -->
        {{-- <div class="w3-card w3-round w3-white">
            <div class="w3-container">
            <h4 class="w3-center">My Profile</h4>
            <p class="w3-center"><img src="/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
            <hr>
            <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Designer, UI</p>
            <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> London, UK</p>
            <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> April 1, 1988</p>
            </div>
        </div> --}}
        {{-- <br> --}}
        
        <!-- Accordion -->
        {{-- <div class="w3-card w3-round">
            <div class="w3-white">
            <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
            <div id="Demo1" class="w3-hide w3-container">
                <p>Some text..</p>
            </div>
            <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
            <div id="Demo2" class="w3-hide w3-container">
                <p>Some other text..</p>
            </div>
            <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
            <div id="Demo3" class="w3-hide w3-container">
            <div class="w3-row-padding">
            <br>
            <div class="w3-half">
                <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
                <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
                <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
                <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
                <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
                <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
            </div>
            </div>
            </div>
            </div>      
        </div> --}}
        {{-- <br> --}}
        
        <!-- Interests --> 
        {{-- <div class="w3-card w3-round w3-white w3-hide-small">
            <div class="w3-container">
            <p>Interests</p>
            <p>
                <span class="w3-tag w3-small w3-theme-d5">News</span>
                <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
                <span class="w3-tag w3-small w3-theme-d3">Labels</span>
                <span class="w3-tag w3-small w3-theme-d2">Games</span>
                <span class="w3-tag w3-small w3-theme-d1">Friends</span>
                <span class="w3-tag w3-small w3-theme">Games</span>
                <span class="w3-tag w3-small w3-theme-l1">Friends</span>
                <span class="w3-tag w3-small w3-theme-l2">Food</span>
                <span class="w3-tag w3-small w3-theme-l3">Design</span>
                <span class="w3-tag w3-small w3-theme-l4">Art</span>
                <span class="w3-tag w3-small w3-theme-l5">Photos</span>
            </p>
            </div>
        </div> --}}
        <br>
        
        <!-- Alert Box -->
        {{-- <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
            <i class="fa fa-remove"></i>
            </span>
            <p><strong>Hey!</strong></p>
            <p>People are looking at your profile. Find out who.</p>
        </div> --}}
        
        <!-- End Left Column -->
        </div>
        
        <!-- Middle Column -->
        <div class="m7 sm:w-[50%] m-auto">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <button onclick="openModal()" class="bg-[#f0f2f5] text-[#1c1e21] p-2 w-full text-left rounded-3xl"><i class="fa fa-pencil mr-3"></i>Bạn đang nghĩ gì thế?</button> 
                        </div>
                    </div>
                </div>
            </div>
             {{-- list post  --}}
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
        console.log("Opening modal");
        document.getElementById('postModal').classList.remove('hidden');
    }

    function closeModal() {
        console.log("Closing modal");
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
