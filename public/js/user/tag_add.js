
document.addEventListener('DOMContentLoaded', function () {
	$('#tag_add_button').on('click', function(event) {
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
	let url = '/tags/create';
	let data = {
		'tag_name': name,
	}

	$.get(url, data)
		.fail(function (err) {
			console.log(err);
			document.location = '/tags';
		})
		.then(function (response) {
			console.log(response);
			document.location = '/tags';
		});
}