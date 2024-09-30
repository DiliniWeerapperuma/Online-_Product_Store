<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .custom-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            width: 100%;
            background-color: #28a745;
            color: white;
        }
    </style>

    <title>Document</title>
</head>




<body class= "container mt-5" >

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


    <center>
        <form class= "custom-form"action="{{ route('issue.update', $issue->id) }}" method="POST">
            @method('PUT')


           <h2>EDIT LINE FREE ISSUES</h2>

@csrf




<div class="form-group">
    <label for="free_issue_label">FREE ISSUE LABLE</label>
    <input type="text" class="form-control" name="free_issue_label" id="free_issue_label" value="{{ $issue->free_issue_label }}"  required>
</div>



<div class="form-group">
    <label for="type">TYPE</label>
    <select class="form-control" name="type" id="type" required>
        <option value="" disabled>Select Type</option>
        <option value="Flat" @if($issue->type == 'Flat') selected @endif>Flat</option>
        <option value="Multiple" @if($issue->type == 'Multiple') selected @endif>Multiple</option>
    </select>
</div>



<div class="form-group">
    <label for="product">PURCHASE PRODUCT</label>
    <select id="product" class="form-control" name="product" required>
        <option value="" selected disabled>Select</option>
        @if(isset($products))
            @foreach($products as $product)
                <option value="{{ $product->id }}"
                        data-product-name="{{ $product->product_name }}"
                        @if ($issue->purchase_product == $product->id) selected @endif >
                    {{ $product->product_name }}
                </option>
            @endforeach
        @endif
    </select>
</div>

{{-- <div class="form-group">
    <label for="product">PURCHASE PRODUCT</label>
    <select id="product" class="form-control" name="product" value="{{ $issue->product}}" required>
        <option value="" selected disabled>Select</option>
        @if(isset($products))
            @foreach($products as $product)
                <option value="{{ $product->id }}" @if ($issue->purchase_product == $product->id) selected @endif >{{ $product->product_name }}</option>
            @endforeach
        @endif
    </select>
</div> --}}

<div class="form-group">
    <label for="free_product_display">FREE PRODUCT</label>
    <input type="text" class="form-control" id="free_product_display"  value="{{ $issue->free_product }}"  readonly required>
    <input type="hidden" name="free_product" id="free_product">
</div>


{{-- <div class="form-group">
    <label for="free_product_display">FREE PRODUCT</label>
    <input type="text" class="form-control" id="free_product_display" value="{{ optional($products->where('id', $issue->free_product)->first())->product_name }}" readonly required>
    <input type="hidden" name="free_product" id="free_product" value="{{ $issue->free_product }}">
</div> --}}


           <div class="form-group">
               <label for="purchase_quantity">PURCHASE QUANTITY</label>
               <input type="text" class="form-control" name="purchase_quantity" id="purchase_quantity" value="{{ $issue->purchase_quantity }}"  required>
           </div>

           <div class="form-group">
            <label for="free_quantity">FREE QUANTITY</label>
            <input type="text" class="form-control" name="free_quantity" id="free_quantity" value="{{ $issue->free_quantity }}"  required>
        </div>


        <div class="form-group">
            <label for="lower_limit">LOWER LIMIT</label>
            <input type="text" class="form-control" name="lower_limit" id="lower_limit" value="{{ $issue->lower_limit }}"  required>
        </div>

        <div class="form-group">
            <label for="upper_limit">UPPER LIMIT</label>
            <input type="text" class="form-control" name="upper_limit" id="upper_limit" value="{{ $issue->upper_limit }}"  required>
        </div>

           <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
       </form>


   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




{{-- <script>
    $(document).ready(function() {
        $('#product').change(function() {
            var selectedProductName = $('#product option:selected').data('product-name');
            var selectedProductId = $('#product').val(); // Get the selected product ID

            // Set the values in the respective fields
            $('#free_product_display').val(selectedProductName); // Display the product name
            $('#free_product').val(selectedProductId); // Store the product ID in the hidden input
        });
    });
</script> --}}


<script>
    $(document).ready(function() {
        // Populate the free_product_display field based on the currently selected product
        var selectedProductId = $('#product').val();
        var selectedProductName = $('#product option:selected').data('product-name');

        // Set the values in the respective fields
        $('#free_product_display').val(selectedProductName); // Display the product name
        $('#free_product').val(selectedProductId); // Store the product ID in the hidden input

        // Update the free_product_display field when the product dropdown changes
        $('#product').change(function() {
            var selectedProductName = $('#product option:selected').data('product-name');
            var selectedProductId = $('#product').val(); // Get the selected product ID

            // Set the values in the respective fields
            $('#free_product_display').val(selectedProductName); // Display the product name
            $('#free_product').val(selectedProductId); // Store the product ID in the hidden input
        });
    });
</script>

</center>
</body>
</html>




