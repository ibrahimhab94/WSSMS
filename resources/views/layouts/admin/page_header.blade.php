<div class="row">

    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">

            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-home"></i>
            @yield('page_header')
            <span>>
								@yield('page_header_subtitle')
							</span>
        </h1>
    </div>
    <!-- end col -->

    <!-- right side of the page with the sparkline graphs -->
    <!-- col -->
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <!-- sparks -->
       @section('sparkline')
           @show
        <!-- end sparks -->
    </div>
    <!-- end col -->

</div>