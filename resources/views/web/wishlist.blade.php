@extends("web.layout")
@section("main")
    <div class="ht__bradcaump__area" style="background-color: whitesmoke;margin-bottom: 100px">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{url("/")}}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">Wish List</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wishlist-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                @if(count($cart2) != null)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="wishlist-content">
                        <form>
                            <div class="wishlist-table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-remove"><span class="nobr">Remove</span></th>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name"><span class="nobr">Product Name</span></th>
                                        <th class="product-price"><span class="nobr">Price </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Stock Status </span></th>
                                        <th class="product-add-to-cart"><span class="nobr">Add To Cart</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cart2 as $crt)
                                        <tr>
                                            <td class="product-remove"><a href="{{url("delete-wish",["id"=>$crt->id])}}">×</a></td>
                                            <td class="product-thumbnail"><a href="{{url("product-detail",["id"=>$crt->id])}}"><img src="{{$crt->getImage()}}" alt="" /></a></td>
                                            <td class="product-name"><span style="font-size: 18px;color:black;font-weight: 600;font-family: 'Poppins', sans-serif;">{{$crt->name}}</span></td>
                                            <td class="product-price">
                                                <span class="amount">
                                                   @if($crt->promotion_price > 0)
                                                        <span class="amount">{{number_format($crt['promotion_price'])}} VND</span>
                                                    @else
                                                        <span class="amount">{{number_format($crt['unit_price'])}} VND</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="product-stock-status">
                                                @if($crt->qty > 0)
                                                    <span class="wishlist-in-stock" style="color: #22e122">In Stock</span>
                                                @else
                                                    <span class="wishlist-in-stock">Out Of Stock</span>
                                                @endif
                                            </td>
                                            <td class="product-add-to-cart"><a href="{{url("products/add-to-cart",["id"=>$crt->id])}}"> Add to Cart</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <div class="wishlist-share">
                                                <h4 class="wishlist-share-title">Share on:</h4>
                                                <div class="social-icon">
                                                    <ul>
                                                        <li><a href="#"><i class="icon-social-twitter icons"></i></a></li>
                                                        <li><a href="#"><i class="icon-social-instagram icons"></i></a></li>
                                                        <li><a href="#"><i class="icon-social-facebook icons"></i></a></li>
                                                        <li><a href="#"><i class="icon-social-google icons"></i></a></li>
                                                        <li><a href="#"><i class="icon-social-linkedin icons"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                    <div style="height: 300px">
                        <p style="color: black;text-align: center;font-size: 25px;margin-bottom: 20px">No favorites on the list ! </p>
                        <a class="btn btn-info" href="{{url("/")}}" style="margin-left: 45%">Shopping Now</a>
                        <hr>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- wishlist-area end -->
    <div class="htc__brand__area bg__cat--4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ht__brand__inner">
                        <ul class="brand__list owl-carousel clearfix">
                            @foreach($brands as $brand)
                                <li><img src="{{$brand->brandImage()}}" alt="brand images" style="padding: 40px;width: 250px;height: 230px"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
