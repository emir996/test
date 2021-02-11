<?php if(isset($_SESSION['user_id']) && $_SESSION['user_status'] == 1): ?>
<?php require APPROOT . '/views/admin/inc/header.php'; ?>


<div class="jumbotron jumbotron-flud text-center">
<h1 class="display-3"><?php echo $data['title']; ?></h1>
</div>


<?php require APPROOT . '/views/admin/inc/footer.php'; ?>
<?php else: {redirect('home/index');} endif; ?>