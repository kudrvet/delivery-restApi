<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\BuyerOrder;
use App\Models\SellerGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $orders = BuyerOrder::where('buyer_id',$buyer->id)->get();
        return $orders;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Buyer $buyer)
    {
        $order = BuyerOrder::create($request->all() +['buyer_id' => $buyer->id]);
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @param  \App\Models\BuyerOrder  $buyerOrder
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer, $buyerOrderID)
    {
        $order = BuyerOrder::find($buyerOrderID)->first();

        return $order;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyer  $buyer
     * @param  \App\Models\BuyerOrder  $buyerOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer, BuyerOrder $buyerOrder)
    {
        //

//        $buyerOrder->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyer  $buyer
     * @param  \App\Models\BuyerOrder  $buyerOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer, $buyerOrderID)
    {
//        {
//            $order = BuyerOrder::find($buyerOrderID);
//            if ($order) {
//                $order->delete($buyerOrderID);
//            }
//
//        }
    }


    public function createUnconfirmedOrderWithDeliveryCost(Request $request, $buyerID)
    {

        $goodID = $request->input('good_id');

        if(!$goodID) {
            return "good_id query param is not recieved";
        }

//        dd(SellerGood::find($goodID));

//        $sellerAddress = SellerGood::find($goodID)->seller->pivot->address;

        $sellerAddress = DB::table('seller_goods')
            ->join('sellers','seller_goods.seller_id','=','sellers.id')
            ->where('seller_goods.id',$goodID)
            ->select('address')
            ->get()
            ->first();

        $errors = [];
        if(is_null($sellerAddress))
        {

            $errors['error'][] = "Good with good_id = {$goodID} is not existing";
        }

        $sellerAddress = $sellerAddress->address;

        $buyerAddress = Buyer::find($buyerID);

        if(is_null($buyerAddress))
        {
            return $errors['error'][] = "Buyer with buyer_id = {$buyerID} is not existing";
        }

        if(!empty($errors)) {
            return $errors;
        }

        $buyerAddress = Buyer::find($buyerID)->address;

        $deliveryCost = (strlen($sellerAddress) + strlen($buyerAddress)) * 10;

        $newOrder = BuyerOrder::create(['delivery_cost' => $deliveryCost]);

        return ['deliveryCost' => $deliveryCost, 'orderID' => $newOrder->id];




    }
}
