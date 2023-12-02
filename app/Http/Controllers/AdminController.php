<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // show all categories
    public function category(){
        $categories = Category::all();
        return view("adminPage.category", compact("categories"));
    }

    // add new category
    public function addCategory(Request $request){
        try{
            $category = new Category;
            $category->categoryName = $request->category;
            $category->userID = Auth::user()->id;
            $category->save();
    
            return redirect()->back()->with('message', 'Category added successfully');
        } catch(\Throwable $th){
            return redirect()->back()->with('error', 'Category already exists');
        }
    }
    
    // update category 
    public function editCategory(Request $request, $id){
        try{
            $category = Category::findorfail($id);
            if(Auth::user()->id == $category->userID || Auth::user()->usertype){
                $category->categoryName = $request->name;
                $category->update();
                return redirect()->back()->with('deleted','Category updated successfully');
            }
            return abort(403);
        }catch(\Throwable $th){
            return redirect()->back()->with('error', $th);
        }
    }

    // delete category 
    public function deleteCategory($id){
        try{
            $category = Category::findorfail($id);
            if(Auth::user()->id == $category->userID || Auth::user()->usertype){
                $category->delete();
                return redirect()->back()->with('deleted','Category deleted successfully');
            }
            return abort(403);
        }catch(\Throwable $th){
            return redirect()->back()->with('error', $th);
        }
    }
}
