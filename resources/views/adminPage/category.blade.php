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
            {{-- add category form --}}
            <div class="content-wrapper">
                <h1 class="text-center ">Add Category</h1>
                <div class="d-flex justify-content-center ">
                    <div class="p-5">
                        <form action="{{route('addCategory')}}" class="d-flex" method="POST">
                            @csrf
                            <input type="text" name="category" class="form-control" placeholder="Category Name">
                            <input type="submit" style="margin-left: 10px" class="btn btn-outline-primary" value="add">
                        </form>
                    </div>
                </div>

                {{-- table show categories --}}
                <div>
                    <table class="table w-50 m-auto bg-secondary ">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($categories as $category)
                            <tr>
                                <th scope="row" class="text-dark">{{$category->id}}</th>
                                <td class="text-dark">{{$category->categoryName}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal_{{$category->id}}">Edit</button>
                                </td>
                                <td>
                                    <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal_{{$category->id}}">
                                        Delete
                                    </button>
                                </td>
                               
                            </tr>

                            {{-- delete modal --}}
                            <!-- Modal -->
                            <div class="modal fade"id="deleteModal_{{$category->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-dark" id="deleteModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close border-0 rounded text-light bg-dark" data-bs-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body  text-dark">
                                        are you sure you want to delete {{$category->categoryName}} ?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ url('deleteCategory/' . $category->id)}}" method="post">
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
                            <div class="modal fade" id="editModal_{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content bg-secondary">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Edit Category</h1>
                                      <button type="button" class="btn-close border-0 rounded text-light bg-dark" data-bs-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ url('editCategory/' . $category->id)}}" method="post">
                                            @csrf 
                                            @method('put')
                                            <div class="mb-3">
                                            <label for="recipient-name" class="text-dark col-form-label">name:</label>
                                            <input type="text" class="form-control text-light" id="name" name="name" value="{{$category->categoryName}}">
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

                          @if(count($categories) < 1)
                            <tr>
                                <th class="text-center py-5 text-danger " scope="col" colspan="4">there is no category available</th>
                            </tr>
                          @endif
                        </tbody>
                      </table>
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