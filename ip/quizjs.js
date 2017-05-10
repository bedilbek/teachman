 // var regex = /^(.+?)(\d+)$/i;
 // var clnindex=$(".question").length;
 $(document).ready(function() {

        



           $("#add").click(function()
           {

            $(".question:last").clone(true, true).appendTo(".question:last").find('input').val('');
             $("#edit").prop("disabled", true);
            
           });

           $("#save").click(function()
           {

           
            // $('.question input').blur(function(){
            //     if($(this).val().length==0)
            //     {
                   
            //        alert('Fill the blank!');
            //        return false;
                    
            //     }
            // });


            $(":text").prop("disabled", true);
             $("#save").prop("disabled", true);
             $("#edit").prop("disabled", false);
           });
          

           $("#edit").click(function()
           {
            $(":text").prop("disabled", false);
             $("#save").prop("disabled", false);
           });

            $("#delete").click(function(e)
           {
            $(this).closest(".question").remove();
             e.preventCefault();

           });



        });

// function clone()
// {
//     $(this).parents(".question").clone().appendTo(".question:last").attr("id", "question"+ "clnindex").find("*")
//     .each(function(){
//         var id=this.id ||"";
//         var match=id.match(regex) ||[];
//         if(match.length==3){
//             this.id=match[1]+(clnindex);
//         }
//     })
//     .on('click', 'button#add', clone)
//     .on('click', 'button#delete', remove);
//     clnindex++;
// }

// function remove()
// {
//     $(this).parents(".question").remove();
// }
// $("button#add").on("click", clone);
// $("button#delete").on("click", remove);