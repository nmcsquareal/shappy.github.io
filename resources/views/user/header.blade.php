<header class="header_section">
    <div class="container">
       <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{url('/')}}"><img width="150" src="img/2.png" alt="#" /></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav">
                <li class="nav-item active">
                   <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{url('products')}}">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('show_cart')}}"><i class="fa fa-shopping-cart mr-2"></i>Cart</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('show_order')}}">Order</a>
                </li>
                <form class="form-inline">
                   <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                   <i class="fa fa-search" aria-hidden="true"></i>
                   </button>
                </form>
            @if (Route::has('login'))
                @auth
                <x-app-layout>
                    
                </x-app-layout>
                @else
                <li class="nav-item">
                    <a class=" btn btn-outline-primary mx-1" href="{{ route('login') }}">Login</a>
                 </li>
                 @if (Route::has('register'))
                 <li class="nav-item">
                    <a class=" btn btn-outline-success" href="{{ route('register') }}">Register</a>
                 </li>
                 @endif
             @endauth
             @endif
             </ul>
          </div>
       </nav>
    </div>
 </header> 
 