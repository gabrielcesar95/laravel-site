import 'bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;
window.toastr = require('toastr');
window.SimpleBar = require('simplebar/dist/simplebar');
window.Swal = require('sweetalert2');
window.CKEDITOR_BASEPATH = '../admin/assets/js/ckeditor/';

require('ckeditor');
require('bootstrap4-toggle');
require('select2/dist/js/select2.full.min');
require('inputmask/dist/min/jquery.inputmask.bundle.min');

/*
 **********************************************************************
 *************************** GENERAL CONFIG ***************************
 **********************************************************************
*/

$(document).ready(function () {
    setTooltips();
    setMasks();
    setSelects();
});

// Select2 pt-BR Translation
!function () {
    if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd) var e = jQuery.fn.select2.amd;
    e.define("select2/i18n/pt-BR", [], function () {
        return {
            errorLoading: function () {
                return "Os resultados não puderam ser carregados."
            }, inputTooLong: function (e) {
                var n = e.input.length - e.maximum, r = "Apague " + n + " caracter";
                return 1 != n && (r += "es"), r
            }, inputTooShort: function (e) {
                return "Digite " + (e.minimum - e.input.length) + " ou mais caracteres"
            }, loadingMore: function () {
                return "Carregando mais resultados…"
            }, maximumSelected: function (e) {
                var n = "Você só pode selecionar " + e.maximum + " ite";
                return 1 == e.maximum ? n += "m" : n += "ns", n
            }, noResults: function () {
                return "Nenhum resultado encontrado"
            }, searching: function () {
                return "Buscando…"
            }, removeAllItems: function () {
                return "Remover todos os itens"
            }
        }
    }), e.define, e.require
}();

/*
 **********************************************************************
 ****************************** FUNCTIONS *****************************
 **********************************************************************
*/

function ajaxSearch(options) {
    
    if (options.page && options.data) {
        options.data = options.data + ('&_page=' + options.page);
    }
    
    if (options.order && options.data) {
        options.data = options.data + ('&_order=' + options.order.column);
        options.data = options.data + ('&_order_direction=' + options.order.direction);
    }
    
    $.ajax({
        type: options.method,
        url: options.action,
        timeout: 10000,
        dataType: "html",
        processData: false,
        contentType: false,
        data: options.data,
        beforeSend: function () {
            $('#main-list').html(
                $('<div>')
                    .addClass('w-100 d-flex justify-content-center py-5')
                    .append(
                        $('<div>')
                            .addClass('spinner-border text-primary')
                            .attr({
                                'role': 'status'
                            })
                            .append(
                                $('<span>')
                                    .addClass('sr-only')
                                    .text('Carregando')
                            )
                    )
            );
        },
        success: function (response) {
            $('#main-list').html(response);
        },
        error: function (xhr, status) {
            $('#main-list').html('')
        }
    });
}

function setTooltips() {
    $('[data-toggle="tooltip"]').tooltip({
        placement: 'auto'
    });
}

function setToggles() {
    $('[data-toggle="toggle"]').bootstrapToggle();
}

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

function setSelects() {
    $('.select2').each(function () {
        let elem = $(this);
        
        elem.select2({
            theme: 'bootstrap4',
            language: 'pt-BR',
            dropdownParent: elem.parent(),
        });
    });
}


/*
 **********************************************************************
 *************************** EVENT HANDLERS ***************************
 **********************************************************************
*/

$(document).on('click', '[data-trigger-submit]', function (event) {
    event.preventDefault();
    
    $('#' + $(this).data('trigger-submit')).submit();
});

/* **************************** FILTERS **************************** */

$(document).on('submit', '[data-search-form]', function (event) {
    event.preventDefault();
    
    let form = {
        method: $(this).attr('method'),
        action: $(this).attr('action'),
        data: $(this).serialize()
    };
    
    ajaxSearch(form);
});

$(document).on('click', '[data-search-page]', function (event) {
    event.preventDefault();
    
    let href = $(this).attr('href');
    let search_form = $(document).find('[data-search-form]');
    let page = href.substr(href.indexOf('?page=') + 6);
    let order = $('#main-list').find('th a[data-search-order-active]');
    
    let options = {
        method: search_form.attr('method'),
        action: search_form.attr('action'),
        data: search_form.serialize(),
        page: page,
        order: {
            column: order.data('search-order'),
            direction: order.data('search-order-direction') == 'asc' ? 'desc' : 'asc'
        }
    };
    ajaxSearch(options);
});

$(document).on('click', '[data-search-order]', function (event) {
    event.preventDefault();
    
    let search_form = $(document).find('[data-search-form]');
    let options = {
        method: search_form.attr('method'),
        action: search_form.attr('action'),
        data: search_form.serialize(),
        order: {
            column: $(this).data('search-order'),
            direction: $(this).data('search-order-direction')
        }
    };
    
    ajaxSearch(options);
    
});

$(document).on('click', '[data-search-clear]', function (event) {
    let form = $(document).find('[data-search-form]:first');
    let inputs = {
        inputs: form.find('input[name$="[value]"]'),
        selects: form.find('select'),
    };
    
    inputs.inputs.val('');
    $(inputs.selects).each(function (key, val) {
        let option = $(this).find('option:first');
        
        $(this).val(option.val());
    });
    
    form.submit();
});

/* **************************** POP-UP ***************************** */

$(document).ajaxError(function (event, xhr, settings) {
    switch (xhr.status) {
        case 401:
        case 403:
            toastr.error("Você não tem permissão para essa atividade");
            break;
    }
});

$(document).on('click', '[data-trigger-popup]', function (event) {
    
    event.preventDefault();
    
    let options = {
        url: $(this).data('trigger-popup'),
        data: $(this).data('popup-data'),
        size: $(this).data('popup-size')
    };
    
    let parent = $(this).parents('.modal');
    let modal = $('.modal:first');
    
    if (parent.length > 0) {
        modal.parent().append(
            $('<div>')
                .addClass('modal')
        );
        modal = $('.modal:last');
    }
    
    $.get({
        url: options.url,
        data: options.data,
        dataType: 'html',
        success: function (view) {
            modal.html(view).modal();
            
            modal.find('.modal-dialog').addClass(options.size ? 'modal-' + options.size : '');
            
            setTooltips();
            setToggles();
            setMasks();
            setSelects();
        },
    })
    
});

$(document).on('submit', '.modal-dialog form', function (event) {
    event.preventDefault();
    
    let form = $(this);
    let modal = $(this).parents('.modal-dialog');
    let request = {
        method: form.attr('method'),
        action: form.attr('action'),
        data: new FormData(form[0]),
        alerts_div: modal.find('#alerts')
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
            window.loading = Swal.fire({
                html: $('<div>')
                    .addClass('w-100 d-flex justify-content-center py-5')
                    .append(
                        $('<div>')
                            .addClass('spinner-border text-primary')
                            .attr({
                                'role': 'status'
                            })
                            .append(
                                $('<span>')
                                    .addClass('sr-only')
                                    .text('Carregando')
                            )
                    ),
                customClass: {
                    popup: 'bg-transparent'
                },
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false
            });
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
            loading.close();
        }
    });
    
});

$(document).on('change', '.custom-file input[type="file"]', function (event) {
    let files = $(this)[0].files;
    let label = $(this).siblings('.custom-file-label');
    let total_files = files.length;
    
    
    if (total_files) {
        if (total_files > 1) {
            label.text(total_files + ' arquivos selecionados');
        } else {
            label.text(files[0].name);
        }
    } else {
        label.text('Selecionar Arquivo(s)');
    }
});

$(document).on({
    'show.bs.modal': function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    },
    'hidden.bs.modal': function () {
        if ($('.modal:visible').length > 0) {
            // restore the modal-open class to the body element, so that scrolling works
            // properly after de-stacking a modal.
            setTimeout(function () {
                $(document.body).addClass('modal-open');
            }, 0);
        }
    }
}, '.modal');

/* ************************* NOTIFICATIONS ************************* */

$(document).on('show.bs.dropdown', '#notifications-wrap', function (event) {
    $.ajax({
        type: 'get',
        url: window.location.protocol + '//' + window.location.host + '/adm/notificacoes/listar',
        timeout: 10000,
        dataType: "json",
        beforeSend: function () {
            $('#notifications').html(
                $('<div>')
                    .addClass('w-100 d-flex justify-content-center')
                    .append(
                        $('<div>')
                            .addClass('spinner-border spinner-border-sm text-primary')
                            .attr({
                                'role': 'status'
                            })
                            .append(
                                $('<span>')
                                    .addClass('sr-only')
                                    .text('Carregando')
                            )
                    )
            );
        },
        success: function (response) {
            if (response.length < 1) {
                $('#notifications').html(
                    $('<span>')
                        .addClass('dropdown-item-text')
                        .text('Nenhuma notificação. Bom trabalho! 😉')
                )
            } else {
                $('#notifications').html('');
                
                $(response).each(function (kn, notification) {
                    $('#notifications')
                        .append(
                            $('<a>')
                                .addClass('dropdown-item d-flex flex-column')
                                .append(
                                    $('<p>')
                                        .addClass('text-bold mb-0')
                                        .text(notification.data.title)
                                )
                                .append(
                                    $('<small>')
                                        .text(notification.data.date)
                                )
                        );
                    
                    if (notification.data.attr) {
                        $('#notifications a:last').attr(notification.data.attr);
                        
                        if (!notification.data.attr.href) {
                            $('#notifications a:last').attr('href', '#');
                        }
                    }
                    
                    $('#notifications a:last').attr('data-id', notification.id);
                });
            }
        },
        done: function () {
            $('#notifications').html('');
        }
    });
    
    $(document).on('click', '#notifications .dropdown-item', function () {
        let id = $(this).data('id');
        
        $.ajax({
            type: "post",
            url: window.location.protocol + '//' + window.location.host + '/adm/notificacoes/visualizar/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            timeout: 10000,
            success: function (response) {
                console.log(response);
            },
        });
    });
});
