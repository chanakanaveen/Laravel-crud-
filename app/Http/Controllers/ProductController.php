<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = product::orderBy('updated_at' , 'DESC')->paginate();
        return view('product.index' ,compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:4096'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id,
            'slug' => Str::slug($request->name),

        ]);

        return redirect()->back()->with('messages', 'Product has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        $product = Product::where('slug',$slug)->first();

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:4096'
            ]);
            $newImageName = uniqid() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            $product->image_path = $newImageName;
        }

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->status = $request->status;
        $product->user_id = auth()->user()->id;
        $product->update();

        return redirect()->route('index')->with('messages', 'Product has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$id)->first();
        $product->delete();

        return redirect()->route('index')->with('messages', 'Product has been deleted successfully!');
    }

}
