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

              <div class="container border table-responsive">
                <table class="table">
                  <thead>
                    <tr>
            
                      <th>Product Title </th>
                      <th>Product Description </th>
                      <th>Product Price </th>
                      <th>Product Quantity </th>
                      <th>Product Category </th>
                      <th>Product Image </th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->title}} </td>
                        <td>{{ $product->description}} </td>
                        <td>{{ $product->price}} </td>
                        <td>{{ $product->quantity}} </td>
                        <td>{{ $product->category}} </td>
                        <td><img src="/product/{{ $product->image}}"> </td>
                        <td>
                          <a class="btn btn-outline-danger mr-2" onclick="return confirm('Are you sure you want to delete?')" href="{{url('delete_product',$product->id)}}">Delete</a>
                          <a class="btn btn-outline-warning" href="{{url('update_product',$product->id)}}">Edit</a>
                        </td>
                       
                      </tr>      
                    @endforeach
                    
                    
                  </tbody>
                </table>
              </div>
             
            </div>
        </div>
        
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>