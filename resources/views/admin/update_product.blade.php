<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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

                    <h1 class="mb-5">Add Products</h1>

                    <form action="{{url('update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="mb-4">
                            <label for="">Product Title: </label>
                            <input class="text-black" required type="text" name="title" placeholder="Shirt" value="{{$product->title}}">
                        </div>

                        <div class="mb-4">
                            <label for="">Product Description: </label>
                            <input class="text-black" type="text" name="product_description" placeholder="Shirt that is comfortable" value="{{$product->description}}">
                        </div>

                       <div class="mb-4">
                        <label for="">Product Price: </label>
                        <input class="text-black" required type="number" name="price" placeholder="200" value="{{$product->price}}">
                       </div>
                       
                       <div class="mb-4">
                        <label for="">Product Quantity: </label>
                        <input class="text-black" required type="number" name="quantity" min="0" placeholder="10" value="{{$product->quantity}}">
                       </div>
                       
                       <div class="mb-4">
                        <label for="">Product Category: </label>
                        <select class="text-black"name="category">
                          <option value="{{$product->category}}"selected="">{{$product->category}}</option>
                          @foreach ($categories as $category)
                          <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                          @endforeach
                        
                          
                        </select>
                       </div>

                       <div class="mb-4 flex">
                        <label>Current Product Image: </label>
                            <img src="/product/{{$product->image}}" alt="product image" width="150" height="150">
                       </div>

                       <div class="mb-4">
                        <label>Change Product Image: </label>
                        <input type="file" name="image">
                       </div>
                        
                      <input type="submit" value="Update Product" class="btn btn-outline-primary btn-lg text-lg">
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