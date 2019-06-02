<?php require_once('product_list/data.php');?>

<!DOCTYPE html>
<html lang="ja">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Product List</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">


</head>

<body>
  <?php if(!isset($_SESSION['id'])){
    header('Location: ../login.php');
  } ?>

  <!-- Navigation -->
  

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Item List</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="product_list.php">HOME
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
          </li>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container mt-5">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Sample Shop</h1>
        <div class="list-group">
          <a href="product_list.php" class="list-group-item">HOME</a>
          <a href="cart.php" class="list-group-item">Cart</a>
          <a href="../logout.php" class="list-group-item">Logout</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9 mt-4">

        <div class="row">

            <?php foreach ($items as $item): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                    <img class="card-img-top" src="<?php echo $item->getImage() ?>" alt="" style="height: 210px;">
                    <div class="card-body">
                        <h4 class="card-title">
                        <a href="#"><?php echo $item->getName() ?></a>
                        </h4>
                        <h5>¥<?php echo $item->getTaxIncludedPrice() ?>（税込）</h5>
                        <p class="card-text"><?php echo $item->getIntroduce() ?></p>
                    </div>
                    <div class="card-footer">
                        <form action="product_detail.php" method="post">
                            <input type="hidden" name="productId" value="<?php echo $item->getId() ?>">
                            <button class="btn btn-md btn-primary" type="submit" name="detail">Detail</button>
                        </form>
                    </div>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
      <p class="m-0 text-center text-white">Copyright &copy; toshiblog 2019</p>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>




