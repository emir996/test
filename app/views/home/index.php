<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-flud text-center">
<h1 class="display-3"><?php echo $data['title']; ?></h1>
<p class="lead"><?php echo $data['description'] ?></p>
</div>


<div class="row row-cols-1 row-cols-md-3 mb-3 mt-10 text-center">
    <div class="col">

    <?php foreach($data['products'] as $product): ?>

      <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 fw-normal"><?php echo $product->title; ?></h4>
      </div>
      <div class="card-body">
        <!-- <img src="asdasd" alt="image" /> -->
        <?php echo $product->image ?>
      </div>
      <div class="card=footer">
          <?php echo $product->description; ?>
      </div>
    </div>
    </div>

    <?php endforeach; ?>
    
  </div>

  
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>
