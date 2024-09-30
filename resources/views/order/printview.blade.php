<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .invoice-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1500px;
            margin: 0 auto;
            overflow-x: auto;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .invoice-header h1 {
            font-size: 24px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
        }
        .invoice-info {
            font-size: 14px; /* Reduced font size */
        }
        .invoice-info b {
            display: block;
            margin-bottom: 10px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            margin-bottom: 30px;
            background-color: #fff;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
            text-align: center;
            font-size: 12px; /* Reduced font size */
        }
        .table tbody tr:last-child td {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .table td, .table th {
            padding: 8px;
            vertical-align: middle;
            font-size: 12px; /* Reduced font size */
        }
        .table td:first-child, .table th:first-child {
            text-align: left;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <div class="invoice-header">
        <h1>Invoice - Order {{$order->order_number}}</h1>
    </div>

    <div class="invoice-info">
        <b>Customer Name: {{$order->customer_name}}</b>
        <b>Order Number: {{$order->order_number}}</b>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Discount Percentage(%)</th>
                    <th scope="col">Purchased Quantity</th>
                    <th scope="col">Free Product</th>
                    <th scope="col">Free Quantity</th>
                    <th scope="col">Discount Value</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td>{{$detail->product_name}}</td>
                    <td>{{$detail->product_code}}</td>
                    <td align="right">{{number_format($detail->product_price, 2)}}</td>
                    <td>{{$detail->product_discount}}</td>
                    <td>{{$detail->order_quantity}}</td>
                    <td>{{$detail->product_name}}</td>
                    <td>{{$detail->free_quantity}}</td>
                    <td>{{$detail->order_discount}}</td>
                    <td align="right">{{number_format($detail->net_amount, 2)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8" class="text-end">Net Amount:</td>
                    <td align="right">{{number_format($order->amount, 2)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBogGz1A3g8rK3ntk5ZPVQbnP9ep9JTVp5+7VwXU5RSYQGh+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-QF1U6jNA10z40mNudbW1Bqi3kkX1p7J4zI4E1mUpL7wqGVk6RJIFcGfIOMbFA58k" crossorigin="anonymous"></script>

</body>
</html>
