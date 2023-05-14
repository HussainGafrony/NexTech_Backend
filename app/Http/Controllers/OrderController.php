<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\order;
use App\Models\OrderDetails;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $order = order::where('user_id', '=', $request->user_id)->first();
        return new OrderResource($order);
    }

    public function store(Request $request)
    {

        $product = products::where('id', '=', $request->product_id)->first();
        if ($request->order_id == 0) {
            $order = new order;
            $order->user_id = $request->user_id;
            $order->adress_id = $request->adress_id;
            $order->final_price = $product->price * $request->QTY;
            $order->status = 1;
            $order->save();
            $order_details = new OrderDetails;
            $order_details->order_id = $order->id;
            $order_details->product_id = $product->id;
            $order_details->product_name = products::find($product->id)->name;
            $order_details->category_id = $product->category_id;
            $order_details->QTY = $request->QTY;
            $order_details->price = $product->price;
            $order_details->total_price = $product->price * $request->QTY;
            $order_details->save();
            return new OrderResource($order);
        } else {
            $order = order::find($request->order_id);
            $oldOrderDetails = OrderDetails::where('order_id', '=', $request->order_id)->where('product_id', '=', $request->product_id)->first();
            if (empty($oldOrderDetails)) {

                $order->update([
                    'final_price' => ($product->price * $request->QTY) + ($order->final_price),
                ]);
                $order_details = new OrderDetails;
                $order_details->order_id = $order->id;
                $order_details->product_id = $product->id;
                $order_details->product_name = products::find($product->id)->name;
                $order_details->category_id = $product->category_id;
                $order_details->QTY = $request->QTY;
                $order_details->price = $product->price;
                $order_details->total_price = $product->price * $request->QTY;
                $order_details->notes = $request->notes;
                $order_details->save();
                return new OrderResource($order);
            } else {

                $new_total_price = $product->price * $request->QTY;
                $price_difference = $new_total_price - $oldOrderDetails->total_price;

                $oldOrderDetails->update(['QTY' => $request->QTY, 'total_price' => $new_total_price]);

                $order->final_price += $price_difference;
                $order->save();
                return new OrderResource($order);

            }

        }
    }

    public function update(Request $request)
    {
        $order_details = OrderDetails::find($request->order_detail_id);
        $product = products::find($order_details->product_id);
        $order = order::find($order_details->order_id);

        $new_total_price = $product->price * $request->QTY;
        $price_difference = $new_total_price - $order_details->total_price;

        $order_details->update(['QTY' => $request->QTY, 'total_price' => $new_total_price]);

        $order->final_price += $price_difference;
        $order->save();

        return new OrderResource($order);
    }

    public function destroy(Request $request)
    {

        $order = order::find($request->order_id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        OrderDetails::where('order_id', '=', $order->id)->delete();
        $order->delete();

        return response(['Deleted' => Response::HTTP_NO_CONTENT]);
    }

    public function delete_OrderDetailsID(Request $request)
    {
        $order_details = OrderDetails::find($request->order_detail_id);
        $order = order::find($order_details->order_id);
        $order->final_price = $order->final_price - $order_details->total_price;
        $order->save();
        $order_details->delete();
        return new OrderResource($order);

    }
}
