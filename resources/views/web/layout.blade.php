<!doctype html>
<html class="no-js" lang="en">

@include("web.components.head")

<body>
<!-- Body main wrapper start -->
<div class="wrapper">
    <!-- Start Header Style -->
    @include("web.components.header")
    <!-- End Header Area -->

    <!-- End Offset Wrapper -->
    <!-- Start Slider Area -->
    @yield("main")
    <!-- End Blog Area -->
    <!-- End Banner Area -->
    <!-- Start Footer Area -->
    @include("web.components.footer")
    <!-- End Footer Style -->
</div>
<!-- Body main wrapper end -->

<!-- Placed js at the end of the document so the pages load faster -->

<!-- jquery latest version -->
@include("web.components.scripts")
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "100558045692227");
    chatbox.setAttribute("attribution", "biz_inbox");

    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v11.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_GB/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>

</html>
