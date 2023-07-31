@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a href="{{ route('blog-index') }}">Blog</a> / {{ $blog_item->title_hy }}</h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12 m-auto">
                    <div class="p-5">
                        <form enctype="multipart/form-data" class="user" method="post" action="{{ route('blog-update', $blog_item->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="title_en">EN Title</label>
                                <input type="text" required id="title_en" name="title_en" class="form-control" value="{{ $blog_item->title_en }}">
                            </div>

                            <div class="form-group">
                                <label for="title_ru">RU Title</label>
                                <input type="text" required id="title_ru" name="title_ru" class="form-control" value="{{ $blog_item->title_ru }}">
                            </div>

                            <div class="form-group">
                                <label for="title_hy">HY Title</label>
                                <input type="text" required id="title_hy" name="title_hy" class="form-control" value="{{ $blog_item->title_hy }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="description_en">EN Description</label>
                                <textarea required id="description_en" name="description_en" class="form-control" rows="10">{{ $blog_item->description_en }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_ru">RU Description</label>
                                <textarea required id="description_ru" name="description_ru" class="form-control" rows="10">{{ $blog_item->description_ru }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_hy">HY Description</label>
                                <textarea required id="description_hy" name="description_hy" class="form-control" rows="10">{{ $blog_item->description_hy }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="img" class="w-100">Image</label>
                                <img src="{{ asset('storage/blog/'.$blog_item->img) }}" class="img-fluid rounded">
                                <input type="file" class="form-control" id="img" name="img">
                            </div>

                            <div class="form-group">
                                <label for="file" class="w-100">File</label>
                                <a target="_blank" href="{{ asset('storage/blog/files/'.$blog_item->file) }}">View File</a>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

