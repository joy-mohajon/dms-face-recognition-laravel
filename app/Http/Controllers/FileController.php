<?php

namespace App\Http\Controllers;


use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:file_list', ['only' => ['index', 'preview']]);
        $this->middleware('permission:file_create', ['only' => ['create','store']]);
        $this->middleware('permission:file_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // return auth::id();
        $files = File::orderBy('id', 'DESC')->paginate(10);

        return view('pages.file.index', compact('files'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.file.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(FileRequest $request)
    {
        $fileModel = new File;

        // Generate a unique filename
        $fileName = 'files/' . $request->name . '_' . time() . '.' . $request->file->getClientOriginalExtension();

        // Store the file in the public disk
        $filePath = Storage::putFileAs('public', $request->file('file'), $fileName);
        // // $filePath = $request->file('file')->storeAs('files', $fileName, 'public');
        // $filePath = Storage::put($fileName, $request->file('file'), 'public');

        // Fill the file model attributes
        $fileModel->name = $request->name;
        $fileModel->mimeType = $request->file->getClientMimeType();
        $fileModel->size = $request->file->getSize();
        $fileModel->user_id = auth()->id(); // Use auth() helper instead of Auth facade
        $fileModel->path = Storage::url($filePath); // Generate a public URL for the file

        $fileModel->save();
        return redirect()->route('files.index')
            ->with('success', 'File created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::findOrFail($id);

        return view('pages.file.view', ['file'=>$file]);
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        // Delete the file from storage
        if (Storage::exists($file->path)) {
            Storage::delete($file->path);
        }
        // Storage::delete($file->path);

        // Delete the file record from the database
        $file->delete();

        return response()->json(['success' => true, 'status'=> 'File has been deleted.']);
    }

    public function preview(string $id)
    {
        try {
            $file = File::findOrFail($id);

            if($file->mimeType=='application/pdf'){
                $response = response()->file(public_path($file->path), [
                    'Content-Type' => 'application/pdf',
                ]);
            }else {
                $response = response()->file(public_path($file->path), [
                    'Content-Type' => 'image/jpeg',
                ]);
            }

            return $response;
        } catch (\Exception $e) {
            // Handle file not found gracefully
            return abort(404, "The file does not exist."); // Or redirect, show an error message, etc.
        }
    }

}
