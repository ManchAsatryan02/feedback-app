@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add new item
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Blog</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" class="user" method="post" action="{{ route('blog-store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title_en">EN Title</label>
                                <input type="text" required id="title_en" name="title_en" class="form-control" placeholder="Title">
                            </div>

                            <div class="form-group">
                                <label for="title_ru">RU Title</label>
                                <input type="text" required id="title_ru" name="title_ru" class="form-control" placeholder="Title">
                            </div>

                            <div class="form-group">
                                <label for="title_hy">HY Title</label>
                                <input type="text" required id="title_hy" name="title_hy" class="form-control" placeholder="Title">
                            </div>
                            
                            <div class="form-group">
                                <label for="description_en">EN Description</label>
                                <textarea required id="description_en" name="description_en" class="form-control" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_ru">RU Description</label>
                                <textarea required id="description_ru" name="description_ru" class="form-control" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description_hy">HY Description</label>
                                <textarea required id="description_hy" name="description_hy" class="form-control" rows="10"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="img" class="w-100">Image</label>
                                <input type="file" class="form-control" id="img" name="img">
                            </div>

                            <div class="form-group">
                                <label for="file" class="w-100">File</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Items</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($blog_items as $item)
                        <tr>
                            <td>{{ $item->title_hy }}</td>
                            <td><img src="{{ asset('storage/blog/'.$item->img) }}" class="img-fluid"></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('blog-show', $item->id) }}">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="{{ route('blog-destroy', $item->id) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
