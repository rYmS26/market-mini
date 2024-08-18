@extends('master')

@section('title', 'Product Report')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Product Report</h1>

    <!-- PDF Download Button -->
    <div class="mb-3 text-center">
        <a href="{{ route('product.report.pdf') }}" class="btn btn-danger">Download PDF</a>
    </div>
    
    <!-- Product Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
