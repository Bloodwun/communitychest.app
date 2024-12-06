<?php

namespace App\Http\Controllers;

use App\Models\PromotionalPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionalPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotionalPdfs = PromotionalPdf::all();
        return view('user.promotional_pdfs.index', compact('promotionalPdfs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.promotional_pdfs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Validate the request
        $validatedData = $request->validate([
            'logo' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'banner' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'promotional_detail' => 'string|nullable',
            'term_n_conditions' => 'string|nullable',
            'coupon_code' => 'string|nullable',
            'start_date' => 'date|nullable',
            'expiration_date' => 'date|nullable|after_or_equal:start_date',
            'layout' => 'string|nullable',
            'img1' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img2' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img3' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img4' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img5' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img6' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img7' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img8' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img9' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img10' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file uploads and move them to the public folder
        $uploadedFiles = [];

        // Handle logo and banner upload
        foreach (['logo', 'banner'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $destinationPath = public_path('uploads/promotional_pdfs');

                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $fileName = $request->file($fileField)->getClientOriginalName();
                $request->file($fileField)->move($destinationPath, $fileName);

                // Store the relative path of the file
                $uploadedFiles[$fileField] = 'uploads/promotional_pdfs/' . $fileName;
            }
        }

        // Handle img1 to img10 uploads
        foreach (range(1, 10) as $i) {
            $fileField = 'img' . $i;
            if ($request->hasFile($fileField)) {
                $destinationPath = public_path('uploads/promotional_pdfs');

                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $fileName = $request->file($fileField)->getClientOriginalName();
                $request->file($fileField)->move($destinationPath, $fileName);

                // Store the relative path of the file
                $uploadedFiles[$fileField] = 'uploads/promotional_pdfs/' . $fileName;
            }
        }
       
        // Merge validated data with uploaded files
        $promotionalPdf = PromotionalPdf::create(array_merge(
            $validatedData,
            $uploadedFiles,
            ['user_id' => auth()->id()]
        ));
       
        // Redirect with success message
        return redirect()->route('promotional-pdfs.index')
                         ->with('success', 'Promotional PDF created successfully.');
    } catch (\Exception $e) {
        // Catch errors and return a message
        return redirect()->back()
                         ->with('error', 'An error occurred: ' . $e->getMessage())
                         ->withInput();
    }
}

    
    

    /**
     * Display the specified resource.
     */
    public function show(PromotionalPdf $promotionalPdf)
    {
        return view('user.promotional_pdfs.show', compact('promotionalPdf'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PromotionalPdf $promotionalPdf)
    {
        return view('user.promotional_pdfs.edit', compact('promotionalPdf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PromotionalPdf $promotionalPdf)
    {
        $validatedData = $request->validate([
            'logo' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'banner' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'promotional_detail' => 'string|nullable',
            'term_n_conditions' => 'string|nullable',
            'coupon_code' => 'string|nullable',
            'start_date' => 'date|nullable',
            'expiration_date' => 'date|nullable',
            'layout' => 'string|nullable',
            'img1' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img2' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img3' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img4' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img5' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img6' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img7' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img8' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img9' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
            'img10' => 'file|nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $uploadedFiles = [];
        foreach (['logo', 'banner', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9', 'img10'] as $fileField) {
            if ($request->hasFile($fileField)) {
                // Delete old file if it exists
                if ($promotionalPdf->$fileField) {
                    Storage::disk('public')->delete($promotionalPdf->$fileField);
                }
                $uploadedFiles[$fileField] = $request->file($fileField)->store('promotional_pdfs', 'public');
            }
        }

        $promotionalPdf->update(array_merge(
            $validatedData,
            $uploadedFiles,
            ['user_id' => auth()->id()]
        ));
        return redirect()->route('promotional-pdfs.index')
                         ->with('success', 'Promotional PDF updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PromotionalPdf $promotionalPdf)
    {
        // Delete files from storage
        foreach (['logo', 'banner', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9', 'img10'] as $fileField) {
            if ($promotionalPdf->$fileField) {
                Storage::disk('public')->delete($promotionalPdf->$fileField);
            }
        }

        $promotionalPdf->delete();

        return redirect()->route('promotional-pdfs.index')
                         ->with('success', 'Promotional PDF deleted successfully.');
    }
}
