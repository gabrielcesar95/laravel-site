import 'bootstrap';
import $ from 'jquery';
import 'material-icons';

window.$ = window.jQuery = $;

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

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
                                    .text('Carreando')
                            )
                    )
            );
        },
        success: function (response) {
            $('#main-list').html(response);
        },
        error: function (xhr, status) {
            console.log([status, xhr]);
            alert(status + ':\n' + xhr);
        }
    });
}

/*
 **********************************************************************
 *************************** EVENT HANDLERS ***************************
 **********************************************************************
*/

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
