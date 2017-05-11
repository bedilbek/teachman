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
    $courses = CourseDB::getAllOnUserID($user_id);
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
                        <a  href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
                    </li>
                    </li>
                    <?php foreach($fields as $field) { ?>
                        <li>
                            <a <?php if($field->name == "Courses") { ?> class="active-menu" <?php } ?> href="<?=$field->link?>"><i class="glyphicon glyphicon-<?=$field->img?>"></i><?=$field->name?></a>
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
                     <h2>Courses </h2>
                        <h5>Welcome <?=$user->firstname?> <?=$user->lastname?> , Love to see you back. </h5>
                    </div>
                </div>
                 <!--  ROW  -->
                 <hr />
                 <div class="row">

                   <div class="col-md-12">
                     <div class="panel panel-info">
                       <div class="panel-heading" style="font-size:20px">
                          Course Management
                          <div class="text-right">
                            <?php if (!$user->isAdmin()) { ?> <button data-target="#modalCourse" class="btn btn-info text-right" data-toggle="modal">ADD</button> <?php } ?>
                          </div>
                        </div>

                        <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                 <thead>
                                     <tr>
                                         <th>Course</th>
                                         <th>Course Alias</th>
                                         <th>Course Description</th>
                                         <?php $t = "Course Category"; if ($user->isAdmin()) $t = "User Name"; { ?> <th><?=$t?></th> <?php } ?>
                                         <th></th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 <?php $odd=0;  foreach ($courses as $course) { ?>
                                 <?php if ($odd % 2 == 0) $c = "odd"; else $c="even"; ?>  <tr class="<?=$c?>" id="row<?=$course->id?>">
                                       <td><?=$course->course_name?></td>
                                       <td><?=$course->course_shortname?></td>
                                       <td><?=$course->course_description?></td>
                                         <?php $t = $course->category->category_name; if ($user->isAdmin()) $t = $course->category->user->firstname." ".$course->category->user->lastname; ?> <td><?=$t?></td>
                                       <td class="center">
                                           <?php if (!$user->isAdmin()){ ?>  <span class="glyphicon glyphicon-edit hov" data-target="#modalEditCourse" data-toggle="modal"></span> <?php } ?>
                                           <span class="delete glyphicon glyphicon-remove hov" onclick="delete_row_course('<?=$course->id?>')"></span>
                                       </td>
                                   </tr>
                                 <?php } ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                 <!--End Tables -->
               </div>
             </div>
           </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->



<!-- MODAL COURSE -->
     <div id="modalCourse" class="modal fade" style="font-size:14px">
         <div class="modal-dialog" role="document">
             <!-- Modal content -->
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title text-center">Course</h4>
                 </div>
                 <div class="modal-body">
                     <form id="crsFrm" class="form-horizontal" method="post" action="submit.php">
                         <div class="form-group">
                             <label for="courseFname" class="control-label col-sm-3">Course FullName:</label>
                             <div class="col-sm-9">
                                 <input type="text" id="courseFname" class="form-control" name="CourseForName" placeholder="Full Name of your Course">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="crsSname" class="control-label col-sm-3">Course ShortName:</label>
                             <div class="col-sm-9">
                                 <input type="text" class="form-control" id="crsSname" name="CourseShortName" placeholder="Short Name of your Course">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="selCrsCat" class="control-label col-sm-3">Select Course Category:</label>
                             <div class="col-sm-9">
                                 <select id="selCrsCat" class="form-control" name="CourseCategory" >
                                     <option value="Category1">Category 1</option>
                                     <option value="Category2">Category 2</option>
                                     <option value="Category3">Category 3</option>
                                 </select>
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

<!--  MODAL EDIT COURSE  -->
     <div id="modalEditCourse" class="modal fade" style="font-size:14px">
         <div class="modal-dialog" role="document">
             <!-- Modal content -->
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title text-center">Course</h4>
                 </div>
                 <div class="modal-body">
                     <form id="crsFrm" class="form-horizontal" method="post" action="submit.php">
                         <div class="form-group row">
                             <label for="courseFname" class="control-label col-sm-3">Course FullName:</label>
                             <div class="col-sm-9">
                                 <input type="text" id="courseFname" class="form-control" name="CourseForName" value=" Course">
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="crsSname" class="control-label col-sm-3">Course ShortName:</label>
                             <div class="col-sm-9">
                                 <input type="text" class="form-control" id="crsSname" name="CourseShortName" value="Short Name ">
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="selCrsCat" class="control-label col-sm-3">Select Course Category:</label>
                             <div class="col-sm-9">
                                 <select id="selCrsCat" class="form-control" name="CourseCategory" >
                                     <option value="Category1">Category 1</option>
                                     <option value="Category2">Category 2</option>
                                     <option value="Category3">Category 3</option>
                                 </select>
                             </div>
                         </div>
                           <input type="submit" class="btn btn-success" value="Save">
                     </form>
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>



    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
</script>
</body>
</html>
