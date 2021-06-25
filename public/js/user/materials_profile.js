
document.addEventListener('DOMContentLoaded', function () {
	$('#button-tag-add').on('click', function(event) {
		event.preventDefault();

		$('.invalid-feedback-select').hide();

		let materialId = $('#button-tag-add').attr('data-material-id');

		let tagId = $('#selectAddTag').val();

		if (materialId !== undefined && tagId != undefined && materialId !== '' && tagId !== 'Выберите тэг') {
			let data = {
				'material_id': materialId,
				'tag_id' : tagId,
			}

			let url = '/collections/add';
			send(data, url);
		} else {
			$('.invalid-feedback-select').show();
		}
	});

	$('.tag-delete').on('click', function(event) {
		event.preventDefault();

		let materialId = $(event.currentTarget).attr('data-material-id');
		let tagId = $(event.currentTarget).attr('data-tag-id');

		let isDelete = confirm('Нажмите "OK" для удаления');

		if (isDelete) {
			let data = {
				'material_id': materialId,
				'tag_id' : tagId,
			}

			let url = '/collections/delete';
			send(data, url);
		}
	});

	$('#button_add_url').on('click', function() {
		let addUrl = '';
		let urlName = '';
		let materialId = document.location.pathname.substr(document.location.pathname.lastIndexOf('/') + 1);

		$('#floatingModalSignature').val('');
		$('#floatingModalLink').val('');

		$('#exampleModalToggleLabel').text('Добавить ссылку');
		$('#button-add-update-url')
			.text('Добавить')
			.attr('data-url-id' , '')
			.attr('data-material-id' , materialId)
			.removeClass('button-update-url')
			.addClass('button-add-url');

		$('.invalid-feedback-first').hide();
	});

	$('.edit-form-url').on('click', function(event) {
		let urlId = $(event.currentTarget).attr('data-url-id');

		$('#floatingModalSignature').val($(event.currentTarget).attr('data-url-name'));
		$('#floatingModalLink').val($(event.currentTarget).attr('data-url'));
		$('#exampleModalToggleLabel').text('Обновить ссылку');
		$('#button-add-update-url')
			.text('Обновить')
			.attr('data-material-id' , '')
			.attr('data-url-id' , urlId)
			.removeClass('button-add-url')
			.addClass('button-update-url');

		$('.invalid-feedback-first').hide();
	});

	$('#button-add-update-url').on('click', function() {
		let elem = $('#button-add-update-url');
		// url для бд
		let url = $('#floatingModalLink').val();
		let urlName = $('#floatingModalSignature').val();
		let materialId;
		let data;
		let urlId;
		// url для api запроса
		let sendUrl;

		if (url.trim() === '') {
			$('.invalid-feedback-first').show();
			return;
		} else if (url.indexOf('http://') === -1 || url.indexOf('https://') === -1) {
			url = 'http://' + url;
		}

		if (urlName.trim() === '') {
			urlName = url;
		}

		if (elem.hasClass('button-add-url')) {
			sendUrl = '/url/add';
			materialId = $('#button-add-update-url').attr('data-material-id');
			data = {
				'material_id': materialId,
				'url' : url,
				'url_name' : urlName,
			}
		} else if (elem.hasClass('button-update-url')) {
			urlId = $('#button-add-update-url').attr('data-url-id');

			if (String(urlId).trim() === '' || typeof Number(urlId) != 'number') {
				console.log('urlId is not number');
				return;
			}

			sendUrl = '/url/update';
			data = {
				'url' : url,
				'url_name' : urlName,
				'url_id' : urlId
			}
		} else {
			console.log('error add or update url');
			return;
		}

		send(data, sendUrl);
	});

	$('.url-delete').on('click', function(event) {
		let urlId = $(event.currentTarget).attr('data-url-id');

		let isDelete = confirm('Нажмите "OK" для удаления');

		console.log(urlId);

		if (isDelete) {
			let data = {
				'url_id' : urlId,
			}

			let url = '/url/delete';
			send(data, url);
		}
	});
});

function send(data, sendUrl) {
	$.get(sendUrl, data)
		.fail(function (err) {
			console.log(err);
			document.location = document.location.pathname;
		})
		.then(function (response) {
			console.log(response);
			document.location = document.location.pathname;
		});
}