//маска для номера телефона
if (typeof ($.masksLoad) === 'function') {
    var maskList = $.masksSort($.masksLoad('/frontend/web/js/order/phone-codes.json'), ['#'], /[0-9]|#/, 'mask');
    var maskOpts = {
        inputmask: {
            definitions: {
                '#': {
                    validator: "[0-9]",
                    cardinality: 1
                }
            },
        },
        match: /[0-9]/,
        replace: '#',
        list: maskList,
        listKey: 'mask'
    };

    $('#order-phone').inputmasks(maskOpts);
}

// Событие открытия попап заявки
$("body").on("click", '#order', function () {
    $('#from-order').show();
    $('#order-modal .response-success').empty();
    $('#order-form').fadeIn();

});

// Событие закрытия попап заявки
$('#order-form-close').on("click", function () {
    $('#order-form').fadeOut();
});

//отправка данных из попап заявки
$('#from-order').on('beforeSubmit', function (e) {
    e.preventDefault();
    var $this = $(this);
    var $fullName = $this.find('input[name="Order[full_name]"]'),
        $domain = $this.find('input[name="Order[domain]"]'),
        $email = $this.find('input[name="Order[email]"]'),
        $phone = $this.find('input[name="Order[phone]"]');

    $('.order-modal .error').empty();

    var blogVersion = '/' + langId.split('-')[0];
    if (langId == 'en-US') {
        blogVersion = '';
    }

    $.ajax({
        url: blogVersion + '/blog/ajax/send-order/',
        type:'POST',
        dataType: "json",
        data: {
            fullName: $fullName.val(),
            domain: $domain.val(),
            email: $email.val(),
            phone: $phone.val(),
            langId: langId,
        },
        success: function(data) {
            if (data.code == 200) {
                $('#from-order').trigger('reset');
                $('#from-order').hide();
                $('#order-modal .response-success').html(data.message);
            }

            if (data.code == 400) {
                var errors = $.parseJSON(data.message);
                errorsOutput(errors);
            }

        },
        error: function (data) {
            var result = $.parseJSON(data.responseText);
            toastr.error(result.message);
        }
    });

    return false;
});

//Вывод ошибок
function errorsOutput(errors) {
    $.each(errors.input_errors, function(inputName, message) {
        $('#from-order').find('.field-order-' + inputName).addClass('has-error');
        $('#from-order').find('.field-order-' + inputName).children('.help-block-error').html(message);
    });

    $('.order-modal .error').html(errors.common_error);
}