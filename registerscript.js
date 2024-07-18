$(document).ready(function(){
    $('#btn').click(function(){
        var email=$('#email').val();
        var username=$('#username').val();
        var password=$('#password').val();
        var confirmPassword=$('#confirmPassword').val();
        // console.log(confirmPassword);

        var flag=true;
        if(email==""){
            $('#emailErr').html("<span style='color:red;'>Email is Required</span>");
            flag=false;   
        }
        else{
            let regex=/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(regex.test(email)){
                $('#emailErr').html("");
            }
            else{
                flag=false;
                $('#emailErr').html("<span style='color:red;'>Invalid email address</span>");   
            }
        }
        if(username==""){
            $('#usernameErr').html("<span style='color:red;'>Username is Required</span>");  
            flag=false; 
        }
        else{
            let regex=/^[a-zA-Z ]{1,30}$/;
            if(regex.test(username)){
                $('#usernameErr').html("");
            }
            else{
                flag=false;
                $('#usernameErr').html("<span style='color:red;'>Username should only contain alphabets</span>");   
            }
        }
        if(password==""){
            $('#password1Err').html("<span style='color:red;'>You must create Password</span>");
            flag=false;
        }
        else{
        let k=0;
        let error="<span style='color:red;'>Must Contain atleast one ";
        let uppercase=/[A-Z]/.test(password);
        let lowercase=/[a-z]/.test(password);
        let digits=/[0-9]/.test(password);
        let special=/\W/.test(password);
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
        if(password.length<8){
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
        console.log(confirmPassword);
        if(confirmPassword==""){
        $('#password2Err').html("<span style='color:red;'>Enter again the same password</span>");
        flag=false;
        }
        else{
        console.log("hello");
        if(confirmPassword!=password){
            $('#password2Err').html("<span style='color:red;'>Both password must be same</span>");
            flag=false;
        }
        else{
            $('#password2Err').html("");


        }

        }
        if(flag==true){
            console.log("insert");
            var form = $('#uploadForm')[0];
            var formData = new FormData(form);
            console.log(formData)
            $.ajax({
                url:'register_insert.php',
                type:'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    response=response.trim();
                    if (response === "user_exists") {
                        // alert('User already registered, try Login');

                        $('#emailErr').html("<span style='color:red;'>Email id already exists</span>");
                    } else if (response === "success") {
                        alert('Registered Successfully');
                        $('#email').val("");
                        $('#username').val("");
                        $('#password').val("");
                        $('#confirmPassword').val("");
                        window.location.href = "login.php";
                    } else {
                        alert('Registration failed. Please try again.' + response + response.length);
                    }
                }

            });
        }
    
    });
});