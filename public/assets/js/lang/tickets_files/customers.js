var _add_customer = function(route,form,table,custom){
    var ajax = $.post(route,$(form).serializeArray()).done(function(res){
        //console.log(res);
        form.name.value = '';
        form.mobile.value = '';
        form.phone.value = '';
        form.email.value = '';
        form.address.value = '';
        form.address_full.value = '';

        table.append("<tr data-customer-id=\""+res.id+"\">" +
            "<td data-customer-content=\"id\">"+res.id+custom+"</td>" +
            "<td data-customer-content=\"name\">"+res.name+"</td>" +
            "<td data-customer-content=\"mobile\">"+res.mobile+"</td>" +
            "<td data-customer-content=\"address\">"+res.address+"</td>" +
            "</tr>");
        console.log(res);
    });
    return ajax;
};
var _update_customer= function (route,form,table,level,id,callback) {
    if(level === 'get'){
        console.log('get');
        $.post(route,{
            _token:form._token.value,
            method:'get',
            id:id,
        }).done(function(res){
            form.name.value = res.name;
            form.mobile.value = res.mobile;
            form.phone.value = res.phone;
            form.email.value = res.email;
            form.address.value = res.address;
            form.address_full.value = res.full_address == 'undefined' ? res.full_address:"";
        });
    }
    else if(level === 'post'){
        $.post(route,{
            _token:form._token.value,
            name:form.name.value,
            mobile:form.mobile.value,
            email:form.email.value,
            address:form.address.value,
            full_address:form.address_full.value,
            phone:form.phone.value,
            method:'post',
            id:id,
        }).done(function(res){
            if(res.status == 'ok'){
                    $.smallBox({
                        title : "تم تعديل بيانات العميل بنجاح",
                        content : "تم تعديل بيانات العميل : "+form.name.value+" بنجاح",
                        color : "#5384AF",
                        timeout: 10000,
                        icon : "fa fa-bell"
                    });

            }
        }).then(function () {

        });
    }

};