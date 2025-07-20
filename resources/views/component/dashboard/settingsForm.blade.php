<!-- current password -->
<div class="mb-4">
    <label for="current_pass" class="poppins-medium fw-normal">Current Password</label>
    <input type="password" name="current_pass" id="current_password" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="Password">
    <small id="errorCurrentPass" class="text-danger"></small>
</div>
<!-- new password -->
<div class="mb-4">
    <label for="new_password" class="poppins-medium fw-normal">New Password</label>
    <input type="password" name="new_password" id="new_password" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="Password">
    <small id="errorNewPass" class="text-danger"></small>
</div>
<!-- confirm password -->
<div class="mb-4">
    <label for="confirm_password" class="poppins-medium fw-normal">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="Password">
    <small id="errorConfirmPass" class="text-danger"></small>
</div>
<!-- forget and login button -->
<div class="mb-4">
    <button onclick="changePassword()" class="btn btn-dark px-3 text-uppercase"><small>save</small></button>
</div>
<script>
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
        document.querySelectorAll("input").forEach((el) => el.classList.remove("is-invalid"));
    }
    async function changePassword(){
        clearErrors();
        let error = false;

        let currentPassInput = document.getElementById('current_password');
        let current_password = currentPassInput.value.trim();

        let newPassInput = document.getElementById('new_password');
        let new_password = newPassInput.value.trim();

        let confirmPassInput = document.getElementById('confirm_password');
        let confirm_password = confirmPassInput.value.trim();

        if(current_password.length === 0){
            document.getElementById('errorCurrentPass').innerText = "Current password required!";
            currentPassInput.classList.add("is-invalid");
            error = true;
        }
        if(new_password.length < 6){
            document.getElementById('errorNewPass').innerText = "Password must be at least 6 characters";
            newPassInput.classList.add("is-invalid");
            error = true;
        }
        if(new_password !== confirm_password){
            document.getElementById('errorConfirmPass').innerText = "Passwords do not match";
            confirmPassInput.classList.add("is-invalid");
            error = true;
        }

        if(!error){
            showLoader();
            try {
                let res = await axios.post("/change-password", {
                    current_password: current_password,
                    new_password: new_password
                });
                hideLoader();
                if(res.status === 200 && res.data['status'] === 'success'){
                    successToast(res.data['message']);
                    setTimeout(function (){
                        window.location.href="/setting"
                    }, 1000)
                } else {
                    errorToast(res.data['message']);
                }
            } catch (err) {
                hideLoader();
                errorToast("Current Password dosen't match!");
            }
        }
    }
</script>