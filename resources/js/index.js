$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function checkErrors(errors) {
    let {name, phone, surname, email} = errors.responseJSON.errors;
    if (name !== undefined) {
        name.map(function (el) {
            $.notify(el, "error");
        })
    }
    if (phone !== undefined) {
        phone.map(function (el) {
            $.notify(el, "error");
        })
    }
    if (surname !== undefined) {
        surname.map(function (el) {
            $.notify(el, "error");
        })
    }
    if (email !== undefined) {
        email.map(function (el) {
            $.notify(el, "error");
        })
    }
}

function deletePhoto(currentItem) {
    let sendData = {
        imageId: $(currentItem).attr('data-id'),
        editId: $(currentItem).attr('data-edit-id')
    };
    let imageName = $(currentItem).attr('data-name');
    let thisItem = $(currentItem);
    let url = $(currentItem).attr('data-url');

    $.ajax(url, {
        type: 'POST',
        data: sendData,
        success: function () {
            $('#' + imageName).attr('src', window.origin + '/default.png');
            thisItem.remove();
            alert('Изображение успешно удалено!')
        },
        error: function () {
            alert('Что-то пошло не так')
        }
    });
}

function formSend(currentForm, method, onSuccess) {

    let url = $(currentForm).attr('action');

    let form_data = new FormData($(currentForm)[0]);

    $(currentForm).serializeArray().map(function (obj) {
        if (name !== 'image') {
            console.log(obj.name);
            form_data.append(obj.name, obj.value);
        }
    })
    let fileInput = $(currentForm).children('#myImage').get(0).files[0];
    form_data.append('image', fileInput);


    $.ajax({
        type: method,
        processData: false,
        contentType: false,
        cache: false,
        url: url,
        data: form_data,
        enctype: 'multipart/form-data',
        success: function (data) {
            onSuccess(data);

        },
        error: function (errors) {
            checkErrors(errors);
        }
    });
}

function setImage(data) {
    $('#contactImage').children().remove();
  let image =   `<div class="mb-3 d-flex flex-column">
        <div class="mb-3">
          <img width=150 id='imageUploaded' src='`+ window.origin + '/storage/' +data['imagePath']+`' alt=''>
        </div>
        <a href="#" data-id="`+data['dataId']+`" data-edit-id="`+data['dataEditId']+`" data-name="imageUploaded" data-url="`+data['dataUrl']+`" data-img-delete class="btn btn-danger w-25 addedDeleteButton">Удалить фото</a>
    </div>`;
    $('#contactImage').append(image);
    $('.addedDeleteButton').bind( "click", function() {
        deletePhoto($('.addedDeleteButton'));
    });
}

$('#saveForm').on('submit', function (e) {
    e.preventDefault();
    let currentForm = this;
    formSend(this, 'POST', function (data) {
        $.notify(data['msg'], "success");
        $(currentForm)[0].reset();
    });
});

$('#editForm').on('submit', function (e) {
    e.preventDefault();
    formSend(this, 'POST', function (data) {
        $.notify(data['msg'], "success");
        console.log(data);
        setImage(data['fromImage']);
    });
});

$('.deleteContact').on('submit', function (e) {
    e.preventDefault();
    let row = $(this).parents('.contact-row');
    row = $(this).parent().parent().parent().parent();

    formSend(this, 'DELETE', function (data) {
        $.notify(data['msg'], "success");
        row.remove();
    });


});
$('[data-img-delete]').on('click', function () {

    deletePhoto(this);
});

