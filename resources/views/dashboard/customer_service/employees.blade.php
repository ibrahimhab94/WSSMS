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

        $(document).ready(function () {

            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };
            function format ( d ) {
                // `d` is the original data object for the row
                return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">'+
                    '<tr>'+
                    '<td style="width:100px">Project Title:</td>'+
                    '<td>'+d.name+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>Deadline:</td>'+
                    '<td>'+d.ends+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>Extra info:</td>'+
                    '<td>And any further details here (images etc)...</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>Comments:</td>'+
                    '<td>'+d.comments+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>Action:</td>'+
                    '<td>'+d.action+'</td>'+
                    '</tr>'+
                    '</table>';
            }

            // clears the variable if left blank

            var table = $('#EmployeesTable').DataTable( {
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "ajax": '{{route('get_employees_ajax')}}',
                "bDestroy": true,
                "iDisplayLength": 15,
                "oLanguage": {
                    "sUrl": "/assets/js/lang/Arabic.json",
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "columns": [
                    {
                        "class":          'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "name" },
                    { "data": "mobile" },
                    { "data": "status" },
                    { "data": "states" },
                    { "data": "crate" },
                    { "data": "urate" },

                ],
                "order": [[1, 'asc']],
                "fnDrawCallback": function( oSettings ) {
                    runAllCharts()
                }
            } );



            // Add event listener for opening and closing details
            $('#EmployeesTable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            });
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


        });
    </script>
@endsection
@section('content')
    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="alert alert-info">
                    <strong>NOTE:</strong> All the data is loaded from a seperate JSON file
                </div>

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget well" id="wid-id-0" data-widget-colorbutton="true" data-widget-fullscreenbutton="true">
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
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>Widget Title </h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                            <input class="form-control" type="text">
                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <table id="EmployeesTable" class="display projects-table table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th></th><th>{{__('ar.employees.name')}}</th>
                                    <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> {{__('ar.mobile')}}</th>
                                    <th>{{ __('ar.employees.status')}}</th>
                                    <th><i class="fa fa-circle txt-color-darken font-xs"></i> {{__('ar.employees.states_target')}}/ <i class="fa fa-circle text-danger font-xs"></i> {{__('ar.employees.states_done')}}</th>
                                    <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i>{{__('ar.employees.customers_rate')}}</th>
                                    <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i>{{__('ar.employees.user_rate')}}</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->

            </article>
            <!-- WIDGET END -->

        </div>

        <!-- end row -->

        <!-- row -->

        <div class="row">

            <!-- a blank row to get started -->
            <div class="col-sm-12">
                <!-- your contents here -->
            </div>

        </div>

        <!-- end row -->

    </section>
    <!-- end widget grid -->






@endsection
