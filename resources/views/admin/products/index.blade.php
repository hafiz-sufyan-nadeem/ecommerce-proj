@extends('admin.layouts.main')
@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>

        <div>
            <a href="{{route('admin.products')}}" class="btn btn-dark mb-2 ml-auto">New Product</a>
        </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{asset('images/' . $product->image)}}" width="45px"></td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <!-- Action buttons -->
                                <a class="btn btn-primary" href="{{ route('admin.products.edit',$product->id) }}">Edit</a>

                                <form id="deleteForm{{$product->id}}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="deleteconfirm({{$product->id}})"> Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function deleteconfirm(productId) {
        var confirmation = confirm("Are you sure you want to delete this product?");

        if (confirmation) {
            var form = document.getElementById('deleteForm' + productId);

            if (form) {
                form.submit();
            } else {
                alert("Form not found for product ID: " + productId);
            }
        } else {
            alert("Product deletion cancelled!");a
        }
    }
</script>
@endsection
