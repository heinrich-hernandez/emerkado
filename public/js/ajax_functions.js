/*!
 * E-Merkado Functions
 * Copyright 2024
 * Developer: Julius Paul C. Diez
 */


function delete_coop(id)
{
    if(confirm("Are you sure you want to delete this"))
    {
        $.ajaxSetup({
    headers:
        {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            url:'/admin/coop/delete_coop/'+id,
            type:'DELETE',
            success:function(result)
            {
                $("#"+result['table_row']).remove()
            }
        });
    }
}

function delete_merchant(id)
{
    if(confirm("Are you sure you want to delete this"))
    {
        $.ajaxSetup({
    headers:
        {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            url:'/admin/merchant/delete_merchant/'+id,
            type:'DELETE',
            success:function(result)
            {
                $("#"+result['table_row']).remove()
            }
        });
    }
}


$(function() {
    // Activate COOP record
    $('.approve_coop').on('change', 'approve_coop', function() {
        
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id');
            $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/coop/approve_coop/',
            data: {'status': status, 'id': user_id}, success: function(data) {
            console.log('Success')
            }
        });
    });
});


//# sourceMappingURL=ajax_functions.js.map
