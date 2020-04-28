$(document).ready(function() {
	$('input.updatecart').click(function() {
		let txtrowid = $(this).attr('id');
		let txtqty = $(this).parent().parent().find('.qty').val();
		let txttoken = $("input[name='_token']").val();


		$.ajax({
			url: 'http://localhost/WebGiay/updatecart/' + txtrowid,
			type: 'get',
			cache: false,
			data: {
				"id": txtrowid,
				"qty": txtqty,
				"_token": txttoken
			},
			success: function(data) {
				if (data == "oke") {
					location.reload();
				}
			}
		});
	});

	$('input.deletecart').click(function(){
		let txtrowid = $(this).attr('id');
		let txttoken = $("input[name='_token']").val();

		$.ajax({
			url: "http://localhost/WebGiay/deletecart/" + txtrowid,
			type:'get',
			cache:false,
			data: {
				"id": txtrowid
			},
			success: function(data) {
				if (data == "oke") {
					location.reload();
				}
			}
		});
	});
});

