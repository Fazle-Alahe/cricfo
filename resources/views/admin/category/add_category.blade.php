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
                        @foreach ($n_categories as $category)
                            @include('admin.category.child_category',[
                                'category' => $category,
                            ])
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
                    <form class="sign-box" action="{{ route('category.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if (session('exists'))
                            <div class="alert alert-warning">{{ session('exists') }}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
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
                            <input type="text" name="category_name" class="form-control" placeholder="Category Name" />
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        {!! Main::ShowUploadImageHtml('inputid', '', 'image') !!}

                        <button type="submit" class="btn btn-rounded btn-success sign-up mt-3">Add category</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('foot-js')
    <script>
        // $('.btn').click(function() {
        //     $('#inputid_file').click();

        // });
    </script>
@endpush
