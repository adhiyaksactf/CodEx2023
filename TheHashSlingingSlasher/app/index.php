<?php
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Super Password Hash Generator</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
   <!-- top -->
   <div class="full_bg">
      <div class="slider_main">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                        <!-- first slide -->
                        <div class="carousel-item active">
                           <div class="carousel-caption relative">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="dream">
                                       <h1>CodEx<br>2023</h1>
                                       <a class="read_more" href="Javascript:void(0)">CodEx 2023</a>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="dream_img">
                                       <figure><img src="images/cysec.png" alt="#"/></figure>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="domain">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage text_align_center">
                     <h2>Generate SHA-512<span class="blue_light"> Hash Generator</span></h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 offset-md-1">
               <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col-9">
                        <input type="text" name="string" class="form-control form-control-lg" style="border-radius: 30px;" placeholder="Masukan password..">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-lg btn-outline-primary" style="border-radius: 30px;" name="submit">SUBMIT</button>
                    </div>
                </div>

            </div>
        </form>
        <?php
            if (isset($_POST['submit'])) {

                $strings = $_POST['string'];

                $result = shell_exec('echo '.$strings.'| sha512sum');

                $result_lines = explode(PHP_EOL, $result);

                $json = json_encode(explode('\n', $result));
            }
        ?>

        <?php if(!empty($result)){ ?>
                        <?php foreach($result_lines as $line) { echo htmlspecialchars($line) . "<br>"; } ?>
        <?php } ?>
    </div>
            </div>
         </div>
      </div>
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="copyright">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <p>CodEx 2023<br><br>© 2020 All Rights Reserved. <a href="https://html.design/"> Free html Templates</a></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- sidebar -->
      <script src="js/custom.js"></script>
</body>

</html>
