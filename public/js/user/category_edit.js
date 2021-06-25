
document.addEventListener('DOMContentLoaded', function () {
	$('#category_edit_button').on('click', function(event) {
		$('.invalid-feedback').hide();

		let name = $('#floatingName').val().trim();
		let id = $('#category_edit_button').attr('data-category-id');

		if (name !== '') {
			console.log(name);
			send(name, id);
		} else {
			$('.invalid-feedback').show();
		}
	});
});

function send(name, id) {
	let url = '/categories/update';
	let data = {
		'category_name': name,
		'category_id': id,
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