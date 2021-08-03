// Custom JS Function
// For AJAX Forms
jQuery(function(){ Dashmix.helpers('notify'); });

$.fn.spinbutton = function(action, icon = '', text = '') {
    if (!action) {
        this.find("i").removeClass().addClass("fas fa-sync fa-spin mr-1").parent().removeClass().addClass("btn btn-secondary").prop("disabled", true).find("span").text("Sending...");
    }
    if (action === "error") {
        this.find("i").removeClass().addClass("fas fa-times mr-1").parent().removeClass().addClass("btn btn-danger").prop("disabled", false).find("span").text("Error Occurred");
    }
    if (action === "success") {
        this.find("i").removeClass().addClass("fas fa-check mr-1").parent().removeClass().addClass("btn btn-success").prop("disabled", true).find("span").text("Successful");
    }
    if (action === "reset") {
        this.find("i").removeClass().addClass(icon).parent().removeClass().addClass("btn btn-primary").prop("disabled", false).find("span").text(text);
    }
    return this;
};

// Override Defaults Datatables

$(function() {
    $('.form-control').on('change', function() {
        if ($(this).val()) {
            $(this).parent().addClass("open");
        } else {
            $(this).parent().removeClass("open");
        }
    });
});

ff =  Function.prototype.bind.call(console.log, console, "Fuck Fuck: ");

$.fn.ajaxCreateModal = function(options){
    // Options:
    // slug - element prefix
    // url - ajax URL
    // method - ajax type
    // form - FormData
    // btn_icon - button icon
    // btn_text - button text
    // swal_title - Alert Title
    // swal_text - Alert Text
    var promise = $.ajax({
        type: options.method,
        url: options.url,
        data: options.form,
        dataType: 'json',
        encode: true,
        contentType: false,
        processData: false
    }).done(function (data) {
        if (data.success) {
            $("#"+options.slug).spinbutton("success");
            $("#"+options.slug+"_form").trigger("reset");
            $("#"+options.slug+"_modal").modal('toggle');
            $("#"+options.slug+"_form").trigger("reset");
            $("#"+options.slug).spinbutton("reset",options.btn_icon+" mr-1",options.btn_text);
            Swal.fire({
                icon: 'success',
                title: options.swal_title,
                text: options.swal_text,
                showConfirmButton: false,
                timer: 2000
            })
        } else {
            $("#"+options.slug).spinbutton("reset",options.btn_icon+" mr-1",options.btn_text);
            Swal.fire(
                'Error',
                data.error,
                'error'
            )
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        $("#"+options.slug).spinbutton("reset",options.btn_icon+" mr-1",options.btn_text);
        Swal.fire(
            'Error',
            errorThrown,
            'error'
        )
    });
    return promise;
}
$.fn.ajaxDelete = function(options, afterDoneCallback){
    // Options:
    // url - ajax URL
    // id - delete id
    // swal_title - swal title
    // swal_cancel

    var promise;
    swal.fire({
        title: 'Warning',
        html: options.swal_question,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.value) {;
            promise = $.ajax({
                type:'DELETE',
                url:options.url,
                data:{'id':options.id}
                }).done(function (data) {
                    if(data.success){
                        swal.fire({
                            icon: 'success',
                            title: options.swal_success,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    } else {
                        swal.fire(
                            'Error',
                            'Something went wrong...',
                            'danger'
                        )
                    }
            });
            promise.done(function(data) {
            if (afterDoneCallback) {
                afterDoneCallback(data);
            }});
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swal.fire(
                'Cancelled',
                options.swal_cancel,
                'error'
            )
        }
    })
}
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
