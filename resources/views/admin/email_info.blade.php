<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/public">
   @include('admin.css')
   <style>
    label{
        display: inline-block;
        width: 12rem;
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
                <h1 class="text-center">Send Email to {{$order->email}}
                </h1>
                <form class="text-center" action="{{route('send_user_email', $order->id)}}" method="">
                    @csrf

                <div class=" pt-5">
                    <label class="text-left">Email Greeting</label>
                    <input type="text" name="greeting" class="text-neutral-900">
                 </div>

                 <div class=" pt-5">
                    <label  class="text-left">Email FirstLine</label>
                    <input type="text" name="firstline" class="text-neutral-900">
                 </div>

                 <div class=" pt-5">
                    <label  class="text-left">Email Body</label>
                    <input type="text" name="body" class="text-neutral-900">
                 </div>

                 <div class=" pt-5">
                    <label  class="text-left">Email Button Name</label>
                    <input type="text" name="button" class="text-neutral-900">
                 </div>

                 <div class=" pt-5">
                    <label  class="text-left">Email Url</label>
                    <input type="text" name="url" class="text-neutral-900">
                 </div>

                 <div class=" pt-5">
                    <label  class="text-left">Email Lastline</label>
                    <input type="text" name="lastline" class="text-neutral-900">
                 </div>

                 <div class=" pt-5">
                   
                    <input type="submit" value="Send Email" class="btn btn-outline-warning">
                 </div>

                </form>
            </div>
        </div>
        
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>