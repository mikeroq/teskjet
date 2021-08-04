// Custom JS Function
// For AJAX Forms
jQuery(function(){ Dashmix.helpers('notify'); });



ff =  Function.prototype.bind.call(console.log, console, "Fuck Fuck: ");


$.fn.ajaxOrder = function(options){
    // Options:
    // url - ajax URL
    var promise = $.ajax({
        type: 'GET',
        url: options.url
    }).done(function (data) {
        if (data.success) {

        } else {
            Swal.fire(
            'Error',
            'Something went wrong...',
            'error'
        )
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        Swal.fire(
            'Error',
            errorThrown,
            'error'
        )
    });
    return promise;
}
