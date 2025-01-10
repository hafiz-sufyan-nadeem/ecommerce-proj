@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            </div>
        @endif

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Blogs</h1>

        <div>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-dark mb-2 ml-auto">Add New Blog</a>
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
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->name }}</td>
                                <td>{{ $blog->description }}</td>
                                <td><img src="{{asset('admin-images/blog/' . $blog->image)}}" width="45px"></td>

                                <td>
                                    <!-- Action buttons -->
                                    <a class="btn btn-primary" href="{{ route('admin.blogs.edit', $blog->id) }}">Edit</a>

                                    <form id="deleteForm{{ $blog->id }}" action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="deleteconfirm({{ $blog->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $blogs->links()}}

                </div>
            </div>
        </div>

    </div>

    <script>
        function deleteconfirm(blogId) {
            var confirmation = confirm("Are you sure you want to delete this category?");

            if (confirmation) {
                var form = document.getElementById('deleteForm' + blogId);

                if (form) {
                    form.submit();
                } else {
                    alert("Form not found for blog ID: " + blogId);
                }
            } else {
                alert("Blog deletion cancelled!");
            }
        }
    </script>
@endsection
