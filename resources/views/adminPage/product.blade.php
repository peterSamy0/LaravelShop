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
            {{-- alert for successfully added --}}
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('error')}}
                </div>
            @endif

            @if(session()->has('deleted'))
                <div class="alert alert-success">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('deleted')}}
                </div>
            @endif
            {{-- add product form --}}
            <div class="content-wrapper">
                <h1 class="text-center text-light my-3 ">Products</h1>
                
               
                <!-- table show all products -->
                <div>
                    <table class="table w-75 m-auto bg-secondary ">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">image</th>
                                <th scope="col">Name</th>
                                <th scope="col">description</th>
                                <th scope="col">price</th>
                                <th scope="col">discount</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <th scope="row" class="text-dark">{{$product->id}}</th>
                                <td class="text-dark">
                                    @if(Storage::disk('public')->exists('images/' . $product->image))
                                        <img src="{{ asset('storage/images/' . $product->image) }}" class="rounded-5" width="60px" height="60px" alt="">
                                    @else
                                        <img src="{{ asset('storage/images/default.jpeg') }}" class="rounded-5" width="60px" height="60px" alt="">
                                    @endif
                                </td>
                                <td class="text-dark">{{$product->name}}</td>
                                <td class="text-dark">{{$product->description}}</td>
                                <td class="text-dark">{{$product->price}}</td>
                                <td class="text-dark">{{$product->discount}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal_{{$product->id}}">Edit</button>
                                </td>
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
                                <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="deleteModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close border-0 rounded text-light bg-dark" data-bs-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body  text-dark">
                                        are you sure you want to delete {{$product->productName}} ?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ url('/products/' . $product->id)}}" method="post">
                                            @csrf 
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- end delete modal -->

                            <!-- edit modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="editModal_{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Edit product</h1>
                                        <button type="button" class="btn-close border-0 rounded text-light bg-dark" data-bs-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ url('products/' . $product->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf 
                                            @method('put')
                                            <div class="mb-3">
                                            <label for="name" class="text-dark col-form-label">name:</label>
                                            <input type="text" class="form-control text-light" id="name" name="name" value="{{$product->name}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="text-dark col-form-label">description:</label>
                                                <input type="text" class="form-control text-light" id="description" name="description" value="{{$product->description}}">
                                                </div>
                                            <div class="mb-3">
                                                <label for="price" class="text-dark col-form-label">price:</label>
                                                <input type="number" class="form-control text-light" id="price" name="price" value="{{$product->price}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="discount" class="text-dark col-form-label">discount:</label>
                                                <input type="number" class="form-control text-light" id="discount" name="discount" value="{{$product->discount}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="text-dark col-form-label">product image:</label>
                                                <input type="file" class="form-control text-light" id="image" name="image">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" value="save">
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            <!-- end edit modal -->
                            @endforeach

                            
                            @if(count($products) < 1)
                            <tr>
                                <th class="text-center py-5 text-danger " scope="col" colspan="8">there is no product available</th>
                            </tr>
                            @endif
                        </tbody>
                        </table>
                        <!-- pagination -->
                        <div class="d-flex justify-content-center my-5">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                </div> 
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('adminPage.js')<!-- plugins:js -->
    
    </body>
</html>