<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Manufacturer;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Resources\ProductCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::collection(Product::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyName = Manufacturer::pluck('company', 'id')->toArray();
    /*проблемы в выемке елементов из масива повторить!! */
        foreach ($companyName as $key => $company) {
            if ($company === $request['company']) {
                $companyId = $key;

                $product = new Product;
                $product->title = $request->title;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->company_id = $companyId;
                $product->save();


                return response()->json([
                    'data' => new ProductResource($product)
                ], Response::HTTP_CREATED);
              }else{
                return response()->json([
                        'error' => 'This company not found!'
                    ]
                );
            }
          }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
        'data' => new ProductResource($product)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        
        return response()->json([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'data' => new ProductResource($product)
        ], Response::HTTP_NO_CONTENT);
    }


    /**
     * @param Product $product
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     * 
     */
     public function getProductAndComments(Product $product)
    {
        $product = Product::with('comments')->where('id', $product->id)->first();
        
        return response()->json([
            'data' => $product
        ], Response::HTTP_OK);
    }
}
