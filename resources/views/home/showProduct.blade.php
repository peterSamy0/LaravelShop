<!DOCTYPE html>
<html>
   <head>
    
      <base href="/assest">
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
        <div class="d-flex my-5">
            <div class="w-50 d-flex justify-content-center">
                <img src="{{asset('storage/images/'. $product->image)}}" alt="" class="w-75 m-auto object-fit-cover">
            </div>

            <div class="d-flex justify-content-center "> 
                <div class="detail-box">
                    <h5>
                        {{$product->name}}
                    </h5>
                    <p>
                       Description: {{$product->description}}
                    </p>
                    <p>
                        Category: <!-- $product->category not available now -->
                     </p>
                    @if($product->discount)
                        <h6 class="text-danger">
                           Price Discount: ${{$product->discount}}
                        </h6>
                        <h6 class="text-primary">
                           Price: <span class="text-decoration-line-through">${{$product->price}}</span> 
                        </h6>
                    @else
                        <h6 class="text-primary">
                            ${{$product->price}}
                        </h6>
                    @endif

                    <form action="{{url('addToCart', $product->id)}}" class="d-flex mt-2 ">
                        <input type="number" class="m-0 me-2 rounded" style="width:100px; outline:none"  name="quantity" value="1" min="1" placeholder="quantity" value="1">
                        <input type="submit" class="p-2 w-auto rounded" value="Add To Cart">
                     </form>
                     
                </div>
            </div>
      </div>
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.esm.min.js" integrity="sha512-9IAuCQeqbsF/CP2TJ7avKUW9/+dODxnKuPyj42O++oHkjGuuqj3ZLzTFtCihuRjb5G/aGefieF21ZoRG5kwzwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>