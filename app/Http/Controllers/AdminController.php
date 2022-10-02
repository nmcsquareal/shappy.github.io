<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\TheNotification;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->back()->with('message', 'Category added successfully');
    }
    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    public function view_product()
    {
        $categories = Category::all();
        return view('admin.product',compact('categories'));
    }

    public function add_product(Request $request)
    {
        $product = new Product;

        $product->title = $request->title;
        
        $product->description = $request->product_description;

        $product->price = $request->price;
        
        $product->quantity = $request->quantity;

        $product->category = $request->category;

        $image = $request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('product',$imagename);

        $product->image=$imagename;
        
        $product->save();

        return redirect()->back()->with('message', 'Product added successfully');
    }

    public function show_product()
    {
        $products = Product::all();
        return view('admin.show_product',compact('products'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function update_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.update_product',compact('product','categories'));
    }

    public function update_product_confirm($id,Request $request)
    {
        $product = Product::find($id);
        $categories = Category::all();

        $product->title=$request->title;
        $product->description=$request->product_description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;

        $image = $request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }
        $product->save();
        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function order_product(){

        $order= order:: all();

        return view('admin.order_product', compact('order'));
    }

    public function delivered($id){
   
        $order= order::find($id);
        $order->delivery_status= "Delivered";
        $order->payment_status= "Paid";
        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id){

        $order= order::find($id);

        $pdf=PDF::loadView('admin.pdf', compact('order'));

        return $pdf->download('order_details.pdf');
    }

    public function send_email($id){

       $order= order::find($id);

        return view('admin.email_info', compact('order'));
    }
    public function send_user_email(Request $request, $id){

        $order= order::find($id);

        $details=[
            'greeting' => $request->greeting,

            'firstline' => $request->firstline,

            'body' => $request->body,

            'button' => $request->button,

            'url' => $request->url,

            'lastline' => $request->lastline,
        ];

        Notification::send($order,new TheNotofication($details));
        
        return redirect()->back();
    }

    public function searchdata(Request $request){

        $searchText= $request->search;

        $order= order::where('name', 'LIKE', "%$searchText%")->get();

        return view('admin.order_product', compact('order'));
    }
}
