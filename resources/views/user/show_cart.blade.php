<!DOCTYPE html>
<html>
   <head>
        @include('user.inside_head')

        <base href="/public">
   </head>
   <body>
      @include('user.header')
      <div class="hero_area flex justify-start items-center container">
         <!-- header section strats -->
     
         <!-- end header section -->
         <table class="table table-striped table-hover rounded">
            <thead>
               <tr>
                 <th>Image</th>
                 <th>Title</th>
                 <th>Price</th>
                 <th>Quantity</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               <?php $totalPrice = 0;?>
               @foreach($cart as $carts)
               <tr>
                 <td><img class="rounded"src="/product/{{$carts->image}}" width="200" height="200" alt="product image"/></td>
                 <td>{{$carts->product_title}}</td>
                 <td>₱{{number_format($carts->price)}}</td>
                 <td>{{$carts->quantity}}</td>
                   <td><a class="btn btn-outline-danger"onclick="return confirm('Are you sure you want to remove this product?')" href="{{route('remove_cart',$carts->id)}}">Remove</a></td>
               </tr>
               <?php $totalPrice = $totalPrice + $carts->price;?>
               @endforeach
             </tbody>
          </table>
          <div class="container-fluid flex justify-end">
            <h3 class="text-[40px]">Total Price: ₱{{number_format($totalPrice)}}</h3>
            <a href="{{route('checkout')}}" class="btn btn-primary btn-lg ml-3">Checkout</a>
          </div>
          
         
    </div>
      <!-- footer start -->
      @include('user.footer')
      <!-- footer end -->
     @include('user.script')
   </body>
</html>