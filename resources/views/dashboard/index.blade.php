@extends('layout.index')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    

    <title>Dashboard</title>
  </head>

@section('Dashboard')

@section('content')
<div class="container">
    <row>
        <div class="container">
            <img class ="acc " style="width:100%;" src="{{asset('assets/images/gambar.png')}}">
        </div>
    </row>


<!--footer-->
    <div class="row footer">
        <div class="footer-widget green clearfix">
            <div class="col-sm-12 col-md-2">
                <div class="logo-footer">
                    <img src="https://lppi.umy.ac.id/wp-content/themes/umy_master16/images/logofooter.png" alt="logo-footer">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 footer_widget hide_footer_widget">
                <h4 class="widget_title">Contact</h4>
                <div class="widget-footer footer_widget_content">						
                    <div class="row">    
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            Phone<br>
                            Fax<br>
                            Email<br>
                        </div>
                        <div class="col-md-9 col-sm-3 col-xs-9">
                            : +62 274 387656 <br>
                            : +62 274 387646<br>
                            : lppi@umy.ac.id <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 footer_widget hide_footer_widget">
                <h4 class="widget_title">Address</h4>
                <div class="widget-footer footer_widget_content">           
                        <p>
                            Masjid KH. Ahmad Dahlan
                            <br>
                            Kampus Terpadu UMY<br>
                            JL. Brawijaya, Kasihan, Bantul, Yogyakarta 55183.
                            <br><br>
                            <a href="http://www.umy.ac.id/peta"><i class="fa fa-map-marker fa-1x"></i>&nbsp;&nbsp;Google Map</i></a>        
                        </p>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <h4 class="widget_title hidden-xs">Stay Connected</h4>
                <div class="widget-footer">						
                    <ul class="list-inline">
                        <li><a href="http://facebook.com"><i class="fab fa-facebook-f"></i></a></li>							
                        <li><a href="http://twitter.com"><i class="fab fa-twitter"></i></a></li>							
                        <li><a href="http://instagram.com/"><i class="fab fa-instagram"></i></a></li>							
                        <li><a href="http://youtube.com"><i class="fab fa-youtube"></i></i></a></li>						
                    </ul>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection