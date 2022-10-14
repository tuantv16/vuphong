<!-- begin tin tức mới nhất -->
<div class="hot_news">
    <h2>Tin tức mới nhất</h2>
    <!-- box_news_right_scroll -->
    <div class="scrollbar" id="style-1">
        <div class="area_news force-overflow">
            @if(isset($news[0]->id))
                @foreach ($news as $row)
                <div class="atice_news">
                    <a class="box_news_img">
                        <?php 
                            if(file_exists( public_path().'/uploads/'.$row->filename) && $row->filename != '') {
                        ?> 
                            <img src='{{URL::asset("/uploads/$row->filename")}}' width="100%" alt="{{$row->title}}"/>
                        <?php } else { ?>
                                <img src='{{URL::asset("/uploads/noimage/no-image-news.png")}}' width="100%" alt="{{$row->title}}"/>
                        <?php } ?>
                    </a>
                    <a class="box_news_title" href="{{ asset("tin-tuc-moi-nhat/$row->slug-$row->id.html")}}">{{$row->title}}</a>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- end tin tức mới nhất -->

 <!-- begin video -->
 <div class="video_intro block_left">
    <h2>Video giới thiệu</h2>
    @if(isset($video->url))
    <iframe width="100%" height="315" src="{{$video->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    @endif
    
</div>
<!-- end video -->
<!-- begin dangkyhoc -->
<div class="block_left" style="margin-bottom:0px">
    <div class="dangkyhoc">
        <div class="dangkyhoc-item"><img src= '{{URL::asset("/images/frontend/artice/71806.png")}}' alt="Kiểm tra điểm thi các kỳ"><a href="{{ asset("thong-tin-truong-hoc/ket-qua-diem-thi-cac-ky.html")}}" title="Kiểm tra điểm thi các kỳ">Kết quả điểm thi các kỳ</a></div>
        <div class="dangkyhoc-item"><img src='{{URL::asset("/images/frontend/artice/i_khoahoc.png")}}' alt="Khóa học">
            <a href="{{ asset("thong-tin-truong-hoc/tuyen-sinh.html")}}" title="Tuyển sinh">Tuyển sinh</a>
        </div>
        <div class="dangkyhoc-item"><img src='{{URL::asset("/images/frontend/artice/i_lich.png")}}' alt="Lịch học">
            <a href="{{ asset("thong-tin-truong-hoc/thoi-khoa-bieu.html")}}" title="Thời khóa biểu">Thời khóa biểu</a>
        </div>
        <div class="dangkyhoc-item"><img src='{{URL::asset("/images/frontend/artice/i_tailieu.png")}}' alt="Tài liệu môn học">
            <a href="{{ asset("thong-tin-truong-hoc/tai-lieu-mon-hoc.html")}}" title="Tài liệu">Tài liệu môn học</a>
        </div>
    </div>
</div>
<!-- end dangkyhoc -->

<!-- begin liên kết -->
<div class="block_left">
    <h2>Các liên kết</h2>
    <div id="module21" class="ModuleWrapper" modulerootid="5932330">
        <aside class="widget link-icons clearfix"> 
            @if(isset($link[0]->id))
                @foreach ($link as $row)
            <p class="post-image"> 
                <a href="{{$row->url}}" title="{{$row->url}}" target="_blank">
                    <img src='{{URL::asset("/uploads/$row->filename")}}' width="100%" alt="{{$row->url}}" itemprop="image">
                </a> 
            </p> 
                @endforeach
            @endif
         <!--
        <p class="post-image"> <a href="http://hocvalamtheobac.vn/" title="Học và làm theo Bác" target="_blank">
        <img src="images/frontend/main/hoctheobac42.jpg" width="100%" alt="Các liên kết" itemprop="image">
        </a> </p> 
        <p class="post-image"> <a href="https://namdinh.gov.vn/Default.aspx?sname=ubndnamdinh&sid=4&pageid=468" title="Cổng thông tin điện tử tỉnh Nam Định" target="_blank">
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