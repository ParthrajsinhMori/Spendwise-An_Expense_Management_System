$(document).ready(function(){
    // console.log("js");
    $('#btn').click(function (){
        window.location.href="add_income.php";
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
    // $('th').click();
});