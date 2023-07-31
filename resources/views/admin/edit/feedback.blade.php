@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a href="{{ route('feedback-index') }}">Feedback</a> / {{ $feedback_item->title }}</h1>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12 m-auto">
                    <div class="p-5">
                        <form enctype="multipart/form-data" class="user" method="post" action="{{ route('feedback-update', $feedback_item->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required id="title" name="title" class="form-control" value="{{ $feedback_item->title }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" required id="phone" name="phone" class="form-control" value="{{ $feedback_item->phone }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea required id="description" name="description" class="form-control" rows="10">{{ $feedback_item->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" @if($feedback_item->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($feedback_item->status == 0) selected @endif>Passive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="img" class="w-100">Image</label>
                                <img src="{{ asset('storage/feedback/'.$feedback_item->img) }}" class="img-fluid rounded">
                                <input type="file" class="form-control" id="img" name="img">
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

