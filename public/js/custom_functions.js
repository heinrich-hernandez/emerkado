/*!
 * AdminLTE v3.1.0 (https://adminlte.io)
 * Copyright 2014-2021 Colorlib <https://colorlib.com>
 * Licensed under MIT (https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE)
 */
$(document).ready(function() {
    //*************************************************************************/

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: true,
        timer: 3000
      });

      $('#compose-textarea').summernote()

    /*$('.toastsDefaultDanger').on("click", function () { // use at later implementation
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });*/

    // Function to update the count of checked items (ACCOUNT APPROVAL COUNT CHECK)
    function updateCheckedCount() {
        var checkedCount = $('.check-item:checked').length;
        $('#checked-count').text(checkedCount);

        if (checkedCount > 0) {
            $('#denied-account-modal').show();
            $('#approved-account-modal').hide();
          } else {
            $('#denied-account-modal').hide();
            $('#approved-account-modal').show();
          }
    }

    // Trigger the count update when any checkbox is clicked
    $('.check-item').on('change', function() {
        updateCheckedCount();
    });

    // Initial count on page load
    updateCheckedCount();

});

function showError(message){
    toastr.error(message);
    //alert('asdasdas');
}

function showWarning(message){
    toastr.warning(message);
    //alert('asdasdas');
}

function showSuccess(message){
    toastr.success(message);
    //alert('asdasdas');
}

//# sourceMappingURL=custom_funtions.js.map
