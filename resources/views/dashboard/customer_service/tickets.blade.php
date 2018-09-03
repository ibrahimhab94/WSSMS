@extends('layouts.admin.admin_layout')
@section('page_header',__('ar.customerservice.customerservice'))
@section('page_header_subtitle',__('ar.customerservice.tickets'))
@section('customjs')
<script src="/assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="/assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="/assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="/assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="/assets/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js"></script>
<script src="/assets/js/plugin/clockpicker/clockpicker.min.js"></script>
<script src="/assets/js/customers.js"></script>
<script src="/assets/js/customer_service.js"></script>
<script >
    var _CP = function (val) {
        var PS = '.Customer-Profile';//Profile Selector
        var CS = 'data-content';//Content Selector
        return PS + "[" + CS + "=" + val + "]";
    };
    $(document).ready(function () {
        $(function () {
            $("#ctt").val('{{$__Carbon()->now()->format('d / m / Y h:i ')}}');
            //  $('#datetimepicker4').datetimepicker();
        });

        var __LoadProfiles = function () {
            $(" a.show-profile[data-ref=customer]").on('click', function (e) {
                e.preventDefault(e);
                var customer_id = $(this).attr('data-customer-id');
                var ajax = customer_profile.load(customer_id);
                ajax.done(function (res) {
                    customer_profile.fill("#CustomerProfileModal", res)
                });
                $("#CustomerProfileModal").modal('show');
            });
        };
        var __CustomerServicesTickets = function () {
            $("a.show-ticket[data-ref=ticket]").on('click', function (e) {
                e.preventDefault(e);

                var ticket_id = $(this).attr('data-ticket-id');
                var ticket_no = $(this).attr('data-ticket-no');

                var ajax = customer_tickets.get({no: ticket_no, id: ticket_id});
                ajax.done(function (res) {
                    customer_tickets.fillModal("#TicketModal", res)
                });
                $("#TicketModal").modal('show');
            });
        };
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        var waiting_cst_table = $('#waiting_cst_table').DataTable({
            "buttons": [
                'copy', 'excel', 'pdf'
            ],
            "language": {
                "url": "/assets/js/lang/Arabic.json",
            },

            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "oLanguage": {
                "sUrl": "/assets/js/lang/Arabic.json",
                "sSearch": '<span id="search_span" class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            }
        });

        var customers = $('#customers_list_table').DataTable({
            "language": {
                "url": "/assets/js/lang/Arabic.json",
            },
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "oLanguage": {
                "sUrl": "/assets/js/lang/Arabic.json",
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#customers_list_table'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });
        try {
            __CustomerService();
            __AsignCustomerToId();
            __makeCustomersTableTabable();
            __CST_Form(ticket_form, waiting_cst_table);
            __LoadProfiles();
            __CustomerServicesTickets();
        } catch (e) {
            console.log(e);
        }
    });
</script>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">


    </div>
</div>
<section id="widget-grid" class="">

    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-6   ">

            <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false" data-widget-custombutton="false">
                <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="true"
                    data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>{{__('ar.customerservice.tickets_form')}} </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form id="ticket_form" action="{{route('submit_cs_ticket')}}" method="POST" name="ticket_form" class="smart-form"  novalidate="novalidate">
                            <header>
                                {{__('ar.customerservice.add_ticket')}}
                            </header>
                            <input type="hidden" name="customer_id"/>
                            <input type="hidden" name="customer_name_h">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="customer_name" id="customer_name" placeholder="{{__('ar.customerservice.customer_name')}}">

                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                            <input type="text" id="customer_mobile" name="customer_mobile" placeholder="{{__('ar.customers.mobile')}}">
                                        </label>
                                    </section>
                                </div>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <label for="customer_issue" class="input">
                                        <input type="text" name="customer_issue" id="issue" placeholder="{{__('ar.customerservice.customer_issue')}}">
                                    </label>
                                </section>
                                <section>
                                    <label class="textarea" for="customer_issue_details"> <i class="icon-append fa fa-comment"></i>
                                        <textarea rows="5" name="customer_issue_details" placeholder="{{__('ar.customerservice.customer_issue_details')}}"></textarea>
                                    </label>
                                </section>

                                <section>
                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                        <textarea rows="5" name="expected_needs" placeholder="{{__('ar.customerservice.expected_needs')}}"></textarea>
                                    </label>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <label class="input">{{__('ar.customerservice.ticket_type')}}</label>
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" value="0" name="ticket_type" checked="checked">
                                            <i></i>تركيب جديد</label>
                                        <label class="radio">
                                            <input type="radio" value="1" name="ticket_type">
                                            <i></i>صيانة</label>
                                        <label class="radio">
                                            <input type="radio" value="2" name="ticket_type">
                                            <i></i>تركيب كاميرات</label>
                                        <label class="radio">
                                            <input type="radio" value="3" name="ticket_type">
                                            <i></i>صيانة كاميرات</label>
                                        <label class="radio">
                                            <input type="radio" value="4" name="ticket_type">
                                            <i></i>صيانة عامة</label>
                                    </div>
                                </section>
                            </fieldset>
                            <!--<fieldset>
                                <div class="row">
                                <section class="col col-6">
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="id" placeholder="{{__('ar.invoices.invoice_no')}}">
                                    </label>
                                </section>
                                    <section class="col col-6">
                                       <button class="btn btn-success">{{__('ar.invoices.search_for_invoice')}}</button>
                                    </section>
                                </div>
                            </fieldset>-->
                            <fieldset>
                                <section>
                                    <label for="customer_talking_time" class="input">
                                        {{__('ar.customerservice.customer_calling_time')}}
                                        <input type="text" name="customer_call_time" id="ctt" value="{{$__Carbon()->now()->format('d/m/Y h:i ')}}" placeholder="{{__('ar.customerservice.customer_calling_time')}}">
                                    </label>
                                </section>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <div class="form-group">
                                            <label>التاريخ المطلوب</label>
                                            <div class="input-group">
                                                <input type="text" name="customer_wanted_date" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="col col-6">
                                        <div class="form-group">
                                            <label>الساعة :</label>
                                            <div class="input-group">
                                                <input type="text" name="customer_wanted_time" placeholder="Select a Time" data-mask="99:99" class="form-control timepicker">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </fieldset>

                            <fieldset>


                                <section>
                                    <label for="customer_address" class="input">
                                        <input type="text" name="customer_address" id="customer_address" placeholder="{{__('ar.customers.address')}}">
                                    </label>
                                </section>




                                <section>
                                    <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                        <textarea rows="5" name="customer_full_address" placeholder="{{__('ar.customers.address_details')}}"></textarea>
                                    </label>
                                </section>
                            </fieldset>
                            <footer>
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary">
                                    {{__('ar.customerservice.add_ticket_action')}}
                                </button>
                            </footer>
                        </form>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>

        </article>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                <!-- widget options:
                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                                data-widget-colorbutton="false"
                                data-widget-editbutton="false"
                                data-widget-togglebutton="false"
                                data-widget-deletebutton="false"
                                data-widget-fullscreenbutton="false"
                                data-widget-custombutton="false"
                                data-widget-collapsed="true"
                                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>{{__('ar.customerservice.waiting_ticket')}}</h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <table id="waiting_cst_table" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th data-hide="phone" width="1%">#</th>
                                    <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> {{__('ar.customerservice.customer_name')}}</th>
                                    <th data-hide="phone,tablet"><i class="fa fa-fw fa-mobile text-muted hidden-md hidden-sm hidden-xs"></i> {{__('ar.customerservice.ticket_id')}}</th>
                                    <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{__('ar.customerservice.customerorderedtime')}}</th>
                                    <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{__('ar.options')}}</th>
                                </tr>
                            </thead>
                            <tbody id="TicketsWiatingTableContainer">
                                @foreach($waiting_tickets as $ticket)
                                <tr id="">
                                    <td>{{$ticket->id}}</td>
                                    <td><a class="show-profile" data-ref="customer" data-customer-id='{{$ticket->customer->id}}' href='#Show&Customer={{$ticket->customer->id}}'>{{$ticket->Customer->name}}</a></td>
                                    <td><a class="show-ticket" data-ref="ticket" data-ticket-id="{{$ticket->id}}" data-ticket-no="{{$ticket->ticket_no}}" href="#Show&Ticket={{$ticket->ticket_no}}">{{$ticket->ticket_no}}</a></td>
                                    <td>{{$ticket->customer_needed_time}}</td>
                                    <td>
                                <button type="button" data-ticket-id="{{$ticket->id}}" data-ticket-no="{{$ticket->ticket_no}}" class="btn btn-labeled btn-success">  <i class="fa fa-legal"></i> </button>
                                <button type="button" data-ticket-id="{{$ticket->id}}" data-ticket-no="{{$ticket->ticket_no}}" class="btn btn-labeled btn-danger">   <i class="fa  fa-minus-square"></i> </button>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false">
                <!-- widget options:
                                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                                data-widget-colorbutton="false"
                                data-widget-editbutton="false"
                                data-widget-togglebutton="false"
                                data-widget-deletebutton="false"
                                data-widget-fullscreenbutton="false"
                                data-widget-custombutton="false"
                                data-widget-collapsed="true"
                                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>{{__('ar.customerservice.executing_tickets')}}</h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <table id="executing_tickets_table" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="1%" data-hide="phone">#</th>
                                    <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> {{__('ar.customerservice.customer_name')}}</th>
                                    <th data-hide="phone,tablet"><i class="fa fa-fw fa-mobile text-muted hidden-md hidden-sm hidden-xs"></i> {{__('ar.customerservice.ticket_id')}}</th>
                                    <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{__('ar.customerservice.customerorderedtime')}}</th>
                                    <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{__('ar.options')}}</th>
                                </tr>
                            </thead>
                            <tbody id="CustomersTableContainer">
                                @foreach($customers as $customer)
                                <tr id="">
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->mobile}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td><button class="btn"></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- Widget ID (each widget will need unique ID)-->

            <!-- end widget -->

        </article>
    </div>

</section>



<div class="modal fade" id="customersModal" tabindex="-1" role="dialog" aria-labelledby="CustomersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">{{__('ar.customers.list')}}</h4>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <a class="btn btn-success btn-xs" href="javascript:create_new_customer();">{{__('ar.customers.add')}}</a>
                    <table class="table table-striped table-bordered    table-hover" style="width: 100%;" id="customers_list_table">
                        <thead>
                            <tr>
                                <th width="1%" data-hide="phone">#</th>
                                <th data-class="expand">{{__('ar.customerservice.customer_name')}}</th>
                                <th data-hide="phone,tablet">{{__('ar.customers.mobile')}}</th>
                                <th data-hide="phone,tablet">{{__('ar.customers.address')}}</th>
                            </tr>
                        </thead>

                        <tbody id="customers_table_tbody">
                            @foreach($customers as $c)
                            <tr  data-customer-id="{{$c->id}}" class="customers_table_row">
                                <td data-customer-content="id">{{$c->id}}<button type="radio" class="table_hidden_select" name="a[{{$c->id}}]"  active_table_tr_hover="{{$c->id}}"></button>
                                </td>
                                <td data-customer-content="name">{{$c->name}}</td>
                                <td data-customer-content="mobile">{{$c->mobile}}</td>
                                <td data-customer-content="address">{{$c->address}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary">
                    Post Article
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="create_customer_modal" tabindex="-1" role="dialog" aria-labelledby="CreateCustomerModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">{{__('ar.customers.list')}}</h4>
            </div>
            <div class="modal-body">

                <form id="customer_form" action="{{route('add_customer_json')}}" data-form-type="add" method="post" name="customer_form" class="smart-form"  novalidate="novalidate">
                    <header id="form_header">
                        {{__('ar.customers.add')}}
                    </header>
                    <input type="hidden" name="customer_id" data-customer-id="" value=""/>
                    <fieldset>
                        <div class="row">
                            <section class="col col-6">
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="name" placeholder="{{__('ar.customers.name')}}">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input"> <i class="icon-append fa fa-phone"></i>
                                    <input type="text" name="mobile" data-mask="(999) 999-9999" placeholder="{{__('ar.customers.mobile')}}">
                                </label>
                            </section>
                        </div>

                        <div class="row">
                            <section class="col col-6">
                                <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                    <input type="email" name="email" placeholder="{{__('ar.customers.email')}}">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input"> <i class="icon-append fa fa-phone"></i>
                                    <input type="tel" name="phone" placeholder="{{__('ar.customers.phone')}}" data-mask="(999)9999-9999">
                                </label>
                            </section>
                        </div>
                    </fieldset>

                    <fieldset>


                        <section>
                            <label for="address2" class="input">
                                <input type="text" name="address" id="address2" placeholder="{{__('ar.customers.address')}}">
                            </label>
                        </section>




                        <section>
                            <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                <textarea rows="5" name="address_full" placeholder="{{__('ar.customers.address_details')}}"></textarea>
                            </label>
                        </section>
                    </fieldset>
                    {{csrf_field()}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button name="form_btn" type="submit" class="btn btn-primary">
                    {{__('ar.customers.add')}}
                </button>

            </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="TicketModal" tabindex="-1" role="dialog" aria-labelledby="TicketModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="TicketModalHeader">{{__('ar.customerservice.support_ticket')}} <span class="label label-warning" data-content="ticket-no"></span></h4>
            </div>
            <div class="modal-body">
                <table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">
                    <tbody>
                        <tr>
                            <td style="width:100px">{{__('ar.customerservice.ticket.customer_name')}}</td>
                            <td><a id="TicketCustomerName" class="show-profile" data-ref="customer" data-customer-id="" href=""></a></td>
                        </tr>
                        <tr><td style="width: 30%;">{{__('ar.customerservice.requierd_time')}}</td><td><strong class="ticket_modal" data-content="requierd-time"></strong></td>
                        </tr>
                        <tr>
                            <td>{{__('ar.customerservice.customer_issue')}}</td><td class="ticket_modal" data-content="customer-issue"> </td>
                        </tr>
                        <tr>
                            <td>{{__('ar.customerservice.customer_full_address')}}</td><td>
                                <p class="ticket_modal" data-content="customer-address"></p>
                                <p class="ticket_modal" data-content="customer-address-full"></p>
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('ar.options')}}</td><td>
                                <label class="label ticket_modal" data-content="ticket_status"></label>
                                <div class="ticket_modal" data-contnet=ticket-state>
                                    
                                </div>
                                <button type="button" data-link=execute-ticket class="ticket_modal btn btn-labeled btn-success"> 
                                <span class="btn-label"><i class="fa fa-legal"></i></span>
                                
                                {{__('ar.customerservice.ticket.execute_ticket')}}</button>
                                <button type="button" data-link=close-ticket class="ticket_modal btn btn-labeled btn-danger">
                                 <span class="btn-label"><i class="fa fa-minus-square"></i></span>
                                {{__('ar.customerservice.ticket.close_ticket')}}</button>

                            </td>
                        </tr>
                    </tbody>
                </table> 



                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary">
                        Post Article
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
    <div class="modal fade" id="CustomerProfileModal" tabindex="-1" role="dialog" aria-labelledby="CustomerProfileModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{__('ar.customers.list')}}</h4>
                </div>
                <div class="modal-body">



                    <div class="row">


                        <div class="well well-sm">

                            <div class="well well-light well-sm no-margin no-padding">

                                <div class="row">

                                    <div class="col-sm-12">
                                        <div id="myCarousel" class="carousel fade profile-carousel">
                                            <div class="air air-bottom-right padding-10">
                                                <a href="javascript:void(0);" class="btn txt-color-white bg-color-teal btn-sm"><i class="fa fa-check"></i> Follow</a>&nbsp; <a href="javascript:void(0);" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-link"></i> Connect</a>
                                            </div>
                                            <div class="air air-top-left padding-10">
                                                <h4 class="txt-color-white font-md">Jan 1, 2014</h4>
                                            </div>
                                            <ol class="carousel-indicators">
                                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <!-- Slide 1 -->
                                                <div class="item active">
                                                    <img src="/assets/img/demo/s1.jpg" alt="demo user">
                                                </div>
                                                <!-- Slide 2 -->
                                                <div class="item">
                                                    <img src="/assets/img/demo/s2.jpg" alt="demo user">
                                                </div>
                                                <!-- Slide 3 -->
                                                <div class="item">
                                                    <img src="/assets/img/demo/m3.jpg" alt="demo user">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">

                                        <div class="row">

                                            <div class="col-sm-3 profile-pic">
                                                <img class="Customer-Profile" data-content="avatar" src="" alt="">
                                                <div class="padding-10">
                                                    <h4 class="font-md"><strong class="Customer-Profile" data-content="TicketsCount"></strong>
                                                        <br>
                                                        <small>{{__('ar.customerservice.profile.tickets_count')}}</small></h4>
                                                    <br>
                                                    <h4 class="font-md"><strong>419</strong>
                                                        <br>
                                                        <small>{{__('ar.customerservice.profile.invoice_count')}}</small></h4>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <h1><span class="semi-bold Customer-Profile" data-content="CustomerName"></span>
                                                    <br>
                                                    <small class="Customer-Profile" data-content="CustomerRatio"> </small></h1>

                                                <ul class="list-unstyled">
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken Customer-Profile" data-content="mobile"></span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a class="Customer-Profile" data-content="email"></a>
                                                        </p>
                                                    </li>

                                                </ul>
                                                <br>
                                                <p class="font-md">
                                                    <i class="Customer-Profile" data-content="address"></i>
                                                </p>
                                                <p class="Customer-Profile" data-content="full_address"> </p>
                                                <br>
                                                <a class="Customer-Profile btn btn-default btn-xs" data-content="customer_sms"><i class="fa fa-envelope-o"></i>{{__('ar.customerservice.send_sms')}}</a>
                                                <br>
                                                <br>

                                            </div>
                                            <div class="col-sm-3">
                                                <h1><small>{{__('ar.coming_soon')}}</small></h1>
                                                <ul class="list-inline friends-list">
                                                    <li><img src="/assets/img/avatars/1.png" alt="friend-1">
                                                    </li>
                                                    <li><img src="/assets/img/avatars/2.png" alt="friend-2">
                                                    </li>
                                                    <li><img src="/assets/img/avatars/3.png" alt="friend-3">
                                                    </li>
                                                    <li><img src="/assets/img/avatars/4.png" alt="friend-4">
                                                    </li>
                                                    <li><img src="/assets/img/avatars/5.png" alt="friend-5">
                                                    </li>
                                                    <li><img src="/assets/img/avatars/male.png" alt="friend-6">
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">413 more</a>
                                                    </li>
                                                </ul>

                                                <h1><small>{{__('ar.coming_soon')}}</small></h1>
                                                <ul class="list-inline friends-list">
                                                    <li><img src="/assets/img/avatars/male.png" alt="friend-1">
                                                    </li>
                                                    <li><img src="/assets/img/avatars/female.png" alt="friend-2">
                                                    </li>
                                                    <li><img src="/assets/img/avatars/female.png" alt="friend-3">
                                                    </li>
                                                </ul>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12">

                                        <hr>

                                        <div class="padding-10">

                                            <ul class="nav nav-tabs tabs-pull-right">
                                                <li class="active">
                                                    <a href="#a1" data-toggle="tab">{{__('ar.customerservice.profile.recent_activity')}}</a>
                                                </li>
                                                <li>
                                                    <a href="#a2" data-toggle="tab">{{__('ar.customerservice.profile.current_activty')}}</a>
                                                </li>
                                                <li class="pull-left">
                                                    <span class="margin-top-10 display-inline"><i class="fa fa-rss text-success"></i> Activity</span>
                                                </li>
                                            </ul>

                                            <div class="tab-content padding-top-10">
                                                <div class="tab-pane fade in active" id="a1">

                                                    <div class="row">

                                                        <div class="col-xs-2 col-sm-1">
                                                            <time datetime="2014-09-20" class="icon">
                                                                <strong>Jan</strong>
                                                                <span>10</span>
                                                            </time>
                                                        </div>

                                                        <div class="col-xs-10 col-sm-11">
                                                            <h6 class="no-margin"><a href="javascript:void(0);">Allice in Wonderland</a></h6>
                                                            <p>
                                                                Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi Nam eget dui.
                                                                Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                                                sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel.
                                                            </p>
                                                        </div>

                                                        <div class="col-sm-12">

                                                            <hr>

                                                        </div>



                                                        <div class="col-sm-12">

                                                            <br>

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="a2">

                                                    <div class="alert alert-info fade in">
                                                        <button class="close" data-dismiss="alert">
                                                            ×
                                                        </button>
                                                        <i class="fa-fw fa fa-info"></i>
                                                        <strong>51 new members </strong>joined today!
                                                    </div>


                                                    <div class="text-center">
                                                        <ul class="pagination pagination-sm">
                                                            <li class="disabled">
                                                                <a href="javascript:void(0);">Prev</a>
                                                            </li>
                                                            <li class="active">
                                                                <a href="javascript:void(0);">1</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">2</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">3</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">...</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">99</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">Next</a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div><!-- end tab -->
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!-- end row -->

                            </div>




                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary">
                            Post Article
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    

    @endsection