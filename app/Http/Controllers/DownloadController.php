<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadFileRequest;
use App\Http\Requests\EditDownloadFileRequest;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('downloads.show', ['download' => $download]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Download $download)
    {
        return view('downloads.edit', ['download' => $download]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditDownloadFileRequest $request, Download $download)
    {
        if ($request->hasFile('file_upload')) {
            Storage::delete($download->file);
            $path = $request->file('file_upload')->storePublicly('medias');
            $download->update([
                "title" => $request->title,
                "file" => $path
            ]);
        } else {
            $download->update([
                "title" => $request->title
            ]);
        }

        return redirect(route('downloads.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        //
    }
}
