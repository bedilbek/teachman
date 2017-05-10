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
    $syllabus = SyllabusDB::getAllOnUserID($user_id);
    echo $request->course_id;
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
          <link href="styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <link href="styles/bootstrap/css/bootstrap-select.css" rel="stylesheet">
          <script src="scripts/jquery.min.js"></script>
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
              <a   href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
            </li>
              <?php foreach($fields as $field) { ?>
                  <li>
                      <a <?php if($field->name == "Syllabus") { ?> class="active-menu" <?php } ?> href="<?=$field->link?>"><i class="glyphicon glyphicon-<?=$field->img?>"></i><?=$field->name?></a>
                  </li>
              <?php } ?>
          </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
          <div id="page-inner">
            <div class="row">
              <div class="col-md-12">
                <h2>Syllabus</h2>
                <h5>Welcome <?=$user->firstname?> <?=$user->lastname?> , Love to see you back. </h5>
              </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-info">
                  <div class="panel-heading ">
                    <div class="row">
                      <div class="col-sm-6">

                        <button class="btn btn-info " style="padding:0px">
                          <select id="selectCourse" class="form-control" style="font-size:20px">
                            <?php foreach ($courses as $course) { ?>
                            <option value="<?=$course->id?>"><?=$course->course_name?></option>
                            <?php } ?>
                          </select>
                        </button>
                      </div>
                      <div class="col-sm-6 text-right">
                        <button id="asssa" class="btn btn-success" data-target="#modalSyllabus" data-toggle="modal">CREATE</button>
                        <button class="btn " data-target="#modalEditSyllabus" data-toggle="modal" >EDIT</button>
                        <button class="btn btn-warning">PDF</button>
                        </div>
                      </div>
                    </div>

                    <div class="panel-body">
                      <div class="well">
                      <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                          <h3>Course Objective:</h3>
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-6">
                          <h4>Course Objective</h4>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                          <h3>Textbooks:</h3>
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-6">
                          <h4>Course Objective</h4>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                          <h3>Class methods:</h3>
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-6">
                          <h4>Course Objective</h4>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="table-responsive" style="margin:10px">
                      <table class="table table-striped table-bordered table-hover" id="data_table" >
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
                          <tr class="odd" id="row1">
                            <td  id="no1">1</td>
                            <td id="topic1">Introduction to Discrete Mathematics and Logic</td>
                            <td id="week1">W1</td>
                            <td id="content1">Propositional Equaivalences (1.1, 1.2, 1.3 of the textbook)</td>
                            <td data-target="#modalLesson" data-toggle="modal" id="lesson1" style="color:blue" class="hov">Lesson1</td>
                            <td>
                              <span class="edit glyphicon glyphicon-edit hov" id="edit_button1" onclick="edit_row('1')"></span>
                              <span class="save glyphicon glyphicon-ok hov" id="save_button1" onclick="save_row('1')" style="display:none"></span>
                              <span class="delete glyphicon glyphicon-remove hov"  onclick="delete_row('1')"></span>
                            </td>
                          </tr>

                          <tr class="even" id="row2">
                            <td id="no2">2</td>
                            <td id="topic2">I	Predicates and Quantifiers, Rules of Inference</td>
                            <td id="week2">W2</td>
                            <td id="content2">Predicates, quantification of predicates. Translating statements from English language into logic and vice versa. Rules of Inferences (Modus ponens, modus tallens, etc). (1.4, 1.5, 1.6 of the textbook)</td>
                            <td id="lesson2" data-target="#modalLesson" data-toggle="modal" style="color:blue" class="hov">Lesson2</td>
                            <td class="center">
                              <span class="edit glyphicon glyphicon-edit hov" id="edit_button2" onclick="edit_row('2')"></span>
                              <span class="save glyphicon glyphicon-ok hov" id="save_button2" onclick="save_row('2')" style="display:none"></span>
                              <span class="delete glyphicon glyphicon-remove hov"  onclick="delete_row('2')"></span>
                            </td>
                          </tr>

                          <tr class="odd">
                            <td id="new_no"></td>
                            <td><input type="text" id="new_topic"></td>
                            <td><input type="text" id="new_week"></td>
                            <td><input type="text" id="new_content"></td>
                            <td><input type="text" id="new_lesson"></td>
                            <td><span class="add glyphicon glyphicon-plus hov" onclick="add_row()" ></span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--End Advanced Tables -->
              </div>
            </div>
            <!-- /. PAGE INNER  -->
          </div>
          <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->


  <!--  MODAL LESSON -->
        <div id="modalLesson" class="modal fade">
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
                    <label for="titLes" class="col-sm-3 control-label">Title:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="titLes" name="titleLesson" placeholder="The Title of your Lesson...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="objection" class="col-sm-3 control-label">Lesson Objection:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="objection" name="objectionLesson" placeholder="The obection of your Lesson...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="additionals" class="col-sm-3 control-label">Additional materials:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="additionals" name="additionalsLesson" placeholder="Additional materials of your Lesson...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lesDes" class="control-label col-sm-3">Lesson Description:</label>
                    <div class="col-sm-9">
                      <textarea id="lesDes" class="form-control" name="lessonDescription"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fileinput" class="control-label col-sm-3">File input:</label>
                    <div class="col-sm-9">
                      <input id="fileinput" type="file" />
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">Save</button>
                </form>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-warning">PDF</button>
                  <button  class="btn btn-default" data-dismiss="modal">Close</button>
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

<!--MODAL EDIT SYLLABUS-->
          <div id="modalEditSyllabus" class="modal fade">
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
                      <label for="courseObject" class="control-label col-sm-3">Course Objection:</label>
                      <div class="col-sm-9">
                        <input type="text" id="courseObject" class="form-control" name="Course_objection"  value="Full Name of your Course Objection">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="courseBooks" class="control-label col-sm-3">TextBooks:</label>
                      <div class="col-sm-9">
                        <input type="text" id="courseBooks" class="form-control" name="Text_books" value="Textbooks">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="courseBooks" class="control-label col-sm-3">Class methods:</label>
                      <div class="col-sm-9">
                        <input type="text" id="classMethod" class="form-control" name="Class_methods" value="Methods">
                      </div>
                    </div>
                    </form>

                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-success text-right" value="Save">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
      <!-- CUSTOM SCRIPTS -->
      <script src="scripts/custom.js"></script>
        <script type="text/javascript">
            function pageLoad() {
                alert("hee");
                var e = document.getElementById("selectCourse");
                var selectedCourse = e.options[e.selectedIndex].value;


                $('#selectCourse').on("change", function () {
                    $.ajax({
                        url: 'syllabus.php',
                        type: GET,
                        data: {course_id: selectedCourse},
                        async: false;
                    })
                });

            };
        </script>
</body>
</html>
