<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $news = News::all();

        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $categories = Category::all();

        return view('news.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = "uploads/news/";
            $file->move($path, $filename);
        }

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'banner_image' => $path . $filename,
            'category_id' => $request->category_id,
        ];

        $newData = News::create($data);
        return redirect(route('news.index'))->with('message', 'Succesfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $news = News::find($id);

        return view('news.show', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $news = News::findOrFail($id);
        $categories = Category::all();

        return view('news.edit', ['news' => $news, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNewsRequest $request, string $id)
    {
        $news = News::find($id);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = "uploads/news/";
            $file->move($path, $filename);

            if (File::exists($news->banner_image)) {
                File::delete($news->banner_image);
            }
        }

        $news->title = $request->title;
        $news->content = $request->content;
        $news->category_id = $request->category_id;
        $news->banner_image = isset($filename) ? $path . $filename : $news->banner_image;

        $news->save();


        return redirect(route('news.index'))->with('message', 'Succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $news = News::findOrFail($id);
        if (File::exists($news->banner_image)) {
            File::delete($news->banner_image);
        }

        $news->delete();
        return redirect(route('news.index'))->with('message', 'Blog deleted successfully');
    }
}
