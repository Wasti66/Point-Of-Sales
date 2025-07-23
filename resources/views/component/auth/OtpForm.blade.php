<div>
    <!-- user name or email -->
    <div class="mb-4">
        <label for="email" class="poppins-medium fw-normal">Email address</label>
        <input type="text" name="email" id="email" class="form-control border border-secondary custom-input poppins-medium" placeholder="Email">
        <small id="emailError" class="text-danger"></small>
    </div>
    <!-- forget and login button -->
    <div class="mb-4">
        <button onclick="SubmitOtp()" class="btn btn-dark px-3 text-uppercase"><small>send otp</small></button>
    </div>
    <!-- registration page -->
    <a href="{{url('/UserRegistration')}}" class="text-black-50 fw-medium">Or Create An Account?</a>
</div>

<script>
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
        document.querySelectorAll("input").forEach((el) => el.classList.remove("is-invalid"));
    }
    async function SubmitOtp(){
        clearErrors();
        let error =false;

        let emailInput = document.getElementById('email');
        let email = emailInput.value.trim();

        if(!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById('emailError').innerText = "Email required!";
            emailInput.classList.add("is-invalid");
            error = true;
        }

        if(!error){

            showLoader();
            let res = await axios.post("/send-otp",{
                'email':email
            })
            hideLoader();
            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                sessionStorage.setItem('email', email);
                setTimeout(function (){
                    window.location.href="/verifyOtp"
                }, 2000)
            }else{
                errorToast(res.data['message']);
            }

            
        }

    }
</script>



