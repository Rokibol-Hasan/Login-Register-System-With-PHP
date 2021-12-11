 <?php
    include "lib/user.php";
    include "inc/header.php";
    Session::checkSession();
    ?>

 <?php
    if (isset($_GET['id'])) {
        $userid = (int)$_GET['id'];
    }
    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $updateUsr = $user->updateUserData($id, $_POST);
    }
    ?>

 <section class="userlist">
     <div class="container">
         <div class="row">
             <div class="col-md-12">

                 <div class="card card-default">
                     <div class="card-heading">
                         <h2 class="">User Profile <span class="float-right"><a class="btn btn-primary" href="index.php">Back</a> </span></h2>
                     </div>
                     <div class="card-heading">
                     </div>
                     <div class="card-body">
                         <?php
                            if (isset($updateUsr)) {
                                echo $updateUsr;
                            }
                            ?>
                         <div style="max-width: 600px; margin:0 auto;">

                             <?php
                                $userData = $user->getUserById($userid);
                                if ($userData) {
                                ?>
                                 <form action="" method="POST">
                                     <div class="form-group">
                                         <label for="name">Name:</label>
                                         <input type="text" id="name" name="name" class="form-control" value="<?php echo $userData->name; ?>">
                                     </div>
                                     <div class="form-group">
                                         <label for="username">Username:</label>
                                         <input type="text" id="username" name="username" class="form-control" value="<?php echo $userData->username; ?>">
                                     </div>
                                     <div class="form-group">
                                         <label for="email">Email Address:</label>
                                         <input type="text" id="email" name="email" class="form-control" value="<?php echo $userData->email; ?>">
                                     </div>
                                     <?php
                                        $sesId = Session::get("id");
                                        if ($userid == $sesId) { ?>
                                         <button type="submit" name="update" class="btn btn-success">Update</button>
                                         <a class="btn btn-info" href="changepass.php?id=<?php echo $id ?>"> Change Password</a>
                                     <?php }  ?>
                                 </form>
                             <?php } ?>

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