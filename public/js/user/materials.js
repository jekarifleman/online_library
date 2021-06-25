
document.addEventListener('DOMContentLoaded', function () {
	$('#find-materials-button').on('click', function(event) {
		let name = $('.form-control').val().trim();
		console.log(name);

		if (name !== '') {
			document.location = '/materials?query=' + name;
		} else {
			document.location = '/materials';
		}
	});

	$('.material-delete').on('click', function(event) {
		event.preventDefault();

		let id = $(event.currentTarget).attr('data-material-id');

		console.log(id);

		let isDelete = confirm('Нажмите "OK" для удаления');

		if (isDelete) {
			console.log(id);
			send(id);
		}
	});
});

function send(id) {
	let url = '/materials/delete';
	let data = {
		'material_id': id,
	}

	$.get(url, data)
		.fail(function (err) {
			console.log(err);
			document.location = '/materials';
		})
		.then(function (response) {
			console.log(response);
			document.location = '/materials';
		});
}