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

function formSend(currentForm, method, onSuccess) {

    let data = $(currentForm).serialize();
    let url = $(currentForm).attr('action');
    console.log(url);
    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function (data) {
            onSuccess(data);

        },
        error: function (errors) {
            checkErrors(errors);
        }
    });
}


$('#saveForm').on('submit', function (e) {
    e.preventDefault();
    let currentForm = this;
    formSend(this, 'POST',function (data) {
        $.notify(data['msg'], "success");
        $(currentForm)[0].reset();
    });
});

$('#editForm').on('submit', function (e) {
    e.preventDefault();
    formSend(this, 'PUT',function (data) {
        $.notify(data['msg'], "success");
    });
});

$('.deleteContact').on('submit', function (e) {
    e.preventDefault();
   let row = $(this).parents('.contact-row');
   row =$(this).parent().parent().parent().parent();

    formSend(this, 'DELETE',function (data) {
        $.notify(data['msg'], "success");
        row.remove();
    });



});
