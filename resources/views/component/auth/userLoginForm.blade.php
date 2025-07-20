<div>
    <!-- user name or email -->
    <div class="mb-4">
        <label for="email" class="poppins-medium fw-normal">Email/Username</label>
        <input type="text" name="email" id="email" class="form-control border border-secondary custom-input poppins-medium" placeholder="Email">
        <small id="emailError" class="text-danger"></small>
    </div>
    <!-- password -->
    <div class="mb-4">
        <label for="password" class="poppins-medium fw-normal">Password</label>
        <input type="password" name="password" id="password" class="form-control border border-secondary custom-input poppins-medium" placeholder="Password">
        <small id="errorPass" class="text-danger"></small>
    </div>
    <!-- forget and login button -->
    <div class="mb-4 text-end">
        <a href="{{ url('/sendOtp') }}" class="link-dark me-2"><small>Forgot your password?</small></a>
        <button onclick="SubmitLogin()" class="btn btn-dark px-3 text-uppercase"><small>login</small></button>
    </div>
    <!-- registration page -->
    <a href="{{url('/UserRegistration')}}" class="text-black-50 fw-medium">Or Create An Account?</a>
</div>

<script>
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
    }
    async function SubmitLogin(){

        clearErrors();
        let error =false;

        let email = document.getElementById('email').value.trim();
        let password = document.getElementById('password').value.trim();

        if(email.length === 0){
            document.getElementById('emailError').innerText = "Email field required";
            error = true;
        }
        if(password.length === 0){
            document.getElementById('errorPass').innerText = "Password field required";
        }
        if(!error){
            try{

                showLoader();
                let res = await axios.post("/user-login",{
                    email:email,
                    password:password
                })
                hideLoader();
                if(res.status === 200 && res.data['status'] === 'success'){
                    successToast(res.data['message'])
                    setTimeout(function (){
                        window.location.href="/dashboard"
                    }, 1000)
                    
                }

            }catch(error){
                hideLoader();
                if(error.response){
                    if(error.response.status === 401){
                        errorToast(error.response.data['message']);
                    }else{
                        errorToast("Server error: " + error.response.status);
                    }
                }else{
                    errorToast("Network or unknown error occurred");
                }
            }
            
        }
        
    }
</script>


