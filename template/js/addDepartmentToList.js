 $( document ).ready(function() {
    $( "#organization_id" ).change(function () {
        addItemDepartmentsDropDown();
    });
    
    $( "#department_id" ).change(function () {
        addItemDivisionDropDown();
    });
});

//заполнения выпадающего списка с названиями отделов
function addItemDepartmentsDropDown() {
    var organizationId =  $( "#organization_id" ).val();
        $.ajax({
        type: "POST",
        url: "/admin/department/ajaxlist/" + organizationId,

        success: function(result){
            $('#department_id').html(result);
                 
            var element=document.getElementById('division_id');
            if(element){addItemDivisionDropDown();}
        }
    });
}

//заполнения выпадающего списка с названиями подразделений
function addItemDivisionDropDown() {
    var departmentId =  $( "#department_id" ).val();
        $.ajax({
        type: "POST",
        url: "/admin/division/ajaxlist/" + departmentId,

        success: function(result){
            $('#division_id').html(result);
        }
    });
}