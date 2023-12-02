<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $products = Product::orderBy('name')->paginate(5);
            return view("adminPage.product", compact("products"));
        }catch(Throwable $th){
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

    /**
     *  open create Page.
     */
    public function create(){
        return view("adminPage.addProduct");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), [
                "name" => "required",
                "price" => "required",
                "description" => "required",
                "discount" => "required",
                "image" => "required|image|mimes:jpeg,png,jpg,gif|max:2048", // Add image validation rules
            ]);
    
            if ($validation->fails()) {
                dd($validation->errors());
            }

            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;  
            $product->price = $request->price;  
            $product->discount = $request->discount;  
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName); // Store the image in the public/images directory
                $product->image = $imageName;
            }
            $product->userID = Auth::user()->id;   
            $product->save();

            return redirect()->back()->with("message", 'product added successfully');
        }catch(Throwable $th){
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findorfail($id);
        return view('home.showProduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $product = Product::findorfail($id);
            if(Auth::user()->id == $product->userID || Auth::user()->usertype){
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->discount = $request->discount;
                if ($request->hasFile('image')) {
                    // Delete the old image if it exists
                    if ($product->image) {
                        Storage::disk('public')->delete('images/' . $product->image);
                    }
        
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/images', $imageName);
                    $product->image = $imageName;
                }
                $product->update();
                return redirect()->back()->with('deleted','Category updated successfully');
            }
            return abort(403);
        }catch(Throwable $th){
            return redirect()->back()->with('error', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product = Product::findorfail($id);
            if(Auth::user()->id == $product->userID || Auth::user()->usertype){
                $product->delete();
                return redirect()->back()->with('deleted','product deleted successfully');
            }
            return abort(403);
        }catch(Throwable $th){
            return redirect()->back()->with('error', $th);
        }
    }
}
