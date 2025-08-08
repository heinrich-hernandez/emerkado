/*!
 * AdminLTE v3.1.0 (https://adminlte.io)
 * Copyright 2014-2021 Colorlib <https://colorlib.com>
 * Licensed under MIT (https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE)
 */
$(document).ready(function() {
    // Initialize Toastr for notifications
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    // Initialize SweetAlert2 for toast notifications
    // Swal.fire({
    //     position: 'top-end',
    //     icon: 'success',
    //     title: 'Your work has been saved',
    //     showConfirmButton: false,
    //     timer: 1500
    //   });

    // Initialize Summernote for rich text editor
    $('#compose-textarea').summernote({
        height: 300, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: true // set focus to editable area after initializing summernote
    });
    
    // Initialize DataTables for tables
    $('#dashboardTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": '10',
    });

    // Initialize Bootstrap tooltips
    $('[data-toggle="tooltip"]').tooltip(); 
    // Initialize Bootstrap popovers
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        placement: 'top',
        html: true,
        content: function() {
            return $(this).data('content');
        }
    });
    // Initialize Bootstrap modal
    $('.modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var modal = $(this);
        // If the button has data attributes, set them in the modal
        if (button.data('title')) {
            modal.find('.modal-title').text(button.data('title'));
        }
        if (button.data('body')) {
            modal.find('.modal-body').html(button.data('body'));
        }
        if (button.data('footer')) {
            modal.find('.modal-footer').html(button.data('footer'));
        }
    });

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: true,
        timer: 3000
      });

      $('#compose-textarea').summernote()

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


