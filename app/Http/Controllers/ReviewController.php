<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Store;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd($request);
        // $reviews = Review::where('user_id', $request$id)->get();
        // return $reviews;
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
        $review = Review::create([
            'user_id' => $request->userId,
            'store_id' => $request->storeId,
            'user_name' => $request->userName,
            'title' => $request->title,
            'comment' => $request->comment,
            'rate' => $request->rate,
            'reviewDt' => $request->reviewDt
        ]);

        $store_review = Review::where('store_id', $request->storeId)->get();
        // 該当の店のレビュー総数
        $store_review_count = $store_review->count();
        // スターの総数
        $total_star = 0;
        foreach ($store_review as $review) {
            $total_star += (int)$review->rate;
        }

        (int)$average_rate = (int)$total_star / (int)$store_review_count;
        $average_rate = round((int)$average_rate);

        $store = Store::find($review['store_id']);
        $store->rate = (string)$average_rate;
        $store->save();
        $review->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->path == 'mypage') {
            $reviews = Review::where('user_id', $id)->orderBy('created_at', 'desc')->get();
            return $reviews;
        } else {
            $reviews = Review::where('store_id', $id)->orderBy('created_at', 'desc')->get();
            return $reviews;
        }
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
