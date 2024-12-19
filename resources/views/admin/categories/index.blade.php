@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Categories</h1>

        <div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-dark mb-2 ml-auto">Add New Category</a>
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
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                <td>
                                    <!-- Action buttons -->
                                    <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>

                                    <form id="deleteForm{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="deleteconfirm({{ $category->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="{{ $categories->links() }}" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="{{ $categories->links() }}">1</a></li>
                            <li class="page-item active">
                                <a class="page-link" href="{{ $categories->links() }}">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="{{ $categories->links() }}">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="{{ $categories->links() }}">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>

    </div>

    <script>
        function deleteconfirm(categoryId) {
            var confirmation = confirm("Are you sure you want to delete this category?");

            if (confirmation) {
                var form = document.getElementById('deleteForm' + categoryId);

                if (form) {
                    form.submit();
                } else {
                    alert("Form not found for category ID: " + categoryId);
                }
            } else {
                alert("Category deletion cancelled!");
            }
        }
    </script>
@endsection
