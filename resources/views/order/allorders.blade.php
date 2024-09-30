<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

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



 <a href="{{route('order.add')}}"  class="btn btn-primary mt-5">Add New Order</a>

      <div class="card">
        <div class="card-body">
            <table class="table table-bordered first">
                <thead class="thead-custom">

                    <tr>
                        <th><input type="checkbox" id="checkAll"/></th>
                        <th scope="col">ORDER NUMBER</th>
                        <th scope="col">CUSTOMER NAME</th>
                        <th scope="col">ORDER DATE </th>
                        <th scope="col">ORDER TIME</th>
                        <th scope="col">NET AMOUNT</th>
                        <th scope="col">DETAILED VIEW</th>
                        <th scope="col">PRINT</th>
                        <th scope="col">XL</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($orders as $order)

                        <tr>

                            <td><input type="checkbox" name="select_item" value="{{ $order->order_number }}" /></td>
                            <td>{{$order->order_number}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td>{{ \Carbon\Carbon::parse($order->date_time)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->date_time)->format('H:i:s') }}</td>
                            <td>{{$order->amount}}</td>

                            <td><a button type="button" class="btn btn-success" href="{{ route('order.show', $order->order_number) }}"> VIEW </button></td>
                            <td><a button type="button" class="btn btn-warning" href="{{ route('order.print',$order->order_number) }}"> PRINT </button></td>
                            <td><a button type="button" class="btn btn-danger" href="{{ route('order.csv',$order->order_number) }}"> CSV </button></td>



                        </tr>
                        @endforeach

                    </tbody>
                    </table>

        </div>
      </div>


        {{-- <a class="btn btn-secondary" href="{{route('order.export')}}">Print</a> --}}
        {{-- <a class="btn btn-secondary" href="{{route('order.export.xml')}}">Export as XML</a> --}}


        {{-- <button id="exportAllButton" class="btn btn-primary"  href="{{route('order.export')}}"  >Export All</button> --}}
        <button class="btn btn-secondary btn-sm mt-2" type="button" onclick="exportSelected();">Export All</button>

        {{-- <a class="btn btn-secondary" href="{{route('order.export')}}">Export All</a> --}}


    </div>


    <script>



    function attachSelectAll() {
    var selectAllCheckbox = document.getElementById('checkAll');
    if (selectAllCheckbox) {
        var checkboxes = document.querySelectorAll('input[name="select_item"]');
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    }
}


document.addEventListener('DOMContentLoaded', attachSelectAll);






function exportSelected() {
    // Collect IDs of all checked checkboxes
    var selectedNumbers = [];
    document.querySelectorAll('input[name="select_item"]:checked').forEach(function(checkbox) {
        selectedNumbers.push(checkbox.value);
    });

    if (selectedNumbers.length > 0) {
        $.ajax({
    type: "POST",
    url: "{{ route('order.export') }}", // This uses the named route
    data: {
        "_token": "{{ csrf_token() }}",
        'ids': selectedNumbers,
    },
    success: function(response) {
        if (response.file) {
            window.location.href = response.file; // Trigger the file download
        } else {
            alert('Export failed. Please try again.');
        }
    },
    error: function(xhr) {
        alert('An error occurred while exporting.');
    }
});


    } else {
        alert('No items selected for export.');
    }


}




</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>
</html>




