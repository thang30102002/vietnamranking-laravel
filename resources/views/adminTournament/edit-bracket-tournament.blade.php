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
      transform-origin: top left;
      transition: transform 0.2s ease;
    }
  </style>
</head>
<body>

<div>
    Zoom: <input type="range" id="zoomSlider" min="0.3" max="2" step="0.1" value="1" />
</div>
<div id="save">
    <div id="bracket-wrapper">
      <div class="demo"></div>
    </div>
  </div>

<pre id="saveOutput"></pre>
<pre id="dataOutput"></pre>
<script>
    var teamsFromPHP = {!! json_encode($teams) !!};
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
        userData: "http://127.0.0.1:8001/api/tournament/bracket/1"
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
        userData: "http://127.0.0.1:8001/api/tournament/bracket/1"
    };

    $(function() {
        var container = $('div#save .demo');
        container.bracket(resizeParameters);

        var data = container.bracket('data');
        $('#dataOutput').text(jQuery.toJSON(data));
    });
</script>


<script>
    let zoomLevel = 1;
  
    document.getElementById('zoomSlider').addEventListener('input', function () {
      zoomLevel = parseFloat(this.value);
      document.getElementById('bracket-wrapper').style.transform = `scale(${zoomLevel})`;
    });
  
    document.getElementById('bracket-wrapper').addEventListener('wheel', function(e) {
      if (e.ctrlKey) {
        e.preventDefault();
        zoomLevel += (e.deltaY < 0 ? 0.1 : -0.1);
        zoomLevel = Math.max(0.3, Math.min(zoomLevel, 2));
        this.style.transform = `scale(${zoomLevel})`;
        document.getElementById('zoomSlider').value = zoomLevel.toFixed(1);
      }
    });
  </script>

</body>
</html>
