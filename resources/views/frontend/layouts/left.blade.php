<div class="featured_article">
    @if(isset($featuredArticle->post_id))
        <a href="{{ asset("$featuredArticle->cat_slug/$featuredArticle->post_slug-$featuredArticle->post_id.html")}}" class="title_artice">
            <img src="uploads/{{$featuredArticle->filename}}" width="100%" alt="{{$featuredArticle->original_filename}}" style="min-height: 300px; min-width:300px;"/>
        </a>
        <a href="{{ asset("$featuredArticle->cat_slug/$featuredArticle->post_slug-$featuredArticle->post_id.html")}}" class="title_artice">{{$featuredArticle->title}}</a>
        <p class="lock"><i class="fa fa-clock-o" aria-hidden="true"></i> 
            <span>
                <?php
                    $date = date_create($featuredArticle->post_updater_date);
                    echo date_format($date, 'H:i, d/m/Y');
                ?>
            </span>
        </p>
        <p class="content_artice">
        <?php 
                $content = getplaintextintrofromhtml($featuredArticle->content);
                echo _cutTect($content,1400);
        ?>
        <a href="{{ asset("$featuredArticle->cat_slug/$featuredArticle->post_slug-$featuredArticle->post_id.html")}}" title="{{$featuredArticle->post_slug}}">Xem thêm</a>
           
        </p>
    <div class="artice">

    </div>
    @endif
</div>
<!-- Begin Thông báo toàn trường -->
<div class="block-news-fir">
    <div class="thanh_title"><p><span>Thông báo toàn trường</span></p><a href="thong-bao-toan-truong.html" title="Xem thêm">›› Xem thêm</a></div>
    <div class="container-tintuc">
        <div id="scroll-thongbao" tabindex="0" style="overflow: hidden; outline: none;">
            <ul>
                @if(isset($getSchoolNotice[0]->post_id))
                    @foreach ($getSchoolNotice as $row)
                        <?php $date = date_create($row->post_updater_date); ?>
                        <li><a href="{{ asset("thong-bao-toan-truong/$row->post_slug-$row->post_id.html")}}" title="{{$row->title}}">{{$row->title}}<span>Ngày đăng: {{date_format($date, 'H:i, d/m/Y')}}</span></a></li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- End Thông báo toàn trường -->

    <!-- Begin Kế hoạch của trường -->
     <!-- <div class="block-news-fir slideanim"> -->
    <div class="block-news-fir">
        <div class="thanh_title"><p><span>Kế hoạch của trường</span></p><a href="ke-hoach-cua-truong.html" title="Xem thêm">›› Xem thêm</a></div>
        <div class="container-tintuc">
            <div id="scroll-kehoach" tabindex="0" style="">
                @if(isset($getSchoolPlan[0]->id))
                    @foreach ($getSchoolPlan as $key => $row)
                        @if($key < 5)
                        <?php $date = date_create($row->updater_date); ?>
                        <div class="kehoach-item">
                            <div class="ngaytaokh">
                                <p><br>Tháng<br><span><b>{{date_format($date, 'm')}}</b></span></p>
                            </div>
                            <div class="tenkh">
                                <a href="{{ asset("ke-hoach-cua-truong/$row->slug-$row->id.html")}}" title="{{$row->title}}">
                                    <h3>{{$row->title}}</h3>
                                    @if($key < 3)
                                    <img src="https://media1.giphy.com/media/KfSiYkxnYmWKmIgAsk/200.webp?cid=790b7611efed01f9247bf131934a36324ae9fe086c4981fb&rid=200.webp" width="70px">
                                    @endif
                                </a>
                                <div></div>
                            </div>
                            <div class="ngaydangkh">Ngày đăng: {{date_format($date, 'H:i, d/m/Y')}}</div>
                        </div>
                        @endif
                    @endforeach
                @endif
    
            </div>
        </div>
    </div>
    <!-- End Kế hoạch của trường -->
    <!-- Begin Thông tin chung -->
    <div class="block-news-fir">
        <div class="thanh_title"><p><span>Thông tin chung</span></p></div>
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
                            @if(isset($getAchievements->id))
                                <a href="{{ asset("thong-tin-chung/$getAchievements->slug-$getAchievements->id.html")}}" title="{{$getAchievements->title}}" target="_blank">
                                   <img src='{{URL::asset("/uploads/$getAchievements->filename")}}' class="show" pos-name="pa01" width="100%"/>
                                </a> 
                            @endif
                            @if(isset($getResult->id))
                                <a href="{{ asset("thong-tin-chung/$getResult->slug-$getResult->id.html")}}" title="{{$getResult->title}}" target="_blank">
                                   <img src='{{URL::asset("/uploads/$getResult->filename")}}' class="hide" pos-name="pa02" width="100%"/>
                                </a> 
                            @endif
                            @if(isset($getTypicalStudents->id))
                                <a href="{{ asset("thong-tin-chung/$getTypicalStudents->slug-$getTypicalStudents->id.html")}}" title="{{$getTypicalStudents->title}}" target="_blank">
                                   <img src='{{URL::asset("/uploads/$getTypicalStudents->filename")}}' class="hide" pos-name="pa03" width="100%"/>
                                </a> 
                            @endif
                            @if(isset($getMedia->id))
                                <a href="{{ asset("thong-tin-chung/$getMedia->slug-$getMedia->id.html")}}" title="{{$getMedia->title}}" target="_blank">
                                   <img src='{{URL::asset("/uploads/$getMedia->filename")}}' class="hide" pos-name="pa04" width="100%"/>
                                </a> 
                            @endif
                           <!--  <img src="images/frontend/main/thanh-tich.jpg" class="show" pos-name="pa01" width="100%"/>
                            <img src="images/frontend/main/ket-qua-dat-duoc.jpg" class="hide" pos-name="pa02" width="100%"/>
                            <img src="images/frontend/main/hoc-sinh-tieu-bieu.jpg" class="hide" pos-name="pa03" width="100%"/>
                            <img src="images/frontend/main/bao-dai.jpg" class="hide" pos-name="pa04" width="100%"/> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Thông tin chung -->