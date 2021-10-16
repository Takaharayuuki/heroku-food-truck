<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form = $request->all();

        $productList = $form['product']; // product[]の形で送られてくる


        foreach ($productList as $index => $item) {
            $normalizeItem = json_decode($item);
            $product = new Product();
            $store_id = Store::latest()->get()->first()->id;
            $product->store_id = $store_id;
            $product->name = $normalizeItem->name;
            $product->price = $normalizeItem->price;
            // 画像ファイルの有無の確認
            if ($request->hasFile('file')) {
                $fileList = $request->file('file');
                $file_name = $fileList[$index]->getClientOriginalName();
                $fileList[$index]->storeAs('public/', $file_name);
                $product->thumbnail_url = '/storage/' . $file_name;
            }
            $product->remark = $normalizeItem->remark;
            $product->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::where('store_id', $id)->get();
        return $products;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
