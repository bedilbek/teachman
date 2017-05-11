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
    <?php $header = new Header("Teachman"); ?>
    <?=Header::getTitle()?>
    <?=Header::getMeta("utf-8")?>
    <?=Header::getMeta(null,"IE=edge","X-UA-Compatible")?>
    <?=Header::getMeta("viewport","width=device-width, initial-scale=1",null)?>
    <?=Header::getLink("styles/custom.css")?>
    <!-- Bootstrap -->
    <?=Header::getLink("styles/bootstrap/css/bootstrap-select.css")?>
    <?=Header::getLink("styles/bootstrap/css/bootstrap.min.css")?>
    <?=Header::getScript("scripts/jquery.min.js")?>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?=Header::getScript("scripts/bootstrap.min.js")?>
    <?=Header::getScript("scripts/bootstrap/jquery.js")?>
    <!-- JQUERY SCRIPTS -->
    <!-- CUSTOM SCRIPTS -->
    <?=Header::getScript("scripts/custom.js")?>
    <?=Header::getScript("scripts/table.js")?>
    <!-- METISMENU SCRIPTS -->
    <?=Header::getScript("scripts/dataTables/jquery.dataTables.js")?>
    <?=Header::getScript("scripts/dataTables/dataTables.bootstrap.js")?>
    <!-- CUSTOM SCRIPTS -->
    <?=Header::getScript("scripts/custom.js")?>
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
                        <span id = "teacher" class="delete glyphicon glyphicon-remove hov"  onclick="delete_row_teacher('<?=$teacher->id?>')"></span>
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
  <script>
    $(document).ready(function () {
      $('#dataTables-example').dataTable();
    });
    </script>
</body>
</html>
