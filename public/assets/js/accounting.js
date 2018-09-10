var modal_account_form = (function(obj){
    $("#"+obj.modal).modal('show');
    form($("#"+obj.form_name));
});
var create_modal = (function(obj){
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
var selectizeList = (function (obj) {
    var element = obj.el;
    var returnData = obj.returnData;
    var route = obj.route;
    var fields = obj.fields;
    $(element).selectize({
        valueField: fields.value,
        labelField: fields.label,
        searchField: fields.search,
        create: false,
        render: {
            option: function (item, escape) {
                return returnData(item, escape);

            }
        },
        score: function (search) {
            var score = this.getScoreFunction(search);
            return function (item) {
                return score(item) * (1 + Math.min(item.watchers / 100, 1));
            };
        },
        load: function (query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: route,
                type: 'POST',
                data: query,
                error: function () {
                    callback();
                },
                success: function (res) {
                    callback(res);
                }
            });
        }
    });
});
