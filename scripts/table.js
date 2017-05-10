
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



function add_row()
{
 var new_topic=document.getElementById("new_topic").value;
 var new_week=document.getElementById("new_week").value;
 var new_content=document.getElementById("new_content").value;
 var new_lesson=document.getElementById("new_lesson").value;

 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;
 var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'>"+
  "<td id='no"+table_len+"'>"+table_len+"</td>"+
  "<td id='topic"+table_len+"'>"+new_topic+"</td>"+
  "<td id='week"+table_len+"'>"+new_week+"</td>"+
  "<td id='content"+table_len+"'>"+new_content+"</td>"+
  "<td id='lesson"+table_len+"' data-target='#modalLesson' data-toggle='modal' style='color:blue' class='hov'>"+new_lesson+"</td>"+
  "<td>"+
       "<span class='edit glyphicon glyphicon-edit hov' id='edit_button"+table_len+"' onclick='edit_row("+table_len+")'></span>"+
       "<span class='save glyphicon glyphicon-ok hov' id='save_button"+table_len+"' onclick='save_row("+table_len+")' style='display:none'></span>"+
       "<span class='delete glyphicon glyphicon-remove hov' onclick='delete_row("+table_len+")'></span>"+
  "</td></tr>";

 document.getElementById("new_topic").value="";
 document.getElementById("new_week").value="";
 document.getElementById("new_content").value="";
 document.getElementById("new_lesson").value="";
}
