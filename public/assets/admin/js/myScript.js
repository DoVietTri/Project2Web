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
				console.log(111);
			}
		});
	});
});