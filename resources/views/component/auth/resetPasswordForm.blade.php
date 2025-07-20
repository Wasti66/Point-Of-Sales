<div>
    <!-- new password -->
    <div class="mb-4">
        <label for="password" class="poppins-medium fw-normal">New Password</label>
        <input type="password" name="password" id="password" class="form-control border border-secondary custom-input poppins-medium" placeholder=" Password">
        <small id="passwordError" class="text-danger"></small>
    </div>
    <div class="mb-4">
        <label for="confirm_pass" class="poppins-medium fw-normal">Confirm Password</label>
        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control border border-secondary custom-input poppins-medium" placeholder="Confirm Password">
        <small id="confirmPassError" class="text-danger"></small>
    </div>
    <!-- reset button -->
    <div class="mb-4">
        <button onclick="resetPasssubmit()" class="btn btn-dark px-3 text-uppercase"><small>reset password</small></button>
    </div>
</div>

<script>
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
        document.querySelectorAll("input").forEach((el) => el.classList.remove("is-invalid"));
    }
    async function resetPasssubmit(){
        clearErrors();
        let error =false;

        let passwordInput = document.getElementById('password');
        let password = passwordInput.value.trim();

        let confirmPassInput = document.getElementById('confirm_pass');
        let confirm_pass = confirmPassInput.value.trim();

        if(password.length == '' || password.length < 6){
            document.getElementById('passwordError').innerText = "Password must be at least 6 character";
            passwordInput.classList.add("is-invalid");
            error = true
        }
        if(confirm_pass != password){
            document.getElementById('confirmPassError').innerText = "Password do not match";
            confirmPassInput.classList.add("is-invalid");
            error = true
        }
        if(!error){
            showLoader();
            let res = await axios.post("/reset-password",{
                password:password
            })
            hideLoader();
            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                setTimeout(function (){
                    window.location.href="/userLogin"
                })
            }else{
                errorToast(res.data['message']);
            }
        }

    }
</script>
