<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giải đấu</title>
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
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
</head>

<body class=" m-auto w-[90%] 2xl:w-[70%]">
    <x-notification />
    @isset($tournament_id)
        <x-modal-register-tournament :tournamentid="$tournament_id" />
    @endisset
    <x-menu />
    <h1
        class=" text-white text-center font-semibold text-[17px] 2xl:text-[2.5rem]  mt-[70px] ftitle animate__animated  animate__bounce sm:text-[1.5rem]">
        Giải đấu</h1>
    @if (!empty($tournaments))
        @if (count($tournaments) === 0)
            <h1 class=" text-white text-center text-[13px] mt-[60px]">Chưa có giải đấu nào sắp diễn ra</h1>
        @endif
    @endif
    <div class=" grid grid-cols-1 gap-4 md:grid-cols-3 mt-[15px] min-h-[500px]">
        @foreach ($tournaments as $tournament)
            <x-card-tournament-organizer :organizer="$tournament" />
        @endforeach

    </div>
    <x-footer />
</body>
<script>
    document.querySelectorAll('[id^="toggleButton"]').forEach(button => {
        button.addEventListener('click', function() {

            const id = this.id.replace('toggleButton', '');
            const content = document.getElementById(`information${id}`);

            if (content.classList.contains('overflow-hidden')) {
                content.classList.remove('overflow-hidden', 'max-h-[150px]');
                this.textContent = 'Thu gọn';
            } else {
                content.classList.add('overflow-hidden', 'max-h-[150px]');
                this.textContent = 'Xem thêm';
            }
        });
    });
</script>

</html>
