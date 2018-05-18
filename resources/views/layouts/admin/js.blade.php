<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="/assets/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="/assets/js/libs/jquery-3.2.1.min.js"><\/script>');
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="/assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="/assets/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="/assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="/assets/js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="/assets/js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="/assets/js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<script src="/assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="/assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="/assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="/assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="/assets/js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="/assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->
<script src="/assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices -->
<script src="/assets/js/plugin/fastclick/fastclick.min.js"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<script src="/assets/js/demo.min.js"></script>

<!-- MAIN APP JS FILE -->
<script src="/assets/js/app.min.js"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="/assets/js/speech/voicecommand.min.js"></script>
<script src="/assets/js/smartwidgets/jarvis.widget.min.js"></script>

<!-- SmartChat UI : plugin -->
<script src="/assets/js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="/assets/js/smart-chat-ui/smart.chat.manager.min.js"></script>


<script>

    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         *
         * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
         *
         * // activate tooltips
         * $("[rel=tooltip]").tooltip();
         *
         * // activate popovers
         * $("[rel=popover]").popover();
         *
         * // activate popovers with hover states
         * $("[rel=popover-hover]").popover({ trigger: "hover" });
         *
         * // activate inline charts
         * runAllCharts();
         *
         * // setup widgets
         * setup_widgets_desktop();
         *
         * // run form elements
         * runAllForms();
         *
         ********************************
         *
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
        setup_widgets_desktop();
        pageSetUp();

        /*
         * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
         * eg alert("my home function");
         *
         * var pagefunction = function() {
         *   ...
         * }
         * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
         *
         * TO LOAD A SCRIPT:
         * var pagefunction = function (){
         *  loadScript(".../plugin.js", run_after_loaded);
         * }
         *
         * OR
         *
         * loadScript(".../plugin.js", run_after_loaded);
         */

    })

</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>