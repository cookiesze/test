<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $products =Product::where('name','like','%'.$request->search_name.'%')
                    ->OrderBy('id','desc')
                    ->paginate(500);

        return view('/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = new Product();


        return view('create',  compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Create the directory if it doesn't exist
    if (!File::isDirectory(public_path("assets/uploads/products/images/"))) {
        File::makeDirectory(public_path("assets/uploads/products/images/"), 0755, true);
    }

    // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'price' => 'required|numeric',
        'commission' => 'required|numeric',
        'ex_date' => 'required|string|max:255',
        'description' => 'required|string',
        'name_promotion' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'link' => 'required|url',
        'status' => 'required|in:Enabled,Disabled',
    ]);

    // Handle file upload
    if ($request->hasFile("image")) {
        $file = $request->file("image");
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path("assets/uploads/products/images/"), $imageName);
    }

    // Create the product
    $product = Product::create([
        "name" => $request->name,
        "slug" => $request->slug,
        "price" => $request->price,
        "commission" => $request->commission,
        "ex_date" => $request->ex_date,
        "description" => $request->description,
        "name_promotion" => $request->name_promotion,
        "image" => $imageName,
        "status" => $request->status,
        "link" => $request->link,
    ]);

    // Redirect or perform additional actions after creating the product
    // For example, you might want to redirect the user to a success page
    return redirect()->route('product.create')->with('success', 'Product created successfully');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }


    public function productindex(Product $product)
    {
        $searchName = request('search_name');

        $products = Product::where('name', 'like', '%' . $searchName . '%')
            ->orderBy('id', 'asc')
            ->paginate(500);

        return view('welcome', compact('products'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,$id )
    {
        $product = Product::find($id);

        return view('edit',  compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'price' => 'required|numeric',
        'commission' => 'required|numeric',
        'ex_date' => 'required|string|max:255',
        'description' => 'required|string',
        'name_promotion' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'link' => 'required|url',
        'status' => 'required|in:Enabled,Disabled',
    ]);

    // Handle file upload if a new image is provided
    if ($request->hasFile("image")) {
        // Delete the old image if it exists
        if ($product->image) {
            $oldImagePath = public_path("assets/uploads/products/images/") . $product->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        // Upload the new image
        $file = $request->file("image");
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path("assets/uploads/products/images/"), $imageName);

        // Update the product with the new image
        $product->update([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "commission" => $request->commission,
            "ex_date" => $request->ex_date,
            "description" => $request->description,
            "name_promotion" => $request->name_promotion,
            "image" => $imageName,
            "status" => $request->status,
            "link" => $request->link,
        ]);
    } else {
        // Update the product without changing the image
        $product->update([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "commission" => $request->commission,
            "ex_date" => $request->ex_date,
            "description" => $request->description,
            "name_promotion" => $request->name_promotion,
            "status" => $request->status,
            "link" => $request->link,
        ]);
        // dd($request->all());
    }


    return redirect()->back()->with('success', 'Product updated successfully');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::where('id', $id)->first();

        if (!$products) {
            return view('errors.404');
        }

        if (File::exists('assets/uploads/products/images/'.$products->image)) {
            File::delete('assets/uploads/products/images/'.$products->image);
        }

        $products->delete();

        return redirect('/index')->with('success', 'Product deleted successfully');
    }
}
