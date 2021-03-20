<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
    </head>

    <body>
        <div class="container ">
            <div class="row">
                <div class="login-container col-lg-4 col-md-6 col-sm-8 col-xs-12">
                     <div class="login-title text-center">
                            <h2><span>Logo<strong>Name</strong></span></h2>
                     </div>
                    <div class="login-content">
                        <div class="login-header text-center">
                            <h3><strong>Welcome To Admin Panel</strong></h3>
                        </div>
                        <div class="login-body">
                                <div class="form-group ">
                                    <div class="pos-r">
                                        <input required id="form-username" type="text" name="form-username" placeholder="Username..." class="form-username form-control">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="pos-r">
                                        <input required id="form-password" type="password" name="form-password" placeholder="Password..." class="form-password form-control" >
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                                <br/>

                                <div class="form-group">
                                    <button id="submitBtn" class="btn btn-primary form-control"><strong>Sign in</strong></button>
                                </div>
                        </div> <!-- end  login-body -->
                    </div><!-- end  login-content -->
                </div>  <!-- end  login-container -->

            </div>
        </div><!-- end container -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{asset('js/axios.min.js')}}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </body>
</html>

<script type="text/javascript">

    $('#submitBtn').click(function(){
      let username = $('#form-username').val();
      let userpassword = $('#form-password').val();
      if(username.length == 0){
        swal("Error!", "Please Enter User Name!", "error");
      }else if(userpassword.length == 0){
        swal("Error!", "Please Enter Password!", "error");
      }else{
            axios.post('/LoginData',{
              username : username,
              userpassword : userpassword
            })
              .then(function(response){
                if(response.status == 200 && response.data == 1){
                  
                  swal("Success!", "Congratulation!", "success");
                  window.location.href = "/";
                }else{
                  swal("Error!", "Enter Valid login Details!", "error");
                }
              })
                .catch(function(error){
                  swal("Error!", "Enter Valid login Details!", "error");
                })
      }
    });



</script>
