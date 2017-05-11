
function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";

 var topic=document.getElementById("topic"+no);
 var week=document.getElementById("week"+no);
 var content=document.getElementById("content"+no);
 var lesson=document.getElementById("lesson"+no);

 var topic_data=topic.innerHTML;
 var week_data=week.innerHTML;
 var content_data=content.innerHTML;
 var lesson_data=lesson.innerHTML;

 topic.innerHTML="<input type='text' id='topic_text"+no+"' value='"+topic_data+"'>";
 week.innerHTML="<input type='text' id='week_text"+no+"' value='"+week_data+"'>";
 content.innerHTML="<input type='text' id='content_text"+no+"' value='"+content_data+"'>";
 lesson.innerHTML="<input type='text' id='lesson_text"+no+"' value='"+lesson_data+"'>";
}



function save_row(no)
{
 var topic_val=document.getElementById("topic_text"+no).value;
 var week_val=document.getElementById("week_text"+no).value;
 var content_val=document.getElementById("content_text"+no).value;
 var lesson_val=document.getElementById("lesson_text"+no).value;

 document.getElementById("topic"+no).innerHTML=topic_val;
 document.getElementById("week"+no).innerHTML=week_val;
 document.getElementById("content"+no).innerHTML=content_val;
 document.getElementById("lesson"+no).innerHTML=lesson_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
}



function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";

}
function delete_row_teacher(no)
{
    document.getElementById("row"+no+"").outerHTML="";
    $.ajax({
        type: "POST",
        cache: false,
        async: true,
        dataTYPE: "JSON",
        url: "manipulation/deletedata.php",
        data: {"user_id": no},
        success: function() {},
        error: function(request, error) {console.log(arguments);
            alert(" Can't do because: " + error);}
    });

}

function delete_row_course(no){
    document.getElementById("row"+no+"").outerHTML="";

    $.ajax({
        type: "POST",
        cache: false,
        async: true,
        dataTYPE: "JSON",
        url: "manipulation/deletedata.php",
        data: {"course_id": no},
        success: function() {},
        error: function(request, error) {console.log(arguments);
            alert(" Can't do because: " + error);}
    });
}

function delete_row_category(no){
    document.getElementById("row"+no+"").outerHTML="";

    $.ajax({
        type: "POST",
        cache: false,
        async: true,
        dataTYPE: "JSON",
        url: "manipulation/deletedata.php",
        data: {"category_id": no},
        success: function() {},
        error: function(request, error) {console.log(arguments);
            alert(" Can't do because: " + error);}
    });
}





function add_row() {

    var syllabus_id = document.getElementById("syllabus_id").value;
    var new_topic = document.getElementById("new_topic").value;
    var new_week = document.getElementById("new_week").value;
    var new_content = document.getElementById("new_content").value;
    var new_lesson = document.getElementById("new_lesson").value;
    var bool = true;
    if (new_topic == "") bool = false;
    if (new_week == "") bool = false;
    if (new_content == "") bool = false;
    if (new_lesson == "") bool = false;
    if (syllabus_id == "" || syllabus_id == null) bool = false;
  if (bool) {
      $.ajax({
          type: "POST",
          cache: false,
          async: true,
          dataTYPE: "JSON",
          url: "manipulation/adddata.php",
          data: {"title":new_topic, "content":new_content, "week_number":new_week, "lesson_n":new_lesson, "syllabus_id":syllabus_id},
          success: function() {},
          error: function(request, error) {console.log(arguments);
              alert(" Can't do because: " + error);}
      });
    document.getElementById("new_topic").value = "";
    document.getElementById("new_week").value = "";
    document.getElementById("new_content").value = "";
    document.getElementById("new_lesson").value = "";
}
}
