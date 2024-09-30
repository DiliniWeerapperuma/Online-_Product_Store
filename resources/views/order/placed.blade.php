<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .detail-group {
            margin-bottom: 15px;
        }
        .detail-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .detail-group div,
        .detail-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .detail-group textarea {
            background-color: #fff;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">CL</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('customer.index')}}" required>Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('product.index')}}">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('issue.index')}}">Free</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('order.allorders')}}">Orders</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('discount.index')}}">Discount</a>
              </li> --}}

            </ul>
          </div>
        </div>
      </nav>

<br>

    <div class="container">



        <div class="mb-3">
            <label for="customerName" class="form-label">CUSTOMER NAME</label>
            <input type="text" class="form-control" name="freeLabel" value="{{$order->customer_name}}" id="customerName" readonly>
        </div>

        <div class="mb-3">
            <label for="orderNumber" class="form-label">ORDER NUMBER</label>
            <input type="text" class="form-control" name="orderNumber" value="{{$order->order_number}}" id="customerName" readonly>


<div class="container">
    <form id="orderForm">
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PRODUCT CODE</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">DISCOUNT PERCENTAGE(%)</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">FREE</th>
                    <th scope="col">DISCOUNT VALUE</th>
                    <th scope="col">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                <tr>


                    <th scope="row">{{$detail->product_name}}</th>
                    <td>{{$detail->product_code}}</td>
                    <td>{{$detail->price}}</td>
                    <td>{{$detail->product_discount}}</td>
                    <td>{{$detail->order_quantity}}</td>
                    <td>{{$detail->free_quantity}}</td>
                    <td>{{$detail->order_discount}}</td>
                    <td>{{$detail->net_amount}}</td>

                </tr>
                @endforeach

                <tr>
                    <td>Net Amount</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="text" class="form-control amount" name="amount[]" value="{{$order->amount}}" readonly>
                    </td>

                </tr>
            </tbody>
        </table>


    </form>

    <input type="hidden" id="net_amount" name="net_amount" value="0">

</div>



            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz4fnFO9gybBogGz1A3g8rK3ntk5ZPVQbnP9ep9JTVp5+7VwXU5RSYQGh+" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-QF1U6jNA10z40mNudbW1Bqi3kkX1p7J4zI4E1mUpL7wqGVk6RJIFcGfIOMbFA58k" crossorigin="anonymous"></script>





        </form>
    </div>


    {{-- <a class="btn btn-secondary" href="{{route('order.print', $order->order_number)}}">Print</a> --}}

    <script>

    // document.getElementById('selectAll').addEventListener('change', function() {
    //     var checkboxes = document.querySelectorAll('input[name="select_item"]');
    //     checkboxes.forEach((checkbox) => {
    //         checkbox.checked = this.checked;
    //     });
    // });


    </script>

</body>
</html>




