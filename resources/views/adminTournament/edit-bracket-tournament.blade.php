<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Bảng đấu</title>
  <!-- Thêm lại jQuery Bracket CDN -->
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
  {{-- <div class="my-4 flex gap-2 items-center">
      <button onclick="zoomOut()" class="btn btn-secondary">Thu nhỏ</button>
      <button onclick="zoomIn()" class="btn btn-secondary">Phóng to</button>
      <button onclick="deleteData()" class="btn btn-secondary">Xoá dữ liệu quay về trạng thái ban đầu</button>
  </div>
  <div class=" text-right px-4" style="text-align: right; position: fixed; z-index: 999; right:15px; top: 0;"><a href="{{ route('adminTournament.showEditTournament', ['id' => $tournament->id]) }}" class="btn btn-primary ml-2 mt-4">Quay về trang quản lý giải đấu</a></div>
    
  <div id="save">
      <div id="bracket-wrapper" class="relative overflow-auto p-2" style="height: 100vh; width: 100vw;">
          <div id="bracket-content" class="demo"></div>
      </div>
  </div> --}}
  <!-- PHẦN CHỌN SỐ LƯỢNG VÀ NHẬP TÊN NGƯỜI CHƠI -->
<div id="setup-section" class="mb-4">
  <label for="player-count">Chọn số lượng người chơi:</label>
  <select id="player-count">
    <option value="16">16</option>
    <option value="32" selected>32</option>
    <option value="64">64</option>
    <option value="128">128</option>
  </select>
  <button id="setup-names" class="btn btn-primary">Nhập tên người chơi</button>
  <form id="player-names-form" style="display:none;" class="mt-3">
    <div id="player-names-list"></div>
    <button type="submit" class="btn btn-success mt-2">Bắt đầu giải đấu</button>
  </form>
</div>
<!-- KẾT THÚC GIAO DIỆN GIẢI ĐẤU MỚI -->
<div id="tournament-tables" class="mb-4">
  <h3>Vòng 1</h3>
  <div id="round1-table"></div>
  <div id="round2-section" style="display:none;">
    <h3>Vòng 2 - Nhánh thắng</h3>
    <div id="round2w-table"></div>
    <h3>Vòng 2 - Nhánh thua</h3>
    <div id="round2l-table"></div>
  </div>
  <div id="round3-section" style="display:none;">
    <h3>Vòng 3</h3>
    <div id="round3-table"></div>
  </div>
  <div id="elimination-section" style="display:none;">
    <h3>Vòng loại trực tiếp</h3>
    <div id="elimination-table"></div>
    <div id="elimination-bracket" style="display:none;"></div>
  </div>
  <div id="mermaid-section" style="display:none;">
    <h3>Sơ đồ giải đấu</h3>
    <div class="mermaid" id="mermaid-diagram"></div>
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

  <script src="https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.min.js"></script>
<script>
// --- Giao diện chọn số lượng và nhập tên người chơi ---
let players = [];
let defaultPlayerCount = 32;
function renderPlayerNameInputs(count) {
  let html = '';
  for (let i = 0; i < count; i++) {
    html += `<div class="mb-2"><label>Người chơi ${i+1}: <input type="text" class="form-control d-inline-block w-auto player-name-input" data-idx="${i}" value="Player ${i+1}" required></label></div>`;
  }
  document.getElementById('player-names-list').innerHTML = html;
}
document.getElementById('setup-names').onclick = function() {
  let count = +document.getElementById('player-count').value;
  renderPlayerNameInputs(count);
  document.getElementById('player-names-form').style.display = '';
};
document.getElementById('player-names-form').onsubmit = function(e) {
  e.preventDefault();
  let count = +document.getElementById('player-count').value;
  let nameInputs = document.querySelectorAll('.player-name-input');
  players = Array.from(nameInputs).map(input => input.value.trim() || `Player ${input.dataset.idx*1+1}`);
  if (players.length < count) {
    for (let i = players.length + 1; i <= count; i++) {
      players.push('Player ' + i);
    }
  }
  document.getElementById('setup-section').style.display = 'none';
  document.getElementById('tournament-tables').style.display = '';
  startTournament();
};
// --- LOGIC GIẢI ĐẤU BẰNG TABLE VÀ JS (sử dụng biến players mới) ---
function shuffle(array) {
  return array.sort(() => Math.random() - 0.5);
}
function createPairs(players) {
  let shuffled = shuffle([...players]);
  let pairs = [];
  for (let i = 0; i < shuffled.length; i += 2) {
    let p1 = shuffled[i];
    let p2 = (i + 1 < shuffled.length) ? shuffled[i + 1] : null;
    pairs.push([p1, p2]);
  }
  return pairs;
}
function startTournament() {
  // Vòng 1
  let round1Pairs = createPairs(players);
  let round1Results = Array(round1Pairs.length).fill(null);
  renderTable('round1-table', round1Pairs, round1Results, function(results) {
    // Chia nhánh thắng/thua
    let winners = [], losers = [];
    round1Pairs.forEach((pair, idx) => {
      let [p1, p2] = pair;
      let [s1, s2] = results[idx];
      if (!p2 || s1 > s2) { winners.push(p1); if (p2) losers.push(p2); }
      else { winners.push(p2); losers.push(p1); }
    });
    // Sinh bảng vòng 2
    document.getElementById('round2-section').style.display = '';
    window.round2wPairs = createPairs(winners);
    window.round2lPairs = createPairs(losers);
    window.round2wResults = Array(window.round2wPairs.length).fill(null);
    window.round2lResults = Array(window.round2lPairs.length).fill(null);
    renderTable('round2w-table', window.round2wPairs, window.round2wResults, onRound2wSubmit);
    renderTable('round2l-table', window.round2lPairs, window.round2lResults, onRound2lSubmit);
    // Lưu lại cho Mermaid nếu cần
    window._round1Pairs = round1Pairs;
    window._round1Results = results;
  });
}
function renderTable(containerId, pairs, results, onSubmit) {
  let html = '<form onsubmit="return false;">';
  html += '<table class="table table-bordered"><thead><tr><th>STT</th><th>Người chơi 1</th><th>Điểm</th><th>Người chơi 2</th><th>Điểm</th></tr></thead><tbody>';
  pairs.forEach((pair, idx) => {
    let [p1, p2] = pair;
    html += `<tr>
      <td>${idx + 1}</td>
      <td>${p1}</td>
      <td><input type="number" min="0" class="score-input" data-idx="${idx}" data-side="0" value="${results[idx]?.[0] ?? ''}" ${!p2 ? 'disabled' : ''}></td>
      <td>${p2 ? p2 : '<i>BYE</i>'}</td>
      <td><input type="number" min="0" class="score-input" data-idx="${idx}" data-side="1" value="${results[idx]?.[1] ?? ''}" ${!p2 ? 'disabled' : ''}></td>
    </tr>`;
  });
  html += '</tbody></table>';
  html += '<button type="submit" class="btn btn-success">Xác nhận kết quả</button>';
  html += '</form>';
  document.getElementById(containerId).innerHTML = html;
  // Xử lý nhập điểm
  let form = document.getElementById(containerId).querySelector('form');
  form.onsubmit = function() {
    let newResults = pairs.map((pair, idx) => {
      let [p1, p2] = pair;
      if (!p2) return [1, 0]; // BYE: p1 thắng
      let s1 = +form.querySelector(`.score-input[data-idx="${idx}"][data-side="0"]`).value;
      let s2 = +form.querySelector(`.score-input[data-idx="${idx}"][data-side="1"]`).value;
      if (isNaN(s1) || isNaN(s2)) return null;
      return [s1, s2];
    });
    if (newResults.some(r => r === null)) {
      alert('Vui lòng nhập đầy đủ điểm cho tất cả trận!');
      return false;
    }
    onSubmit(newResults);
    return false;
  };
}
function onRound2wSubmit(results) {
  window.round2wResults = results;
  checkShowRound3();
}
function onRound2lSubmit(results) {
  window.round2lResults = results;
  checkShowRound3();
}
function checkShowRound3() {
  if (!window.round2wResults || !window.round2lResults) return;
  if (window.round2wResults.some(r => r === null) || window.round2lResults.some(r => r === null)) return;
  // Xác định ai vào thẳng loại trực tiếp, ai xuống vòng 3
  let round2wWinners = [], round2wLosers = [];
  window.round2wPairs.forEach((pair, idx) => {
    let [p1, p2] = pair;
    let [s1, s2] = window.round2wResults[idx];
    if (!p2 || s1 > s2) { round2wWinners.push(p1); if (p2) round2wLosers.push(p2); }
    else { round2wWinners.push(p2); round2wLosers.push(p1); }
  });
  let round2lWinners = [], round2lLosers = [];
  window.round2lPairs.forEach((pair, idx) => {
    let [p1, p2] = pair;
    let [s1, s2] = window.round2lResults[idx];
    if (!p2 || s1 > s2) { round2lWinners.push(p1); if (p2) round2lLosers.push(p2); }
    else { round2lWinners.push(p2); round2lLosers.push(p1); }
  });
  // Ghép vòng 3: round2wLosers gặp round2lWinners
  let round3Pairs = [];
  let minLen = Math.min(round2wLosers.length, round2lWinners.length);
  for (let i = 0; i < minLen; i++) {
    round3Pairs.push([round2wLosers[i], round2lWinners[i]]);
  }
  window.round3Pairs = round3Pairs;
  window.round3Results = Array(round3Pairs.length).fill(null);
  document.getElementById('round3-section').style.display = '';
  renderTable('round3-table', round3Pairs, window.round3Results, onRound3Submit);
  // Lưu lại những người vào thẳng loại trực tiếp
  window.eliminationQualified = [...round2wWinners];
}
function onRound3Submit(results) {
  window.round3Results = results;
  // Xác định ai vào loại trực tiếp từ vòng 3
  let round3Winners = [];
  window.round3Pairs.forEach((pair, idx) => {
    let [p1, p2] = pair;
    let [s1, s2] = results[idx];
    if (!p2 || s1 > s2) round3Winners.push(p1);
    else round3Winners.push(p2);
  });
  let qualified = [...window.eliminationQualified, ...round3Winners];
  // Sinh bảng loại trực tiếp
  document.getElementById('elimination-section').style.display = '';
  let eliminationPairs = createPairs(qualified);
  let eliminationResults = Array(eliminationPairs.length).fill(null);
  // Ẩn bảng HTML, hiển thị bracket
  document.getElementById('elimination-table').style.display = 'none';
  document.getElementById('elimination-bracket').style.display = '';
  // Khởi tạo jQuery Bracket
  $(function() {
    $('#elimination-bracket').bracket({
      init: { teams: eliminationPairs, results: [Array(eliminationPairs.length).fill([null, null])] },
      save: function() {},
      disableToolbar: false,
      disableTeamEdit: false
    });
  });
  // Sau khi nhập xong, sinh sơ đồ Mermaid (nếu muốn)
  // showMermaidDiagram(round1Pairs, round1Results, window.round2wPairs, window.round2wResults, window.round2lPairs, window.round2lResults, window.round3Pairs, window.round3Results, eliminationPairs);
}
function showMermaidDiagram(round1Pairs, round1Results, round2wPairs, round2wResults, round2lPairs, round2lResults, round3Pairs, round3Results, eliminationPairs) {
  document.getElementById('mermaid-section').style.display = '';
  // Sinh mã Mermaid flowchart đơn giản (có thể mở rộng logic vẽ nhánh chi tiết hơn)
  let mermaidStr = 'flowchart TD\n';
  // Vòng 1
  round1Pairs.forEach((pair, idx) => {
    let [p1, p2] = pair;
    if (!p2) return;
    let [s1, s2] = round1Results[idx];
    let winner = s1 > s2 ? p1 : p2;
    let loser = s1 > s2 ? p2 : p1;
    mermaidStr += `${p1} -- thắng/thua --> ${winner}\n`;
    mermaidStr += `${p2} -- thắng/thua --> ${winner}\n`;
  });
  // Có thể mở rộng thêm các nhánh vòng 2, 3, loại trực tiếp nếu muốn
  document.getElementById('mermaid-diagram').innerText = mermaidStr;
  if (window.mermaid) mermaid.init(undefined, '#mermaid-diagram');
}
  </script>

</body>
</html>
