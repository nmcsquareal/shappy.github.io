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
                <h1 class="m-5 text-3xl text-center">All Orders</h1>

                <div class="ml-5 mr-5 mb-2 text-neutral-900">
                  <form action="{{route('search')}}" method="get">
                    @csrf
                    <input type="text" name="search" placeholder="Search Here">
                    <input type="submit" value="Search" class="btn btn-primary">
                  </form>
                </div>

                <table class="bg-gray-800 w-11/12 ml-5 pb-5 text-center text-md border-2 rounded-sm">
                    <tr class="bg-cyan-500">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Product title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Delivered</th>
                        <th>Print PDF</th>
                        <th>Send Email</th>
                    </tr>
                      @forelse($order as $order)

                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td><img class ="w-28" src="/product/{{$order->image}}"></td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                            @if($order->delivery_status=='Pending')

                            <a href="{{route('delivered', $order->id)}}" onclick="return confirm('Are you sure this product is delivered?')" class="btn btn-primary">Delivered</a>
                            @else
                            <button type="button" class="btn btn-outline-success" disabled>Done</button>
                            @endif
                        </td>
                        <td><a href="{{route('print_pdf', $order->id)}}" class="btn btn-outline-primary btn-xs">Print Now</a></td>
                        <td><a href="{{route('send_email', $order->id)}}" class="btn btn-outline-warning btn-xs">Send Now</a></td>
                    </tr>

                    @empty
                   <tr>
                    <td colspan="16">
                      NO DATA FOUND
                    </td>
                   </tr>

                    @endforelse
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>