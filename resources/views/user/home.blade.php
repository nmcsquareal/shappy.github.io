<!DOCTYPE html>
<html>
   <head>
        @include('user.inside_head')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('user.header')
         <!-- end header section -->

         <!-- slider section -->
         @include('user.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('user.why')
      <!-- end why section -->
      
      <!-- product section -->
      @include('user.product')
      <!-- end product section -->


      <!-- footer start -->
      @include('user.footer')
      <!-- footer end -->
     @include('user.script')

     <script type="text/javascript">

      function reply(caller){

         document.getElementById('commentId').value = $(caller).attr('data-Commentid');

         $('.replyDiv').insertAfter($(caller));
         $('.replyDiv').show();
      }

      function reply_close(caller){
         $('.replyDiv').hide();
      }
     </script>
     <script>
      document.addEventListener("DOMContentLoaded", function(event) { 
          var scrollpos = localStorage.getItem('scrollpos');
          if (scrollpos) window.scrollTo(0, scrollpos);
      });

      window.onbeforeunload = function(e) {
          localStorage.setItem('scrollpos', window.scrollY);
      };
  </script>
   </body>
</html>