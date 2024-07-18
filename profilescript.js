$(document).ready(function(){
    // console.log("js");
    $('#btn1').click(function(){
        console.log("clicked");
        var password=$('#password').val();
        var password1=$('#password1').val();
        var password2=$('#password2').val();
        console.log(password2);
        let flag=true;
        if(password==""){
            $('#passwordErr').html("<span style='color:red;'>Current Password is Required</span>");  
            flag=false; 
        }
        else{

        }
        if(password1==""){
            $('#password1Err').html("<span style='color:red;'>New Password is Required</span>");  
            flag=false; 
        }
        else{
            let k=0;
            let error="<span style='color:red;'>Must Contain atleast one ";
            let uppercase=/[A-Z]/.test(password1);
            let lowercase=/[a-z]/.test(password1);
            let digits=/[0-9]/.test(password1);
            let special=/\W/.test(password1);
            // console.log(special);

            let q=0;
            if(uppercase==false){
                error+="uppercase";
                q=1;
            }
            if(lowercase==false){
                if(q==0){
                error+="lowercase";
                q=1;
                }
                else{
                error+=", lowercase";
                }
            }
            if(digits==false){
                if(q==0){
                    error+="number";
                    q=1;
                }
                else{
                    error+=", number";
                }
            }
            if(special==false){
                if(q==0){
                    error+="special symbol";
                    q=1;
                }
                else{
                    error+=", special symbol";
                }
            }
            if(password1.length<8){
                if(q==0){
                    error="<span style='color:red;'>Password Length must be atleast 8 characters";
                    q=1;
                }
                else{
                    error+=" and length atleast 8 characters";
                }
            }
            // console.log(error);
            error+="</span>";
            if(q!=0){
                $('#password1Err').html(error);
                flag=false;
            }
            else{
                $('#password1Err').html("");
            }
        }
        if(password2==""){
            $('#password2Err').html("<span style='color:red;'>Enter again new password</span>");  
            flag=false; 
        }
        else{
            if(password1===password2){
                $('#password2Err').html("");
            }
            else{
                $('#password2Err').html("<span style='color:red;'>Both password must be same</span>");
                flag=false;
            }
        }
        
        if(flag==true){
            var form = $('#uploadForm1')[0];
            // console.log(form);
            var formData1 = new FormData(form);
            console.log(formData1);
            $.ajax({
                url:'change_password.php',
                type:'POST',
                data: formData1,
                contentType: false,
                processData: false,
                success : function(response){
                    if(response.trim()==="invalid"){
                        $('#passwordErr').html("<span style='color:red;'>Current Password is Incorrect</span>");
                    }
                    else if(response.trim()==="updated"){
                        $('#status1').html("<span style='color:green'>Password Updated Successfully</span>");
                        $('#password').val("");
                        $('#password1').val("");
                        $('#password2').val("");
                    }
                    else{
                        $('#status1').html("<span style='color:red;'>Unable to update</span>");
                    }
                }
            });
        }

    });
    $('#btn2').click(function(){
        // console.log("clicked");
        var username=$('#username').val();
        // console.log(username);
        let flag=true;
        if(username==""){
            $('#usernameErr').html("<span style='color:red;'>Username is Required</span>");  
            flag=false; 
        }
        else{
            let regex=/^[a-zA-Z ]{1,30}$/;
            if(regex.test(username)){
                if(username===user_name){
                    $('#usernameErr').html("<span style='color:red;'>New Username is same as Current Username</span>");
                    flag=false;
                }
                else{
                    $('#usernameErr').html("");
                }
            }
            else{
                flag=false;
                $('#usernameErr').html("<span style='color:red;'>Username should only contain alphabets</span>");   
            }
        }
        console.log(flag);
        if(flag==true){
            var form = $('#uploadForm2')[0];
            // console.log(form);
            var formData1 = new FormData(form);
            console.log(formData1);
            $.ajax({
                url:'change_username.php',
                type:'POST',
                data: formData1,
                contentType: false,
                processData: false,
                success : function(response){
                    if(response.trim()==="changed"){
                        $('#status2').html("<span style='color:green;'>Username updated successfully.<br>Refresh to view changes</span>");
                        $('#username').val("");
                    }
                    else{
                        $('$status2').html("<span style='color:red;'>Unable to change</span>");
                    }
                }
            });
        }
    });
});