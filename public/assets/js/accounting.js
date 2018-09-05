var modal_account_form = (function(obj){
    $("#"+obj.modal).modal('show');
    form($("#"+obj.form_name));
});
var create_modal = (function(obj){
    //modal_name = obj.modal

    console.log($("#"+obj.modal_btn).on('click',function (e) {
        $("#"+obj.modal).modal('show');
        modal_account_form(obj);
    })[0]);
});
var form = function(data){
    //link = data.form_name
    var form =$(data);
    $(form).on('submit',function (e) {
        var link = $(this).attr('data-href');
        var parameters = $(this).serialize();
        console.log(parameters);
        var ajax = $.post(link,parameters);
        ajax.done(function(e){
            console.log(e);
        });
        e.preventDefault();
        return false;

    })
};
