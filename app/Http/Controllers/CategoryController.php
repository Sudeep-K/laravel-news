<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of all the categories.
     * 
     * @return view of the index page for categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new category.
     * 
     * @return view of form for creation of new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     * 
     * @return redirect to index page of categories.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name, "-")
        ]);

        return redirect(route("categories.index"));
    }

    /**
     * Display the specified category.
     * 
     * @return the view for individual category
     */
    public function show(Category $category)
    {
        return view("categories.show", ["category" => $category]);
    }

    /**
     * Show the form for editing the specified category.
     * 
     * @return the form view.
     */
    public function edit(Category $category)
    {
        return view("categories.edit", ["category" =>  $category]);
    }

    /**
     * Update the specified category in storage.
     * 
     * @return redirect to the edited category
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, "-");
        $category->save();

        return redirect(route("categories.show", ["category" => $category]));
    }

    /**
     * Remove the specified category from storage.
     * 
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect(route("categories.index"));
    }
}
