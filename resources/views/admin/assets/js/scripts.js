import 'bootstrap';
import $ from 'jquery';
import 'material-icons';

window.$ = window.jQuery = $;

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
