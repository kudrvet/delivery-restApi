<?php

namespace App\Http\Controllers;


use App\Models\Seller;
use App\Models\SellerGood;
use Illuminate\Http\Request;

class SellerGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {

        $goods = SellerGood::where('seller_id',$seller->id)->get();
        return $goods;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Seller $seller)
    {
        //
        return SellerGood::create($request->all() + ['seller_id' => $seller->id]);
//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @param  \App\Models\SellerGood  $sellerGood
     * @return \Illuminate\Http\Response
     */
    public function show (Seller $seller, $sellerGoodID)
    {

        $good = SellerGood::find($sellerGoodID)->first();

        return $good;



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @param  \App\Models\SellerGood  $sellerGood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, SellerGood $sellerGood)
    {
        //
//        return $sellerGood->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @param  \App\Models\SellerGood  $sellerGood
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller,  $sellerGoodID)
    {
        //
//        $good = SellerGood::find($sellerGoodID);
//        if ($good) {
//            $good->delete($good);
//        }
    }
}
