@extends('layouts.admin.admin_layout')
@section('page_header',__('ar.accounts.accounting'))
@section('page_header_subtitle',__('ar.accounts.dashboard'))
@section('sparkline')
    <div class="well well-sm well-light padding-10">
        <a data-class="show_modal" id="add_account" href="#AddAccountGroup"  href="#AddAccount" class="btn btn-labeled btn-success">
 <span class="btn-label">
  <i class="glyphicon glyphicon-ok"></i>
 </span>إضافة حساب
        </a>
        <a class="btn btn-labeled btn-success">
 <span class="btn-label">
  <i class="glyphicon glyphicon-ok"></i>
 </span>إضافة مجموعه حسابات
        </a>
        <a href="#CustomSearch" class="btn btn-labeled btn-success">
 <span class="btn-label">
  <i class="glyphicon glyphicon-ok"></i>
 </span> بحث مفصل
        </a>
    </div>
@endsection
@section('content')
<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
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
        <h2>{{__('ar.accounts.list')}} </h2>

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

            <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">

                <thead>
                <tr>
                    <th class="hasinput" style="width:17%">
                        <input type="text" class="form-control" placeholder="اسم الحساب" />
                    </th>
                    <th class="hasinput" style="width:18%">
                            <input class="form-control" placeholder="مجموعه الحساب" type="text">


                    </th>
                    <th class="hasinput" style="width:16%">
                        <input type="text" class="form-control" placeholder="رصيد الحساب" />
                    </th>
                    <th class="hasinput" style="width:17%">
                        <input type="text" class="form-control" placeholder="الهاتف" />
                    </th>
                    <th class="hasinput icon-addon">
                        <input id="dateselect_filter" type="text" placeholder="Filter Date" class="form-control datepicker" data-dateformat="yy/mm/dd">
                        <label for="dateselect_filter" class="glyphicon glyphicon-calendar no-margin padding-top-15" rel="tooltip" title="" data-original-title="اخر حركة"></label>
                    </th>
                    <th class="hasinput" style="width:16%">
                    </th>
                </tr>
                <tr>
                    <th  data-class="expand" data-hide="phone">رقم الحساب</th>
                    <th data-class="expand">اسم الحساب</th>
                    <th> مجموعة الحساب</th>
                    <th>رصيد الحساب</th>
                    <th data-hide="phone">آخر حركة</th>
                    <th data-hide="phone,tablet">خيارات</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>0100034</td>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>010005</td>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>$170,750</td>
                </tr>
                </tbody>

            </table>

        </div>
        <!-- end widget content -->

    </div>
    <!-- end widget div -->

</div>

<div class="modal fade" id="AddAccountModal" tabindex="-1" role="dialog" aria-labelledby="AddAccountModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="TicketModalHeader">{{__('ar.accounts.add_account')}} <span class="label label-warning" data-content="ticket-no"></span></h4>
            </div>
            <div class="modal-body">
                <form id="accounts_form" data-form-type="add" method="post" name="accounts_form" class="smart-form" data-href="{{route('add_accounts_post')}}" novalidate="novalidate">

                    <input type="hidden" name="account_id" data-customer-id="" value=""/>
                    <fieldset>
                        <section>
                            <label for="account_name" class="input">
                                <input type="text" name="account_name" id="account_name" placeholder="{{__('ar.accounts.account_name')}}">
                            </label>
                        </section>
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
                                <select name="account_group" style="width:100%" class="select_account_group">
                                    <option value="VT">Vermonta</option>
                                    <option value="VA">Virginaa</option>
                                    <option value="V3">Virgin3a</option>
                                    <option value="V4">Virgin4a</option>
                                    <option value="V5">Virgin5a</option>
                                    <option value="WV">West Vir</option>
                                </select>
                        </section>
                    </fieldset>

                    <footer>
                        {{csrf_field()}}
                        <button name="form_btn" type="submit" class="btn btn-primary">
                            {{__('ar.accounts.add_account')}}
                        </button>
                    </footer>
                </form>



                <div class="modal-footer">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
    @endsection
@section('customjs')
    <script src="/assets/js/plugin/select2/select2.min.js"></script>
    <script src="/assets/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="/assets/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="/assets/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
    <script src="/assets/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js"></script>
    <script src="/assets/js/plugin/clockpicker/clockpicker.min.js"></script>
    <script src="/assets/js/accounting.js"></script>
    <script>
    $(document).ready(function() {
        function matchCustom(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }
            if (typeof data.text === 'undefined') {
                return null;
            }
            if (data.text.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (matched)';
                return modifiedData;
            }
            return null;
        }
        $('.select_account_group').select2({
            matcher: matchCustom,
            placeholder: 'Select an option',
            tags: true
        });
    pageSetUp();

    /* // DOM Position key index //

    l - Length changing (dropdown)
    f - Filtering input (search)
    t - The Table! (datatable)
    i - Information (records)
    p - Pagination (paging)
    r - pRocessing
    < and > - div elements
    <"#id" and > - div with an id
    <"class" and > - div with a class
    <"#id.class" and > - div with an id and class

    Also see: http://legacy.datatables.net/usage/features
    */

    /* BASIC ;*/
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
    tablet : 1024,
    phone : 480
    };
    var otable = $('#datatable_fixed_column').DataTable({
    //"bFilter": false,
    //"bInfo": true,
    //"bLengthChange": false
    //"bAutoWidth": false,
    //"bPaginate": false,
    //"bStateSave": true // saves sort state using localStorage
     "sDom": "C <'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>  >r>"+
     "t"+
     "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        // "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C><'toolbar'>>r>"+
        //     "t"+
        //     "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
    "autoWidth" : true,
    "oLanguage": {
        "sUrl": "/assets/js/lang/Arabic.json",
        "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
    },
    "preDrawCallback" : function() {
    // Initialize the responsive datatables helper once.
    if (!responsiveHelper_datatable_fixed_column) {
    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
    }
    },
    "rowCallback" : function(nRow) {
    responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
    },
    "drawCallback" : function(oSettings) {
    responsiveHelper_datatable_fixed_column.respond();
    }

    });

    // custom toolbar
    $("div.toolbar").html('<div class="text-right"><img src="/assets/img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

    // Apply the filter
    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

    otable
    .column( $(this).parent().index()+':visible' )
    .search( this.value )
    .draw();

    } );
    /* END COLUMN FILTER */


    /* END COLUMN SHOW - HIDE */

    /* TABLETOOLS */


    /* END TABLETOOLS */
        create_modal({modal:"AddAccountModal",modal_btn:"add_account",form_name:"accounts_form"});
    });
    </script>
    @endsection
