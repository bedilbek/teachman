<?php
require_once "start.php";
$request = new Request();
$user_id = $request->user_id;
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
          <link rel="stylesheet" type="text/css" href="styles/style.css">

          <title></title>
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
                  <img src="assets/img/find_user.png" class="user-image img-responsive"/>
        </li>
                  <li>
                      <a href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
                  </li>
                  <li>
                      <a href="teachers.php"><i class="glyphicon glyphicon-user"></i>Teachers</a>
                  </li>
                   <li>
                      <a  href="categories.php"><i class=" glyphicon glyphicon-list-alt"></i> Categories</a>
                  </li>
                  <li>
                      <a  href="courses.php"><i class="glyphicon glyphicon-book"></i>Courses</a>
                  </li>

                    <li  >
                      <a  href="syllabus.php"><i class="glyphicon glyphicon-th-list"></i>Syllabus</a>
                  </li>
                  <li  >
                      <a class="active-menu"  href="quizzes.php"><i class="glyphicon glyphicon-edit"></i>Quizzes</a>
                  </li>

              </ul>
          </div>

      </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Quiz</h2>
                        <h5>Welcome Jhon Deo , Love to see you back. </h5>

                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <!--   <div class="row">
                <div class="col-md-12">-->
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                    <div class="panel-heading">Quiz Creating</div>
                    <div class="panel-body">
                      <div class="row"> 
                      <div class="col-md-6">
                        <label class="label-control"><p>Course: </p></label>
                        <select class="bootstrap-select">
                          <option value="math ">Math  </option>
                          <option value="english">English</option>
                        </select>
                      </div> 
                      </div>

                      <div class="row"> 
                      <div class="col-md-6">
                        <label><p>Lesson: </p></label>
                        <select>
                          <option value="math ">Lesson1  </option>
                          <option value="english">Lesson2</option>
                        </select>
                      </div> 
                      </div>

                   

                     <div class ="question" >
                       <label><p>Question </p></label>
                       <input id="name" type="text" name="text" size="60" required >
                    

                         <div class="answer">
                            <label><p>Answer </p></label>

                            <form action="" >
                             <label><p>A </p></label>
                               <input id="a" type="text" name="a" size="50" required ><br> 
                             <label><p>B </p></label>
                               <input id="b" type="text" name="b" size="50" required ><br> 
                             <label><p>C </p></label>
                               <input id="c" type="text" name="c" size="50" required ><br> 
                             <label><p>D </p></label>
                               <input id="d" type="text" name="b" size="50" required><br> 

                            </form>


                         </div>

                         <div class="submit" style="margin: auto; width: 20%;"> 
                        <label> <button id="save">Save</button>
                                <button id="edit">Edit</button>
                                <button id="delete">Delete</button>
                        </label>
                         </div>
                         
                      </div>
                      <p class="then"></p>
                  <button id="add" type="button" > ADD</button>
                       




                    </div>
                    






                        <div class="panel-heading">
                            Form Element Examples
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Basic Form Examples</h3>
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Text Input</label>
                                            <input class="form-control" />
                                            <p class="help-block">Help text here.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Text Input with Placeholder</label>
                                            <input class="form-control" placeholder="PLease Enter Keyword" />
                                        </div>
                                        <div class="form-group">
                                            <label>Just A Label Control</label>
                                            <p class="form-control-static">info@yourdomain.com</p>
                                        </div>
                                        <div class="form-group">
                                            <label>File input</label>
                                            <input type="file" />
                                        </div>
                                        <div class="form-group">
                                            <label>Text area</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Checkboxes</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="" />Checkbox Example One
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""/>Checkbox Example Two
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value=""/>Checkbox Example Three
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Inline Checkboxes Examples</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"/> One
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"/> Two
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"/> Three
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Radio Button Examples</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked />Radio Example One
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"/>Radio Example Two
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3"/>Radio Example Three
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Select Example</label>
                                            <select class="form-control">
                                                <option>One Vale</option>
                                                <option>Two Vale</option>
                                                <option>Three Vale</option>
                                                <option>Four Vale</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Multiple Select Example</label>
                                            <select multiple class="form-control">
                                                <option>One Vale</option>
                                                <option>Two Vale</option>
                                                <option>Three Vale</option>
                                                <option>Four Vale</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-primary">Reset Button</button>

                                    </form>
                                    <br />
                                      <h3>With radio & checkboxes</h3>
                                    <form>

    <div class="form-group input-group">
      <span class="input-group-addon">
        <input type="checkbox" />
      </span>
      <input type="text" class="form-control" />
    </div>
                                         <div class="form-group input-group">
      <span class="input-group-addon">
        <input type="radio" />
      </span>
      <input type="text" class="form-control" />
    </div>
                                    </form>


    </div>

                                <div class="col-md-6">
                                    <h3>Disabled Form State Examples</h3>
                                    <form role="form">
                                        <fieldset disabled="disabled">
                                            <div class="form-group">
                                                <label for="disabledSelect">Disabled input</label>
                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled />
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledSelect">Disabled select </label>
                                                <select id="disabledSelect" class="form-control">
                                                    <option>Disabled select</option>
                                                </select>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" />Disabled Checkbox
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Disabled Button</button>
                                        </fieldset>
                                    </form>
                                    <h3>Validation State Examples</h3>
                                    <form role="form">
                                        <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Input with success</label>
                                            <input type="text" class="form-control" id="inputSuccess">
                                        </div>
                                        <div class="form-group has-warning">
                                            <label class="control-label" for="inputWarning">Input with warning</label>
                                            <input type="text" class="form-control" id="inputWarning">
                                        </div>
                                        <div class="form-group has-error">
                                            <label class="control-label" for="inputError">Input with error</label>
                                            <input type="text" class="form-control" id="inputError">
                                        </div>
                                    </form>
                                    <h3>Input Group Examples</h3>
                                    <form role="form">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-eur"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Font Awesome Icon">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                    <h3>Different Size Input Groups</h3>
                                     <form role="form">
  <div class=" form-group input-group input-group-lg">
  <span class="input-group-addon">@</span>
  <input type="text" class="form-control" placeholder="Username" />
</div>

<div class="form-group input-group">
  <span class="input-group-addon">@</span>
  <input type="text" class="form-control" placeholder="Username" />
</div>

<div class="form-group input-group input-group-sm">
  <span class="input-group-addon">@</span>
  <input type="text" class="form-control" placeholder="Username" />
</div>

                                     </form>
                                    <h3>Different Size Input Groups</h3>
                                     <form role="form">
                                  <div class="input-group">
      <span class="form-group input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
      <input type="text" class="form-control" />
    </div>
<br />
                                           <div class="input-group">

      <input type="text" class="form-control" />
                                                <span class="form-group input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div>
                                         </form>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <h3>More Customization</h3>
                         <p>
                        For more customization for this template or its components please visit official bootstrap website i.e getbootstrap.com or <a href="http://getbootstrap.com/components/" target="_blank">click here</a> . We hope you will enjoy our template. This template is easy to use, light weight and made with love by binarycart.com
                        </p>
                    </div>
                </div>
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="scripts/jquery.min.js"></script>

          <!-- Include all compiled plugins (below), or include individual files as needed -->
          <script src="scripts/bootstrap.min.js"></script>
          <script src="scripts/bootstrap/jquery.js"></script>
          <link href="styles/custom.css" rel="stylesheet" />
           <script type="text/javascript" src="scripts/quizjs.js"></script>

</body>
</html>
