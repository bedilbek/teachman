/*=============================================================
    Authour URI: www.binarycart.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */


(function ($) {
    "use strict";
    var mainApp = {

        select_on_change: function () {
            var selectCourse = $("#selectCourse");
            selectCourse.unbind('change');
            selectCourse.on("change", function () {
                 var selectedCourse = $("#selectCourseDiv").find("select").val();
                document.location = "/teachman/syllabus.php?selectCourse="+selectedCourse;
            });
        },
        after_before_select: function () {
            alert(selectedCourse);
            $("#selectCourseDiv").find("select").val(selectedCourse);
        },
        ajax: function () {
            $.post("/teachman/syllabus.php",{ name: "John", time: "2pm" }).done(function (data) {
                alert(data);
            });

            alert(selectedCourse);
            $.ajax({
                type: "GET",
                cache: false,
                async: true,
                dataTYPE: "JSON",
                url: "deletedata.php",
                data: {"selectCourse": selectedCourse},
                success: function(data) {alert(data);},
                error: function(request, error) {console.log(arguments);
                    alert(" Can't do because: " + error);}
            });
        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.select_on_change();
    });

}(jQuery));
