@extends('layouts.admin.admin_layout')
@section('page_header',__('ar.customers.customers'))
@section('page_header_subtitle',__('ar.customers.list'))
@section('customjs')
    <script src="/assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="/assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="/assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
    <script src="/assets/js/customers.js"></script>
    <script >
        var Update_customer = function(id){
            var form = customer_form;
            $(form).attr('data-form-type',"update");
            console.log(form);
            $(form.customer_id).attr('data-customer-id',id);
            form.customer_id.value= id;
            $(form.form_btn).text("{{__("ar.customers.updateform")}}");
            $("#form_header").text('{{__('ar.customers.updateform')}}');
            _update_customer("{{route('update_customer')}}",customer_form,$("#CustomersTableContainer"),'get',id);
            //console.log(func());
        };
        $(document).ready(function() {

            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };
            $('#customers_table').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "oLanguage": {
                    "sUrl": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json",
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#customers_table'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic.respond();
                }
            });
        $("#customer_form").submit(function(e){
            e.preventDefault(e);
            //console.log(add_customer.name.value);
            if($("#customer_form").attr('data-form-type') === "add")
            _add_customer("{{route('add_customer_json')}}",customer_form,$("#CustomersTableContainer"));
            else if($("#customer_form").attr('data-form-type') ==="update"){
                var id =$(customer_form.customer_id).attr('data-customer-id');
                console.log(id);
                _update_customer("{{route('update_customer')}}",customer_form,$("#CustomersTableContainer"),'post',id);
                var form = customer_form;
                $(form.form_btn).text("{{__("ar.customers.add_form_action")}}");
                $("#form_header").text('{{__('ar.customers.add_form')}}');
                form.customer_id.value= id;
                form.name.value = '';
                form.mobile.value = '';
                form.phone.value = '';
                form.email.value= "";
                form.address.value='';
                $(form.customer_id).attr('data-customer-id',"");
                $(form).attr('data-form-type',"add");
            }
            return false;
        });

        });
    </script>
    @endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="well">
                <button class="close" data-dismiss="alert">
                    ×
                </button>
                <h1><span class="semi-bold">Smart</span> <i class="ultra-light">Widgets</i> (aka JarvisWidgets) <sup class="badge bg-color-red bounceIn animated">v 2.0</sup> <br>
                    <small class="text-danger slideInRight fast animated"><strong>Exclusive to SmartAdmin!</strong></small></h1>

                <p>The all new and revolutionary JarvisWidgets v2.0 (<strong>$35 value</strong>) is now only exclusive to SmartAdmin.
                    JarvisWidgets allows you to do more than your normal widgets. You can now use realtime
                    <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="<span class=''>You can load content with ajax. You can even set a 'last updated' timestamp (customizable) a refresh button and set an auto refresh timer.</span>" data-html="true">
                        AJAX loading </a> in a snap with auto refresh.
                    Add <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="You can use 5 types of action buttons, toggle, edit, fullscreen, delete and custom button(s) which you can set for a custom action(s). You can even change the order of the action buttons. You can set a custom icon for every button. You can also add your own custom buttons, tabs, progress bars and more."> Infinite </a> buttons and controls to widget header. All widgets are
                    <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="The Jarvis Widgets are sortable, on tablet and some phones. Dont want sortable widgets on tables/phones, no problem you can remove this."> Sortable</a> across all bootstrap col-spans and uses
                    <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="This plugin gives you the option to let you save a couple of settings for example the position, color and title of the widget.">HTML5 localStorage</a>. Also now supports
                    <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="This plugin is by default ltr, but it has a rtl option.">RTL Support</a>,
                    <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="The Jarvis Widget works in every modern browser on windows, ios, osx, android, blackberry and windows phone.">Crosbrowser Support</a>,
                    <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="The Jarvis Widget plugin has a couple of callback function wich you can use for several things, for example, use AJAX to store the data into a database.">Callback functions</a> and
                    <a href="javascript:void(0)" class="semi-bold" rel="popover-hover" data-placement="bottom" data-content="To give you more control you can set a lot of options per widget by using a dataset tag which will override the main plugin settings.">More</a>..</p>

            </div>


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
                <h2 >{{__('ar.customers.add_form')}} </h2>

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

                    <form id="customer_form" data-form-type="add" method="post" name="customer_form" class="smart-form"  novalidate="novalidate">
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
                        <footer>
                            {{csrf_field()}}
                            <button name="form_btn" type="submit" class="btn btn-primary">
                                {{__('ar.customers.add')}}
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
                    <h2>{{__('ar.customers.list')}}</h2>

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

                        <table id="customers_table" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th data-hide="phone">#</th>
                                <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> {{__('ar.customers.name')}}</th>
                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-mobile text-muted hidden-md hidden-sm hidden-xs"></i> {{__('ar.customers.mobile')}}</th>
                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{__('ar.customers.address')}}</th>
                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{__('ar.customers.city')}}</th>
                            </tr>
                            </thead>
                            <tbody id="CustomersTableContainer">
                            @foreach($customers as $customer)
                            <tr data-id="{{$customer->id}}">
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->address}}</td>
                                <td><button class="btn btn-xs btn-default" data-id="{{$customer->id}}" onclick="Update_customer({{$customer->id}})"><i class="fa fa-pencil"></i></button></td>
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

            <!-- Widget ID (each widget will need unique ID)-->

            <!-- end widget -->

        </article>
    </div>
   
    </section>

@endsection