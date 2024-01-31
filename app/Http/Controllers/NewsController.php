<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
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

        $tags = $request->tags;
        $tags = explode(",", $tags);

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

        foreach ($tags as $tag) {
            if (Tag::where('name', $tag)->exists()) {

                $tagData = Tag::where('name', $tag)->first();
                $newData->tags()->attach($tagData->id);
            } else {
                $tagData = Tag::create(['name' => $tag, 'slug' => Str::slug($tag)]);
                $newData->tags()->attach($tagData->id);
            }
        }
        
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
        $tags = News::find($id)->tags;
        $tagData = [];

        foreach ($tags as $tag) {
            array_push($tagData, $tag->name);
        }


        $news = News::findOrFail($id);

        $categories = Category::all();

        return view('news.edit', ['news' => $news, 'categories' => $categories, 'tags' => $tagData]);
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

        // $tags = $request->tags;
        // $tags = explode(",", $tags);

        // $tagsFromDB = News::find($id)->tags;
        // foreach ($tagsFromDB as $tagDB) {
        //     $news->tags()->detach($tagDB->id);
        // }




        // foreach ($tags as $tag) {
        //     if (Tag::where('name', $tag)->exists()) {

        //         $tagData = Tag::where('name', $tag)->first();
        //         $news->tags()->attach($tagData->id);
        //     } else {
        //         $tagData = Tag::create(['name' => $tag, 'slug' => Str::slug($tag)]);
        //         $news->tags()->attach($tagData->id);
        //     }
        // }


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
