<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Issue;
use App\Models\Product;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;


use PDF;
// use Storage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

// use ZipArchive;
// use ZipStream\ZipStream;
// use ZipStream\Option\Archive;




class OrderController extends Controller
{
    public function addOrder(){

        $customers = Customer::select('customer_name', 'id')->get();
        $issues = Issue::get(['id', 'free_issue_label', 'type', 'purchase_product', 'free_product', 'purchase_quantity', 'free_quantity', 'lower_limit', 'upper_limit'])
            ->keyBy('id')
            ->toArray();

        $products = Product::get(['id', 'product_name', 'product_code', 'price' , 'discount'])
            ->keyBy('id')
            ->toArray();

        $nextPrimaryKey = Order::max('order_number') + 1;

    return view('order.addorder', compact('customers', 'products', 'issues', 'nextPrimaryKey'));

    }





public function save(Request $request)
{

    // dd($request->all());

    $order = new Order();
    // $order-> customer_name	= $request->selectCustomer;
    $order->customer_name = $request->customerId;
    // $order->customer_id = $request->customer_name;
    $order-> amount= $request->amount;
    $order->save();

    $nextPrimaryKey = $order->order_number;
    // $nextPrimaryKey = Order::max('order_number');

    $productName = $request->productName;
    $productNames = array_filter($productName, function($value) {
        return !is_null($value);
    });

    $productCode = $request->productCode;
    $productCodes = array_filter($productCode, function($value) {
        return !is_null($value);
    });

    $productPrice = $request->productPrice;
    $productPrices = array_filter($productPrice, function($value) {
        return !is_null($value);
    });

    $productDiscount = $request->productDiscount;
    $productDiscounts = array_filter($productDiscount, function($value) {
        return !is_null($value);
    });

    $orderQuantity=$request->orderQuantity;
    $orderQuantities = array_filter($orderQuantity, function($value) {
        return !is_null($value);
    });

    $orderFree = $request->orderFree;
    $orderFrees = array_filter($orderFree, function($value) {
        return !is_null($value);
    });

    $orderDiscount = $request->orderDiscount;
    $orderDiscounts = array_filter($orderDiscount, function($value) {
        return !is_null($value);
    });

    $orderAmount = $request->orderAmount;
    $orderAmounts = array_filter($orderAmount, function($value) {
        return !is_null($value);
    });

    if (is_array($productNames) && count($productNames) > 0) {
        for ($i = 1; $i <= count($productNames); $i++) {
            $dataSave = [
                'order_id' => $nextPrimaryKey,
                'product_name' =>$productNames[$i],
                'product_code' =>$productCodes[$i],
                'product_price' =>$productPrices[$i],
                'product_discount' =>$productDiscounts[$i],
                'order_quantity' =>$orderQuantities[$i],
                'free_quantity' =>$orderFrees[$i] ?? 0,
                'order_free' =>$orderFrees[$i] ?? null,
                'order_discount' =>$orderDiscounts[$i] ?? 0,

                'net_amount' =>$orderAmounts[$i]
            ];
            DB::table('details')->insert($dataSave);
        }
    }

    // return view('order.allorders',compact('orders'));;
    return redirect()->route('order.allorders');
}


public function allorders(){


    $orders = Order::join('customers as c', 'c.id', 'orders.customer_name')
    ->select([
        'orders.order_number as order_number',
        'orders.customer_name as customer_id',
        'c.customer_name as customer_name',
        'orders.created_at as date_time',
        'orders.amount as amount'
    ])

    ->get();

    // dd($orders);
    // $orders = Order::all();
    return view('order.allorders',compact('orders'));


}

public function show($order_number)
{
    // Fetch the order
    $order = Order::where('order_number', $order_number)
        ->join('customers as c', 'c.id', 'orders.customer_name')
        ->select([
            'orders.order_number as order_number',
            'c.customer_name as customer_name',
            'orders.created_at as date_time',
            'orders.amount as amount'

        ])
        ->first();


    $details = Order::join('details as d', 'd.order_id', 'orders.order_number')
        ->join('products as p', 'p.product_code', 'd.product_code')
        ->join('customers as c' , 'c.id', 'orders.customer_name')
        ->where('orders.order_number', $order_number)
        ->select([

            'p.product_name as product_name',
            'p.product_code as product_code',
            'p.price as price',
            'd.Product_discount as product_discount',
            'd.free_quantity as free_quantity',
            'd.order_quantity as order_quantity',
            'd.Order_discount as order_discount',
            'd.net_amount as net_amount'
        ])
        ->get();

        // dd($details);


    return view('order.placed', compact('order', 'details'));
}


// public function csv($order_number) {

//     $orders = Order::where('order_number', $order_number)
//     ->join('customers as c', 'c.id', 'orders.customer_name')
//     ->select([
//         'orders.order_number as order_number',
//         'c.customer_name as customer_name',
//         'orders.created_at as date_time',
//         'orders.amount as amount'
//     ])
//     ->first();


// $details = Order::join('details as d', 'd.order_id', 'orders.order_number')
//     ->join('products as p', 'p.product_code', 'd.product_code')
//     ->join('customers as c' , 'c.id', 'orders.customer_name')
//     ->where('orders.order_number', $order_number)
//     ->select([

//         'p.product_name as product_name',
//         'p.product_code as product_code',
//         'p.price as product_price',
//         'd.Product_discount as product_discount',
//         'd.free_quantity as free_quantity',
//         'd.order_quantity as order_quantity',
//         'd.Order_discount as order_discount',
//         'd.net_amount as net_amount'

//     ])
//     ->get();


//     $currentDateTime = now();

//     // Prepare the CSV header
//     $csvData = "Order Number,Customer Name,Product Name,Product Code,Price,Discount,Order Quantity,Free Quantity, Discount Value, Amount, Net Amount\n";

//     // Add order and details data to CSV
//     foreach ($details as $detail) {
//         $csvData .= "{$orders->order_number},{$orders->customer_name},{$detail->product_name},{$detail->product_code},{$detail->product_price},{$detail->product_discount},{$detail->order_quantity},{$detail->free_quantity},{$detail->order_discount}, {$detail->net_amount},{$orders->amount}, \n";

//     }

//     // Set headers for download
//     $fileName = 'order_' . $order_number . '.csv';
//     return response($csvData, 200)
//         ->header('Content-Type', 'text/csv')
//         ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
// }


public function csv($order_number) {
    // Fetch the order and customer details
    $order = Order::where('order_number', $order_number)
        ->join('customers as c', 'c.id', 'orders.customer_name')
        ->select([
            'orders.order_number as order_number',
            'c.customer_name as customer_name',
            'orders.created_at as date_time'
        ])
        ->first();

    // Fetch the details of each product in the order
    $details = Order::join('details as d', 'd.order_id', 'orders.order_number')
        ->join('products as p', 'p.product_code', 'd.product_code')
        ->where('orders.order_number', $order_number)
        ->select([
            'p.product_name as product_name',
            'p.product_code as product_code',
            'p.price as product_price',
            'd.Product_discount as product_discount',
            'd.free_quantity as free_quantity',
            'd.order_quantity as order_quantity',
            'd.Order_discount as order_discount',
            'd.net_amount as net_amount'
        ])
        ->get();

    // Calculate the total amount for the order
    $totalAmount = $details->sum('net_amount');

    // Prepare the CSV header
    $csvData = "Order Number,Customer Name,Product Name,Product Code,Price,Discount,Order Quantity,Free Quantity,Discount Value,Amount\n";

    // Add each detail row to the CSV
    foreach ($details as $detail) {
        $csvData .= "{$order->order_number},{$order->customer_name},{$detail->product_name},{$detail->product_code},{$detail->product_price},{$detail->product_discount},{$detail->order_quantity},{$detail->free_quantity},{$detail->order_discount},{$detail->net_amount}\n";
    }

    // Append the Net Amount row at the end
    $csvData .= ",,,,,,,,Net Amount,{$totalAmount}\n";

    // Set headers for download
    $fileName = 'order_bill_' . $order_number . '.csv';
    return response($csvData, 200)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
}




public function print($order_number) {

    $order = Order::where('order_number', $order_number)
    ->join('customers as c', 'c.id', 'orders.customer_name')
    ->select([
        'orders.order_number as order_number',
        'c.customer_name as customer_name',
        'orders.created_at as date_time',
        'orders.amount as amount'
    ])
    ->first();


$details = Order::join('details as d', 'd.order_id', 'orders.order_number')
    ->join('products as p', 'p.product_code', 'd.product_code')
    ->join('customers as c' , 'c.id', 'orders.customer_name')
    ->where('orders.order_number', $order_number)
    ->select([

        'p.product_name as product_name',
        'p.product_code as product_code',
        'p.price as product_price',
        'd.Product_discount as product_discount',
        'd.free_quantity as free_quantity',
        'd.order_quantity as order_quantity',
        'd.Order_discount as order_discount',
        'd.net_amount as net_amount'

    ])
    ->get();

        $currentDateTime = now();

        $pdf = PDF::loadview('order.printview', compact('order','details'));

        return $pdf->stream("{$order_number}_{$currentDateTime}.pdf");



}








// public function exportCsv(Request $request) {

//     $order_numbers = $request->input('ids');

//     if (empty($order_numbers)) {
//         return response()->json(['error' => 'No orders selected.'], 400);
//     }

//     $csvData = "Order Number,Customer Name,Product Name,Product Code,Price,Discount,Order Quantity,Free Quantity,Discount Value ,Amount, Net Amount\n";

//     foreach ($order_numbers as $order_number) {
//         $order = Order::join('customers as c', 'c.id', 'orders.customer_name')
//             ->where('orders.order_number', $order_number)
//             ->select([
//                 'orders.order_number as order_number',
//                 'c.customer_name as customer_name',
//                 'orders.amount as amount'
//             ])
//             ->first();

//         $details = Order::join('details as d', 'd.order_id', 'orders.order_number')
//             ->join('products as p', 'p.product_code', 'd.product_code')
//             ->where('orders.order_number', $order_number)
//             ->select([
//                 'p.product_name as product_name',
//                 'p.product_code as product_code',
//                 'p.price as product_price',
//                 'd.Product_discount as product_discount',
//                 'd.free_quantity as free_quantity',
//                 'd.order_quantity as order_quantity',
//                 'd.Order_discount as order_discount',
//                 'd.net_amount as net_amount'
//             ])
//             ->get();



//         // Iterate over the $details collection
//         foreach ($details as $detail) {
//             $csvData .= "{$order->order_number},{$order->customer_name},{$detail->product_name},{$detail->product_code},{$detail->product_price},{$detail->product_discount} ,{$detail->order_quantity},{$detail->free_quantity}, {$detail->order_discount},{$detail->net_amount},{$order->amount}\n";
//         }
//     }




//     // Set headers for download
//     $fileName = 'orders_export_' . now()->format('Ymd_His') . '.csv';
//     $filePath = public_path("storage/{$fileName}");

//     file_put_contents($filePath, $csvData);

//     return response()->json(['file' => asset("storage/{$fileName}")]);
// }


public function exportCsv(Request $request) {
    $order_numbers = $request->input('ids');

    if (empty($order_numbers)) {
        return response()->json(['error' => 'No orders selected.'], 400);
    }

    // Prepare the CSV header
    $csvData = "Order Number,Customer Name,Product Name,Product Code,Price,Discount,Order Quantity,Free Quantity,Discount Value,Amount\n";

    foreach ($order_numbers as $order_number) {
        // Fetch the order and customer details
        $order = Order::join('customers as c', 'c.id', 'orders.customer_name')
            ->where('orders.order_number', $order_number)
            ->select([
                'orders.order_number as order_number',
                'c.customer_name as customer_name',
                'orders.amount as amount'
            ])
            ->first();

        // Fetch the details of each product in the order
        $details = Order::join('details as d', 'd.order_id', 'orders.order_number')
            ->join('products as p', 'p.product_code', 'd.product_code')
            ->where('orders.order_number', $order_number)
            ->select([
                'p.product_name as product_name',
                'p.product_code as product_code',
                'p.price as product_price',
                'd.Product_discount as product_discount',
                'd.free_quantity as free_quantity',
                'd.order_quantity as order_quantity',
                'd.Order_discount as order_discount',
                'd.net_amount as net_amount'
            ])
            ->get();

        // Calculate the total net amount for the order
        $totalNetAmount = $details->sum('net_amount');

        // Add each detail row to the CSV
        foreach ($details as $detail) {
            $csvData .= "{$order->order_number},{$order->customer_name},{$detail->product_name},{$detail->product_code},{$detail->product_price},{$detail->product_discount},{$detail->order_quantity},{$detail->free_quantity},{$detail->order_discount},{$detail->net_amount}\n";
        }

        // Append the Net Amount row at the end of the order
        $csvData .= ",,,,,,,,Net Amount,{$totalNetAmount}\n\n";
    }

    // Save the CSV file to the public storage path
    $fileName = 'orders_export_' . now()->format('Ymd_His') . '.csv';
    $filePath = public_path("storage/{$fileName}");

    file_put_contents($filePath, $csvData);

    // Return the file path as a response
    return response()->json(['file' => asset("storage/{$fileName}")]);
}



}









