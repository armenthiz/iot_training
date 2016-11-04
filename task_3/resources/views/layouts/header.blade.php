<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crud Image</title>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css "/>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-material-design.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/ripples.min.css">
        <style type="text/css">
            .content {
                padding:60px 0 0 0;
            }
                .content .title {
                    text-align: center;
                    margin:40px 0;
                }
                .content ul.recent-pictures {
                    margin-top:40px;
                    margin-bottom:40px;
                    list-style: none;
                }
                    .content ul.recent-pictures li.picture {
                    }
                        .content ul.recent-pictures li.picture .picture-content {
                            background: #fafafa;
                            margin:10px;
                            box-shadow: 1px 1px 1px rgba(0,0,0,.1);
                            overflow: hidden;
                        }
                            .content ul.recent-pictures li.picture .picture-content img.picture-image {
                                width: 100%;
                            }
                            .content ul.recent-pictures li.picture .picture-content p.picture-title {
                                padding:10px 10px 0 10px;
                            }
                            .content ul.recent-pictures li.picture .picture-content .picture-users {
                                overflow: hidden;
                                padding:20px 0;
                                border-top:1px solid rgba(0,0,0,.1);
                            }
                                .content ul.recent-pictures li.picture .picture-content .picture-users img {
                                    width: 25px;
                                    height: 25px;
                                    border-radius:50%;
                                }
                .content .login, .content .register {
                    background: #fafafa;
                    padding:20px;
                    margin-bottom:40px;
                    box-shadow: 1px 1px 1px rgba(0,0,0,.1);
                }
                .content .box {
                    margin:20px;
                    background: #fafafa;
                    box-shadow: 1px 1px 1px rgba(0,0,0,.1);
                    overflow: hidden;
                }
                    .content .box .dashboard-profile {

                    }
                        .content .dashboard-profile .dashboard-profile-image {
                            
                        }
                            .content .dashboard-profile img.dashboard-profile-image {
                                width: 100%;
                            }
                            .content .dashboard-profile p.dashboard-profile-name {
                                text-align: center;
                                padding: 20px;
                                font-style: italic;
                                font-weight: bold;
                            }
                        .content .dashboard-images {

                        }
                            .content .dashboard-images img.dashboard-images-thumb {
                                width: 50px;
                            }
                        .content .dashboard-images-show {
                            padding:20px 0;
                        }
                            .content .dashboard-images-show img.dashboard-images-show-thumb {
                            }
                        .content .dashboard-images-edit {
                            padding:20px;
                        }
            .grid-item { 
                width: 220px; 
            }
            .grid-item--width2 { 
                width: 400px; 
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="header navbar navbar-fixed-top navbar-default">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/">Imagist</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li>{!! link_to(route('home.index'), 'Home') !!}</li>
                    @if (Sentinel::check())
                        <li>{!! link_to(route('images.index'), 'Images') !!}</li>
                        <li>{!! link_to(route('session.logout'), 'Logout') !!}</li>
                    @else
                        <li>{!! link_to(route('session.login'), 'Login') !!}</li>
                        <li>{!! link_to(route('user.register'), 'Register') !!}</li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
            <div class="content container">
                @if (Session::has('error'))
                    <div class="alert alert-dismissible alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>
                          {{ Session::get('error') }}
                      </strong>
                    </div>
                @endif
                @if (Session::has('notice'))
                    <div class="alert alert-dismissible alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>
                          {{ Session::get('notice') }}
                      </strong>
                    </div>
                @endif