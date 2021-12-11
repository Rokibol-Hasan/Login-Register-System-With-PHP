 <?php
    include "lib/user.php";
    include "inc/header.php";
    Session::checkSession();
    ?>

 <?php
    $loginmsg = Session::get("loginmsg");
    if (isset($loginmsg)) {
        echo $loginmsg;
    }
    Session::set("loginmsg", NULL);
    ?>

 <section class="userlist">
     <div class="container">
         <div class="row">
             <div class="col-md-12">

                 <div class="card card-default">
                     <div class="card-heading">
                         <h2 class="">User List
                             <span class="float-right">Welcome<strong> <?php
                                                                        $name = Session::get("name");
                                                                        if (isset($name)) {
                                                                            echo $name;
                                                                        }
                                                                        ?></span></strong>
                         </h2>
                     </div>
                     <div class="card-body">
                         <table class="table table-striped">
                             <th width="20%">Serial</th>
                             <th width="20%">Name</th>
                             <th width="20%">Username</th>
                             <th width="20%">Email</th>
                             <th width="20%">Action</th>
                             <?php
                                $user = new User();
                                $userData = $user->getUserData();
                                if ($userData) {
                                    $i = 0;
                                    foreach ($userData as $sdata) {
                                        $i++; ?>
                                     <tr>
                                         <td><?php echo $i; ?></td>
                                         <td><?php echo $sdata['name']; ?></td>
                                         <td><?php echo $sdata['username']; ?></td>
                                         <td><?php echo $sdata['email']; ?></td>
                                         <td>
                                             <a href="profile.php?id=<?php echo $sdata['id']; ?>">View</a>
                                         </td>
                                     </tr>
                                 <?php
                                    }
                                } else { ?>

                                 <tr>
                                     <td colspan="5">
                                         <h2>No User Data Found...</h2>
                                     </td>
                                 </tr>
                             <?php
                                }
                                ?>
                         </table>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </section>

 <?php
    include "inc/footer.php";
    ?>