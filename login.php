 <?php
    include "inc/header.php";
    include "lib/User.php";
    ?>
 <?php

    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $usrLogin = $user->userLogin($_POST);
    }


    ?>

 <section class="userlist">
     <div class="container">
         <div class="row">
             <div class="col-md-12">

                 <div class="panel panel-default">
                     <div class="panel-heading">
                         <ul class="">
                             <li>
                                 <h2 class="">User Login</h2>
                             </li>
                         </ul>
                     </div>
                     <div class="panel-body">
                         <div style="max-width: 600px; margin:0 auto;">
                             <?php
                                if (isset($usrLogin)) {
                                    echo $usrLogin;
                                }
                                ?>
                             <form action="" method="POST">
                                 <div class="form-group">
                                     <label for="email">Email Address:</label>
                                     <input type="text" id="email" name="email" class="form-control">
                                 </div>
                                 <div class="form-group">
                                     <label for="email">Password:</label>
                                     <input type="password" id="password" name="password" class="form-control">
                                 </div>
                                 <button type="submit" name="login" class="btn btn-success">Login</button>

                             </form>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </section>

 <?php
    include "inc/footer.php";
    ?>