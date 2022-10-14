
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

    <meta name="theme-color" content="#563d7c">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/marquee.css') }}" >
    <link rel="stylesheet" href="{{ asset('lib/font-awesome-4.7.0/css/font-awesome.min.css')}}">
  <style>
       body {
          /*font-family: Arial, Helvetica, sans-serif;*/
          font-family: 'Roboto', sans-serif
       }

       .nav a {
            color: white !important
        }

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
        <img src={{URL::asset('/images/frontend/main/school-banner.jpg')}} width="100%" />
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
                     @yield('directional')
                     @if(isset($flagView))
                        @include("frontend.layouts.left")
                     @endif
                </div>  
                <!-- end left -->
                <!-- right -->
                <div class="col-md-4 col-xs-12">
                     @include("frontend.layouts.sidebar")
                </div>
                <!-- end right -->
            </div>
        </section>
</main>

<!-- begin footer -->
    <section>
        <div class="footer"> 
            <div class="row footer_main">
                <div class="container">
                    <div class="col-md-2 logo_ft">
                        <a href="" title="Trang chủ">
                           
                             <img src="{{URL::asset('/images/frontend/main/logo02.png')}}" width="170px" alt="Logo"></a>
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

