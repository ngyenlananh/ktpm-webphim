


@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Quản lý phim quốc gia </h3>

    {{-- Form thêm / sửa danh mục --}}
    @if(!isset($country))
        <form action="{{ route('country.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="form-control"
                       placeholder="Nhập vào dữ liệu...">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                          id="description"
                          class="form-control"
                          style="resize:none"
                          placeholder="Nhập vào dữ liệu..."></textarea>
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
    @else
        <form action="{{ route('country.update', $country->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="form-control"
                       value="{{ $country->title }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                          id="description"
                          class="form-control"
                          style="resize:none">{{ $country->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Active</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $country->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $country->status == 0 ? 'selected' : '' }}>Không</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    @endif

    {{-- Bảng danh mục --}}
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Active/Inactive</th>
                <th scope="col">Manage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $key => $cate)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $cate->title }}</td>
                    <td>{{ $cate->description }}</td>
                    <td>
                        @if($cate->status)
                            Hiển thị
                        @else
                            Không hiển thị
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('country.destroy', $cate->id) }}" method="POST" onsubmit="return confirm('Xóa hay không?')" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>

                        <a href="{{ route('country.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
