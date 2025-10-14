<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo e(route('home')); ?>">Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('category.create')); ?>">Danh mục phim</a>
      </li>

         <li class="nav-item ">
        <a class="nav-link" href="<?php echo e(route('genre.create')); ?>">Thể loại </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('country.create')); ?>">Quốc gia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('movie.create')); ?>">phim</a> 
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('episode.create')); ?>">Tap phim</a>
      </li>
      
 

     




   </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">tìm kiếm phim </button>
    </form>
  </div>
</nav>  <?php /**PATH D:\Laravel\webphim_tutorial\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>