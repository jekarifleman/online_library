
document.addEventListener('DOMContentLoaded', function () {
	$('.tag-delete').on('click', function(event) {
		event.preventDefault();

		let id = $(event.currentTarget).attr('data-tag-id');

		console.log(id);

		let isDelete = confirm('Нажмите "OK" для удаления');

		if (isDelete) {
			console.log(id);
			send(id);
		}
	});
});

function send(id) {
	let url = '/tags/delete';
	let data = {
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