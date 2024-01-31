<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadFileRequest;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * Display a listing of the download files
     * 
     * @return view of the index page
     */
    public function index()
    {
        $downloads = Download::all();

        return view('downloads.index', ['downloads' => $downloads]);
    }

    /**
     * Show the form for uploading a new file
     */
    public function create()
    {
        return view('downloads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DownloadFileRequest $request)
    {
        // dd($request);
        $path = $request->file('file_upload')->storePublicly('medias');

        Download::create([
            'title' => $request->title,
            'file' => $path
        ]);

        return redirect(route('downloads.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Download $download)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Download $download)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Download $download)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        //
    }
}
