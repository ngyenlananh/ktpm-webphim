




<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Quản lý phim quốc gia </h3>

    
    <?php if(!isset($country)): ?>
        <form action="<?php echo e(route('country.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
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
    <?php else: ?>
        <form action="<?php echo e(route('country.update', $country->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="form-control"
                       value="<?php echo e($country->title); ?>">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                          id="description"
                          class="form-control"
                          style="resize:none"><?php echo e($country->description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Active</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" <?php echo e($country->status == 1 ? 'selected' : ''); ?>>Hiển thị</option>
                    <option value="0" <?php echo e($country->status == 0 ? 'selected' : ''); ?>>Không</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    <?php endif; ?>

    
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
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($key + 1); ?></th>
                    <td><?php echo e($cate->title); ?></td>
                    <td><?php echo e($cate->description); ?></td>
                    <td>
                        <?php if($cate->status): ?>
                            Hiển thị
                        <?php else: ?>
                            Không hiển thị
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?php echo e(route('country.destroy', $cate->id)); ?>" method="POST" onsubmit="return confirm('Xóa hay không?')" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>

                        <a href="<?php echo e(route('country.edit', $cate->id)); ?>" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel\webphim_tutorial\resources\views/country/create.blade.php ENDPATH**/ ?>