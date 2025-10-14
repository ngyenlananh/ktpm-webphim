

                @extends('layouts.app')

                @section('content')
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">Quản lý thể loại </div>

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <form action="{{ route('genre.store') }}" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    placeholder="Nhập vào dữ liệu...">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control"
                                                    style="resize:none" placeholder="Nhập vào dữ liệu..."></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Active</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="0">Không</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success">Thêm dữ liệu</button>
                                        </form>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                @endsection