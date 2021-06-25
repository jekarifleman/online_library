
document.addEventListener('DOMContentLoaded', function () {
	$('#tag_edit_button').on('click', function(event) {
		$('.invalid-feedback').hide();

		let name = $('#floatingName').val().trim();
		let id = $('#tag_edit_button').attr('data-tag-id');

		if (name !== '') {
			console.log(name);
			send(name, id);
		} else {
			$('.invalid-feedback').show();
		}
	});
});

function send(name, id) {
	let url = '/tags/update';
	let data = {
		'tag_name': name,
		'tag_id': id,
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