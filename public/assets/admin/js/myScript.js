$("div.alert").delay(3000).slideUp();

function confirmDelete(msg) {
	if( window.confirm(msg) ) {
		return true;
	}
	return false;
}

$(document).ready(function(){
	$(".view_info_order").click(function(){
		let id = $(this).data('id');

		$.ajax({
			url : 'http://localhost/WebGiay/admin/order/order/detail/' + id,
			type : 'get',
			success: function(result) {
				$('#view_order_detail .content').html(result.html);
			}
		});
	});

	$("a.delete_image_detail").click(function(){
		var idHinh = $(this).parent().find("img").attr("id");
		//var txt_token = $("form[name=frmEditProduct]").find("input[name='_token']").val();
		// var idImage = $(this).parent().find("img").attr("id");

		$.ajax({
			url: 'http://localhost/WebGiay/admin/product/delImg/' + idHinh,
			type: 'get',
			cache: false,
			data: {
				'id': idHinh
			},
			success: function(data) {
				if (data = "oke") {
					$(this).remove();
					location.reload();
				}
			}
		});
	});

	$("#statusOrder").on('change', function() {

		var status = $(this).val();
		$.ajax({
			url: 'http://localhost/WebGiay/admin/order/order/filter/' + status,
			type: 'get',
			cache: false,
			success: function(data) {
				$(".content_filter").html(data.html);
			}
		});
	});
});