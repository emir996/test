<?php if(isset($_SESSION['user_id']) && $_SESSION['user_status'] == 1): ?>
<?php require APPROOT . '/views/admin/inc/header.php'; ?>

<div class="jumbotron jumbotron-flud text-center">
<h1 class="display-3"><?php echo $data['subtitle']; ?></h1>

</div>

<a href="<?php echo URLROOT; ?>/admin/store" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT; ?>/admin/store" method="post">
      <div class="form-group">
        <label for="title">Title: <sup>*</sup></label>
        <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="description">Description: <sup>*</sup></label>
        <textarea name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['description']; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
      </div>
        <div class="col text-center mt-3">
      <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>
  </div>

  


<?php require APPROOT . '/views/admin/inc/footer.php'; ?>
<?php else: {redirect('home/index');} endif; ?>