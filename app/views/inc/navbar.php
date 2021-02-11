<header class="d-flex flex-column bg-light flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom shadow-sm">
  <a href="#" class="h5 my-0 me-md-auto fw-normal text-dark"><?php echo SITENAME; ?></a>
  <nav class="my-2 my-md-0 me-md-3">
    <a class="p-2 text-dark" href="#">Home</a>
    <a class="p-2 text-dark" href="#">About</a>
  </nav>
  <?php if(isset($_SESSION['user_id'])) : ?>

    <a class="btn btn-outline-danger" href="<?php echo URLROOT; ?>/users/logout">Log out</a>

    <?php else : ?>
        <a class="btn btn-outline-dark" href="<?php echo URLROOT; ?>/users/login">Sign up</a>
        <a class="btn btn-outline-dark" href="<?php echo URLROOT; ?>/users/register">Register</a>
    <?php endif; ?>
</header>