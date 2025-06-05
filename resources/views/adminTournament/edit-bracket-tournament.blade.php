<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Bảng đấu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bracket/0.11.1/jquery.bracket.min.js"></script>

  <style>
    #bracket-wrapper {
  width: 100vw;
  height: 100vh;
  overflow: scroll; /* Bắt buộc để kích hoạt scroll khi nội dung lớn */
  transform-origin: top left;
  transition: transform 0.2s ease;
  cursor: grab;
  position: relative;
}
    #bracket-wrapper:active {
      cursor: grabbing;
    }

  </style>
</head>
<body>

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
      var saveData = bracketData;
    }
    else
    {
      var saveData = {
        teams: teamsFromPHP,
        results: [
        [
            [[1, 0], [null, null], [null, null], [null, null]],
            [[null, null], [1, 4]],
            [[null, null], [null, null]]
        ]
        ]
    };
    }

    function saveFn(data, userData) {
        var json = jQuery.toJSON(data);
        $('#saveOutput').text('POST ' + userData + ' ' + json);
        console.log(json);

        fetch(userData, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: json
        })
        .then(response => {
            if (!response.ok) throw new Error("Lỗi khi gọi API");
            return response.json();
        })
        .then(result => {
            console.log("API Response:", result);
        })
        .catch(error => {
            console.error("API Error:", error);
        });
    }

    $(function() {
        var container = $('div#save .demo');
        container.bracket({
        init: saveData,
        save: saveFn,
        userData: "http://127.0.0.1:8000/api/tournament/bracket/" + tournamentId
        });

        var data = container.bracket('data');
        $('#dataOutput').text(jQuery.toJSON(data));
    });


    var resizeParameters = {
        teamWidth: 200,
        scoreWidth: 30,
        matchMargin: 10,
        roundMargin: 50,
        init: saveData,
        save: saveFn,
        userData: "http://127.0.0.1:8000/api/tournament/bracket/" + tournamentId
    };

    $(function() {
        var container = $('div#save .demo');
        container.bracket(resizeParameters);

        var data = container.bracket('data');
        $('#dataOutput').text(jQuery.toJSON(data));
    });
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
  

</body>
</html>
