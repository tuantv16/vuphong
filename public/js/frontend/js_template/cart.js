//const { initial } = require("lodash");

$(document).ready(function(){
	initial();
    $(document).on('click', '.add-to-cart', function (e) {
		e.preventDefault();
		let product_id = $(this).closest('.single-products').data('product_id');

		let price = $(this).closest('.single-products').data('price');
		let data = {
			product_id: product_id,
			price: price
		};
		updateCart(data);
		// console.log(product_id);
		// debugger;
		
	});

	// update số lượng giỏ hàng, update session giỏ hàng
	function updateCart(data) {
		// Chưa check mã sản phẩm không tồn tại thì hiện thông báo lỗi
		$.ajax({
			url: '/cart/update-cart',
			type: 'GET',
			dataType: 'json',
			data: data
		}).done(function(res) {
			// console.log(res);
		    //     debugger;
			if (res.status == 200) { // done
                let infoCart = JSON.parse(res.cart);
                $("#icon-cart").text(infoCart['totalProduct']);
                alert('Bạn đã thêm sản phẩm thành công');
				
				//location.href = '/';
			} 
            
            if (res.status == 1001) { // chưa login
                location.href= res.url
            }
		});
	}

	//Xử lý trong màn hình cart.html
	// Tăng, giảm số lượng sản phẩm
	$(document).on('click', '.cart_quantity_up, .cart_quantity_down', function (e) {
		e.preventDefault();
		let nameThis = $(this).get(0).className;
		let quantityElement = $(this).parents('.cart_quantity').find('.cart_quantity_input');
		let quantity = 0;
		if (nameThis == 'cart_quantity_up') {
			quantity = parseInt(quantityElement.attr("value")) + 1;
		}

		if (nameThis == 'cart_quantity_down') {
			quantity = parseInt(quantityElement.attr("value")) - 1;
			if (quantity < 1) {
				quantity = 1;
			}
		}

		if (quantity > 5) {
			alert('Bạn đã đặt vượt quá số lượng quy định');
			return;
		}

		quantityElement.attr("value", quantity); // Cập nhật quantity giao diện
		let priceElement = $(this).parents('.product').find('.cart_total'); 
		let priceProduct = parseInt(priceElement.data("price")) * quantity;
		priceElement.attr('data-price', priceProduct)
		priceElement.find('.cart_total_price').text(currencyFormat(priceProduct));

		//set tổng giá sản phẩm
		totalPriceProduct();
				
	});

	$(document).on('change', '.cart_quantity_input', function (e) {
		e.preventDefault();
		let quantity = $(this).val();
		quantity = parseInt(quantity);
		if (quantity > 5) {
			alert('Bạn đã đặt vượt quá số lượng quy định');
			return;
		}
		let priceElement = $(this).parents('.product').find('.cart_total');
		let priceProduct = parseInt(priceElement.data("price")) * quantity;
		priceElement.attr('data-price', priceProduct)
		priceElement.find('.cart_total_price').text(currencyFormat(priceProduct));	
		//set tổng giá sản phẩm
		totalPriceProduct();
	});

	//xóa row giỏ hàng
	$(document).on('click', '.cart_quantity_delete', function (e) {
		e.preventDefault();
		let countProduct = $('.product').length;
		// Giỏ hàng phải tồn tại ít nhất 1 sản phẩm
		if (countProduct < 2) {
			alert('Không thể xóa sản phẩm.\nGiỏ hàng phải tồn tại ít nhất 1 sản phẩm.');
			return;
		}
		$(this).parents('.product').remove();
		
	});
	
	$(document).on('click', '.cart_quantity_delete', function (e) {
		e.preventDefault();

	});
	

	//debugger;
	// $.ajaxSetup({
	// 	headers: {
	// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 	}
	// });
	// Thực hiện cập nhật giỏ hàng (trong trang cart.html)
	$(document).on('click', '#btn-update-cart', function (e) {
		e.preventDefault();
		let data = {}
		let list_product = [];
		let product_id,price,quantity = 0
		$('.product').each(function(i) {
			list_product[i] = {}; 
			let product_id = $(this).data("product_id");

			let price = $(this).find('.cart_total').data('price');
			let quantity = $(this).find('.cart_quantity').find('.cart_quantity_input').val();
			// list_product[i][product_id] :  1,
			// list_product[i][price] : $(this).find('.cart_total').data('price'),
			// list_product[i][quantity] : $(this).find('.cart_quantity').find('.cart_quantity_input').val(),

			list_product[i] = {
				'product_id': product_id,
				'quantity': quantity,
				'price': price
			};

		});
		data.item = list_product;
		$.ajax({
			url: '/cart/update-table-cart',
			type: 'POST',
			dataType: 'json',
			data: data,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		}).done(function(res) {
			// console.log('aaaaaaa');
			// debugger;
			if (res.status == 200) { // done
				alert('Cập nhật giỏ hàng thành công');
				infoCart();	
				$("#scrollUp").trigger("click");
			} 
		});
	});
	

	
	// Xác nhận đơn hàng. Insert đơn hàng và chi tiết đơn hàng vào bảng order và order detail
	$(document).on('click', '#btn-confirm', function (e) {
		let input_confirm = {
			'remark' : $("#remark").val(),
			'name' : $("#name").val(),
			'address' : $("#address").val(),
			'phone' : $("#phone").val(),
		};
		$.ajax({
			url: '/order/save-order',
			type: 'POST',
			dataType: 'json',
			data: input_confirm,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		}).done(function(res) {
			// console.log('aaaaaaa');
			// debugger;
			if (res.status == 200) { // done
				alert('Insert đơn hàng thành công');
				infoCart();	
				$("#scrollUp").trigger("click");
			} 
		});
	});

});

function initial() {
	//Lấy thông tin cart từ session
	infoCart();

	
}

function totalPriceProduct() {
	//$('.total-price-product')
	let total = 0;
	$('.product').each(function() {
		let price = $(this).find('.cart_total').data('price');
		let quantity = $(this).find('.cart_quantity .cart_quantity_input').val();
		total += (parseInt(price) * parseInt(quantity));
		$('.total-price-product').attr('data-total_product',total)
		$('.total-price-product').find('span').text(currencyFormat(total))
	});
}

function infoCart() {
	data = {};
	$.ajax({
		url: '/cart/info-cart',
		type: 'GET',
		dataType: 'json',
		data: data,
		//headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	}).done(function(res) {
		if (res.status == 200) { // done
			let infoCart = JSON.parse(res.cart);
			$("#icon-cart").text(infoCart['totalProduct']);		
		} 
	});
}


function currencyFormat(number) {
	return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
}