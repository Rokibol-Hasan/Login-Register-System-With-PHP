 <?php
    include "inc/header.php";
    ?>

 <section class="userlist">
     <div class="container">
         <div class="row">
             <div class="col-md-12">

                 <div class="panel panel-default">
                     <div class="panel-heading">
                         <h2 class="">User Profile <span class="float-right"><a class="btn btn-primary" href="index.php">Back</a> </span></h2>
                     </div>
                     <div class="panel-heading">
                     </div>
                     <div class="panel-body">
                         <div style="max-width: 600px; margin:0 auto;">
                             <form action="" method="POST">
                                 <div class="form-group">
                                     <label for="name">Name:</label>
                                     <input type="text" id="name" name="name" class="form-control" value="Rokibol Hasan">
                                 </div>
                                 <div class="form-group">
                                     <label for="username">Username:</label>
                                     <input type="text" id="username" name="username" class="form-control" value="rjrakib">
                                 </div>
                                 <div class="form-group">
                                     <label for="email">Email Address:</label>
                                     <input type="text" id="email" name="email" class="form-control" value="fuck@gmail.com">
                                 </div>
                                 <button type="submit" name="update" class="btn btn-success">Update</button>

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