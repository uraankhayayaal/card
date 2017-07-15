/*$('.cabinet-card').mouseenter(function() {
	console.log($(this));
	$(this).text('');
})*/

$('.add_card_btn').click(function() {
	$('#company_id').val($(this).attr('id'));
});

$(function() {
	$('#card_create').on('submit', function(e) {
		e.preventDefault();
		var $that = $(this),
		formData = new FormData($that.get(0));
		$.ajax({
			url: $that.attr('action'),
			type: $that.attr('method'),
			contentType: false,
			processData: false,
			data: formData,
			dataType: 'json',
			success: function(data) {
            	$('.modal').modal('hide');
				$('#cards-'+data.company_id).append('<a href="card/view?id='+data.id+'"><img src="'+data.path+'" class="cabinet-card pull-left"></a>');
			},
			error: function(data) {
				console.log(data);
			}
		});
	});
});

$('.btn-address').click(function() {
	var company_id = $(this).data('company_id');
	$('#address').html('');
	$.ajax({
		url: 'address/list',
		type: 'POST',
		data: {company_id: company_id},
		dataType: 'JSON',
		success: function(data) {
			$.each(data, function(key, address) {
				$('#address').append('<p>'+ ++key +'. <a href="address/view?id='+address.id+'">'+address.value+'</a></p>');
			});
			$('#btn-add-address').data('add_address', company_id);
			//$('#address').append('<p><button class="btn btn-success pull-right" id="btn-add-address" data-add_address="'+company_id+'">Добавить</button></p>');
		},
		error:function(data) {
			console.log(data);
		}
	});
});

$('#btn-add-address').click(function() {
	$('#address-company_id').val($('#btn-add-address').data('add_address'));
	$('.modal').modal('hide');
	$('#AddAddress').modal('show');
});

$(function() {
	$('#address_create').on('submit', function(e) {
		e.preventDefault();
		var $that = $(this),
		formData = new FormData($that.get(0));
		$.ajax({
			url: $that.attr('action'),
			type: $that.attr('method'),
			contentType: false,
			processData: false,
			data: formData,
			dataType: 'json',
			success: function(data) {
            	$('.modal').modal('hide');
			},
			error: function(data) {
				console.log(data);
			}
		});
	});
});