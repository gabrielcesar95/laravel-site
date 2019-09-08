import 'bootstrap';
import $ from 'jquery';
import 'material-icons';

window.$ = window.jQuery = $;

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});


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
    
    // form.data += '&_order=name_asc';
    
    console.log(form);
    
    $.ajax({
    	type: form.method,
    	url: form.action,
    	timeout: 10000,
    	dataType: "html",
    	processData: false,
        contentType: false,
    	data: form.data,
    	beforeSend: function(){
    	    $('#main-list').html('');
    	},
    	success: function(response){
    	    $('#main-list').html(response);
    	    
    	    
    	    console.log('request succesful');
    	},
    	error: function (xhr, status) {
    		console.log([status, xhr]);
    		alert(status + ':\n' + xhr);
    	}
    });
});
