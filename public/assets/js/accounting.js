var modal_account_form = (function(obj){
    $("#"+obj.modal).modal('show');

});
var create_modal = (function(obj){
    //modal_name = obj.modal

    console.log($("#"+obj.modal_btn).on('click',function (e) {
        $("#"+obj.modal).modal('show');
        modal_account_form(obj);
    })[0]);
});