
document.addEventListener('DOMContentLoaded', function () {
	$('.category-delete').on('click', function(event) {
		event.preventDefault();

		let id = $(event.currentTarget).attr('data-category-id');

		console.log(id);

		let isDelete = confirm('Нажмите "OK" для удаления');

		if (isDelete) {
			console.log(id);
			send(id);
		}
	});
});

function send(id) {
	let url = '/categories/delete';
	let data = {
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