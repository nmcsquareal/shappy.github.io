<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Reply;
use Session;

use Stripe;
class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = auth()->user()->usertype;
        if($usertype == '1')
        {
            $total_product= product::all()->count();
            $total_order= order::all()->count();
            $total_user= user::all()->count();
            $total_p= product::all()->count();
            $order= order::all();

            $total_revenue= 0;

            foreach($order as $order)

            {
             $total_revenue= $total_revenue + $order->price;
            }

            $total_delivered= order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_pending= order::where('delivery_status', '=', 'processing')->get()->count();
            
            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_pending'));
        }
        else{
            $product = Product::paginate(20);
            $comment = Comment::orderby('id', 'desc')->get();
            $reply = Reply::all();
           
            return view('user.home',compact('product', 'comment', 'reply'));

        }
    }

    public function index()
    {
        $product = Product::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        return view('user.home', compact('product', 'comment', 'reply'));
    }

    public function product_details($id){
        if(Auth::id())
        {
            $product = Product::find($id);
            return view('user.product_details',compact('product'));
        }
        else{
            return redirect()->route('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        {
            $user_id = Auth::id();
            $cart = Cart::where('user_id',$user_id)->get();
            return view('user.show_cart',compact('cart'));
        }
        else{
            return redirect()->route('login');
        }
     
    }

    public function add_cart(Request $request, $id)
    {
      if(Auth::id())
      {
       $user = Auth::user();
       $product= Product::find($id);

       $userid = $user->id;
       $product_exist_id = Cart::where('product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();

       if($product_exist_id){
        $cart = cart::find($product_exist_id)->first();
        $quantity = $cart->quantity;
        $cart->quantity=$quantity + $request->quantity;

        $cart->price = $cart->price*$cart->quantity;
        $cart->save();

        return redirect()->back();
       }

       else{
        $cart = new Cart;
        $cart->name = $user->name;
        $cart->email = $user->email;
        $cart->phone = $user->phone;
        $cart->address = $user->address;
        $cart->product_title = $product->title;
        $cart->price = $product->price * $request->quantity;
        $cart->quantity = $request->quantity;
          $cart->image = $product->image;
          $cart->product_id = $product->id;
             $cart->user_id = $user->id;
             $cart->save();
 
             return redirect()->back()->with('success','Product added to cart successfully');
       }

      }
      else{
        return redirect()->route('login');
      }
    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('success','Product removed from cart successfully');
    }

    public function checkout()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id',$user_id)->get();
        return view('user.checkout',compact('cart'));
    }


    public function cash_order()
    {
        $user = Auth::user();
        $userID=$user->id;
        $foo = Cart::where('user_id','=',$user->id)->get();

        foreach($foo as $data)
        {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->user_id = $data->user_id;
            $order->payment_status = 'Cash on delivery';
            $order->delivery_status = 'Pending';
            $order->save();

            $cart_id=$data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('messsage','Order placed successfully');
        
    }

    public function stripe($totalPrice)
    {
        return view('user.stripe',compact('totalPrice'));

    }

    public function stripePost(Request $request,$totalPrice)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $totalPrice * 100,

                "currency" => "php",

                "source" => $request->stripeToken,

                "description" => "Test payment from itsolutionstuff.com." 

        ]);

        $user = Auth::user();
        $userID=$user->id;
        $foo = Cart::where('user_id','=',$user->id)->get();

        foreach($foo as $data)
        {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->user_id = $data->user_id;
            $order->payment_status = 'Paid with stripe';
            $order->delivery_status = 'Pending';
            $order->save();

            $cart_id=$data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();

    }

    public function show_order(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;

            $order = order::where('user_id', '=', $userid)->get();
            return view('user.order', compact('order'));
        }
        else{
            return redirect('login');
        }
    }

    public function cancel_order($id){
        $order = order::find($id);
    
        $order->delivery_status = "Cancelled Order";
        $order->save();

        return redirect()->back();
    }

    public function remove_cancel_order($id){
        $order = order::find($id);
        $order->delete();

        return redirect()->back();
    }

    public function add_comment(Request $request){
        if(Auth::id()){
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;

            $comment->save();

            return redirect()->back();  
        }
        else{
            return redirect('login');
        }
    }

    public function add_reply(Request $request){
        if(Auth::id()){
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->name = Auth::user()->name;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request-> reply;
            $reply->save();

            return redirect()->back();

        }   
        else{
            return redirect('login');
        }
    }

    public function product_search(Request $request){

        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        $search_text = $request->search;

        $product = Product::where('title', 'LIKE', "%$search_text%")
        ->orWhere('category', 'LIKE', "%$search_text%")->paginate(10);

        return view('user.home', compact('product', 'comment', 'reply'));
    }

    public function products(){
        $product = Product::paginate(20);
            $comment = Comment::orderby('id', 'desc')->get();
            $reply = Reply::all();

        return view('user.all_product', compact('product', 'comment', 'reply'));
    }

    public function search_product(Request $request){
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        $search_text = $request->search;

        $product = Product::where('title', 'LIKE', "%$search_text%")
        ->orWhere('category', 'LIKE', "%$search_text%")->paginate(10);

        return view('user.all_product', compact('product', 'comment', 'reply'));
    }
}
