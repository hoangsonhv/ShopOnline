<!doctype html>
<html lang="en">

@include("web.components.head")

<body>
<!-- Body main wrapper start -->
@include("web.components.header")
<div class="wrapper">
    <!-- Start Header Style -->

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
{{--<!-- Messenger Plugin chat Code -->--}}
{{--<div id="fb-root"></div>--}}
@yield("detail")
{{--<!-- Your Plugin chat code -->--}}
{{--<div id="fb-customer-chat" class="fb-customerchat"></div>--}}
</body>

</html>
