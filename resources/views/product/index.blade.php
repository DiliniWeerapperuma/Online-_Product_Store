<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

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

<h1> <center> VIEW ALL PRODUCT DETAILS </center> </h1>

<body class ="container">

    <a href = "{{ route('product.add') }}" class="btn btn-primary mt-5">ADD PRODUCT</a>
<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th scope="col">PRODUCT NAME</th>
      <th scope="col">PRODUCT CODE</th>
      <th scope="col">PRICE</th>
      <th scope="col">DISCOUNT PERCENTAGE(%)</th>
      <th scope="col">EXPIRY DATE</th>
      <th scope="col">ACTION</th>



    </tr>
  </thead>
  <tbody>

    @foreach ($products as $product )


    <tr>
      <th scope="row">{{ $product->product_name}}</th>
      <td>{{ $product->product_code }}</td>
      <td>{{ $product->price }}</td>
      <td>{{ $product->discount }}</td>
      <td>{{ $product->expiry_date }}</td>
      <td><a button type="button" class="btn btn-success" href="{{ route('product.show', $product->id) }}"> VIEW </button></td>
      <td><a button type="button" class="btn btn-warning" href="{{ route('product.edit', $product->id) }}"> EDIT </button></td>




    </tr>

    @endforeach

  </tbody>
</table>

</body>
</html>
