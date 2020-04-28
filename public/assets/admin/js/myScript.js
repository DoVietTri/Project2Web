$("div.alert").delay(3000).slideUp();

function confirmDelete(msg) {
	if( window.confirm(msg) ) {
		return true;
	}
	return false;
}

$(document).ready(function(){
	$("a#del_img_demo").on('click', function (){
		var url = "http://localhost/WebGiay/admin/product/delImg/";

		var _token = $("form[name=frmEditProduct]").find("input[name='_token']").val();

		var idHinh = $(this).parent().find("img").attr("idHinh");
		var img = $(this).parent().find("img").attr("src");
		var rid = $(this).parent().find("img").attr("id");
		var idButton = $(this).parent().find("a").attr('idButton');

		$.ajax({
			url: url + idHinh,
			type: 'GET',
			cache: false,
			data: {
				"_token":_token,
				"idHinh": idHinh, 
				"urlHinh" : img
			},
			success: function (data){
				if (data == "Oke") {
					$("#" + idButton).remove();
				} else {
					alert("Lỗi");
				}
			}
		});

	$('.view_info_order').on(click, function() {
		$('#view_order_detail').modal({
			show : true
		})
		console.log(111);
	});
});

