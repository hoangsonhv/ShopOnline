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
/*-------------------------------
 Price Slider Active
--------------------------------*/
{{--<script>--}}
{{--    var chatbox = document.getElementById('fb-customer-chat');--}}
{{--    chatbox.setAttribute("page_id", "100558045692227");--}}
{{--    chatbox.setAttribute("attribution", "biz_inbox");--}}

{{--    window.fbAsyncInit = function() {--}}
{{--        FB.init({--}}
{{--            xfbml            : true,--}}
{{--            version          : 'v11.0'--}}
{{--        });--}}
{{--    };--}}

{{--    (function(d, s, id) {--}}
{{--        var js, fjs = d.getElementsByTagName(s)[0];--}}
{{--        if (d.getElementById(id)) return;--}}
{{--        js = d.createElement(s); js.id = id;--}}
{{--        js.src = '{{url("https://connect.facebook.net/en_GB/sdk/xfbml.customerchat.js")}}';--}}
{{--        fjs.parentNode.insertBefore(js, fjs);--}}
{{--    }(document, 'script', 'facebook-jssdk'));--}}
{{--</script>--}}
<script>
    var btnContainer = document.getElementById("active_button");

    // Get all buttons with class="btn" inside the container
    var btns = btnContainer.getElementsByClassName("btn");

    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active2");
            current[0].className = current[0].className.replace(" active2", "");
            this.className += " active2";
        });
    }

</script>
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
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                $( "#start_price" ).val(ui.values[ 0 ]);
                $( "#end_price" ).val( ui.values[ 1 ]);
            }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );
</script>

<script>
    function myFunction(id) {
        document.getElementById("demo"+id).style.display="block" ;
    }
</script>




