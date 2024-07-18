$(document).ready(function(){
    $('#btn').click(function(){
        // console.log("hi");
        var date=$('#date').val();
        var category=$('#category').val();
        var amount=$('#amount').val();
        var message=$('#message').val();
        // console.log(category);

        var flag=true;
        if(date==""){
            $('#dateErr').html("<span style='color:red;'>Date is Required</span>");
            flag=false;   
        }
        else{
            $('#dateErr').html("");
        }
        if(category==null){
            $('#categoryErr').html("<span style='color:red;'>Category is Required</span>");
            flag=false;   
        }
        else{
            $('#categoryErr').html("");
        }
        if(amount==""){
            $('#amountErr').html("<span style='color:red;'>Amount is Required</span>");
            flag=false;   
        }
        else{
            let regex=/^(?!0(\.0+)?$)\d+(\.\d+)?$/;
            if(regex.test(amount)){
                $('#amountErr').html("");
            }
            else{
                flag=false;
                $('#amountErr').html("<span style='color:red;'>Amount email address</span>");   
            }
        }

        if(file_name==="add_expense.php"){
            file_name="addexpense_insert.php";
        }
        if(file_name==="add_income.php"){
            file_name="addincome_insert.php";
        }
        if(file_name==="update_expense.php"){
            file_name="updateexpense_insert.php?srno="+srno;
        }

        
        if(flag==true){
            console.log("insert");
            var form = $('#uploadForm')[0];
            var formData = new FormData(form);
            console.log(formData)
            $.ajax({
                url:file_name,
                type:'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    response=response.trim();
                    // console.log(response);
                     if (response === "success") {
                        if(file_name==="addexpense_insert.php"){
                            $('#status').html("<span style='color:green;'>Expense Added Successfully</span>");
                        }
                        if(file_name==="addincome_insert.php"){
                            $('#status').html("<span style='color:green;'>Income Added Successfully</span>");
                        }
                        if(file_name===("updateexpense_insert.php?srno="+srno)){
                            $('#status').html("<span style='color:green;'>Expense Updated Successfully</span>");
                        }
                        $('#date').val("");
                        $('#category').val("0");
                        $('#amount').val("");
                        $('#message').val("");
                    }
                }

            });
        }

    });
});