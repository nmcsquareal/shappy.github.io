<!DOCTYPE html>
<html>
   <head>
        @include('user.inside_head')
        <style type="text/css">
            td{
                line-height: 200px;
            }
        </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('user.header')
         <!-- end header section -->

         <div class="table mt-5">
            <table class="mx-auto mt-3">
                <tr class="text-center">
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th></th>
                </tr>

                @foreach ($order as $orders)
                <tr class="text-center">

                    <td>{{$orders->product_title}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>{{$orders->price}}</td>
                    <td>{{$orders->payment_status}}</td>
                    <td>{{$orders->delivery_status}}</td>
                    <td>
                        <img height=80 width="150"src="product/{{$orders->image}}">
                    </td>
                    <td>
                        @if($orders->delivery_status == 'Pending')

                        <a onclick="return confirm('Are you sure to cancel this order?')" 
                        href="{{url('cancel_order', $orders->id)}}" class="btn btn-danger w-100">Cancel Order</a>

                        @elseif($orders->delivery_status == 'Cancelled Order')
                        <a onclick="return confirm('Are you sure to remove this cancelled order?')" 
                        href="{{url('remove_cancel_order', $orders->id)}}" class="btn btn-danger w-100">Remove</a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </table>
         </div>

      </div>
   </body>
</html>