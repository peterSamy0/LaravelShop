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
        @include('adminPage.content')
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('adminPage.js')<!-- plugins:js -->
   
  </body>
</html>