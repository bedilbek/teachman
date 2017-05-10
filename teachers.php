<?php
require_once "start.php";
$request = new Request();
if (!session_id()) session_start();
if (!empty($_SESSION["auth_login"]) && !empty($_SESSION["auth_password"])) {
    $username = $_SESSION["auth_login"];
    $password = $_SESSION["auth_password"];
    $user = UserDB::authUser($request->username, $request->password);

    $user_id = $user->getID();
    $teachers = UserDB::getAllOnTeacher("E");
    $fields = MixedDB::getMixedObjects($user_id);
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
          <script src="scripts/bootstrap.min.js"></script>
          <script src="scripts/bootstrap/jquery.js"></script>
          <link href="styles/custom.css" rel="stylesheet" />
          <title>TeachMan</title>
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
       font-size: 16px;">Last access : 30 May 2014
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
                <a <?php if($field->name == "Teachers") { ?> class="active-menu" <?php } ?> href="<?=$field->link?>"><i class="glyphicon glyphicon-<?=$field->img?>"></i><?=$field->name?></a>
            </li>
        <?php } ?>
    </ul>
    </div>
  </nav>
  <!-- /. NAV SIDE  -->
  <div id="page-wrapper" >
    <div id="page-inner">
      <div class="row">
        <div class="col-md-12">
          <h2>Teacher</h2>
          <h5>Welcome <?=$user->firstname?> <?=$user->lastname?> , Love to see you back. </h5>
        </div>
      </div>
      <hr/>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading " style="font-size:20px">
              Teacher management
            </div>


            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Teacher name</th>
                      <th>Surname</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $odd=0;  foreach($teachers as $teacher) { ?>
                  <?php if ($odd % 2 == 0) $c = "odd"; else $c="even"; ?>  <tr class="<?=$c?>" id="row<?=$teacher->id?>">
                      <td><?=$teacher->firstname?></td>
                      <td><?=$teacher->lastname?></td>
                      <td class="center">
                        <span class="delete glyphicon glyphicon-remove hov"  onclick="delete_row('<?=$teacher->id?>')"></span>
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

  <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
  <!-- JQUERY SCRIPTS -->
  <script src="scripts/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="scripts/bootstrap.min.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="scripts/table.js"></script>
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
