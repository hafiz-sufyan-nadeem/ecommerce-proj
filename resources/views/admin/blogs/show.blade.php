@extends('admin.layouts.main')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Category</h2>

            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.blogs') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $blog->name }}
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{$blog->description}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image</strong>
                {{ $blog->image }}
            </div>
        </div>


    </div>
@endsection
