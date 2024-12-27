<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
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
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <style>
        body {
            font-family: "Lato", sans-serif
        }

        .mySlides {
            display: none
        }

        .menu {
            position: fixed;
            width: 100%;
            left: 0;
            right: 0;
            top: 0;
            z-index: 999999;
        }
    </style>


</head>

<body>
    <x-notification />
    <x-menu />
    <!-- Page content -->
    <div class="w3-content" style="max-width:2000px;">

        <!-- Automatic Slideshow Images -->
        <div class="mySlides w3-display-container w3-center">
            <img src="/images/reyes_cup1.jpg" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
                <h3>Reyes Cup</h3>
                <p><b>Dương Quốc Hoàng và team Châu Á xuất sắc vô địch Reyes Cup!</b></p>
            </div>
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="/images/reyes_cup2.jpg" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
                <h3>Reyes Cup</h3>
                <p><b>Phần trình diễn xuất sắc của team Châu Á.</b></p>
            </div>
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="/images/reyes_cup3.jpg" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
                <h3>Reyes Cup</h3>
                <p><b>Aloysius Yapp đạt MVP của giải đấu.</b></p>
            </div>
        </div>

        <!-- The Band Section -->
        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
            <h2 class="w3-wide">VIET NAM POOL</h2>
            <p class="w3-opacity"><i>Hệ thống tổ chức giải và quản lý hàng đầu Việt Nam</i></p>
            <p class="w3-justify">Việt Nam Pool là hệ thống tổ chức giải đấu billiard là một mô hình tổ chức sự kiện thể
                thao chuyên
                nghiệp, được thiết kế để mang đến không gian thi đấu công bằng, hấp dẫn và chuyên môn cho các vận động
                viên billiard. Giải đấu này thường xuyên được tổ chức tại các địa điểm thi đấu quy mô lớn, thu hút sự
                tham gia của những tay cơ tài năng trong nước và quốc tế. Hệ thống tổ chức giải bao gồm các vòng đấu
                loại, các trận đấu chính thức và các trận chung kết, với sự tham gia của các trọng tài chuyên nghiệp,
                đội ngũ kỹ thuật và ban tổ chức làm việc chặt chẽ để đảm bảo sự minh bạch, công bằng và chất lượng cho
                giải đấu. Các giải đấu billiard không chỉ là cơ hội để các vận động viên thể hiện kỹ năng mà còn tạo ra
                sân chơi giao lưu, học hỏi giữa các thế hệ và phát triển phong trào thể thao billiard rộng rãi trong
                cộng đồng.</p>
            <br>
            <p class="w3-justify">Khi các cơ thủ tham gia các giải đấu trong hệ thống của Việt Nam Pool, các thông tin
                cá
                nhân và thành tích sẽ được lưu trên hệ thống một cách minh bạch, giúp phân hạng người chơi một cách công
                bằng nhất. Hạng của cơ thủ sẽ được xếp theo điểm <strong>Point</strong>. Khi cơ thủ tham gia giải đấu sẽ
                bị trừ 100 Point và nếu cơ thủ đoạt giải thưởng Point sẽ được tăng tương ứng với giải đoạt được (Quán
                quân + 400 point; Á quân + 300 point; Hạng 3 + 200 point ). Sau khi giải đấu kết thúc Point, tiền thưởng
                và hạng của cơ thủ sẽ được cập nhật. </p>
        </div>

        <!-- The Tour Section -->
        <div class="w3-black" id="tour"
            style="background-color: #21324C !important;
    background-image: url(../images/background-dots.png);">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
                <h2 class="w3-wide w3-center">Đơn vị tổ chức giải đấu</h2>
                <p class="w3-opacity w3-center"><i>Các đơn vị hợp tác của Việt Nam Pool</i></p><br>
                <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
                    <div class="w3-third w3-margin-bottom">
                        <img src="/images/adminTournament/oc-sen.jpg" alt="New York" style="width:100%"
                            class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Ốc sên team</b></p>
                            <p>Đơn vị tổ chức giải đấu dành cho các cơ thủ hạng thấp (F G H). Nhằm tạo môi trường lành
                                mạnh để những chơi cùng đam mê billiard giao lưu và cọ xát.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ticket Modal -->
        <div id="ticketModal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-teal w3-center w3-padding-32">
                    <span onclick="document.getElementById('ticketModal').style.display='none'"
                        class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
                    <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Tickets</h2>
                </header>
                <div class="w3-container">
                    <p><label><i class="fa fa-shopping-cart"></i> Tickets, $15 per person</label></p>
                    <input class="w3-input w3-border" type="text" placeholder="How many?">
                    <p><label><i class="fa fa-user"></i> Send To</label></p>
                    <input class="w3-input w3-border" type="text" placeholder="Enter email">
                    <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right">PAY <i
                            class="fa fa-check"></i></button>
                    <button class="w3-button w3-red w3-section"
                        onclick="document.getElementById('ticketModal').style.display='none'">Close <i
                            class="fa fa-remove"></i></button>
                    <p class="w3-right">Need <a href="#" class="w3-text-blue">help?</a></p>
                </div>
            </div>
        </div>

        <!-- The Contact Section -->
        <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
            <h2 class="w3-wide w3-center">Liên hệ</h2>
            <p class="w3-opacity w3-center"><i>Liên hệ hợp tác</i></p>
            <div class="w3-row w3-padding-32">
                <div class="w3-col m6  w3-margin-bottom">
                    <i class="fa fa-map-marker" style="width:30px"></i> Hà Nội, Việt Nam<br>
                    <i class="fa fa-phone" style="width:30px"></i> Phone: +84 3470 52653<br>
                    <i class="fa fa-envelope" style="width:30px"> </i> Email: thangnguyen30102002@mail.com<br>
                    <i class="fa fa-comment"style="width:30px" aria-hidden="true"> </i> Zalo: +84 3847 05005<br>
                </div>
                <div class="w3-col m6">
                    <form action="/action_page.php" target="_blank">
                        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Name" required
                                    name="Name">
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Email" required
                                    name="Email">
                            </div>
                        </div>
                        <input class="w3-input w3-border" type="text" placeholder="Message" required
                            name="Message">
                        <button disabled class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- End Page Content -->
    </div>



    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </footer>

    <script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 4000);
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('ticketModal');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            @if (session('showModal'))
                $('#ChangePassModal').modal('show');
            @endif
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('showModal'))
                var myModal = new bootstrap.Modal(document.getElementById('ChangePassModal'));
                myModal.show();
            @endif
        });
    </script>

</body>

</html>
