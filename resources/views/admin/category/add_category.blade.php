@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>All Category</h3>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($n_categories as $n_category)
                            <li>--> {{ $n_category->category_name }}</li>
                            @foreach ($n_category->childrenCategories as $childCategory)
                                @include('admin.category.child_category', ['childCategory' => $childCategory])
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Add new category</h3>
                </div>
                <div class="card-body"> 
                    <form class="sign-box" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('exists'))
                            <div class="alert alert-warning">{{session('exists')}}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <div class="form-group">
                            <select class="form-control" name="category_id" aria-label="Default select example">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="category_name" class="form-control" placeholder="Category Name"/>
                            @error('category_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="file" name="icon" class="form-control" placeholder="Icon"/>
                            @error('icon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-rounded btn-success sign-up">Add category</button>
                    </form>
                </div>
            </div>
        </div>

        
        {!! Main::ShowUploadImageHtml('image123', '', 'image') !!}
    </div>
@endsection