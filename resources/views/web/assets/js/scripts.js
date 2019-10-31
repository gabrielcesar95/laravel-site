import 'bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;
window.toastr = require('toastr');

require('inputmask/dist/min/jquery.inputmask.bundle.min');

/*
 **********************************************************************
 *************************** GENERAL CONFIG ***************************
 **********************************************************************
*/

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    setMasks();
});

/*
 **********************************************************************
 ****************************** FUNCTIONS *****************************
 **********************************************************************
*/

function setMasks() {
    $('.mask-datetime').inputmask({'mask': '99/99/9999 99:99'});
    $('.mask-zipcode').inputmask('99999-999', {
        'oncomplete': function (a, b, c) {
            zipCodeSearch($(this).val(), $(this).parents('.form-row'));
        }
    });
    $('.mask-phone').inputmask({
        mask: function () {
            return ['(99) 9999-9999', '(99) 99999-9999'];
        }
    });
}

/*
 **********************************************************************
 *************************** EVENT HANDLERS ***************************
 **********************************************************************
*/

$(document).on('submit', '[data-ajax]', function (event) {
    event.preventDefault();
    
    let form = $(this);
    let request = {
        method: form.attr('method'),
        action: form.attr('action'),
        data: new FormData(form[0]),
        alerts_div: form.find('.alerts')
    };
    
    $.ajax({
        type: request.method,
        url: request.action,
        timeout: 10000,
        dataType: "json",
        processData: false,
        contentType: false,
        async: true,
        data: request.data,
        beforeSend: function () {
        
        },
        success: function (response) {
            if (response.refresh) {
                location.reload();
            } else if (response.redirect) {
                window.location.href = response.redirect;
            }
        },
        error: function (xhr, status) {
            if (xhr.status == 422 && xhr.responseJSON.errors) {
                request.alerts_div.find('div.alert').remove();
                $.each(xhr.responseJSON.errors, function (key, error) {
                    request.alerts_div.append(
                        $('<div>')
                            .addClass('alert alert-danger alert-dismissable fade show mb-1 py-1')
                            .attr({
                                'role': 'alert'
                            })
                            .append(
                                error
                            )
                            .append(
                                $('<button>')
                                    .addClass('close')
                                    .attr({
                                        'type': 'button',
                                        'data-dismiss': 'alert',
                                        'aria-label': 'Fechar'
                                    })
                                    .append(
                                        $('<span>')
                                            .attr({
                                                'aria-hidden': 'true'
                                            })
                                            .html('&times;')
                                    )
                            )
                    );
                    
                    form.find('[name="' + key + '"], [name="' + key + '[]"]').addClass('is-invalid');
                });
            }
        },
        complete: function (xhr, status) {
        
        }
    });
    
});
