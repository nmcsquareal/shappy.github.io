<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   @include('admin.css')
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

                <div class="flex justify-center items-center flex-col">
                    <h2 class="text-center text-[40px] pt-[40px]">Add Category</h2>
                    <form action="add_category" method="POST" class="my-5">
                        @csrf
                        <input class="text-black"type="text" name="category_name" placeholder="Write category name">
                        <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Add Category">
                    </form>
                </div>
                {{-- Table --}}
                <div class="container border table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                
                          <th>Category Name </th>
                          
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->category_name}} </td>
                            <td>
                              <a onclick="return confirm('Are you sure you want to delete?')" href="{{url('delete_category',$category->id)}}" class="btn btn-outline-danger">Delete</a>
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