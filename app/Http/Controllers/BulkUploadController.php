<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BulkUploadController extends Controller
{
    public function __invoke(Request $request)
    {
        info('got called');
        // Validate the request
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Max size of 2MB
        ]);

        // Get the uploaded file
        $file = $request->file('image');

        // Generate a unique file name
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        // Store the file in the 'uploads' directory (public disk)
        $filePath = $file->storeAs('public/bulk_uploads', $filename);

        // Return a response with the file path or URL
        return response()->json([
            'success' => true,
            'file_path' => Storage::url($filePath),
        ]);
    }
}
