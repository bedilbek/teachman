<?php
        require_once "start.php";
        $request = new Request();
    if (!session_id()) session_start();
    if (!empty($_SESSION["auth_login"]) && !empty($_SESSION["auth_password"])) {
        $username = $_SESSION["auth_login"];
        $password = $_SESSION["auth_password"];
        $user = UserDB::authUser($request->username, $request->password);
        $user_id = $user->getID();
        $fields = MixedDB::getMixedObjects($user_id);
        $categories = CategoryDB::getAllOnUserID($user_id);
    }
    else {
        //print "4";
        $newURL = "login.php";
        header('Location: '.$newURL);
    }
       ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- Bootstrap -->
          <link href="styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <link href="styles/bootstrap/css/bootstrap-select.css" rel="stylesheet">

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) >-->
            <script src="scripts/jquery.min.js"></script>
          <!-- Include all compiled plugins (below), or include individual files as needed -->
          <script src="scripts/bootstrap/bootstrap.min.js"></script>
          <script src="scripts/bootstrap/jquery.js"></script>
          <link href="styles/custom.css" rel="stylesheet" />
       </head>
<body>
  <div id="wrapper">
      <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
          </div>
          <div style="color: white;  padding: 15px 50px 5px 50px;  float: right;
       font-size: 16px;">
              <a href="dashboard.php?logoutid=<?=$user_id?>" class="btn btn-danger square-btn-adjust">Logout</a>
          </div>
</nav>
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">
      <li class="text-center">
        <img src="<?=$user->img?>" class="user-image img-responsive"/>
      </li>
      <li>
        <a href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
      </li>
        <?php foreach($fields as $field) { ?>
            <li>
                <a <?php if($field->name == "Categories") { ?> class="active-menu" <?php } ?> href="<?=$field->link?>"><i class="glyphicon glyphicon-<?=$field->img?>"></i><?=$field->name?></a>
            </li>
        <?php } ?>
    </div>
  </nav>
  <!-- /. NAV SIDE  -->
  <div id="page-wrapper" >
    <div id="page-inner">
      <div class="row">
        <div class="col-md-12">
          <h2>Categories</h2>
          <h5>Welcome <?=$user->firstname?> <?=$user->lastname?> , Love to see you back. </h5>
        </div>
      </div>
      <hr/>
      <div class="row">

        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading " style="font-size:20px">
              Category management
              <div class="text-right">
                <!--ADD CATEGORY-->
               <?php if (!$user->isAdmin()){ ?> <button data-target="#modalCategory" class="btn btn-info text-right " data-toggle="modal">ADD</button>  <?php } ?>
              </div>
            </div>

            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Category alias</th>
                      <th>Category description</th>
                      <?php if ($user->isAdmin()) { ?> <th>User Name</th> <?php } ?>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $odd=0;  foreach ($categories as $category) { ?>
                  <?php if ($odd % 2 == 0) $c = "odd"; else $c="even"; ?>  <tr class="<?=$c?>" id="row<?=$category->id?>">
                      <td data-target="#modalCategory" data-toggle="modal"><?=$category->category_name?></td>
                      <td><?=$category->category_short_name?></td>
                      <td><?=$category->category_description?></td>
                      <?php if ($user->isAdmin()) { ?> <td><?=$category->user->firstname?> <?=$category->user->lastname?></td> <?php } ?>
                      <td class="center">
                          <?php if (!$user->isAdmin()){ ?> <span class="glyphicon glyphicon-edit hov" data-target="#modalEditCategory" data-toggle="modal"></span> <?php } ?>
                        <span class="delete glyphicon glyphicon-remove hov" onclick="delete_row('<?=$category->id?>')"></span>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--End Advanced Tables -->
        </div>
      </div>
    </div>
    <!-- /. PAGE INNER  -->
  </div>
  <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->

<!-- MODAL CATEGORY -->
<div id="modalCategory" class="modal fade" style="font-size:14px">
  <div class="modal-dialog" role="document">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Create Category</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="submit.php">
          <div class="form-group">
            <label for="crsCFname" class="control-label col-sm-3">Course Category FullName:</label>
            <div class="col-sm-9">
              <input type="text" id="crsCFname" class="form-control" name="courseCategoryFullName" placeholder="Full Name of your Course Category">
            </div>
          </div>
          <div class="form-group">
            <label for="crsCSname" class="control-label col-sm-3">Course Category ShortName:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="crsCSname" name="CourseShortName" placeholder="Short Name of your Course Category">
            </div>
          </div>
          <div class="form-group">
            <label for="crsCatDes" class="control-label col-sm-3">Course Category Description:</label>
            <div class="col-sm-9">
              <textarea id="crsCatDes" class="form-control" name="courseCategoryDescription"></textarea>
            </div>
          </div>
          <input type="submit" class="btn btn-success" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--EDITMODAL-->
<div id="modalEditCategory" class="modal fade" style="font-size:14px">
  <div class="modal-dialog" role="document">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Create Category</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="submit.php">
          <div class="form-group">
            <label for="crsCFname" class="control-label col-sm-3">Course Category FullName:</label>
            <div class="col-sm-9">
              <input type="text" id="crsCFname" class="form-control" name="courseCategoryFullName" value="Trident">
            </div>
          </div>
          <div class="form-group">
            <label for="crsCSname" class="control-label col-sm-3">Course Category ShortName:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="crsCSname" name="CourseShortName" value="Internet Explorer 6">
            </div>
          </div>
          <div class="form-group">
            <label for="crsCatDes" class="control-label col-sm-3">Course Category Description:</label>
            <div class="col-sm-9">
              <textarea id="crsCatDes" class="form-control" name="courseCategoryDescription" value="Win 98+"></textarea>
            </div>
          </div>

        </form>
        <input type="submit" class="btn btn-success" value="Save">
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- JQUERY SCRIPTS -->
<script src="scripts/table.js"></script>
<script src="scripts/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="scripts/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="scripts/jquery.metisMenu.js"></script>
<script src="scripts/dataTables/jquery.dataTables.js"></script>
<script src="scripts/dataTables/dataTables.bootstrap.js"></script>
<script>
$(document).ready(function () {
  $('#dataTables-example').dataTable();
});
</script>
<!-- CUSTOM SCRIPTS -->
<script src="scripts/custom.js"></script>
</body>
</html>
