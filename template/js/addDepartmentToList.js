$( document ).ready(function() {
    $( "#organization_id" ).change(function() {
        var id =  $( "#organization_id" ).val();
            $.ajax({
            type: "POST",
            url: "/admin/department/ajaxlist/" + id,
            //data: {department_id: $( "#department_id" ).val()},

            success: function(result){
                 $('#department_id').html(result);
            }
        });
    });
});