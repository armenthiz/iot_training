<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="XUACompatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Task4</title>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/material-design/bootstrap-material-design.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/ripples/ripples.min.css" />
        <style type="text/css">
            body {
                padding-top: 50px;
                background-color:#fff;
            }
        </style>
    </head>
    <body style="padding-top:60px;">
        {{-- bagian navigation --}}
        @include('shared.head_nav')

        {{-- Bagian Content --}}
        <div class="container clearfix">
            <div class="row row-offcanvas row-offcanvas-left">
                {{-- Bagian Kiri --}}
                @include('shared.left_nav')

                {{-- Bagian Kanan --}}
                <div id="main-content" class="col-xs-12 col-sm-9 main pull right">
                    <div class="panel-body">
                        @if (Session::has('error'))
                            <div class="session-flash alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if (Session::has('notice'))
                            <div class="session-flash alert-info">
                                {{ Session::get('notice') }}
                            </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/material-design/material.min.js"></script>
    <script type="text/javascript" src="/js/material-design/ripples.min.js"></script>
    <script type="text/javascript" src="/js/custom/layout.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
</html>