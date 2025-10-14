
{{--

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Quản lý danh mục</h3>

    {{-- Form thêm / sửa danh mục --
    @if(!isset($genre))
        <form action="{{ route('genre.store') }}" method="POST">
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
                  <label for="slug">Slug</label>
                   <input 
                       type="text" 
                        name="slug" 
                        id="slug" 
                        class="form-control" 
                        placeholder="Nhập vào dữ liệu..." 
                       value="{{ old('slug', isset($category) ? $category->slug : '') }}">
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
        <form action="{{ route('genre.update', $genre->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="form-control"
                       value="{{ $genre->title }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                          id="description"
                          class="form-control"
                          style="resize:none">{{ $genre->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Active</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ $genre->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $genre->status == 0 ? 'selected' : '' }}>Không</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    @endif




    {{-- Bảng danh mục --
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
                        <form action="{{ route('genre.destroy', $cate->id) }}" method="POST" onsubmit="return confirm('Xóa hay không?')" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>

                        <a href="{{ route('genre.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
--}}






{{--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ isset($category) ? 'Cập nhật danh mục' : 'Thêm danh mục mới' }}
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if(isset($category))
                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('category.store') }}" method="POST">
            @endif
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="form-control"
                           placeholder="Nhập vào dữ liệu..."
                           value="{{ old('title', isset($category) ? $category->title : '') }}"
                           onkeyup="ChangeToSlug();">
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text"
                           name="slug"
                           id="convert_slug"
                           class="form-control"
                           placeholder="Nhập vào dữ liệu..."
                           value="{{ old('slug', isset($category) ? $category->slug : '') }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description"
                              id="description"
                              class="form-control"
                              style="resize:none"
                              placeholder="Nhập vào dữ liệu">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Active</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ (isset($category) && $category->status == 1) ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ (isset($category) && $category->status == 0) ? 'selected' : '' }}>Không</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($category) ? 'Cập nhật' : 'Thêm dữ liệu' }}
                </button>

            </form>
        </div>
    </div>
</div>

{{-- Script tạo slug --
<script type="text/javascript">
    function ChangeToSlug() {
        var slug;

        // Lấy text từ input title
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();

        // Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');

        // Xóa ký tự đặc biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

        // Đổi khoảng trắng thành dấu gạch ngang
        slug = slug.replace(/ /gi, "-");

        // Xóa nhiều ký tự gạch ngang liên tiếp
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');

        // Xóa gạch ngang ở đầu và cuối
        slug = slug.replace(/^-+/, '');
        slug = slug.replace(/-+$/, '');

        // Gán vào input slug
        document.getElementById('convert_slug').value = slug;
    }
</script>
@endsection

--}}





{{--

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ isset($category) ? 'Cập nhật danh mục' : 'Thêm danh mục mới' }}
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if(isset($category))
                <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('category.store') }}" method="POST">
            @endif
                @csrf

                {{-- Title --
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text"
                           name="title"
                           id="title"  {{-- ✅ sửa id thành "title" --}}
                           class="form-control"
                           placeholder="Nhập vào dữ liệu..."
                           value="{{ old('title', isset($category) ? $category->title : '') }}"
                           onkeyup="ChangeToSlug();">
                </div>

                {{-- Slug --
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text"
                           name="slug"
                           id="convert_slug"
                           class="form-control"
                           placeholder="Nhập vào dữ liệu..."
                           value="{{ old('slug', isset($category) ? $category->slug : '') }}">
                </div>

                {{-- Description --
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description"
                              id="description"
                              class="form-control"
                              style="resize:none"
                              placeholder="Nhập vào dữ liệu">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
                </div>

                {{-- Status --
                <div class="form-group">
                    <label for="status">Active</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ (isset($category) && $category->status == 1) ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ (isset($category) && $category->status == 0) ? 'selected' : '' }}>Không</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($category) ? 'Cập nhật' : 'Thêm dữ liệu' }}
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Script tạo slug --
<script type="text/javascript">
    function ChangeToSlug() {
        var slug;

        // ✅ Lấy text từ input title
        slug = document.getElementById("title").value;
        slug = slug.toLowerCase();

        // Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');

        // Xóa ký tự đặc biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

        // Đổi khoảng trắng thành dấu gạch ngang
        slug = slug.replace(/ /gi, "-");

        // Xóa nhiều ký tự gạch ngang liên tiếp
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');

        // Xóa gạch ngang ở đầu và cuối
        slug = slug.replace(/^-+/, '');
        slug = slug.replace(/-+$/, '');

        // ✅ Gán vào input slug
        document.getElementById('convert_slug').value = slug;
    }
</script>
@endsection

--}}


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">Thêm danh mục mới</div>
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Nhập vào dữ liệu...">
                </div>
                <div class="form-group mb-2">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="Nhập vào dữ liệu...">
                </div>
                <div class="form-group mb-2">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="status">Active</label>
                    <select name="status" class="form-control">
                        <option value="1">Hiển thị</option>
                        <option value="0">Không</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Thêm dữ liệu</button>
            </form>
        </div>
    </div>

    {{-- Danh sách category --}}
    <div class="card">
        <div class="card-header">Danh sách danh mục</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Active/Inactive</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $cate)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $cate->title }}</td>
                            <td>{{ $cate->description }}</td>
                            <td>{{ $cate->slug }}</td>
                            <td>{{ $cate->status ? 'Hiển thị' : 'Không' }}</td>
                            <td>
                                <a href="{{ route('category.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('category.destroy', $cate->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
