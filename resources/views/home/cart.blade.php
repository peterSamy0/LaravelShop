<?php 
use App\Models\Product;
?>
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

        <style>
            th, td{
                text-align: center
            }
        </style>
   </head>
   <body>
        <div class="hero_area">
            <!-- header section strats -->
            @include('home.header')
            <!-- end header section -->
            <div>
                <div>
                    <h1 class="my-5 text-center">Cart</h1>
                </div>
                <table class="table w-50 m-auto bg-secondary ">
                    <thead>
                      <tr>
                        <th scope="col">no</th>
                        <th scope="col">image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product quantity</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $totalPrice = 0; ?>
                      @foreach ($products as  $i => $product)
                        <tr>
                            <?php 
                                $productItem = Product::where('id', $product->productID)->first();
                                if($productItem->discount){
                                    $totalPrice += $productItem->discount * $product->quantity;
                                }else{
                                    $totalPrice += $productItem->price * $product->quantity;
                                }
                            ?>
                            <th scope="row" class="text-dark">{{$i + 1}}</th>
                            <td class="text-dark">
                                <img src="{{asset('storage/images/'. $productItem->image)}}" alt="" width="60px" height="60px" class="object-fit-content ">
                            </td>
                            <td class="text-dark">{{$productItem->name}}</td>
                            @if ($productItem->discount)
                                <td class="text-dark">${{$productItem->discount * (int)$product->quantity}}</td>
                            @else
                                <td class="text-dark">${{(int)$productItem->price * (int)$product->quantity}}</td> 
                            @endif
                            <td class="text-dark">{{$product->quantity}}</td> 
                            <td>
                                <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal_{{$product->id}}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        {{-- delete modal --}}
                        <!-- Modal -->
                        <div class="modal fade"id="deleteModal_{{$product->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteModalLabel">Modal title</h1>
                                <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close">x</button>
                                </div>
                                <div class="modal-body ">
                                    are you sure you want to delete {{$product->categoryName}} ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ url('deleteFromCart/' . $product->id)}}" method="post">
                                        @csrf 
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- end delete modal -->
                        @endforeach
                        
                      @if(count($products) < 1)
                        <tr>
                            <th class="text-center py-5 text-danger " scope="col" colspan="4">there are no Selected Products available</th>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                  <div class="fw-bold text-center my-3">
                    Total Price: $<?php echo $totalPrice ?>
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