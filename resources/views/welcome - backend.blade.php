
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Trường THPT Lý Tự Trọng</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/jumbotron/">
    <link rel="icon" href="{{ asset('css/frontend/imgs/logo.jpg') }}" sizes="32x32" type="image/png">
    <!-- Bootstrap core CSS -->
   <!--  <link href="bootstrap-4.4.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml"> -->

 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
     
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
     
    <!-- Latest compiled and minified JavaScript -->



    <meta name="theme-color" content="#563d7c">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/marquee.css') }}" >
    <link rel="stylesheet" href="{{ asset('lib/font-awesome-4.7.0/css/font-awesome.min.css')}}">
  <style>
       body {
          font-family: Arial, Helvetica, sans-serif;
       }

       .nav a {
            color: white !important
        }
        
       /*.dropdown-menu {
        display: none;
        transition: display 1s ease-out;
        opacity: 0;
        
       }

       .dropdown:hover .dropdown-menu {  
            display:block;
            opacity: 1;
        }

        .dropdown-menu a:hover {
            background: #0071a6
        }*/
        
  </style>

  <script>
      $(document).ready(function() {
        var marquee = $('div.marquee');
        marquee.each(function() {
            var mar = $(this),
                indent = mar.width();
            mar.marquee = function() {
                indent--;
                mar.css('text-indent', indent);
                if (indent < -1 * mar.children('div.marquee-text').width()) {
                    indent = mar.width();
                }
            };
            mar.data('interval', setInterval(mar.marquee, 800 / 60));
        });

        $(document).on("click",".thongtin-chung .quanly-button button",function() {
             let pos = $(this).attr("pos-name");   
             $(".dieuhuong-button .khung img").removeClass("show");
             $(".dieuhuong-button .khung img").addClass("hide");
             $(".dieuhuong-button .khung img[pos-name='"+pos+"']").removeClass("hide");
             $(".dieuhuong-button .khung img[pos-name='"+pos+"']").addClass("show");
        });
        //mỗi lần kéo chuột tới div tên là slideanim thì sẽ hiển thị ra vùng có class slideanim
        $(window).scroll(function() {
            $(".slideanim").each(function(){
            var pos = $(this).offset().top;
            console.log(pos);
            var winTop = $(window).scrollTop();
                if (pos < winTop + 1) {
                $(this).addClass("slide");
                }
            });
        });

    });
 </script>
  </head>
  <body>
    <div class="container fixed-top container-img" style="position:relative; padding:0">
        <img src="images/frontend/main/nam-dinh.jpg" width="100%" />
    </div>
    <nav class="navbar navbar-default" role="navigation">
        @include("frontend.layouts.menu")
    </nav>
<!-- See more at: http://firdaus.grandexa.com/2013/09/twitter-bootstrap-3-multilevel-dropdown-menu/#sthash.h3DteUH5.dpuf -->
<!-- end test -->
<!-- body -->
<main role="main">

  <!-- Lấy ra ngày giờ hiện tại -->
  <div class="container">
    <!-- Example row of columns -->
        <?php
            $date = getdate();
            $nameDay = '';
            switch($date['weekday']) {
                case 'Monday':
                    $nameDay = 'Thứ hai';
                break;
                case 'Tuesday':
                    $nameDay = 'Thứ ba';
                break;
                case 'Wednesday':
                    $nameDay = 'Thứ tư';
                break;
                case 'Thursday':
                    $nameDay = 'Thứ năm';   
                break;
                case 'Friday':
                    $nameDay = 'Thứ sáu';   
                break;
                case 'Saturday':
                    $nameDay = 'Thứ bảy';   
                break;
                case 'Sunday':
                    $nameDay = 'Chủ nhật';   
                break;
                default:
                    $nameDay = '';   
                break;
            }
            $minutes = ($date['minutes'] < 10)? '0'.$date['minutes'] : $date['minutes'];
            $seconds = ($date['seconds'] < 10)? '0'.$date['seconds'] : $date['seconds'];
            $showTiemCurrent = $nameDay.", ngày ".$date['mday']."/".$date['mon']."/".$date['year']." ".$date['hours'].":".$minutes.":".$seconds;

        ?>
        <div class="row bg-white ar">
            <div class="col-md-3">
                <div class="text-date"><?php echo $showTiemCurrent;?></div>
            </div>
            <div class="col-md-9" style="height: 30px; line-height:30px">
                <div class="col-md-12 marquee">
                    <div class="marquee-text">Cổng thông tin điện tử Trường Trung Học Phổ Thông Lý Tự Trọng hân hạnh chào đón các em học sinh.</div>
                </div> 
            </div>
            <div class="col-md-12 line-block" style="background:white"></div>
        </div>

       

        <section class="area_header sec01">
         <div class="row bg-white">
         <!-- left -->
            <div class="col-md-8 col-xs-12">
                <div class="featured_article">
                    <img src="images/frontend/artice/imgs1.jpg" width="100%"/>
                        <a href="#" class="title_artice">Động lực khơi dậy, thu hút HSSV học tập và làm theo tư tưởng, đạo đức, phong cách Hồ Chí Minh</a>
                        <p class="lock"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>08:48, 10/01/2020</span></p>
                        <p class="content_artice">Dự buổi lễ có các đồng chí: Võ Văn Thưởng- Trưởng ban Tuyên giáo Trung ương; Phùng Xuân Nhạ- Bộ trưởng Bộ GD&ĐT; Phùng Khánh Tài - Phó Chủ tịch Ủy ban Trung ương MTTQ Việt Nam; Nguyễn Anh Tuấn- Bí thư Thường trực Trung ương Đoàn; đại diện lãnh đạo một số bộ, ban, ngành Trung ương cùng đông đảo các thầy cô giáo, các em học sinh, sinh viên.
Phát biểu tại buổi lễ, Bộ trưởng Bộ GD&ĐT Phùng Xuân Nhạ cho biết: Thời gian qua, Chỉ thị 05 của Bộ Chính trị đã được thực hiện sâu rộng trong toàn ngành Giáo dục, đạt nhiều kết quả quan trọng. Bộ GD&ĐT đã tổ chức quán triệt các nội dung của Chỉ thị 05 tới toàn thể cán bộ, giáo viên và học sinh, sinh viên trong cả nước...
                            <a href="#">Xem thêm </a>
                        </p>
                    <div class="artice">

                    </div>
                </div>

                <!-- Begin Thông báo toàn trường -->
                <div class="block-news-fir">
                <div class="thanh_title"><p><span>Thông báo toàn trường</span></p><a href="thong-bao.html" title="Xem thêm">›› Xem thêm</a></div>
                <div class="container-tintuc">
                    <div id="scroll-thongbao" tabindex="0" style="overflow: hidden; outline: none;">
                        <ul>
                                <li><a href="thong-bao/lich-kiem-tra-hoc-ky-i-nam-hoc-2019-2020-783.html" title="Lịch Kiểm Tra Học Kỳ I Năm Học 2019 - 2020">Lịch Kiểm Tra Học Kỳ I Năm Học 2019 - 2020<span>Ngày đăng: 02 - 12 - 2019</span></a></li>
                                <li><a href="thong-bao/lich-nghi-tet-canh-ty-nam-2020-780.html" title="LỊCH NGHỈ TẾT CANH TÝ NĂM 2020">LỊCH NGHỈ TẾT CANH TÝ NĂM 2020<span>Ngày đăng: 27 - 11 - 2019</span></a></li>
                                <li><a href="thong-bao/danh-sach-dat-giai-giong-ca-vang-nam-viet-775.html" title="Danh Sách Đạt Giải Giọng Ca Vàng Nam Việt">Danh Sách Đạt Giải Giọng Ca Vàng Nam Việt<span>Ngày đăng: 19 - 11 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-vnexpress-cong-nghe-quet-dau-van-tay-o-truong-quoc-te-nam-viet-741.html" title="Báo Vnexpress - " công="" nghệ="" quét="" dấu="" vân="" tay="" ở="" trường="" quốc="" tế="" nam="" việt""="">Báo Vnexpress - "Công nghệ quét dấu vân tay ở trường Quốc tế Nam Việt"<span>Ngày đăng: 15 - 08 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-lao-dong-viec-dua-don-hoc-sinh-bang-xe-rieng-phai-co-quy-dinh-ro-rang-740.html" title="Báo Lao Động - " việc="" đưa="" đón="" học="" sinh="" bằng="" xe="" riêng="" phải="" có="" quy="" định="" rõ="" ràng""="">Báo Lao Động - "Việc đưa đón học sinh bằng xe riêng phải có quy định rõ ràng"<span>Ngày đăng: 15 - 08 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-thanh-nien-truong-qt-nam-viet-yeu-to-an-toan-duoc-uu-tien-ben-canh-chat-luong-giao-duc-739.html" title="Báo Thanh Niên - " trường="" qt="" nam="" việt:="" yếu="" tố="" an="" toàn="" được="" ưu="" tiên="" bên="" cạnh="" chất="" lượng="" giáo="" dục""="">Báo Thanh Niên - "Trường QT Nam Việt: Yếu tố an toàn được ưu tiên bên cạnh chất lượng giáo dục"<span>Ngày đăng: 15 - 08 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-cong-luan-tuyen-sinh-lop-10-tai-tp-ho-chi-minh-truong-thcs-thpt-nam-viet-duoc-giao-850-chi-tieu-712.html" title="Báo Công Luận - " tuyển="" sinh="" lớp="" 10="" tại="" tp.="" hồ="" chí="" minh:="" trường="" thcs="" -="" thpt="" nam="" việt="" được="" giao="" 850="" chỉ="" tiêu""="">Báo Công Luận - "Tuyển sinh lớp 10 tại TP. Hồ Chí Minh: Trường THCS - THPT Nam Việt được giao 850 chỉ tiêu"<span>Ngày đăng: 16 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-cong-an-truong-thcs-thpt-nam-viet-dau-tu-nhieu-co-so-day-hoc-dat-tieu-chuan-quoc-te-709.html" title="Báo Công An - " trường="" thcs="" –="" thpt="" nam="" việt:="" Đầu="" tư="" nhiều="" cơ="" sở="" dạy="" học="" đạt="" tiêu="" chuẩn="" quốc="" tế""="">Báo Công An - "Trường THCS – THPT Nam Việt: Đầu tư nhiều cơ sở dạy học đạt tiêu chuẩn quốc tế"<span>Ngày đăng: 16 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-giao-duc-truong-thcs-thpt-nam-viet-dau-tu-nhieu-co-so-day-hoc-dat-tieu-chuan-quoc-te-708.html" title="Báo Giáo Dục - " trường="" thcs="" –="" thpt="" nam="" việt="" :="" Đầu="" tư="" nhiều="" cơ="" sở="" dạy="" học="" đạt="" tiêu="" chuẩn="" quốc="" tế""="">Báo Giáo Dục - "Trường THCS – THPT Nam Việt : Đầu tư nhiều cơ sở dạy học đạt tiêu chuẩn quốc tế"<span>Ngày đăng: 15 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-thanh-nien-tap-doan-giao-duc-quoc-te-nam-viet-phat-trien-vung-manh-voi-6-co-so-707.html" title="Báo Thanh Niên - " tập="" đoàn="" giáo="" dục="" quốc="" tế="" nam="" việt="" phát="" triển="" vững="" mạnh="" với="" 6="" cơ="" sở"'"="">Báo Thanh Niên - "Tập đoàn giáo dục Quốc tế Nam Việt phát triển vững mạnh với 6 cơ sở"'<span>Ngày đăng: 15 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-tuoi-tre-tap-doan-giao-duc-quoc-te-nam-viet-phat-trien-vung-manh-voi-6-co-so-706.html" title="Báo Tuổi Trẻ - " tập="" đoàn="" giáo="" dục="" quốc="" tế="" nam="" việt="" phát="" triển="" vững="" mạnh="" với="" 6="" cơ="" sở""="">Báo Tuổi Trẻ - "Tập đoàn Giáo dục Quốc tế Nam Việt phát triển vững mạnh với 6 cơ sở"<span>Ngày đăng: 15 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-dan-tri-tap-doan-giao-duc-quoc-te-nam-viet-duoc-giao-chi-tieu-tuyen-sinh-850-hoc-sinh-lop-10-705.html" title="Báo Dân Trí - " tập="" đoàn="" giáo="" dục="" quốc="" tế="" nam="" việt="" được="" giao="" chỉ="" tiêu="" tuyển="" sinh="" 850="" học="" lớp="" 10""="">Báo Dân Trí - "Tập đoàn giáo dục Quốc tế Nam Việt được giao chỉ tiêu tuyển sinh 850 học sinh lớp 10"<span>Ngày đăng: 15 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/bao-vietnamnet-thcsthpt-nam-viet-tuyen-sinh-850-hoc-sinh-lop-10-704.html" title="BÁO VIETNAMNET - " thcs-thpt="" nam="" viỆt="" tuyỂn="" sinh="" 850="" hỌc="" lỚp="" 10""="">BÁO VIETNAMNET - "THCS-THPT NAM VIỆT TUYỂN SINH 850 HỌC SINH LỚP 10"<span>Ngày đăng: 15 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/quyet-dinh-ve-viec-giao-chi-tieu-tuyen-sinh-lop-10-nam-hoc-2019-2020-cho-tap-doan-nam-viet-692.html" title="QUYẾT ĐỊNH VỀ VIỆC GIAO CHỈ TIÊU TUYỂN SINH LỚP 10 NĂM HỌC 2019 - 2020 CHO TẬP ĐOÀN NAM VIỆT">QUYẾT ĐỊNH VỀ VIỆC GIAO CHỈ TIÊU TUYỂN SINH LỚP 10 NĂM HỌC 2019 - 2020 CHO TẬP ĐOÀN NAM VIỆT<span>Ngày đăng: 09 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/thong-bao-tuyen-sinh-nam-hoc-2019-2020-687.html" title="THÔNG BÁO TUYỂN SINH NĂM HỌC 2019 - 2020">THÔNG BÁO TUYỂN SINH NĂM HỌC 2019 - 2020<span>Ngày đăng: 03 - 07 - 2019</span></a></li>
                                <li><a href="thong-bao/lich-kiem-tra-hoc-ky-2-nam-hoc-2018-2019-670.html" title="Lịch Kiểm Tra Học Kỳ 2 Năm Học 2018 - 2019 ">Lịch Kiểm Tra Học Kỳ 2 Năm Học 2018 - 2019 <span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/ke-hoach-kiem-tra-hoc-ky-2-cap-thpt-nam-hoc-2018-2019-669.html" title="Kế Hoạch Kiểm Tra Học Kỳ 2 - Cấp THPT Năm Học 2018 - 2019">Kế Hoạch Kiểm Tra Học Kỳ 2 - Cấp THPT Năm Học 2018 - 2019<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/ke-hoach-ve-viec-to-chuc-kiem-tra-hoc-ky-2-cap-thcs-quan-12-nam-hoc-2018-2019-668.html" title="Kế Hoạch Về Việc Tổ Chức Kiểm Tra Học Kỳ 2 Cấp THCS Quận 12 Năm Học 2018 - 2019">Kế Hoạch Về Việc Tổ Chức Kiểm Tra Học Kỳ 2 Cấp THCS Quận 12 Năm Học 2018 - 2019<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/hoc-sinh-tap-doan-nam-viet-dat-huy-chuong-tai-cuoc-thi-robocom-olympic-do-so-giao-duc-tphcm-to-chuc-662.html" title="Học sinh Tập Đoàn Nam Việt đạt huy chương tại cuộc thi Robocom Olympic do Sở Giáo Dục TPHCM tổ chức ">Học sinh Tập Đoàn Nam Việt đạt huy chương tại cuộc thi Robocom Olympic do Sở Giáo Dục TPHCM tổ chức <span>Ngày đăng: 08 - 04 - 2019</span></a></li>
                                <li><a href="thong-bao/hoc-phi-truong-tieu-hoc-quoc-te-nam-viet-659.html" title="Học Phí Trường Tiểu Học Quốc Tế Nam Việt">Học Phí Trường Tiểu Học Quốc Tế Nam Việt<span>Ngày đăng: 21 - 03 - 2019</span></a></li>
                                <li><a href="thong-bao/thong-bao-nghi-le-639.html" title="Thông Báo Nghỉ Lễ">Thông Báo Nghỉ Lễ<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/thong-bao-vv-giao-duc-ky-nang-song-voi-chuyen-de-long-hieu-thao-kinh-trong-le-phep-doi-voi-cha-me-thay-co-634.html" title="THÔNG BÁO V/v: Giáo dục kỹ năng sống với chuyên đề: “ Lòng hiếu thảo, kính trọng, lễ phép đối với Cha Mẹ, Thầy Cô”">THÔNG BÁO V/v: Giáo dục kỹ năng sống với chuyên đề: “ Lòng hiếu thảo, kính trọng, lễ phép đối với Cha Mẹ, Thầy Cô”<span>Ngày đăng: 13 - 11 - 2018</span></a></li>
                                <li><a href="thong-bao/bang-hoc-phi-uu-dai-nam-hoc-20192020-476.html" title="Bảng Học Phí Ưu Đãi Năm Học 2019-2020">Bảng Học Phí Ưu Đãi Năm Học 2019-2020<span>Ngày đăng: 06 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/so-do-dieu-hanh-hoat-dong-nha-truong-614.html" title="Sơ Đồ Điều Hành Hoạt Động Nhà Trường">Sơ Đồ Điều Hành Hoạt Động Nhà Trường<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/thong-tin-tai-khoan-ngan-hang-phu-huynh-chuyen-tien-giu-cho-554.html" title="Thông Tin Tài Khoản Ngân Hàng Phụ Huynh Chuyển Tiền Giữ Chỗ">Thông Tin Tài Khoản Ngân Hàng Phụ Huynh Chuyển Tiền Giữ Chỗ<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/thong-bao-su-dung-tong-dai-lien-lac-phu-huynh-hoc-sinh-549.html" title="Thông Báo Sử Dụng Tổng Đài Liên Lạc Phụ Huynh Học Sinh">Thông Báo Sử Dụng Tổng Đài Liên Lạc Phụ Huynh Học Sinh<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/thoi-khoa-bieu-hoc-he-truong-nam-viet-co-so-2-540.html" title="Thời Khóa Biểu Học Hè Trường Nam Việt Cơ Sở 2">Thời Khóa Biểu Học Hè Trường Nam Việt Cơ Sở 2<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/bang-gia-xe-dua-don-phuc-vu-hoc-sinh-534.html" title="BẢNG GIÁ XE ĐƯA ĐÓN PHỤC VỤ HỌC SINH">BẢNG GIÁ XE ĐƯA ĐÓN PHỤC VỤ HỌC SINH<span>Ngày đăng: 09 - 05 - 2018</span></a></li>
                                <li><a href="thong-bao/thong-bao-ve-dong-phuc-ao-dai-430.html" title="THÔNG BÁO VỀ ĐỒNG PHỤC ÁO DÀI">THÔNG BÁO VỀ ĐỒNG PHỤC ÁO DÀI<span>Ngày đăng: 01 - 12 - 2017</span></a></li>
                                <li><a href="thong-bao/thoi-gian-bieu-416.html" title="Thời Gian Biểu">Thời Gian Biểu<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/quy-dinh-noi-tru-415.html" title="Quy Định Nội Trú">Quy Định Nội Trú<span>Ngày đăng: 02 - 05 - 2019</span></a></li>
                                <li><a href="thong-bao/ne-nep-hoc-duong-414.html" title="NỀ NẾP HỌC ĐƯỜNG">NỀ NẾP HỌC ĐƯỜNG<span>Ngày đăng: 28 - 06 - 2018</span></a></li>
                                <li><a href="thong-bao/le-khanh-thanh-truong-thcs-thpt-nam-viet-co-so-ii-391.html" title=" LỄ KHÁNH THÀNH TRƯỜNG THCS- THPT NAM VIỆT CƠ SỎ II"> LỄ KHÁNH THÀNH TRƯỜNG THCS- THPT NAM VIỆT CƠ SỎ II<span>Ngày đăng: 28 - 06 - 2018</span></a></li>
                                <li><a href="thong-bao/lich-giao-vien-du-tuyen-325.html" title="LỊCH GIÁO VIÊN DỰ TUYỂN">LỊCH GIÁO VIÊN DỰ TUYỂN<span>Ngày đăng: 03 - 04 - 2017</span></a></li>
                                <li><a href="thong-bao/khanh-thanh-truong-nam-viet-co-so-ii-316.html" title="KHÁNH THÀNH TRƯỜNG NAM VIỆT CƠ SỞ II">KHÁNH THÀNH TRƯỜNG NAM VIỆT CƠ SỞ II<span>Ngày đăng: 28 - 06 - 2018</span></a></li>
                                <li><a href="thong-bao/thu-moi-du-le-so-ket-hoc-ky-i-va-hoi-nghi-cmhs-lan-ii-261.html" title="THƯ MỜI DỰ LỄ SƠ KẾT HỌC KỲ I VÀ HỘI NGHỊ CMHS LẦN II">THƯ MỜI DỰ LỄ SƠ KẾT HỌC KỲ I VÀ HỘI NGHỊ CMHS LẦN II<span>Ngày đăng: 28 - 06 - 2018</span></a></li>
                                <li><a href="thong-bao/cong-van-cua-bo-giao-duc-va-dao-tao-phuong-an-thi-ki-thi-quoc-gia-2017-198.html" title="CÔNG VĂN CỦA BỘ GIÁO DỤC VÀ ĐÀO TẠO PHƯƠNG ÁN THỊ KÌ THI QUỐC GIÁ 2017">CÔNG VĂN CỦA BỘ GIÁO DỤC VÀ ĐÀO TẠO PHƯƠNG ÁN THỊ KÌ THI QUỐC GIÁ 2017<span>Ngày đăng: 28 - 06 - 2018</span></a></li>
                                <li><a href="thong-bao/quyet-dinh-cong-nhan-hieu-truong-co-phan-thi-anh-hoang-143.html" title="QUYẾT ĐỊNH CÔNG NHẬN HIỆU TRƯỞNG CÔ PHAN THỊ ÁNH HOÀNG">QUYẾT ĐỊNH CÔNG NHẬN HIỆU TRƯỞNG CÔ PHAN THỊ ÁNH HOÀNG<span>Ngày đăng: 28 - 06 - 2018</span></a></li>
                                <li><a href="thong-bao/mo-them-cap-thcs-81.html" title="MỞ THÊM CẤP THCS">MỞ THÊM CẤP THCS<span>Ngày đăng: 28 - 06 - 2018</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Thông báo toàn trường -->
                <!-- Begin Kế hoạch của trường -->
                <div class="block-news-fir slideanim">
                    <div class="thanh_title"><p><span>Kế hoạch của trường</span></p><a href="thong-bao.html" title="Xem thêm">›› Xem thêm</a></div>
                    <div class="container-tintuc">
                        <div id="scroll-kehoach" tabindex="0" style="">
                            <div class="kehoach-item">
                                <div class="ngaytaokh">
                                    <p><span>01</span><br>Tháng<br><span>01</span></p>
                                </div>
                                <div class="tenkh">
                                    <a href="ke-hoach/thong-bao-ve-dong-phuc-ao-dai-538.html" title="Thông báo về đồng phục áo dài">
                                        <h3>Thông báo về đồng phục áo dài</h3>
                                        <img src="https://media1.giphy.com/media/KfSiYkxnYmWKmIgAsk/200.webp?cid=790b7611efed01f9247bf131934a36324ae9fe086c4981fb&rid=200.webp" width="70px">
                                    </a>
                                    <div></div>
                                </div>
                                <div class="ngaydangkh">Ngày đăng: 25 - 04 - 2019</div>
                            </div>
                            <div class="kehoach-item">
                                <div class="ngaytaokh">
                                    <p><span>02</span><br>Tháng<br><span>01</span></p>
                                </div>
                                <div class="tenkh">
                                    <a href="ke-hoach/thong-bao-ve-dong-phuc-ao-dai-538.html" title="Thông báo về đồng phục áo dài">
                                        <h3>Lịch kiểm tra học kỳ II Trường THPT Lý Tự Trọng</h3>
                                        <img src="https://media1.giphy.com/media/KfSiYkxnYmWKmIgAsk/200.webp?cid=790b7611efed01f9247bf131934a36324ae9fe086c4981fb&rid=200.webp" width="70px">
                                    </a>
                                    <div></div>
                                </div>
                                <div class="ngaydangkh">Ngày đăng: 25 - 04 - 2019</div>
                            </div>
                            <div class="kehoach-item">
                                <div class="ngaytaokh">
                                    <p><span>03</span><br>Tháng<br><span>01</span></p>
                                </div>
                                <div class="tenkh">
                                    <a href="ke-hoach/thong-bao-ve-dong-phuc-ao-dai-538.html" title="Thông báo về đồng phục áo dài">
                                        <h3>LỊCH KIỂM TRA ĐỊNH KÌ HÀNG THÁNG TRƯỜNG THPT Lý Tự Trọng</h3>
                                    </a>
                                    <div></div>
                                </div>
                                <div class="ngaydangkh">Ngày đăng: 25 - 04 - 2019</div>
                            </div>
                            <div class="kehoach-item">
                                <div class="ngaytaokh">
                                    <p><span>03</span><br>Tháng<br><span>01</span></p>
                                </div>
                                <div class="tenkh">
                                    <a href="ke-hoach/thong-bao-ve-dong-phuc-ao-dai-538.html" title="Thông báo về đồng phục áo dài">
                                        <h3>LỊCH KIỂM TRA ĐỊNH KÌ HÀNG THÁNG TRƯỜNG THPT Lý Tự Trọng</h3>
                                    </a>
                                    <div></div>
                                </div>
                                <div class="ngaydangkh">Ngày đăng: 25 - 04 - 2019</div>
                            </div>
                            <div class="kehoach-item">
                                <div class="ngaytaokh">
                                    <p><span>03</span><br>Tháng<br><span>01</span></p>
                                </div>
                                <div class="tenkh">
                                    <a href="ke-hoach/thong-bao-ve-dong-phuc-ao-dai-538.html" title="Thông báo về đồng phục áo dài">
                                        <h3>LỊCH KIỂM TRA ĐỊNH KÌ HÀNG THÁNG TRƯỜNG THPT Lý Tự Trọng</h3>
                                    </a>
                                    <div></div>
                                </div>
                                <div class="ngaydangkh">Ngày đăng: 25 - 04 - 2019</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Kế hoạch của trường -->
                <!-- Begin Thông tin chung -->
                <div class="block-news-fir slideanim">
                    <div class="thanh_title"><p><span>Thông tin chung</span></p><a href="thong-bao.html" title="Xem thêm">›› Xem thêm</a></div>
                    <div class="container-tintuc">
                        <div id="scroll-thongtinchung" tabindex="0" style="">
                            <div class="row thongtin-chung">
                                <div class="col-md-4 col-xs-12 quanly-button">
                                    <button class="button" style="vertical-align:middle; width: 100%" pos-name="pa01" ><span>Thành Tích </span></button>
                                    <button class="button" style="vertical-align:middle; width: 100%" pos-name="pa02" ><span>Kết Quả Đạt Được </span></button>
                                    <button class="button" style="vertical-align:middle; width: 100%" pos-name="pa03" ><span>Học Sinh Tiêu Biểu </span></button>
                                    <button class="button" style="vertical-align:middle; width: 100%" pos-name="pa04" ><span>Báo Đài </span></button>
                                </div>
                                <div class="col-md-8 col-xs-12 dieuhuong-button">
                                    <div class="khung">
                                        <img src="images/frontend/main/thanh-tich.jpg" class="show" pos-name="pa01" width="100%"/>
                                        <img src="images/frontend/main/ket-qua-dat-duoc.jpg" class="hide" pos-name="pa02" width="100%"/>
                                        <img src="images/frontend/main/hoc-sinh-tieu-bieu.jpg" class="hide" pos-name="pa03" width="100%"/>
                                        <img src="images/frontend/main/bao-dai.jpg" class="hide" pos-name="pa04" width="100%"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Thông tin chung -->
            </div>  <!-- end left -->
            <!-- right -->
            <div class="col-md-4 col-xs-12">
            <!-- begin tin tức mới nhất -->
                <div class="hot_news">
                    <h2>Tin tức mới nhất</h2>
                    <div class="area_news box_news_right_scroll">
                        <div class="atice_news">
                            <a class="box_news_img">
                                <img src="images/frontend/artice/news01.jpg" width="100%"/>
                            </a>
                            <a class="box_news_title" href="#">Trường THPT Lý Tự Trọng đăng cai hoạt động cụm THPT năm 2019 với các hoạt động của thầy và trò sôi nổi. </a>
                        </div>
                        <div class="atice_news">
                            <a class="box_news_img">
                                <img src="images/frontend/artice/news02.jpg" width="100%"/>
                            <a class="box_news_title" href="#">Văn nghệ đầu tuần cùng 11a9 - K59. Tuyên truyền bảo vệ môi trường, phân loại rác thải của công ty du học AKI.</a>
                        </div>
                        <div class="atice_news">
                            <a class="box_news_img">
                                <img src="images/frontend/artice/news03.jpg" width="100%"/>
                            </a>
                            <a class="box_news_title" href="#">Tiếp nối thành công giải bóng đá học sinh khối 12,tổ chức giải bóng đá học sinh cho khối 11 vào Chủ nhật.</a>
                        </div>
                        <div class="atice_news">
                            <a class="box_news_img">
                                <img src="images/frontend/artice/news04.jpg" width="100%"/>
                            </a>
                            <a class="box_news_title" href="#">Nhân ngày hiến chương các nhà giáo.</a>
                        </div>
                        <div class="atice_news">
                            <a class="box_news_img">
                                <img src="images/frontend/artice/news05.jpg" width="100%"/>
                            </a>
                            <a class="box_news_title" href="#">Góc tri ân.</a> 
                        </div>
                    </div>
                </div>
                <!-- end tin tức mới nhất -->
                <!-- begin video -->
                <div class="video_intro block_left">
                    <h2>Video giới thiệu</h2>
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/0B3X3pVsLCQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <!-- end video -->
                <!-- begin dangkyhoc -->
                <div class="block_left slideanim">
                    <div class="dangkyhoc">
                        <div class="dangkyhoc-item"><img src="images/frontend/artice/71806.png" alt="Đăng ký nhập học online"><a href="dang-ky-hoc-online.html" title="Đăng ký nhập học online">Đăng ký nhập học online</a></div>
                        <div class="dangkyhoc-item"><img src="images/frontend/artice/i_khoahoc.png" alt="Khóa học"><a href="tuyen-sinh.html" title="Khóa học">Khóa học</a></div>
                        <div class="dangkyhoc-item"><img src="images/frontend/artice/i_lich.png" alt="Lịch học"><a class="fancy_log" href="#login-top" title="Lịch học">Lịch học</a></div>
                        <div class="dangkyhoc-item"><img src="images/frontend/artice/i_tailieu.png" alt="Tài liệu môn học"><a href="tai-lieu.html" title="Tài liệu môn học">Tài liệu môn học</a></div>
                    </div>
                </div>
                <!-- end dangkyhoc -->

                <!-- begin liên kết -->
                <div class="block_left slideanim">
                    <h2>Các liên kết</h2>
                    <div id="module21" class="ModuleWrapper" modulerootid="5932330">
                        <aside class="widget link-icons clearfix"> 
                            <p class="post-image"> <a href="http://hocvalamtheobac.vn/" title="Học và làm theo Bác" target="_blank">
                        <img src="images/frontend/main/hoctheobac42.jpg" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="https://namdinh.gov.vn/Default.aspx?sname=ubndnamdinh&sid=4&pageid=468" title="Cổng thông tin điện tử tỉnh Nam Định" target="_blank">
                        <img src="images/frontend/main/cttdtnd.JPG" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="https://dichvucong.namdinh.gov.vn/portaldvc/Home/default.aspx" title="Dịch vụ công trực tuyến" target="_blank">
                        <img src="images/frontend/main/DICH-VU-CONG.gif" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="https://dichvucong.namdinh.gov.vn/portaldvc/KenhTin/thong-ke.aspx" title="Kết quả giải quyết TTHC Sở GD&amp;ĐT" target="_blank">
                        <img src="images/frontend/main/kqtthc_6f71dc5e1e.jpg" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="http://csdl.moet.gov.vn/" title="Cơ sở dữ liệu ngành GD&amp;ĐT" target="_blank">
                        <img src="images/frontend/main/csdl_nganh81.JPG" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="http://namdinh.edu.vn/chuyen-de-giao-duc-va-dao-tao/giao-duc-thuong-xuyen/tin-tuc-hoat-dong/danh-sach-trung-tam-ngoai-ngu-tin-hoc-duoc-hoat-dong-tren-di.html?preview=1" title="Trung tâm Ngoại Ngữ - Tin học" target="_blank">
                        <img src="images/frontend/main/tt_nn_th.jpg" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="http://namdinh.edu.vn/chuyen-de-giao-duc-va-dao-tao/giao-duc-thuong-xuyen/tin-tuc-hoat-dong/danh-sach-cac-don-vi-tu-van-du-hoc-duoc-cap-phep-hoat-dong-t.html?preview=1" title="Đơn vị Tư vấn du học" target="_blank">
                        <img src="images/frontend/main/tvdh.jpg"  width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> 
                        <!-- <p class="post-image"> <a href="http://namdinh.edu.vn/chuyen-de-giao-duc-va-dao-tao/giao-duc-mam-non/tin-tuc-hoat-dong/danh-sach-truong-lop-mau-giao-nhom-tre-doc-lap-tu-thuc-cap-h.html?preview=1" title="Danh sách trường, lớp mẫu giáo, nhóm trẻ độc lập tư thục cấp học mầm non được cấp phép và chưa được cấp phép tỉnh Nam Định" target="_blank">
                        <img src="images/frontend/main/mntuthuc.JPG" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="http://namdinh.edu.vn/tin-tuc-su-kien/tin-tuc-va-thong-bao/ket-qua-cong-nhan-ket-qua-va-cap-giay-chung-nhan-chat-luong-.html" title="Danh sách các trường được cấp giấy chứng nhận kết quả KĐCLGD" target="_blank">
                        <img src="images/frontend/main/khung_anh_dep__373__.png" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="https://www.youtube.com/watch?time_continue=7&v=xc9Fk0KmH0U" title="Triển lãm Hoàng Sa, Trường Sa những bằng chứng lịch sử và pháp lý" target="_blank">
                        <img src="images/frontend/main/trienlamts_hs.jpg" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> <p class="post-image"> <a href="http://namdinh.edu.vn/chuyen-de-giao-duc-va-dao-tao/thi-dua-khen-thuong/tiep-nhan-phan-anh-kien-nghi-ve-quy-dinh-hanh-chinh.html?preview=1" title="TIẾP NHẬN PHẢN ÁNH, KIẾN NGHỊ VỀ QUY ĐỊNH HÀNH CHÍNH" target="_blank">
                        <img src="images/frontend/main/tnpa_7422d85e92.jpg" width="100%" alt="Các liên kết" itemprop="image">
                        </a> </p> -->
                    </aside>
                    </div>
                </div>
                <!-- end liên kết -->

                <!-- begin thống kê truy cập -->
                <div class="statistical_access block_left">
                    <h2>Thống kê lượng truy cập</h2>
                </div>
                <!-- end thống kê truy cập -->

                <!-- begin fanpage -->
                <div class="statistical_access block_left fanpage">
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0"></script>
                <div class="fb-page" data-href="https://www.facebook.com/truongthptlytutrongnamdinh/" data-tabs="timeline" data-width="360" data-height="70" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/truongthptlytutrongnamdinh/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/truongthptlytutrongnamdinh/">Trường THPT Lý Tự Trọng - Nam Định</a></blockquote></div>
                <!-- end fanpage -->
            </div>
        </div>
        </section>
</main>

<!-- begin footer -->
    <section>
        <div class="footer"> 
            <div class="row footer_main">
                <div class="container">
                    <div class="col-md-2 logo_ft">
                        <a href="" title="Trang chủ"><img src="images/frontend/main/logo02.png" width="170px" alt="Logo"></a>
                    </div>
                    <div class="col-md-6 footer_news">
                        <div class="title_footer">
                            <p>Thông tin liên hệ</p>
                        </div>
                        <div class="clear"></div>
                        <div class="content_footer1">
                            <p><span style="font-size:18px"><span style="color:rgb(255, 255, 0)"><span style="font-family:tahoma,geneva,sans-serif"><strong>TRƯỜNG THPT LÝ TỰ TRỌNG</strong></span></span></span></p>

                            <p><span style="color:#FFFFFF"><strong>Địa chỉ:&nbsp;</strong>Nam Thanh, Nam Trực, Nam Định.</span></p>

                            <p><span style="color:#FFFFFF"><strong>Điện thoại:</strong>&nbsp;+1 251-382-9206&nbsp;- Mobile: 098 372 52 35&nbsp;- +1 251-382-9206&nbsp;<br>
                            <span style="font-size:18px"><strong>HOTLINE: 1900.23.23.23</strong></span><br>
                            <strong>Email:</strong>&nbsp;&nbsp;thpt.lytutrong@namdinh.edu.vn<br>
                            <strong>Cơ&nbsp;sở 1:</strong>&nbsp;</span><a href="http://cs1.truongnamviet.edu.vn" style="line-height: 20.8px;"><span style="color:#FFFFFF">...</span></a><span style="color:#FFFFFF">&nbsp;</span><span style="color:#FFFFFF">-&nbsp;<strong>Cơ sở 2:</strong></span><a href="http://cs2.truongnamviet.edu.vn"><span style="color:#FFFFFF">&nbsp;</span></a><a href="http://cs2.truongnamviet.edu.vn"><span style="color:#FFFFFF">...</span></a></p>
                        </div>
                    </div>
                    <div class="col-md-3 footer_news" style="float: right;margin-right: 0px;">
                        <div class="title_footer">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;Bản đồ&nbsp;&nbsp;&nbsp;&nbsp;</p>
                        </div>
                        <div class="content_footer">

                            <div class="bando_ft">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3741.340268616364!2d106.25427411535662!3d20.327557086382324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135e203b03398b5%3A0xd6c0aeb7f9749ea!2sLy%20Tu%20Trong%20High%20School!5e0!3m2!1sen!2s!4v1577686979357!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                            </div>
                            <style>
                                .bando_ft iframe{
                                    width: 100% !important;height: 165px !important;
                                }
                            </style>
                        
                    </div>
                    <div class="clear"></div>
                </div> <!--container -->
            </div> <!--footer_main -->
        </div>              
    </section>

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="bootstrap-4.4.1/site/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      <!-- bootstrap.bundle.min.js thực hiển xử lý dropDown -->
      <script src="bootstrap-4.4.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{ asset('js/frontend/main.js') }}"></script>
</body>
</html>

