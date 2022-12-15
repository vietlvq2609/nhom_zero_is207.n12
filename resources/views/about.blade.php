<x-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/about.css">

        <title>Giới thiệu nhóm</title>
    </head>

    <body>
        <header>
            <a href="#">Giới thiệu</a>
            <a href="#">Mục tiêu</a>
            <a href="#">Thành viên</a>
            <a href="#">Kế hoạch</a>
            <a href="#">Liên hệ</a>
        </header>
        <main>
            <div id="introduce" class="introduce">
                <h2>Giới thiệu đồ án</h2>
                <div class="intro-body">
                    <div class="intro-images">
                        <img src="./images/food.jpg" alt="Ảnh giới thiệu về trang web">
                    </div>
                    <div class="intro-content">
                        <p>Trong một vài năm gần đây, do sự tác động của đại dịch Covid làm lượng khách hàng giảm đi, nhu cầu mua sắm giảm mạnh đã làm cho phương thức kinh doanh offline gặp nhiều bất lợi. Bên cạnh đó, hệ sinh thái dành cho kinh doanh online đã được xây dựng gần như hoàn thiện từ nguồn hàng, kênh bán hàng hay đơn vị vận chuyển đều có sẵn. Điều đó đã tạo điều kiện thuận lợi cho hình thức kinh doanh online vươn lên. Mà nhu cầu ăn uống của khách hàng không thay đổi, chỉ khác là phương thức mua sắm dần chuyển sang online do vừa thuận tiện, lại tiết kiệm thời gian. Do đó các website bán thức ăn cũng trở thành vùng đất màu mỡ cho người kinh doanh. Đấy cũng là lý do bọn em chọn đề tài “Website bán thức ăn”.</p>
                    </div>
                </div>
            </div>
            <div id="goal" class="goal">
                <h2>Mục tiêu đồ án</h2>
                <div class="goal-body">
                    <div class="goal-content">
                        <p>Cung cấp website giúp quản lý hiệu quả nguồn hàng, nhân lực, kinh phí, đơn hàng cho cửa hàng giúp chủ cửa hàng tiết kiệm thời gian, tiền bạc, công sức.</p>
                        <br>
                        <p>Hỗ trợ người tiêu dùng tiếp cận các sản phẩm của cửa hàng, có được cái nhìn trực quan, dễ dàng tìm được và order sản phẩm mình cần.</p>
                        <br>
                        <p>Thông qua việc thực hiện đồ án, giúp các thành viên trong nhóm rèn luyện khả năng phối hợp với nhóm, hiểu rõ hơn cách xây dựng và quản lý một dự án. Tạo cơ hội cho các thành viên tìm hiểu các công nghệ mới và áp ụng các công nghệ vào đồ án.</p>
                    </div>
                    <div class="goal-images">
                        <img src="./images/goal.jpeg" alt="Ảnh mục tiêu của web">
                    </div>
                </div>
            </div>
            <div id="members" class="members">
                <h2>Thành viên nhóm</h2>
                <div class="slideshow-container">
                    <div class="slideMember fade">
                        <div class="numberText">1 / 4</div>
                        <img src="./images/hinh1.jpg" alt="Avatar of Luu Thuong Vy">
                        <div class="text">
                            <span class="nameMember">Lưu Thượng Vỹ (Trưởng nhóm)</span>
                            <br>
                            <span class="idMember">2052</span>
                        </div>
                    </div>
                    <div class="slideMember fade">
                        <div class="numberText">2 / 4</div>
                        <img src="./images/hinh2.jpg" alt="Avatar of Lam Quoc Dat">
                        <div class="text">
                            <span class="nameMember">Lâm Quốc Đạt</span>
                            <br>
                            <span class="idMember">2052</span>
                        </div>
                    </div>
                    <div class="slideMember fade">
                        <div class="numberText">3 / 4</div>
                        <img src="./images/hinh3.jpg" alt="Avatar of Le Vu Quoc Viet">
                        <div class="text">
                            <span class="nameMember">Lê Vũ Quốc Việt</span>
                            <br>
                            <span class="idMember">2052</span>
                        </div>
                    </div>
                    <div class="slideMember fade">
                        <div class="numberText">4 / 4</div>
                        <img src="./images/hinh4.jpg" alt="Avatar of Nguyen Le Trong Nhan">
                        <div class="text">
                            <span class="nameMember">Nguyễn Lê Trọng Nhân</span>
                            <br>
                            <span class="idMember">20521698</span>
                        </div>
                    </div>
                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>
                </div>
                <br>
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
            </div>
            <div id="plan" class="plan">
                <h2>Kế hoạch</h2>
                <div class="planContent">
                    <ul>Giai đoạn đầu: <br>
                        <li>Lên kế hoạch cho đồ án cuối kỳ, phân tích nội dung cần làm</li>
                        <li>Thống nhất công cụ quản lý đồ án</li>
                        <li>Xác định các đối tượng, thiết kế database cho trang web</li>
                    </ul>
                    <ul>Giai đoạn giữa: <br>
                        <li>Code giao diện cho trang web</li>
                        <li>Xử lý các chức năng cho trang web</li>
                    </ul>
                    <ul>Giai đoạn cuối: <br>
                        <li>Hoàn thiện Source code website</li>
                        <li>Kiểm thử website</li>
                        <li>Làm báo cáo, thuyết trình và giới thiệu giao diện trên Behance hoặc Dribble</li>
                    </ul>
                </div>
            </div>
            <div id="contact" class="contact">
                <h2>Liên hệ</h2>
                <div class="contactAbout">
                    <div class="email">Email: <a href="mailto:20522179@gm.uit.edu.vn">20521698@gm.uit.edu.vn</a></div>
                    <div class="phone">Phone: <a href="#">0123456789</a></div>
                    <div class="address">Address: <a href="">Trường Đại học Công nghệ Thông tin, Đường Hàn Thuyên, khu phố 6 Phường Linh Trung
                            Thành phố Hồ Chí Minh, Thủ Đức
                            Việt Nam</a></div>
                </div>
                <form action="" class="contactForm">
                    <div class="form-group">
                        <label for="name"><strong>Tên</strong> (yêu cầu)</label>
                        <input type="text" required id="name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Thư điện tử</strong> (yêu cầu)</label>
                        <input type="email" required id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="message"><strong>Tin nhắn</strong></label>
                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn">CONTACT US</button>
                    </div>
                </form>
            </div>
        </main>

        <script>
            let slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                let i;
                let slides = document.getElementsByClassName("slideMember");
                let dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
            }
        </script>

    </body>

    </html>
</x-layout>