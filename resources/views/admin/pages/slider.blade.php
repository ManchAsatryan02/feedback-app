@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Slider</h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7 m-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Slider Data</h1>
                        </div>
                        <form class="user" method="post" action="{{ route('slider-update') }}">
                            @csrf
                            <div class="form-group">
                                <div class="w-100 p-2 border rounded">
                                    <label for="video_url">Video URL</label>
                                    <iframe class="w-100" height="300px" src="{{ $slider_item->video_url }}" frameborder="0"></iframe>
                                    <input required type="text" id="video_url" name="video_url" class="form-control" value="{{ $slider_item->video_url }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description_en">EN Description</label>
                                <textarea required id="description_en" name="description_en" class="form-control" rows="10">{{ $slider_item->description_en }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_ru">RU Description</label>
                                <textarea required id="description_ru" name="description_ru" class="form-control" rows="10">{{ $slider_item->description_ru }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_hy">HY Description</label>
                                <textarea required id="description_hy" name="description_hy" class="form-control" rows="10">{{ $slider_item->description_hy }}</textarea>
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

