<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   @include('admin.css')
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        label{
          display: inline-block;
          width: 200px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                  
              @if(session('message'))
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
                  {{session('message')}}
              </div>
              @endif
               
                <div class="glassmorphism container flex justify-center items-center flex-col p-5">

                    <h1 class="mb-5">Add Productss</h1>

                    <form action="{{'add_product'}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="mb-4">
                            <label for="">Product Title: </label>
                            <input class="text-black" type="text" name="title" placeholder="Shirt" required>
                        </div>

                        <div class="mb-4">
                            <label for="">Product Description: </label>
                            <input class="text-black" type="text" name="product_description" placeholder="Shirt that is comfortable">
                        </div>

                       <div class="mb-4">
                        <label for="">Product Price: </label>
                        <input class="text-black" type="number" name="price" placeholder="200">
                       </div>
                       
                       <div class="mb-4">
                        <label for="">Product Quantity: </label>
                        <input class="text-black" type="number" name="quantity" min="0" placeholder="10">
                       </div>
                       
                       <div class="mb-4">
                        <label for="">Product Category: </label>
                        <select class="text-black"name="category">
                          <option value="" selected="">Add Category here:</option>
                          @foreach ($categories as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                          @endforeach
                          
                        </select>
                       </div>

                       <div class="mb-4">
                        <label>Product Image Here: </label>
                        <input type="file" name="image" required>
                       </div>
                     
                      <input type="submit" value="Add Product" class="btn btn-outline-primary btn-lg text-lg">
                    </form>
                </div>
             
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>