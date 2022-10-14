@extends('welcome')
@section('directional')
	@if(isset($processCat->id))
	<section class="news-detail-default">
	    <article id="article16" itemscope="" itemtype="http://schema.org/NewsArticle" data-id="16" class="Article-News">
	        <meta itemprop="datePublished" content="2020-01-13T17:11:14+07:00">
	        <h2 class="" style="line-height: 1.42857;" itemprop="headline">{{$processCat->title}}</h2>
	        <div class="post-desc">
	            <div class="social clearfix">
	                <div class="news-date" style="margin-right:10px;"><span>Ngày đăng:</span>&nbsp;
	                	<?php
		                    $date = date_create($processCat->updater_date);
		                    echo date_format($date, 'H:i, d/m/Y');
		                ?>
	                </div>
	            </div>
	            <!-- <div class="brief-detail" itemprop="description">
	                <p><i>Sáng ngày 11 tháng 01 năm 2020, trường THPT Trần Nhân Tông đã long trọng tổ chức buổi đón&nbsp; bằng công nhận trường đạt chuẩn Quốc gia, đạt kiểm định chất lượng giáo dục và đạt chuẩn Xanh – Sạch – Đẹp – An toàn sau 13 năm xây dựng và phát triển</i></p>
	            </div> -->
	            <div class="data-content">
	                <div class="content-detail" itemprop="articleBody" style="text-align: justify;">
						{{$processCat->content}}
	                </div>
	            </div>
	            <div class="clearfix mt-10"> </div>
	        </div>
	    </article>
	</section>
	@endif
@stop