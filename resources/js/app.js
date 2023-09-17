import './bootstrap';
import './jquery';
import $ from 'jquery';
window.$ = window.jQuery = $;
import  './TextHighlighter';
import '../css/app.css';

$(".badges").click(function () {
    let url = '/badges';
    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
            $(".modal-body-badges").html(data);
        },
        error: function () {
            alert('Some error occurred, please try again.');
        }
    });
});
