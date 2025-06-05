<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Bảng đấu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.js"></script>

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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <style>
        #bracket-wrapper {
        cursor: grab;
        }

        #bracket-wrapper:active {
        cursor: grabbing;
        }

    </style>
</head>
<body class="w-full">
    <x-notification />
    @isset($tournament_id)
        <x-modal-register-tournament :tournamentid="$tournament_id" />
    @endisset
    <x-menu />
    <h1
        class=" text-white text-center font-semibold text-[17px] 2xl:text-[2rem]  mt-[70px] ftitle animate__animated  animate__bounce sm:text-[1.5rem]">
        {{$tournament->name}}</h1>
    <div>
        <div class="my-4 flex gap-2 items-center">
            <button onclick="zoomOut()" class="btn btn-secondary">Thu nhỏ</button>
            <button onclick="zoomIn()" class="btn btn-secondary">Phóng to</button>
        </div>
          
        <div id="save">
            <div id="bracket-wrapper" class="relative overflow-auto p-2" style="height: 80vh; width: 100vw;">
                <div id="bracket-content" class="demo"></div>
            </div>
        </div>
    </div>
</body>
<script>
var bracket_data = {!! json_encode($bracket_data) !!};
    var bracketData = JSON.parse(bracket_data);
    var tournamentId = {!! json_encode($tournament->id) !!};
    
    var teamsFromPHP = {!! json_encode($teams) !!};
    if(teamsFromPHP == null)
    {
      teamsFromPHP = [['player 1', 'player 2']];
    }

    if(bracketData != null)
    {
      var eightTeams = bracketData;
    }
    else
    {
      var eightTeams = {
        teams : [
            ["Team 1",  "Team 2" ],
            ["Team 3",  "Team 4" ],
            ["Team 5",  "Team 6" ],
            ["Team 7",  "Team 8" ]
        ],
        results : [[ /* WINNER BRACKET */
            [[1,2], [3,4], [5,6], [7,8]],
            [[9,1], [8,2]],
            [[1,3]]
        ], [         /* LOSER BRACKET */
            [[5,1], [1,2], [3,2], [6,9]],
            [[1,2], [3,1]],
            [[4,2]]
        ]]
        }
    }
 
    var resizeParameters = {
    teamWidth: 200,
    // scoreWidth: 30,
    // matchMargin: 10,
    // roundMargin: 50,
    init: eightTeams,   // dữ liệu khởi tạo bracket
    // Nếu có hàm save, có thể thêm save: saveFn
    // Nếu có userData url thì thêm userData: "..."
};

$('div#save .demo').bracket(resizeParameters);
</script>

<script>
    let currentZoom = 1;
    
    function applyZoom() {
      document.getElementById("bracket-content").style.transform = `scale(${currentZoom})`;
      document.getElementById("bracket-content").style.transformOrigin = "top left";
    }
    
    function zoomIn() {
      currentZoom += 0.1;
      applyZoom();
    }
    
    function zoomOut() {
      currentZoom = Math.max(0.2, currentZoom - 0.1);
      applyZoom();
    }
    
    function zoomReset() {
      currentZoom = 1;
      applyZoom();
    }
    
    $(function () {
      var resizeParameters = {
        teamWidth: 200,
        // scoreWidth: 30,
        // matchMargin: 10,
        // roundMargin: 50,
        skipGrandFinalComeback: true,
        init: eightTeams,
      };
    
      $('div#bracket-content').bracket(resizeParameters);
      applyZoom(); // Khởi động với zoom 100%
    });
    </script>
    
    <script>
        let isDragging = false;
        let startX, startY, scrollLeft, scrollTop;
        const wrapper = document.getElementById('bracket-wrapper');
        
        wrapper.addEventListener('mousedown', (e) => {
          isDragging = true;
          wrapper.classList.add('active');
          startX = e.pageX - wrapper.offsetLeft;
          startY = e.pageY - wrapper.offsetTop;
          scrollLeft = wrapper.scrollLeft;
          scrollTop = wrapper.scrollTop;
        });
        
        wrapper.addEventListener('mouseleave', () => {
          isDragging = false;
        });
        
        wrapper.addEventListener('mouseup', () => {
          isDragging = false;
        });
        
        wrapper.addEventListener('mousemove', (e) => {
          if (!isDragging) return;
          e.preventDefault();
          const x = e.pageX - wrapper.offsetLeft;
          const y = e.pageY - wrapper.offsetTop;
          const walkX = (x - startX) * 1; // tốc độ kéo theo chiều ngang
          const walkY = (y - startY) * 1; // tốc độ kéo theo chiều dọc (nếu có)
          wrapper.scrollLeft = scrollLeft - walkX;
          wrapper.scrollTop = scrollTop - walkY;
        });
        </script>
        

</html>
