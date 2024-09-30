<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Place the Order</title>



    <style>

        .container {
          width: 60%;
          margin: 20px auto;
          overflow: hidden;
          background-color: rgb(211, 211, 211);
          box-shadow: rgba(0, 0, 0, 0) 0px 5px 15px !important;
          border-radius: 10px !important;
          padding: 20px 30px;


        }

        .column {
          width: 48%;
          float: left;
          margin-right: 2%;
        }

        .column:last-child {
          margin-right: 0;
        }


        .botton{

            width: 100%; /* Make the button 100% width of its container */
          background-color: #4caf50;
          color: white;
          padding: 10px 15px;
          border: none;
          border-radius: 4px;
          cursor: pointer;}

        .btn{
            border: none;

        }

        .title{
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            font-family: sans-serif;}

        </style>






</head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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













    <div class="container">

        <h1 class="title">PLACING ORDER</h1>

        <form id="orderForm" class="mt-5" action="{{ route('order.save') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="selectCustomer" class="form-label">Customer Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="selectCustomer" name="selectCustomer"
                        aria-label="Text input with dropdown button" readonly value="{{ old('selectCustomer') }}" required>
                    <input type="hidden" name="customerId" id="customerId">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Select Customer</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach ($customers as $customer)
                        <li><a class="dropdown-item" href="#"
                                onclick="updateCustomer('{{ $customer->id }}','{{ $customer->customer_name }}')">
                                {{ $customer->customer_name }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>

                <script>
                    function updateCustomer(customerId, customerName) {
                        document.getElementById('selectCustomer').value = customerName;
                        document.getElementById('customerId').value = customerId;
                    }
                </script>


            <div class="mb-3">
                <label for="orderNumber" class="form-label">Order Number</label>
                <input type="text" class="form-control" name="orderNumber" id="orderNumber"
                value="{{ $nextPrimaryKey }}"  readonly>
            </div>

            <table class="table" id="orderTable">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount Percentage(%)</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Free</th>
                        <th scope="col">Discount Value</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="rowTemplate" style="display: none;">
                        <!-- This is a hidden template row that will be cloned when 'Add' button is clicked -->
                        <td>
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="productName[]"
                                        aria-label="Text input with dropdown button" id="productName" readonly required>
                                    <input type="hidden" name="productId[]" id="productId">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Select Product</button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        @foreach ($products as $id => $product)
                                        <li><a class="dropdown-item" href="#"
                                                onclick="updatePro(this, '{{ $product['id'] }}','{{$product['product_name'] }}','{{ $product['product_code'] }}' ,'{{ $product['price'] }}', '{{ $product['discount'] }}' )">{{ $product['product_name'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="productCode[]" readonly required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="productPrice[]" readonly
                                    required>
                            </div>
                        </td>

                        <td>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="productDiscount[]" readonly
                                    required>
                            </div>
                        </td>



                        <td>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="orderQuantity[]"
                                    oninput="calculate(this)">
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="orderFree[]" readonly
                                    >
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="orderDiscount[]" readonly
                                    >
                            </div>
                        </td>


                        <td>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="orderAmount[]" readonly required>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>


            <button type="button" class="btn btn-success" onclick="addRow()">Add</button>

            <div class="mb-3">
                <label for="amount" class="form-label">Net Amount</label>
                <input type="text" class="form-control" name="amount" id="amount" readonly
                    value="{{ old('amount') }}" required>
            </div>

            <script>
                function addRow() {
                    var tableBody = document.getElementById("orderTable").getElementsByTagName('tbody')[0];
                    var newRow = document.getElementById("rowTemplate").cloneNode(true);
                    newRow.style.display = "table-row";

                    // Remove the ID attribute from the cloned row to avoid duplicate IDs
                    newRow.removeAttribute('id');

                    // Set the onclick attribute for the "Remove" button in the cloned row
                    newRow.querySelector('[onclick="removeRow(this)"]').setAttribute('onclick', 'removeRow(this)');

                    // Append the new row to the table
                    tableBody.appendChild(newRow);
                }

                function removeRow(button) {
                    var row = button.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                    updateTotalAmount();
                }

                function updatePro(button, id,productName, productCode, productPrice, productDiscount) {

                    console.log('Updating product:',id, productName, productCode, productPrice, productDiscount );
        // Get the corresponding row
        var row = button.closest('tr');

        // Set values for the row
        row.querySelector('[name="productName[]"]').value = productName;
        row.querySelector('[name="productCode[]"]').value = productCode;
        row.querySelector('[name="productPrice[]"]').value = productPrice;
        row.querySelector('[name="productDiscount[]"]').value = productDiscount;
        row.querySelector('[name="productId[]"]').value = id;

        // Reset other columns
        row.querySelector('[name="orderQuantity[]"]').value = '';
        row.querySelector('[name="orderFree[]"]').value = '';
        // row.querySelector('[name="orderDiscount[]"]').value = '';
        row.querySelector('[name="orderAmount[]"]').value = '';

        // Display the row
        row.style.display = 'table-row';

        calculate(row.querySelector('[name="orderQuantity[]"]'));
    }

                function calculate(input) {
                    // Get the corresponding row
                    var row = input.parentNode.parentNode.parentNode;

                    // Get values from input fields
                    var column1Value = parseFloat(row.querySelector('[name="productPrice[]"]').value) || 0;
                    var column2Value = parseFloat(row.querySelector('[name="orderQuantity[]"]').value) || 0;
                    var column3Value = parseFloat(row.querySelector('[name="productDiscount[]"]').value) || 0;
                    // console.log ('discount',column3Value );
                    var pro_id = row.querySelector('[name="productId[]"]').value;

                    // Perform multiplication and addition
                    var discountValue = (column1Value*column2Value*column3Value)/100 ;
                    var  result = (column1Value * column2Value)- discountValue;

                    // var result = pre_result ;
                    console.log('result', result);

                    // console.log('discountValue',discountValue );

                    row.querySelector('[name="orderAmount[]"]').value = result.toFixed(2);
                    row.querySelector('[name="orderDiscount[]"]').value = discountValue.toFixed(2);

                    cal(row); // Call the cal function after calculating the orderAmount
                    updateTotalAmount();
                }

                function cal(row) {
                    var qv = parseFloat(row.querySelector('[name="orderQuantity[]"]').value) || 0;
                    var productName = row.querySelector('[name="productName[]"]').value;
                    var pro_id = row.querySelector('[name="productId[]"]').value;

                    var productData = getProductData(pro_id);

                    if (productData !== 0) {

                        var v1 = parseFloat(productData['lower_limit']) || 0;
                        var v2 = parseFloat(productData['upper_limit']) || 0;
                        var v2a = parseFloat(productData['upper_limit']) || 0
                        var v3 = (productData['type']) || 0;
                        var v4 = parseFloat(productData['purchase_quantity']) || 0;
                        var v5 = parseFloat(productData['free_quantity']) || 0;
                        var v7 = 0;

                        var v6 = parseFloat(row.querySelector('[name="orderQuantity[]"]').value) || 0;
                        var v20 = parseFloat(row.querySelector('[name="productPrice[]"]').value) || 0;
                        var v30 = parseFloat(row.querySelector('[name="orderAmount[]"]').value) || 0;
                        var v40 = parseFloat(row.querySelector('[name="orderDiscount[]"]').value) || 0;


                        if (productData !== 0) {
                            if (v3 == "Flat") {
                                if (v6 >= v1) {
                                    row.querySelector('[name="orderFree[]"]').value = v5;
                                    console.log("ff")
                                } else {
                                    row.querySelector('[name="orderFree[]"]').value = v7;

                                }

                            }
                            if(v3 == "Multiple"){
                                if (v6 >= v1 && v6 <= v2) {
                                    var v10z = parseInt(v6 / v4);

                                    var v10 = parseInt(v10z*v5);

                                    row.querySelector('[name="orderFree[]"]').value = v10;
                                    row.querySelector('[name="orderFree[]"]').value = v10;
                                    console.log("ff")
                                }

                                if (v6 > v2) {
                                    var v11 = v2 / v4 * v5;
                                    row.querySelector('[name="orderFree[]"]').value = v11;
                                    console.log("ff")
                                }

                                if (v6 < v1) {
                                    row.querySelector('[name="orderFree[]"]').value = v7;
                                }
                            }

                        }
                    } else {
                        row.querySelector('[name="orderFree[]"]').value = v7;
                    }
                }

                function getProductData(productName) {
                    var frees = {!! json_encode($issues) !!};

                    console.log(frees);
                    console.log('frees');
                    console.log(productName);


                    for (const key in frees) {
                        console.log(frees[key].purchase_product);
                        if (frees.hasOwnProperty(key) && frees[key].purchase_product === productName) {
                            return frees[key];
                            console.log(frees[key]);
                            console.log('frees[key]');


                        }
                    }


                    return 0;
                }

                function updateTotalAmount() {
                    var tableRows = document.getElementById("orderTable").getElementsByTagName('tbody')[0]
                        .getElementsByTagName('tr');
                    var totalAmount = 0;

                    for (var i = 0; i < tableRows.length; i++) {
                        var rowAmount = parseFloat(tableRows[i].querySelector('[name="orderAmount[]"]').value) || 0;
                        totalAmount += rowAmount;
                    }

                    document.getElementById("amount").value = totalAmount.toFixed(2);
                }
            </script>

            <button type="submit" class="botton">Save</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
