














                           class="form-control"
                           placeholder="Nhập vào dữ liệu..."
                           value="<?php echo e(old('title', isset($category) ? $category->title : '')); ?>"
                           onkeyup="ChangeToSlug();">
                </div>

                




<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card mb-3">
        <div class="card-header">Thêm danh mục mới</div>
        <div class="card-body">
            <form action="<?php echo e(route('category.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
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
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key); ?></td>
                            <td><?php echo e($cate->title); ?></td>
                            <td><?php echo e($cate->description); ?></td>
                            <td><?php echo e($cate->slug); ?></td>
                            <td><?php echo e($cate->status ? 'Hiển thị' : 'Không'); ?></td>
                            <td>
                                <a href="<?php echo e(route('category.edit', $cate->id)); ?>" class="btn btn-warning">Sửa</a>
                                <form action="<?php echo e(route('category.destroy', $cate->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\webphim_tutorial\resources\views/category/create.blade.php ENDPATH**/ ?>