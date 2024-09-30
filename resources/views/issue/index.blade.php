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

<h1> <center> DEFINE FREE ISSUES </center> </h1>

<body class ="container">

    <a href = "{{ route('issue.add') }}" class="btn btn-primary mt-5">ADD FREE ISSUES</a>
<table class="table table-striped mt-5">
  <thead>
    <tr>
        <th scope="col">FREE ISSUE LABEL</th>
        <th scope="col">TYPE</th>
        <th scope="col">PURCHASE PRODUCT</th>
        <th scope="col">FREE PRODUCT</th>
        <th scope="col">PURCHASE QUANTITY</th>
        <th scope="col">FREE QUANTITY</th>
        <th scope="col">LOWER LIMIT</th>
        <th scope="col">UPPER LIMIT</th>
        <th scope="col">ACTION</th>

    </tr>
  </thead>
  <tbody>

    @foreach ($issues as $issue)
    <tr>
      <th scope="row">{{  $issue->free_issue_label }}</th>
      <td>{{ $issue->type }}</td>
      {{-- <td>{{ $issue->purchase_product }}</td> --}}
      <td>{{ $issue->product_name }}</td>
      <td>{{ $issue->product_name }}</td>
      <td>{{ $issue->purchase_quantity }}</td>
      <td>{{ $issue->free_quantity }}</td>
      <td>{{ $issue->lower_limit }}</td>
      <td>{{ $issue->upper_limit }}</td>


      {{-- <td>{{ $issue->purchaseproduct->product_name }}</td>
      <td>{{ $issue->freeProduct->product_name }}</td> --}}




      <td><a button type="button" class="btn btn-warning" href="{{ route('issue.edit', $issue->issue_id) }}"> EDIT </button></td>
        <td><a button type="button" class="btn btn-success" href="{{ route('issue.show', $issue->issue_id) }}"> VIEW </button></td>

    </tr>

    @endforeach

  </tbody>
</table>

</body>
</html>
