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
      <button onclick="deleteData()" class="btn btn-secondary">Xoá dữ liệu quay về trạng thái ban đầu</button>
  </div>
  <div class=" text-right px-4" style="text-align: right; position: fixed; z-index: 999; right:15px; top: 0;"><a href="{{ route('adminTournament.showEditTournament', ['id' => $tournament->id]) }}" class="btn btn-primary ml-2 mt-4">Quay về trang quản lý giải đấu</a></div>
    
  <div id="save">
      <div id="bracket-wrapper" class="relative overflow-auto p-2" style="height: 100vh; width: 100vw;">
          <div id="bracket-content" class="demo"></div>
      </div>
  </div>
</div>

<script>
    var api_url = {!! json_encode(env('APP_URL')) !!};
    
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
        userData: api_url + "/api/tournament/bracket/" + tournamentId
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
        userData: api_url + "/api/tournament/bracket/" + tournamentId
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
  <script>
    function deleteData() {
        if (confirm("Bạn có chắc chắn muốn xoá dữ liệu bảng đấu?")) {
            fetch(api_url + "/api/tournament/delete-bracket/" + tournamentId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error("Lỗi khi gọi API");
                return response.json();
            })
            .then(result => {
                console.log("API Response:", result);
                alert("Dữ liệu bảng đấu đã được xoá thành công.");
                location.reload(); // Tải lại trang để cập nhật giao diện
            })
            .catch(error => {
                console.error("API Error:", error);
                alert("Đã xảy ra lỗi khi xoá dữ liệu bảng đấu.");
            });
        }
  }
  </script>

</body>
</html>
