<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bảng xếp hạng</title>
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
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" m-auto w-full">
    <x-menu />
    <x-notification />
    <h1
        class=" text-white text-center font-semibold text-[1rem] sm:text-[1.5rem]  mt-[90px] pb-[10px] ftitle animate__animated  animate__bounce">
        Bảng xếp hạng</h1>
    <div class="flex ">
        <div class="w-[90%] xl:w-[70%] m-auto relative ">
            <div class=" text-right grid grid-cols-[100px_1fr] gap-1 mb-1">
                <button data-bs-toggle="modal" data-bs-target="#filterModal"
                    class=" bg-white  rounded-sm  text-[0.7rem] lg:text-[1rem] py-2 "><i class="fa fa-filter mr-[5px]"
                        aria-hidden="true"></i>Bộ lọc</button>
                <button data-bs-toggle="modal" data-bs-target="#HowBonusModal"
                    class=" bg-white  rounded-sm  text-[0.7rem] lg:text-[1rem] py-2 max-w-[200px]"><i
                        class="fa fa-question-circle mr-1" aria-hidden="true"></i>Cách xếp hạng</button>
            </div>
            @if (!empty($players_top_5))
                @if (count($players_top_5) === 0)
                    <h1 class=" text-white text-center text-[13px] mt-[60px]">Không tìm thấy người chơi tương ứng</h1>
                @endif
            @endif

            <x-top5-player :players="$players_top_5 ?? []" />
            <x-top10-player :players="$Player_top_6_from_15 ?? []" />
            <x-footer />
        </div>
        <x-filter />
        <x-modal-how-bonus />
    </div>
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



</html>
