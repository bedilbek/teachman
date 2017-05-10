<?php
require_once "start.php";

$request = new Request();
$fp = new FormProcessor($request,new Message(Config::FILE_MESSAGES));
    if ($request->logoutid) {
       // print "1";
        if (!session_id()) session_start();
        session_unset();
        session_destroy();
    }
    if ($request->firsttime == "1") {
            //            print "2";
            $user = UserDB::authUser($request->username, $request->password);
            $fields = MixedDB::getMixedObjects($user->getID());
    }
    else {
        //print "3";
        if (!session_id()) session_start();
        if (!empty($_SESSION["auth_login"]) && !empty($_SESSION["auth_password"])) {
            $username = $_SESSION["auth_login"];
            $password = $_SESSION["auth_password"];
            $user = UserDB::authUser($request->username, $request->password);
            $fields = MixedDB::getMixedObjects($user->getID());
        }
        else {
            //print "4";
            $newURL = "login.php?session=0";
            header('Location: '.$newURL);

        }
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="styles/custom.css" rel="stylesheet" />
        <!-- Bootstrap -->
        <link href="styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="styles/bootstrap/css/bootstrap-select.css" rel="stylesheet">

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="scripts/bootstrap.min.js"></script>
        <script src="scripts/bootstrap/jquery.js"></script>
</head>


<body>
    <div id="wrapper">
        <nav class="navbar navbar-collapse navbar-cls-top" role="navigation" style="margin-bottom: 0">
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
                <a href="dashboard.php?logoutid=<?=$user->id?>" class="btn btn-danger square-btn-adjust">Logout</a>
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
                <a class="active-menu"  href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
              </li>
                <?php foreach($fields as $field) { ?>
                <li>
                    <a  href="<?=$field->link?>"><i class="glyphicon glyphicon-<?=$field->img?>"></i><?=$field->name?></a>
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
                     <h2>Dashboard</h2>
                        <h5>Welcome <?=$user->firstname?> <?=$user->lastname?> , Love to see you back. </h5>
                    </div>
                </div>

                 <!-- /. ROW  -->
                <hr />
       <div class="row">
           <?php foreach($fields as $field) { ?>
           <div class="col-md-3 col-sm-6 col-xs-12" >
               <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-<?=$field->color?> set-icon">
                      <i class="glyphicon glyphicon-<?=$field->img?>" aria-hidden="true"></i>
                    </span>
                   <div class="text-box">
                       <a href="<?=$field->link?>">  <p class="main-text"><?=$field->name?></p></a>
                       <span class="center-block text-muted"><?=$field->count?></span>
                   </div>

                   <?php if (!$user->isAdmin()) { ?>
                   <div class="text-right">
                       <i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i>
                       <span data-target="#modal<?=$field->name?>" data-toggle="modal" class="hov">Create New</span>
                   </div>
                   <?php } ?>
               </div>
           </div>
           <?php } ?>
       </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Chat Box
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i>Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i>Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i>Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i>Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <ul class="chat-box">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="images/avatar/1.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body">
                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">

                                        <img src="images/avatar/2.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                         <img src="images/avatar/3.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">

                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>14 mins ago</small>

                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                         <img src="images/avatar/4.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">

                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>15 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>

                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="images/avatar/1.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body">
                                            <strong >Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                            </small>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                       <img src="images/avatar/2.png" alt="User" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                            <strong class="pull-right">Jhonson Deed</strong>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message to send..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>

                    </div>

                </div>
              </div>
                 <!-- /. ROW  -->
              </div>
             <!-- /. PAGE INNER  -->
           </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->

    <!--MODAL Category-->
    <div id="modalCategories" class="modal fade" style="font-size:14px">
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

    <!--MODAL Course-->
    <div id="modalCourses" class="modal fade">
        <div class="modal-dialog" role="document">
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
                        <div class="form-group">
                            <label for="crsSdate" class="control-label col-sm-3">Course Start Date:</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="crsSdate" name="courseStartDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crsEdate" class="control-label col-sm-3">Course End Date:</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="crsEdate" name="courseEndDate">
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

    <!-- MODAL Quiz-->
    <div id="modalQuizzes" class="modal fade" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Quiz</h4>
                </div>
                <div class="modal-body">
                    <form id="quizFrm" class="form-horizontal method = "post.php" action="sub.php"">
                    <div class="form-group">
                        <label for="titQuiz" class="col-sm-3 control-label">Title:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="titQuiz" name="titleQuiz" placeholder="The Title of your Quiz...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lesSel" class="col-sm-3 control-label">Lesson Selection: </label>
                        <div class="col-sm-9">
                            <select id="lesSel" class="form-control" name="lessonSelect" multiple>
                                <option value="chrome">Google Chrome</option>
                                <option value="firefox">Firefox</option>
                                <option value="ie">IE</option>
                                <option value="safari">Safari</option>
                                <option value="opera">Opera</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="variant">Variant:</label>
                        <div class="col-sm-3">
                            <input id="variant" class="form-control" type="number" name="numberOfVariants" value="1" min="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nmbrOfQuiz" class=" col-sm-3 control-label">Number of Quizzes:</label>
                        <div class="col-sm-3">
                            <input id="nmbrOfQuiz" class="form-control" type="number" name="numberOfQuizzes" value="1" min="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="radio-inline col-sm-3 control-label"><input type="radio" name="privacy" value="public">Public</label>
                        <div class="col-sm-3">
                            <label class="radio-inline  control-label"><input type="radio" name="privacy" value="private">Private</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SYLLABUS -->
    <div id="modalSyllabus" class="modal fade">
        <div class="modal-dialog" role="document">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Create Syllabus</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="submit.php">
                        <div class="form-group">
                            <label for="sylCourse" class="control-label col-sm-3">Select Course:</label>
                            <div class="col-sm-9">
                                <select id="sylCourse" class="form-control" name="SylCourse" >
                                    <option value="Category1">Discrete </option>
                                    <option value="Category2">SystemProgramming</option>
                                    <option value="Category3">English</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="courseObject" class="control-label col-sm-3">Course Objection:</label>
                            <div class="col-sm-9">
                                <input type="text" id="courseObject" class="form-control" name="Course_objection" placeholder="Full Name of your Course Objection">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="courseBooks" class="control-label col-sm-3">TextBooks:</label>
                            <div class="col-sm-9">
                                <input type="text" id="courseBooks" class="form-control" name="Text_books" placeholder="Textbooks">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="courseObject" class="control-label col-sm-3">Class methods:</label>
                            <div class="col-sm-9">
                                <input type="text" id="classMethod" class="form-control" name="Class_methods" placeholder="Full Name of your Course Objection">
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Topic</th>
                                    <th>Week</th>
                                    <th>Content</th>
                                    <th>Lesson</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <input type="text" id="topic" class="form-control" name="CourseForName" placeholder="Full Name of your Course">
                                    </td>
                                    <td>
                                        <input type="text" id="week" class="form-control" name="CourseForName" placeholder="Full Name of your Course">
                                    </td>
                                    <td>
                                        <input type="text" id="content" class="form-control" name="CourseForName" placeholder="Full Name of your Course">
                                    </td>
                                    <td>
                                        <input type="text" id="lesson" class="form-control" name="CourseForName" placeholder="Full Name of your Course">
                                    </td>
                                </tr>
                            </table>
                            <div class="text-left">
                                <button class="btn btn-info" type="button" name="button">Add new row</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success text-right" value="Submit">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JQUERY SCRIPTS -->
    <script src="scripts/jquery-1.10.2.js"></script>

    <!-- BOOTSTRAP SCRIPTS -->
    <script src="scripts/bootstrap/bootstrap.min.js"></script>

    <!-- CUSTOM SCRIPTS -->
    <script src="scripts/custom.js"></script>
</body>
</html>
