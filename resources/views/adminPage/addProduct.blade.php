<!DOCTYPE html>
<html lang="en">
    <head>
    @include('adminPage.css')
    </head>
    <body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('adminPage.slider')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('adminPage.header')
        <!-- partial -->
        <div class="main-panel">
            <!-- alert for successfully added -->
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif

            <div class="content-wrapper">
                <h1 class="text-center ">Products</h1>

                <form class="w-50 m-auto bg-secondary text-dark p-4 rounded" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="rounded bg-secondary text-dark form-control" placeholder="product name" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="rounded bg-secondary text-dark form-control" placeholder="product description" id="description" name="description">
                    </div>
                    <div class="mb-3">
                        <input type="number" class="rounded bg-secondary text-dark form-control" placeholder="product price" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <input type="number" class="rounded bg-secondary text-dark form-control" placeholder="product discount" id="discount" name="discount">
                    </div>
                    <div class="mb-3">
                        <input type="file" class="rounded bg-secondary text-dark form-control" id="image" name="image">
                    </div>
                
                <button type="submit" class="btn btn-primary">Add</button>
              </form>
            </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('adminPage.js')<!-- plugins:js -->
    
    </body>
</html>