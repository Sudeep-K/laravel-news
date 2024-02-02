<?php

namespace App\Http\Controllers;

use App\DataTables\NewsDataTable;
use App\Http\Requests\StoreNewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of all the news.
     */
    public function index()
    {


        // $news = News::all();
        // return view('news.index', ['news' => $news]);

        // $data = News::latest()->get();
        // dd($data);


        if (request()->ajax()) {
            $data = News::latest()->get();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="/news/' . $row['id'] . '/edit" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" data-id="' . $row['id'] . '" onclick="deleteData(' . $row['id'] . ')"  class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('news.index');
    }





    public function homepage()
    {

        $news = News::all();

        $latestNews = News::latest()->take(5)->get();
        $categories = Category::all();
        // dd($categories);
        return view('welcome', ['news' => $news, 'categories' => $categories, 'latestNews' => $latestNews]);
    }

    public function article(string $slug)
    {

        $news = News::where('slug', $slug)->get();
        // dd($news[0]->title);
        $latestNews = News::latest()->take(5)->get();
        $categories = Category::all();
        return view('article', ['news' => $news, 'categories' => $categories, 'latestNews' => $latestNews]);
    }

    /**
     * Show the form for creating a new news.
     */
    public function create()
    {
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
        $tags = array_map(fn ($tag) => trim($tag), $tags);
        // dd($tags);



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
     * Display the specified news.
     */
    public function show(News $news)
    {
        return view('news.show', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified news.
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        $retrieved_tags = implode(",", $news->tags->map(fn ($tag) => $tag->name)->toArray());

        // dd($retrieved_tags);

        return view('news.edit', ['news' => $news, 'categories' => $categories, 'tags' => $retrieved_tags]);
    }

    /**
     * Update the specified news with tags and category in storage.
     */
    public function update(StoreNewsRequest $request, News $news)
    {
        // stores all the new and existing tags except the tags that were deleted
        $tag_ids = [];

        // parse the tag here to array format from string
        $tags = $request->tags;
        $tags = explode(",", $tags);
        $tags = array_map(fn ($tag) => trim($tag), $tags);

        // check if the tag is available, else create a new tag
        foreach ($tags as $tag) {
            if (Tag::where('name', $tag)->exists()) {
                $tagData = Tag::where('name', $tag)->first();
                array_push($tag_ids, $tagData->id);
            } else {
                $tagData = Tag::create(['name' => $tag, 'slug' => Str::slug($tag)]);
                $news->tags()->attach($tagData->id);
                array_push($tag_ids, $tagData->id);
            }
        }

        // now sync the ids for the news in the pivot table and remove all other attachments
        $news->tags()->sync($tag_ids);


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
    public function destroy($id)
    {

        $news = News::findOrFail($id);
        if (File::exists($news->banner_image)) {
            File::delete($news->banner_image);
        }

        $news->delete();
        return redirect(route('news.index'))->with('message', 'Blog deleted successfully');
    }

    public function ajaxDelete(string $id)
    {
        $news = News::findOrFail($id);
        if (File::exists($news->banner_image)) {
            File::delete($news->banner_image);
        }

        $news->delete();
        $data = News::all();
        return response()->json(['message' => 'data deleted successfully', 'data' => $data->toArray()]);
    }
}
