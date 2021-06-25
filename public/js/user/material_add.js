
document.addEventListener('DOMContentLoaded', function () {
	$('#material_add_button').on('click', function(event) {
		$('.invalid-feedback').hide();

		let selectType = $('#floatingSelectType').attr('data-type-id');
		let selectCategory = $('#floatingSelectCategory').attr('data-category-id');
		let name = $('#floatingName').val().trim();
		let authors = $('#floatingAuthor').val().trim();
		let description = $('#floatingDescription').val().trim();

		let invalidFedbacks = $('.invalid-feedback');

		if (selectType !== undefined && selectCategory !== undefined && name !== '') {
			console.log(name);
			send(selectType, selectCategory, name, authors, description);
		} else if (selectType === undefined) {
			$(invalidFedbacks[0]).show();
		} else if (selectCategory === undefined) {
			$(invalidFedbacks[1]).show();
		} else if (name === '') {
			$(invalidFedbacks[2]).show();
		}
	});

	$('#floatingSelectType').on('change', function(event) {
        if ($(this).val() != "Выберите тип") {
            $(this).attr('data-type-id' , $(this).val());
        } else {
            $(this).attr('data-type-id' , '');
        }
	});

	$('#floatingSelectCategory').on('change', function(event) {
        $(this).attr('data-category-id' , $(this).val());
	});

});

function send(selectType, selectCategory, name, authors, description) {
	let url = '/materials/create';
	let data = {
		'type_id' : selectType,
		'category_id' : selectCategory,
		'name' : name,
		'authors' : authors,
		'description' : description
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