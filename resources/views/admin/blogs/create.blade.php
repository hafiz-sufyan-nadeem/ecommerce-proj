@extends('admin.layouts.main')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">
                <h2>Add New Blog</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary mb-2" href="{{ route('admin.blogs') }}"> Back</a>
            </div>

        </div>

    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    <input type="text" name="name" class="form-control" placeholder="Name">

                </div>

            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea type="text" name="description" class="form-control" placeholder="Description">
                    </textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Image:</strong>

                    <input type="file" class="form-control" name="image" id="image">

                </div>

            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button  type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>

    </form>
@endsection
