@extends('layout.index')

@section('Sub Bab')
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    <link rel='stylesheet' id='dashicons-css'  href='https://lppi.umy.ac.id/wp-includes/css/dashicons.min.css?ver=5.4.2' type='text/css' media='all' />
    <link rel='stylesheet' id='thickbox-css'  href='https://lppi.umy.ac.id/wp-includes/js/thickbox/thickbox.css?ver=5.4.2' type='text/css' media='all' />
    <title>Dashboard</title>
  </head>
  <body>
    @section('content')
        


        <div class="container">
            <row>
                <div class="container">
                    <img class ="acc " style="width:100%;" src="{{asset('assets/images/gambar.png')}}">
                </div>
            </row>
            <div class="row footer">
                <div class="footer-widget green clearfix">
                    <!-- <div class="col-sm-10 col-md-2" >
                        <div class="logo-footer">
                            <img src="https://lppi.umy.ac.id/wp-content/themes/umy_master16/images/logofooter.png" alt="logo-footer">
                        </div>
                    </div> -->

                    <div class="col-lg-10 col-md-18 col-sm-18 footer-menu">
                        <div class="row">
                            <div class="col-lg-5 col-md-4 col-sm-18">
                                <h4 class="widget_title">Contact</h4>

                                <div class="row" style="color:#fff;">    
                                    <div class="col-md-4 col-sm-4 col-xs-4"> 
                                       
                                        Phone <br>
                                        Fax <br>
                                        Email <br>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        : +62 274 387656 	<br>
                                        : +62 274 387646  <br>
                                        : lppi@umy.ac.id        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-12">
                                <h4 class="widget_title">Address</h4>
                                <div class="widget-footer footer_widget_content">
                                                    
                                        <p>
                                            Masjid KH. Ahmad Dahlan
                                            <br>
                                            Kampus Terpadu UMY<br>
                                            JL. Brawijaya, Kasihan, Bantul, Yogyakarta 55183.
                                            <br><br>
                                            <a href="http://www.umy.ac.id/peta"><i class="fa fa-map-marker fa-1x"></i>&nbsp;&nbsp;Google Map</a>
                                                    
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
                </div>

                <div class="row">
                <div class="footer-copy ">
                   <!-- <div class="col-md-12">
                        <p>© 2020 MyEbadah ● Created By Team Magang Bagus Siti Suci ●</p>
                    </div> --> -->
                </div> 
            </div>
		  
        </div>
    </body>

    
</html>
@endsection