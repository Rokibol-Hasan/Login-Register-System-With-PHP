 <?php
    include "lib/user.php";
    include "inc/header.php";
    Session::checkSession();
    ?>

 <?php
    if (isset($_GET['id'])) {
        $userId = (int)$_GET['id'];
    }
    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])) {
        $updatePass = $user->updatePassword($userId, $_POST);
    }
    ?>

 <section class="userlist">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="card card-default">
                     <div class="card-heading">
                         <h2 class="">Change Password <span class="float-right"><a class="btn btn-primary" href="profile.php?id=<?php echo $userId; ?>">Back</a> </span></h2>
                     </div>
                     <div class="card-heading">
                     </div>
                     <div class="card-body">
                         <?php
                            if (isset($updatePass)) {
                                echo $updatePass;
                            }
                            ?>
                         <div style="max-width: 600px; margin:0 auto;">
                             <form action="" method="POST">
                                 <div class="form-group">
                                     <label for="old_pass">Old Password</label>
                                     <input type="password" id="old_pass" name="old_pass" class="form-control">
                                 </div>
                                 <div class="form-group">
                                     <label for="password">New Password</label>
                                     <input type="password" id="password" name="password" class="form-control">
                                 </div>
                                 <button type="submit" name="updatepass" class="btn btn-success">Update</button>
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