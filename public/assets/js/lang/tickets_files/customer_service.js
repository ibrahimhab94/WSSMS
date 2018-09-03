var __CustomerService = function () {
    $("a[data-ref=customer]").on('click', function (e) {
        __CustomerModal($(this));
    });
    return true;
};
var __CustomerModal = function (obj) {
    console.log(obj.parent().parent());
};
var __AsignCustomerToId = function () {
    $("#customer_name").on('focus', function (e) {
        e.preventDefault(e);
        if ($(this).val() === '')
            $(this).dblclick(); 
    });
    $("#customer_name").dblclick(function (e) {
        e.preventDefault(e);

        $("#customersModal").modal('show');
    });
    $("button.table_hidden_select").on('click', function (e) {
        e.preventDefault(e);
        var current = $(this).parent().parent();
        var id = $(current).attr('data-customer-id');
        ticket_form.customer_name.value = $(current).find('td[data-customer-content=name]').text();
        ticket_form.customer_id.value = id;
        ticket_form.customer_mobile.value = $(current).find('td[data-customer-content=mobile]').text();
        ticket_form.customer_address.value = $(current).find('td[data-customer-content=address]').text();

        $("#customersModal").modal('hide');
    });
};
$('#customersModal').on('shown.bs.modal', function () {
    $('#customers_list_table_filter input').trigger('focus')

});

var __makeCustomersTableTabable = function () {
    $(".table_hidden_select").on('focus', function () {
        var id = $(this).attr('id');
        var current = $(this).parent().parent();
        var tbody = $(this).parent().parent().parent();
        $.each($(tbody).children(), function (i, el) {
            $(el).removeClass('active_table_tr_hover');
        });
        $(current).addClass('active_table_tr_hover');
    });
    var tBODY = $("#customers_table_tbody");
    $.each($(tBODY).children('tr'), function (i, el) {
        $(el).on('mousedown', function (e) {
            e.preventDefault(e);
            console.log($(this).find('button.table_hidden_select').focus());
        });
        $(el).on('dblclick', function (e) {
            $(this).find('button.table_hidden_select').focus();
            $(this).find('button.table_hidden_select').click();
        });
    })
};
var CustomerService = {
    'insert': (function (form, table, callback) {
        var url = $(form).attr('action');
        console.log(url);
        console.log($(form)._token);
        var ajax = $.post(url, $(form).serialize());
        var response = ajax.done(function (result) {
            console.log(result);
            if (result.status === 'ok') {
                var ticket_no = result.ticket_no;
                $.smallBox({
                    title: "تم اضافة التذكره باسم احمد",
                    content: "تم اضافة تذكره رقم " +
                            ticket_no +
                            " باسم العميل " +
                            form.customer_name.value,
                    color: "#4da7af",
                    timeout: 10000,
                    icon: "fa fa-bell"
                });
                form.customer_name.value = '';
                form.customer_mobile.value = '';
                form.customer_address.value = '';
                form.customer_full_address.value = '';
                form.customer_issue.value = '';
                form.customer_call_time.value = '';
                form.customer_wanted_date.value = '';
                form.customer_wanted_time.value = '';
            } else {
                $.smallBox({
                    title: "خطأ",
                    content: "راجع مدير النظام",
                    color: "#afa25e",
                    timeout: 10000,
                    icon: "fa fa-bell"
                });
            }
        });
    }),

};
var create_new_customer = function () {
    $("#create_customer_modal").modal('show');
    $(customer_form).on('submit', function (e) {
        e.preventDefault(e);
        var form = customer_form;
        var route = $(form).attr('action');
        var table = $("#customers_list_table");
        var customElementProperty = "<button type=\"radio\" class=\"table_hidden_select\" name=\"a[]\"  active_table_tr_hover=\"\">";
        var request = _add_customer(route, form, table, customElementProperty);
        request.done(function (res) {
            $("#create_customer_modal").modal('hide');
            $("#customersModal").modal('hide');
            console.log($("tr[data-customer-id=" + res.id + "] button.table_hidden_select").attr('name', 'a[' + res.id + ']').attr('active_table_tr_hover', res.id));
            ticket_form.customer_name.value = res.name;
            ticket_form.customer_id.value = res.id;
            ticket_form.customer_mobile.value = res.mobile;
            ticket_form.customer_address.value = res.address;
        });

        console.log(request);
    });
}
function ucf(string) {
    return string[0].toUpperCase() + string.slice(1);
}
;
var __CST_Form = function (form, table) {
    $(form).on('submit', function (e) {
        e.preventDefault(e);
        var form_data = $(form).serializeArray();
        var url = $(form).attr('action');
        var ajax = $.post(url, form_data);

        var optionWithLink = function (id, txt, ref) {
            return "<a class=\"show-" + ref + "\"  data-ref='" + ref + "' data-customer-id='" + id + "' href='#Show&" + ucf(ref) + "=" + id + "'>" + txt + "</a>"
        };
        var options = '<button class="btn"></button>';
        ajax.done(function (_R) {
            console.log(_R);
            if (_R.status == 'ok') {
                table.row.add([_R.id,
                    optionWithLink(_R.customer.id, _R.customer.name, 'customer')
                            , optionWithLink(_R.ticket_no, _R.ticket_no, 'ticket'), _R.time, options]).draw(false);
                table.draw(false);
                ticket_form.reset();
                $.smallBox({
                    title: "تمت اضافة ال,<<<<طلب",
                    content: "تمت اضافة الطلب رقم " + _R.ticket_no + " .. حالة الطلب غير منفذة يرجى عمل اللازم",
                    color: "#afa25e",
                    timeout: 10000,
                    icon: "fa fa-bell"
                });
            }
        });
    });
};

var customer_profile = {
    load: function (id) {
        var customer = $.post('/Dashboard/CustomerService/Customer/Profile/', {
            id: id
        });
        return customer;

    },
    fill: function (profileSelector, profile) {
        var _ = function (a) {
            return profileSelector + " " + _CP(a)
        };
        $(_('avatar')).attr('src', profile.avatar);
        $(_('avatar')).attr('alt', profile.CustomerName);
        $(_('customer_sms')).attr('href', 'javascript:send_sms(' + profile.id + ');');
        $(_('TicketsCount')).text(profile.TicketsCount);// = 'Text';
        $(_('CustomerName')).text(profile.CustomerName);// = 'Text';
        $(_('CustomerRatio')).text(profile.CustomerRatio);// = 'Text';
        $(_('mobile')).text(profile.mobile);// = 'Text';
        $(_('email')).text(profile.email);// = 'Text';
        $(_('address')).text(profile.address);// = 'Text';
        $(_('full_address')).text(profile.full_address);// = 'Text';
    }
};
var customer_tickets = {
    get: function (data) {
        var ajax = $.post('/Dashboard/CustomerService/Customer/Ticket/', data);
        return ajax;
    },
    fillModal: function (modal, data) {
        console.log(data);
        $(modal + " #TicketModalHeader span[data-content=ticket-no]").text(data.ticket.ticket_no);
        $(modal + " a#TicketCustomerName").attr('data-customer-id', data.customer.id).attr('href', '#Show&Customer=' + data.customer.id).text(data.customer.name);
        $(modal + " .ticket_modal[data-content=requierd-time]").text(data.ticket.customer_needed_time);
        $(modal + " .ticket_modal[data-content=customer-issue]").text(data.ticket.customer_issue);
        $(modal + " .ticket_modal[data-content=customer-address]").text(data.ticket.customer_address);
        $(modal + " .ticket_modal[data-content=customer-address-full]").text(data.ticket.customer_full_address);
        $(modal + " .ticket_modal[data-content=ticket_status]").addClass('label-warning').text(data.ticket_status);
        $(modal + " button.ticket_modal[data-link=execute-ticket]").attr('data-ticket-id',data.ticket.id);
        $(modal + " button.ticket_modal[data-link=execute-ticket]").attr('data-ticket-no',data.ticket.ticket_no);
        $(modal + " button.ticket_modal[data-link=close-ticket]").attr('data-ticket-id',data.ticket.id);
        $(modal + " button.ticket_modal[data-link=close-ticket]").attr('data-ticket-no',data.ticket.ticket_no);
        return true;
    }
};