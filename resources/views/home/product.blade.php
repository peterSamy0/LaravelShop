<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">

       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
       </div>

       <div class="row">
         @foreach ($products as $product)    
            <div class="col-sm-6 col-md-4 col-lg-4">
               <div class="box">
                  <div class="option_container">
                     <div class="options">
                        <a href="{{url('products', $product->id)}}" class="option1">
                        Details
                        </a>
                        <form action="{{url('addToCart', $product->id)}}" class="d-flex mt-2 ">
                           <input type="number" class="m-0 me-2 rounded" style="width:100px" name="quantity" value="1" min="1">
                           <input type="submit" class="p-2 w-auto rounded" value="Add To Cart">
                        </form>
                     </div>
                  </div>
                  <div class="img-box">
                     <img src="{{asset('storage/images/'. $product->image)}}" alt="">
                  </div>
                  <div class="detail-box">
                     <h5>
                        {{$product->name}}
                     </h5>
                     @if($product->discount)
                        <h6 class="text-danger">
                           ${{$product->discount}}
                        </h6>
                        <h6 class="text-primary text-decoration-line-through">
                           ${{$product->price}}
                        </h6>
                     @else
                        <h6 class="text-primary">
                           ${{$product->price}}
                        </h6>
                     @endif
                  </div>
               </div>
            </div>
         @endforeach
       </div>
       <div class="d-flex justify-content-center my-3">
          {{$products->links('pagination::bootstrap-4')}}
       </div>

       <!-- <div class="btn-box">
          <a href="">
          View All products
          </a>
       </div> -->
    </div>
 </section>
 <!-- end product section -->