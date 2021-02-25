@extends('layout.app')

@section('title','Admin | Login Form')
@section('content')
<div class="container mt-5">

    <div class="row text-center ">
        <div class="col-md-6 offset-md-3">
            <div class="card p-3">
                <form action="" class="loginForm">
                    <div class="form-group">
                        <label for="loginInputUsername">Username</label>
                        <input required value="" name="username" type="text" autocomplete="off" class="form-control" id="loginInputUsername" aria-describedby="emailHelp" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="loginInputPassword">Password</label>
                        <input required value="" name="userpassword" type="password"  autocomplete="off" class="form-control" id="loginInputPassword" placeholder="Password">
                    </div>
                    <!-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Check1">
                        <label class="form-check-label" for="Check1">Check me out</label>
                    </div> -->
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection()



@section('script')
    <script type="text/javascript">
        $(".loginForm").on('submit',function(event){
            event.preventDefault();
            let loginFormData = $(this).serializeArray();
            let clientUsername = loginFormData[0]['value'];
            let clientPassword = loginFormData[1]['value'];
            // alert(username+ " " + password);
             console.log("username : "+clientUsername+"\npassword : "+clientPassword);
            axios.post('/loginCheck',{
                username : clientUsername,
                password : clientPassword,
            })
            .then(function(response){
                console.log(response.data);
                if(response.data.status==200)
                {
                    window.location.href="/";
                }
                else{
                    toastr.error("Your Username Or Password Wrong");
                }
            })
            .catch(function(error){
                toastr.error("Your Username Or Password Wrong");
            })
        })
    </script>
@endsection()

