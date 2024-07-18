$(document).ready(function(){
    // console.log("js");
    $('.delete').click(function(){
        $(this).hide();
      });
    $('#btn').click(function (){
        window.location.href="add_expense.php";
    });
    $("#input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#mytable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $('th').on('click',function(){
        console.log($(this).text());
    });
    $('.btnEdit').click(function(){
        // console.log("Edit button clicked");
        $(this).hide();
    });
    $('.delete').click(function(){
        $(this).hide();
      });
    // $('th').click();
});