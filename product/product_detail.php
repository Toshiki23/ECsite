<?php  
require_once('product_list/data.php');

    if(!isset($_SESSION['id'])){
      header('Location: ../login.php');
    } 

    $productId=filter_input(INPUT_POST,'productId');

    foreach($items as $item){
        if($productId == $item->getId()){
            $productId = $item->getId();
            break;
        }
    }

    
   
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Product Detail</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">



</head>

<body>

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

    <h2 class="font-bold text-primary mt-2"><?php if(isset($_POST["cartIn"])){
        $num = filter_input(INPUT_POST,"num");
        if(isset($_SESSION['data'][$productId])){
            $_SESSION['data'][$productId] += $num;
        }else{
            $_SESSION['data'][$productId] = $num;
        }
        echo "カートに".$item->getName()."を".$num."個追加しました";

    }?></h2>

    <div class="row">

      <div class="col-lg-3">


        <h1 class="my-4">Sample Shop</h1>
        <div class="list-group">
          <a href="product_list.php" class="list-group-item">HOME</a>
          <a href="cart.php" class="list-group-item">Cart</a>
          <a href="../logout" class="list-group-item">Logout</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9 mt-4">

        <div class="row">

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
                    <form action="" method="post">
                        <select name="num">
                            <option value="">-</option>
                            <?php for ($i=0; $i<11; $i++):?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor ?>
                        </select>
                        <input type="hidden" name="productId" value="<?php echo $productId ?>">
                        <button class="btn btn-md btn-primary" type="submit" name="cartIn">カートに入れる</button>
                    </form>
                </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark mb-0">
      <p class="mb-0 text-center text-white">Copyright &copy; toshiblog 2019</p>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>