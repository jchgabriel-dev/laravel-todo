<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("categories.index", ["categories" => $categories]);
    }

  
    public function create()
    {

    
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:255",
            "color" => "required|max:7"
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect() -> route("categories.index")->with("success", "Nueva categoria");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show', ['category' => $category]);       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $category = Category::find($category);
        
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        //
        $category = Category::find($category);
        $category->todos()->each(function($todo) {
            $todo->delete(); // <-- direct deletion
         });
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}