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
       <form class= "custom-form"action="{{ route('product.update', $product->id) }}" method="POST">
            @method('PUT')


           <h2>EDIT PRODUCT</h2>

@csrf


<div class="form-group">
    <label for="product_name">PRODUCT NAME</label>
    <input type="text" class="form-control" name="product_name" id="product_name" value="{{ $product->product_name }}"  required>
</div>


           <div class="form-group">
               <label for="product_code">PRODUCT CODE</label>
               <input type="text" class="form-control" name="product_code" id="product_code"  value="{{ $product->product_code }}" readonly>
           </div>


           <div class="form-group">
            <label for="price">PRICE</label>
            <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}"  required>
        </div>


        <div class="form-group">
            <label for="discount_percentage">DISCOUNT PERCENTAGE(%)</label>
            <input type="text" class="form-control" name="discount_percentage" id="discount_percentage" value="{{ $product->discount }}"  required>
        </div>

        <div class="form-group">
            <label for="datePickerFrom">EXPIRY DATE</label>
            <input type="date" class="form-control" name="expiry_date"  value="{{ $product->expiry_date }}"  required>
        </div>



           <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
       </form>


   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</center>
</body>
</html>




