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
    
    let options = {
        method: search_form.attr('method'),
        action: search_form.attr('action'),
        page: page,
        data: search_form.serialize()
    };
    ajaxSearch(options);
});
