@extends('templates.default')
@section('master_layout_content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description">Mô tả sản phẩm</td>
                        <td class="price">Giá cả</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total" style="width:200px">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $totalProduct = 0;
                    ?>
                    @if(!empty($cart['detailCart']))
                        @foreach($cart['detailCart'] as $row)
                        <?php 
                            $totalProduct += $row['price'] * $row['quantity'];
                        ?>
                            <tr class="product" data-product_id={{ $row['product_id'] }}>
                                <td class="cart_product">
                                    <a href=""><img src="{{ asset('uploads/'.$row["detailProduct"]["original_filename"]) }}" alt="" width="110px" height="110px"/></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $row['detailProduct']['title'] }}</a></h4>
                                    <p>Mã SP: {{ 'MS'. $row['product_id'] }}</p>
                                </td>
                                <td class="cart_price">
                                    <p> {{ number_format($row['price'],0, ',', '.') }} <u>đ</u></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $row['quantity'] }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href=""> - </a>
                                    </div>
                                </td>
                                <td class="cart_total" data-price={{$row['price']}}>
                                    <p class="cart_total_price" style="float: right"> {{ number_format($row['totalPrice'],0, ',', '.') }} <u>đ</u></p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Chi phí giỏ hàng</h3>
            <p>Vui lòng thực hiện cập nhật giỏ hàng để lưu thông tin thay đổi</p>
        </div>
        <div class="row">
            <!-- Tuan comment Khuyến mại | Mã giảm giá -->
            <!--
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
             -->
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li class="total-price-product" data-total_product="{{$totalProduct}}">Tổng tiền giỏ hàng <span>{{ number_format($totalProduct, 0, ',', '.') }} <u>đ</u></span></li>
                        <li>Thuế<span> {{ number_format(0, 0, ',', '.') }} <u>đ</u></span></li>
                        <li><del>Phí vận chuyển</del> <span><del>Free</del></span></li>
                        <li class="total-price-product" data-total_product="{{$totalProduct}}">Tổng cộng <span style="font-weight:bold"><b>{{ number_format($totalProduct, 0, ',', '.') }} <u>đ</u></b></span></li>
                    </ul>
                        <a id="btn-update-cart" class="btn btn-default update" href="">Cập nhật giỏ hàng</a>
                        <!-- <a class="btn btn-default check_out" href="">Tiến hành thanh toán</a> Check out-->
                        <a class="btn btn-default check_out" href="{{ asset('confirm.html')}}">Tiến hành xác nhận</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
