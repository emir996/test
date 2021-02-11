<?php if(isset($_SESSION['user_id']) && $_SESSION['user_status'] == 1): ?>
<?php require APPROOT . '/views/admin/inc/header.php'; ?>

<div class="container text-right mt-5">
    <h3><?php echo $data['subtitle']; ?></h3>
    <button type="button" class="btn btn-primary"><a class="text-white" href="create">Create</a></button>
</div>

<div class="jumbotron jumbotron-flud text-center">
<h1 class="display-3"><?php echo $data['title']; ?></h1>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($data['products'] as $product) : ?>
    <tr>
        <td><?php echo $product->id; ?></td>
        <td><?php echo $product->title; ?></td>
        <td><?php echo $product->description ?></td>
        <td><?php echo $product->image ?></td>
        <td><a href="edit/<?php echo $product->id ?>">Edit</a><a href="delete/<?php echo $product->id ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require APPROOT . '/views/admin/inc/footer.php'; ?>
<?php else: {redirect('home/index');} endif; ?>