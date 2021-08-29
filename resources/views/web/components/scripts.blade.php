<script src="{{asset("js/vendor/jquery-3.2.1.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script src="{{asset("js/plugins.js")}}"></script>
<script src="{{asset("js/slick.min.js")}}"></script>
<script src="{{asset("js/owl.carousel.min.js")}}"></script>
<script src="{{asset("js/waypoints.min.js")}}"></script>
<script src="{{asset("js/main.js")}}"></script>
<script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("vendor/jquery-easing/jquery.easing.min.js")}}"></script>
<script src="{{asset("js/sb-admin-2.min.js")}}"></script>
<script src="{{asset("js/myscr.js")}}"></script>
<script src="{{asset("js/test.js")}}"></script>
<script src="{{asset("js/cart-update.js")}}"></script>
<script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js")}}"></script>
{{--<script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js")}}"></script>--}}
{{--<script src="{{asset("https://code.jquery.com/jquery-3.6.0.min.js")}}"></script>--}}


<script>
    function openCity(evt, cityName) {
      var i, x, tablinks;
      x = document.getElementsByClassName("city");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-green", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " w3-green";
    }
</script>

{{--Search--}}
<script src="{{asset("https://code.jquery.com/ui/1.12.1/jquery-ui.js")}}"></script>
<script type="text/javascript">
        $( "#slider-range" ).slider({
            range: true,
            min: {{$min_price_range}},
            max: {{$max_price_range}},
            steps: 1000,
            values: [ {{$min_price}}, {{$max_price}} ],
            slide: function( event, ui ) {
                $( "#amount" ).val(  + ui.values[ 0 ] + "VND" + " - " + ui.values[ 1 ] + "VND" );
                $( "#start_price" ).val(ui.values[ 0 ]);
                $( "#end_price" ).val( ui.values[ 1 ]);
            }
        });
        $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) + "VND" +
        " - " + $( "#slider-range" ).slider( "values", 1 ) + "VND" );
</script>

<script>
    function myFunction(id) {
        document.getElementById("demo"+id).style.display="block" ;
    }
</script>
<script src="{{asset("https://unpkg.com/boxicons@2.0.9/dist/boxicons.js")}}"></script>



