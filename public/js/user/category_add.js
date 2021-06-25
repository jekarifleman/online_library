
document.addEventListener('DOMContentLoaded', function () {
	$('#category_add_button').on('click', function(event) {
		$('.invalid-feedback').hide();

		let name = $('#floatingName').val().trim();

		if (name !== '') {
			console.log(name);
			send(name);
		} else {
			$('.invalid-feedback').show();
		}
	});
});

function send(name) {
	let url = '/categories/create';
	let data = {
		'category_name': name,
	}

	$.get(url, data)
		.fail(function (err) {
			console.log(err);
			document.location = '/categories';
		})
		.then(function (response) {
			console.log(response);
			document.location = '/categories';
		});
}