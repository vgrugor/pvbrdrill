$( document ).ready(function() {
    var id =  $( "#organization_id" ).val();
        $.ajax({
            type: "POST",
            url: "/admin/department/ajaxlist/" + id,

            success: function(result){
                 $('#department_id').html(result);
            }
        });
        
    $( "#organization_id" ).change(function() {
        var id =  $( "#organization_id" ).val();
            $.ajax({
            type: "POST",
            url: "/admin/department/ajaxlist/" + id,

            success: function(result){
                 $('#department_id').html(result);
            }
        });
    });
});
