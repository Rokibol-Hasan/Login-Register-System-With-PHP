 <?php
    include "inc/header.php";
    include "lib/user.php";
    $user = new User();
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

                 <div class="panel panel-default">
                     <div class="panel-heading">
                         <ul class="">
                             <li>
                                 <h2 class="">User List</h2>
                             </li>
                             <li><span class=""><strong>Welcome</strong> <br/> <?php
                                                                        $name = Session::get("name");
                                                                        if (isset($name)) {
                                                                            echo $name;
                                                                        }
                                                                        ?></span></li>
                         </ul>
                     </div>
                     <div class="panel-body">
                         <table class="table table-striped">
                             <th width="20%">Serial</th>
                             <th width="20%">Name</th>
                             <th width="20%">Username</th>
                             <th width="20%">Email</th>
                             <th width="20%">Action</th>
                             <tr>
                                 <td>01</td>
                                 <td>Rakib</td>
                                 <td>rjrakib</td>
                                 <td>rakib@gmail.com</td>
                                 <td>
                                     <a href="profile.php?id=1">View</a>
                                 </td>
                             </tr>
                             <tr>
                                 <td>02</td>
                                 <td>Sakib</td>
                                 <td>sakib</td>
                                 <td>sakib@gmail.com</td>
                                 <td>
                                     <a href="profile.php?id=2">View</a>
                                 </td>
                             </tr>
                             <tr>
                                 <td>03</td>
                                 <td>Farin</td>
                                 <td>farin</td>
                                 <td>farin@gmail.com</td>
                                 <td>
                                     <a href="profile.php?id=3">View</a>
                                 </td>
                             </tr>
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