@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a href="{{ route('application-index') }}">Application</a> / {{ $application_item->title_hy }}</h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12 m-auto">
                    <div class="p-5">
                        <form enctype="multipart/form-data" class="user" method="post" action="{{ route('application-update', $application_item->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="title_en">EN Title</label>
                                <input type="text" required id="title_en" name="title_en" class="form-control" value="{{ $application_item->title_en }}">
                            </div>

                            <div class="form-group">
                                <label for="title_ru">RU Title</label>
                                <input type="text" required id="title_ru" name="title_ru" class="form-control" value="{{ $application_item->title_ru }}">
                            </div>

                            <div class="form-group">
                                <label for="title_hy">HY Title</label>
                                <input type="text" required id="title_hy" name="title_hy" class="form-control" value="{{ $application_item->title_hy }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="description_en">EN Description</label>
                                <textarea required id="description_en" name="description_en" class="form-control" rows="10">{{ $application_item->description_en }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_ru">RU Description</label>
                                <textarea required id="description_ru" name="description_ru" class="form-control" rows="10">{{ $application_item->description_ru }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_hy">HY Description</label>
                                <textarea required id="description_hy" name="description_hy" class="form-control" rows="10">{{ $application_item->description_hy }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="img" class="w-100">Image</label>
                                <img src="{{ asset('storage/application/'.$application_item->img) }}" class="img-fluid rounded">
                                <input type="file" class="form-control" id="img" name="img">
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="pdf" class="w-100">PDF</label>
                                    <a target="_blank" href="{{ asset('storage/application/files/'.$application_item->pdf) }}">View File</a>
                                <input type="file" class="form-control" id="pdf" name="pdf">
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="word" class="w-100">Word</label>
                                    <a target="_blank" href="{{ asset('storage/application/files/'.$application_item->word) }}">View File</a>
                                <input type="file" class="form-control" id="word" name="word">
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="exc" class="w-100">Excell</label>
                                    <a target="_blank" href="{{ asset('storage/application/files/'.$application_item->excell) }}">View File</a>
                                <input type="file" class="form-control" id="exc" name="exc">
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

