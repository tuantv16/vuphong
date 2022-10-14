@extends('welcome')
@section('directional')

	<div class="">
    <div class="panel panel-default frame564175037f8b9a474e8b4567 frameOptionb9ac4e8a7c panel-article-right panel-article-detail" id="frameBoundB581c23695bef7">
        <div class="panel-heading" style="background: #0071a6; color: white; font-weight: bold; text-transform: uppercase; min-height: 40px;">
            <div class="panel-title">        	
            		{{$panelTitle}} 
        	</div>
        </div>
        <div class="panel-body">
            <div id="module22" class="ModuleWrapper" modulerootid="3090929">
                <section id="section22" class="section-list Article-Detail-listType4">
                	@if(isset($documentSubject[0]->id))
                	@foreach($documentSubject as $key => $row)
	                	<?php 
	                		$date = date_create($row->updater_date);
			                $content = getplaintextintrofromhtml($row->content);
			        	?>
                    <article itemscope="" itemtype="http://schema.org/NewsArticle" data-id="5ddc89ff30817e78732cbb74" class="item-block listType4 Article-News">
                        <div class="post-item row clearfix">
                            <div class="col-xs-12 col-sm-5 col-md-4 left-listType4">
                                <figure class="post-image">
                                    <div class="mask"></div>
                                    <a href="{{ asset("$row->id/$row->slug-$row->id.html")}}" title="{{$row->slug}}">
                                    	<?php 
                                    		if(file_exists( public_path().'/uploads/'.$row->filename) && $row->filename != '' ) {
                                    	?>          	
                                    		<img class="post-image relative-height" data-size-ratio="3:2" width="100%" src='{{URL::asset("/uploads/$row->filename")}}' alt="{{$row->slug}}" itemprop="image" style="height: 161px;">
										<?php } else { ?>
												<img class="post-image relative-height" data-size-ratio="3:2" width="100%" src='{{URL::asset("/uploads/noimage/no-image-news.png")}}' alt="{{$row->slug}}" itemprop="image" style="height: 161px;">
										<?php } ?>
										
                                    </a>
                                </figure>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-8">
                                <div class="post-title" style="margin-top:-10px">
                                    <h5 class="entry-title" itemprop="headline">
                                    	<a href="{{ asset("$row->id/$row->slug-$row->id.html")}}">{{$row->title}}</a>
                                    </h5>
                                </div>
                                <div class="pub-date"> <i class="fa fa-calendar-check-o" aria-hidden="true" style="color:red"></i>
                                    <time class="post-date updated" datetime="2019-11-26T09:08:00+07:00">{{date_format($date, 'd/m/Y')}}</time>
                                </div>
                                <div class="brief"><b> {{_cutTect($content,400)}}</b></div>
                            </div>
                        </div>
                    </article>
                    <?php echo ($key != count($documentSubject)-1)?'<hr/>':''?>
           
          			@endforeach
          			@else
						{{ "Chưa có bài viết nào" }}
          			@endif
          			<div class="text-center">
		                {{ $documentSubject->appends(['sort' => 'post.id'])->links() }}
		            </div>    
                    <div class="clearfix"></div>
                </section>
            </div>
        </div>
    </div>
</div>
@stop