<style>
    /*==================================================
=            Bootstrap 3 Media Queries             =
==================================================*/




    /*==========  Mobile First Method  ==========*/

    /* Custom, iPhone Retina */
    @media only screen and (min-width : 320px) {}

    /* Extra Small Devices, Phones */
    @media only screen and (min-width : 480px) {}

    /* Small Devices, Tablets */
    @media only screen and (min-width : 768px) {}

    /* Medium Devices, Desktops */
    @media only screen and (min-width : 992px) {}

    /* Large Devices, Wide Screens */
    @media only screen and (min-width : 1200px) {}



    /*==========  Non-Mobile First Method  ==========*/

    /* Large Devices, Wide Screens */
    @media only screen and (max-width : 1200px) {}

    /* Medium Devices, Desktops */
    @media only screen and (max-width : 992px) {}

    /* Small Devices, Tablets */
    @media only screen and (max-width : 768px) {}

    /* Extra Small Devices, Phones */
    @media only screen and (max-width : 480px) {}

    /* Custom, iPhone Retina */
    @media only screen and (max-width : 320px) {}



    /*=====================================================
=            Bootstrap 2.3.2 Media Queries            =
=====================================================*/
    @media only screen and (max-width : 1200px) {}

    @media only screen and (max-width : 979px) {}

    @media only screen and (max-width : 767px) {}

    @media only screen and (max-width : 480px) {}

    @media only screen and (max-width : 320px) {}


    /* default styles here for older browsers.
       I tend to go for a 600px - 960px width max but using percentages
    */
    @media only screen and (min-width:960px) {
        /* styles for browsers larger than 960px; */
    }

    @media only screen and (min-width:1440px) {
        /* styles for browsers larger than 1440px; */
    }

    @media only screen and (min-width:2000px) {
        /* for sumo sized (mac) screens */
    }

    @media only screen and (max-device-width:480px) {
        /* styles for mobile browsers smaller than 480px; (iPhone) */
    }

    @media only screen and (device-width:768px) {
        /* default iPad screens */
    }

    /* different techniques for iPad screening */
    @media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) {
        /* For portrait layouts only */
    }

    @media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) {
        /* For landscape layouts only */
    }

    /*******Nuevos mensajes de error******/

    .new-message-box {
        margin: 15px 0;
        padding-left: 20px;
        margin-bottom: 25px !important;
    }

    .new-message-box p {
        font-size: 1.15em;
        font-weight: 600;
    }

    .info-tab {
        width: 40px;
        height: 40px;
        display: inline-block;
        position: relative;
        top: 8px;
    }

    .info-tab {
        float: left;
        margin-left: -23px;
    }

    .info-tab i::before {
        width: 24px;
        height: 24px;
        box-shadow: inset 12px 0 13px rgba(0, 0, 0, 0.5);
    }

    .info-tab i::after {
        width: 0;
        height: 0;
        border: 12px solid transparent;
        border-bottom-color: #fff;
        border-left-color: #fff;
        bottom: -18px;
    }

    .info-tab i::before,
    .info-tab i::after {
        content: "";
        display: inline-block;
        position: absolute;
        left: 0;
        bottom: -17px;
        transform: rotateX(60deg);
    }

    .note-box,
    .warning-box,
    .tip-box-success,
    .tip-box-danger,
    .tip-box-warning,
    .tip-box-info,
    .tip-box-alert {
        padding: 12px 8px 3px 26px;
    }


    /***Success****/

    .new-message-box-success {
        background: #eeeeee;
        padding: 3px;
        margin: 10px 0;
    }

    .tip-icon-success {
        background: #8BC34A; //500
    }

    .tip-box-success {
        color: #33691E; //900
        background: #DCEDC8; //100
    }

    .tip-icon-success::before {
        font-size: 25px;
        content: "\f00c";
        top: 8px;
        left: 11px;
        font-family: FontAwesome;
        position: absolute;
        color: white;
    }

    .tip-icon-success i::before {
        background: #8BC34A; //500
    }


    /*******Danger*******/
    .new-message-box-danger {
        background: #eeeeee;
        padding: 3px;
        margin: 10px 0;
    }

    .tip-icon-danger {
        background: #f44336; //500
    }

    .tip-box-danger {
        color: #b71c1c; //900
        background: #FFCCBC; //100
    }

    .tip-icon-danger::before {
        font-size: 25px;
        content: "\f00d";
        top: 8px;
        left: 11px;
        font-family: FontAwesome;
        position: absolute;
        color: white;
    }

    .tip-icon-danger i::before {
        background: #f44336; //500
    }

    /*******warning*******/
    .new-message-box-warning {
        background: #eeeeee;
        padding: 3px;
        margin: 10px 0;
    }

    .tip-icon-warning {
        background: #FFEB3B; //500
    }

    .tip-box-warning {
        color: #212121; //900
        background: #FFF9C4; //100
    }

    .tip-icon-warning::before {
        font-size: 25px;
        content: "\f071";
        top: 8px;
        left: 11px;
        font-family: FontAwesome;
        position: absolute;
        color: #212121;
    }

    .tip-icon-warning i::before {
        background: #FFEB3B; //500
    }

    /*******info*******/
    .new-message-box-info {
        background: #eeeeee;
        padding: 3px;
        margin: 10px 0;
    }

    .tip-box-info {
        color: #01579B; //900
        background: #B3E5FC; //100
    }

    .tip-icon-info {
        background: #03A9F4; //500
    }

    .tip-icon-info::before {
        font-size: 25px;
        content: "\f129";
        top: 8px;
        left: 11px;
        font-family: FontAwesome;
        position: absolute;
        color: white
    }

    .tip-icon-info i::before {
        background: #03A9F4; //500
    }


    /*******info*******/
    .new-message-box-alert {
        background: #FF6F00;
        padding: 3px;
        margin: 10px 0;
    }

    .tip-box-alert {
        color: #212121; //900
        background: #FFF8E1; //100
    }

    .tip-icon-alert {
        background: #FF6F00; //500
    }

    .tip-icon-alert::before {
        font-size: 25px;
        content: "\f06a";
        top: 8px;
        left: 11px;
        font-family: FontAwesome;
        position: absolute;
        color: white
    }

    .tip-icon-alert i::before {
        background: #FF6F00; //500
    }


    /*************************/

    body {
        background-color: #ffffff;
    }
</style>
<div>
    @if (session('error'))
        <div class="row fixed z-50 right-4 text-[0.7rem] xl:text-[1rem]" id="notification">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 w-full">
                <div class="new-message-box">
                    <div class="new-message-box-danger">
                        <div class="info-tab tip-icon-danger" title="error"><i></i></div>
                        <div class="tip-box-danger">
                            <p>{{ session('error') }}
                                {{-- <a class="btn btn-sm" href="555"> intente nuevamente</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- -->
    @if (session('success'))
        <div class="row fixed z-50 right-4 text-[0.7rem] xl:text-[1rem]" id="notification">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 w-full">
                <div class="new-message-box">
                    <div class="new-message-box-success">
                        <div class="info-tab tip-icon-success" title="success"><i></i></div>
                        <div class="tip-box-success">
                            <p>{{ session('success') }}
                                {{-- <a class="btn btn-sm" href="555"> intente nuevamente</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- -->
    @if (session('warning'))
        <div class="row fixed z-50 right-4 text-[0.7rem] xl:text-[1rem]" id="notification">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 w-full">
                <div class="new-message-box">
                    <div class="new-message-box-warning">
                        <div class="info-tab tip-icon-warning" title="error"><i></i></div>
                        <div class="tip-box-warning">
                            <p>{{ session('warning') }}
                                {{-- <a class="btn btn-sm" href="555"> intente nuevamente</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- -->
    @if (session('info'))
        <div class="row fixed z-50 right-4 text-[0.7rem] xl:text-[1rem]" id="notification">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 w-full">
                <div class="new-message-box">
                    <div class="new-message-box-info">
                        <div class="info-tab tip-icon-info" title="error"><i></i></div>
                        <div class="tip-box-info">
                            <p>{{ session('info') }}
                                {{-- <a class="btn btn-sm" href="555"> intente nuevamente</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- -->

</div>
<script>
    const notification = document.getElementById('notification');
    setTimeout(() => {
        notification.remove();
    }, 5000); // 5000 ms = 5 giây
</script>