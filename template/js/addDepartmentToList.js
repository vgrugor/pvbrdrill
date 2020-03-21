 $( document ).ready(function() {
    $( "#organization_id" ).change(function () {
        addItemDepartmentsDropDown();
        var now = new Date();
        alert( now );
    });
    
    $( "#department_id" ).change(function () {
        addItemDivisionDropDown();
    });
    
    $( "#division_id" ).change(function () {
        addItemPositionDropDown();
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
            
            var element=document.getElementById('position_id');
            if(element){addItemPositionDropDown();}
        }
    });
}

//заполнения выпадающего списка с должностями
function addItemPositionDropDown() {
    var departmentId =  $( "#department_id" ).val();
    var divisionId =  $( "#division_id" ).val();
        $.ajax({
        type: "POST",
        url: "/admin/position/ajaxlist/" + departmentId + "/" + divisionId,

        success: function(result){
            $('#position_id').html(result);
        }
    });
}