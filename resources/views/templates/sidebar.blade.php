
<div class="left-sidebar">
    <h2>Danh mục</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @if(isset($arrCategory) && !empty($arrCategory))
            @foreach($arrCategory as $row)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#neo{{ $row['id'] }}">
                            <span class="badge pull-right">@if(isset($row['level2']))<i class="fa fa-plus"></i>@endif</span>
                        
                            {{ $row['category_nm'] }}
                        </a>
                    </h4>
                </div>
               
                @if(isset($row['level2']))
               
                    <div id="{{ 'neo'.$row['id'] }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($row['level2'] as $item)
                                <?php $url = $row['slug']."/".$item['slug']."-".$item['id'].".html" ?>
                                    <li><a href="{{ asset($url)}}">{{ $item['category_nm'] }} </a></li>
                                    <!-- <li><a href="#">Under Armour </a></li>
                                    <li><a href="#">Adidas </a></li>
                                    <li><a href="#">Puma</a></li>
                                    <li><a href="#">ASICS </a></li> -->
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif  <!-- end category level 2-->
                
            </div>
            @endforeach
         @endif <!-- end category level 1-->
    
    </div><!--/category-products-->

    <div class="brands_products"><!--brands_products-->
        <h2>Nhãn hiệu</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
            </ul>
        </div>
    </div><!--/brands_products-->
    
    <div class="price-range"><!--price-range-->
        <h2>Khoảng giá</h2>
        <div class="well text-center">
             <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
             <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div><!--/price-range-->
    
    <div class="shipping text-center"><!--shipping-->
        <img src="images/frontend/imgs_template/home/shipping.jpg" alt="" />
    </div><!--/shipping-->

</div>