
@extends('templates.default')
@section('master_layout_content')
<section style="margin-top: -45px">
    <style>
        .borderless tr td{
            border-top:0 !important
        }

    </style>
    <div class="container">
        <div class="row table-responsive" >
            <h2 style="color:#696763">Xác nhận đơn hàng</h2>
            <p>Bạn vui lòng xác nhận thông tin đơn hàng trước khi đến bước hoàn tất đơn hàng.</p>
            <?php 
                if (!empty($quantityArr)) {
                    echo 'Bạn đã lựa chọn <b>'.$quantityArr['total_rows_in_cart']. ' loại mặt hàng</b> với tổng số lượng là <b>'.$quantityArr['quanity_product']. ' sản phẩm</b>';
                }
            ?>
            <h3 style="color:#696763">Chi tiết đơn hàng</h3>
            <div class="col-md-9">
                <table border="0" class="table borderless">
                    <tbody>
                        @if(!empty($infoCart))
                            <?php $totalPrice = 0;?>
                            @foreach($infoCart as $row)
                            <?php 
                                $totalItem = (int)$row["price"] * (int)$row["quantity"];
                                $totalPrice += $totalItem;
                            ?>
                            <tr class="border-0">
                                <td class="text-center"><img src="{{ asset('uploads/'.$row["original_filename"]) }}" alt="{{ $row["slug"] }}" width="60px" height="60px"/></td>
                                <td>{{ $row["title"] }}</td>
                                <td class="text-center">{{ number_format($row["price"], 0, ',', '.') }} <u>đ</u></td>
                                <td class="text-center">x</td>
                                <td class="text-center">{{ $row["quantity"] }}</td>
                                <td class="text-right"> {{ number_format($totalItem, 0, ',', '.') }} <u>đ</u></td>
                            </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="4">Ghi chú</td>
                            <td class="text-right">Giá</td>
                            <td class="text-right">{{ number_format($totalPrice, 0, ',', '.') }} <u>đ</u></td>
                        </tr>
                        <tr>
                            <td colspan="4"><textarea name="remark" id="remark" placeholder="Thêm ghi chú cho đơn hàng"></textarea></td>
                            <td class="text-right">Vận chuyển</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">Giao hàng tận nơi</td>
                            <td class="text-right">0 <u>đ</u></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><b>Tổng cộng</b></td>
                            <td class="text-right">{{ number_format($totalPrice, 0, ',', '.') }} <u>đ</u> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">Khách hàng thanh toán</td>
                            <td class="text-right">{{ number_format($totalPrice, 0, ',', '.') }} <u>đ</u></td>
                        </tr>
                        <tr>
                            <td colspan="6">Ngày cập nhật đơn hàng: {{ $row["updater_date"] }}</td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <?php 
                $name = !empty($infoUser) ? $infoUser['name'] : '';
                $address = !empty($infoUser) ? $infoUser['address'] : '';
                $phone = !empty($infoUser) ? $infoUser['phone'] : '';
            ?>
            <div class="col-md-9" style="margin-bottom: 20px; ">
                <h3 style="color:#696763">Thông tin khách hàng</h3>
                <form class="">
                    <div class="form-group">
                        <label for="name">Tên khách hàng:</label>
                        <input type="text" name="name" class="form-control" id="name" disabled value="{{$name}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ giao hàng:</label>
                        <textarea class="form-control" value="address" id="address" rows="5">{{$address}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" value="{{$phone}}">
                    </div>
                </form>
                 <div class="total_area">
                    <a class="btn btn-default check_out" id="btn-confirm" style="margin-left:0px">Xác nhận</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection