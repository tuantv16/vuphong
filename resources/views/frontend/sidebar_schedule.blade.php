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
                
                    <article itemscope="" itemtype="http://schema.org/NewsArticle" data-id="5ddc89ff30817e78732cbb74" class="item-block listType4 Article-News">
                        <div class="post-item row clearfix">
                            <div class="col-xs-12 col-sm-5 col-md-4 left-listType4">
                                <figure class="post-image">
                                    <div class="mask"></div>
                        
                                    <img class="post-image relative-height" data-size-ratio="3:2" width="100%" src='{{URL::asset("/images/frontend/main/class10.png")}}' alt="" itemprop="image" style="height: 161px;">

                                </figure>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-md-4 left-listType4">
                                <figure class="post-image">
                                    <div class="mask"></div>
                        
                                    <img class="post-image relative-height" data-size-ratio="3:2" width="100%" src='{{URL::asset("/images/frontend/main/class11.png")}}' alt="" itemprop="image" style="height: 161px;">

                                </figure>
                            </div>

                            <div class="col-xs-12 col-sm-5 col-md-4 left-listType4">
                                <figure class="post-image">
                                    <div class="mask"></div>
                        
                                    <img class="post-image relative-height" data-size-ratio="3:2" width="100%" src='{{URL::asset("/images/frontend/main/class12.png")}}' alt="" itemprop="image" style="height: 161px;">

                                </figure>
                            </div>
                        </div>
                    </article>
                      
                    <div class="clearfix"></div>
                </section>
            </div>
        </div>
    </div>
</div>
@stop