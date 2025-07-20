<div>
    <div class="row g-2">
        <!-- firstname -->
        <div class="col-md-6">
            <div class="mb-4">
                <label for="firstName" class="poppins-medium fw-normal">First Name</label>
                <input type="text" name="firstName" id="firstName" class="form-control border border-secondary custom-input" placeholder="First Name">
                <small id="errorFirstName" class="text-danger"></small>
            </div>
        </div>
        <!-- last name -->
        <div class="col-md-6">
            <div class="mb-4">
                <label for="lastName" class="poppins-medium fw-normal">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="form-control border border-secondary custom-input" placeholder="Last Name">
                <small id="errorLastName" class="text-danger"></small>
            </div>
        </div>
    </div>
    <!-- user name -->
    <div class="mb-4">
        <label for="userName" class="poppins-medium fw-normal">User Name</label>
        <input type="text" name="userName" id="userName" class="form-control border border-secondary custom-input" placeholder="User name">
        <small id="errorUserName" class="text-danger"></small>
    </div>
    <!-- email -->
    <div class="mb-4">
        <label for="email" class="poppins-medium fw-normal">Email</label>
        <input type="text" name="email" id="email" class="form-control border border-secondary custom-input" placeholder="Email">
        <small id="errorEmail" class="text-danger"></small>
    </div>
    <!-- phone -->
    <div class="mb-4">
        <label for="phone" class="poppins-medium fw-normal">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control border border-secondary custom-input" placeholder="phone">
        <small id="errorPhone" class="text-danger"></small>
    </div>
    <!-- password -->
    <div class="mb-4">
        <label for="password" class="poppins-medium fw-normal">Password</label>
        <input type="password" name="password" id="password" class="form-control border border-secondary custom-input" placeholder="Password">
        <small id="errorPass" class="text-danger"></small>
    </div>
    <!-- confirm password -->
    <div class="mb-4">
        <label for="confirm_pass" class="poppins-medium fw-normal">Confirm Password</label>
        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control border border-secondary custom-input" placeholder="Confirm Password">
        <small id="errorConfirmPass" class="text-danger"></small>
    </div>
    <!-- login and register button -->
    <div class="mb-4 text-end">
        <a href="{{url('/userLogin')}}" class="link-dark me-2"><small>Already registered?</small></a>
        <button onclick="SubmitRegister()" class="btn btn-dark px-3 text-uppercase"><small>register</small></button>
    </div>
</div>

<script>
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
        document.querySelectorAll("input").forEach((el) => el.classList.remove("is-invalid"));
    }
    async function SubmitRegister(){
        clearErrors();
        let error =false;

        let firstNameInput = document.getElementById('firstName');
        let firstName = firstNameInput.value.trim();
        
        let lastNameInput = document.getElementById('lastName');
        let lastName = lastNameInput.value.trim();

        let userNameInput = document.getElementById('userName');
        let userName = userNameInput.value.trim();
        
        let emailInput = document.getElementById('email');
        let email = emailInput.value.trim();

        let phoneInput = document.getElementById('phone');
        let phone = phoneInput.value.trim();

        let passwordInput = document.getElementById('password');    
        let password = passwordInput.value.trim();

        let confirmPassInput = document.getElementById('confirm_pass');
        let confirm_pass = confirmPassInput.value.trim();

        if(!firstName || firstName.length < 3 || firstName.length > 32){
            document.getElementById('errorFirstName').innerText = "First Name must be between 3 and 32 characters.";
            firstNameInput.classList.add("is-invalid");
            error = true;
        }
        if(!lastName || lastName.length < 3 || lastName.length > 32){
            document.getElementById('errorLastName').innerText = "Last Name must be between 3 and 32 characters.";
            lastNameInput.classList.add("is-invalid");
            error = true;
        }
        if(!userName || userName.length < 3 || userName.length > 16){
            document.getElementById('errorUserName').innerText = "User Name must be between 3 and 16 characters.";
            userNameInput.classList.add("is-invalid");
            error = true;
        }
        if(!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById('errorEmail').innerText = "valid email required";
            emailInput.classList.add("is-invalid");
            error = true;
        }
        if(!phone || !/^\d{11}$/.test(phone)){
            document.getElementById('errorPhone').innerText = "Phone must be 11 digits.";
            phoneInput.classList.add("is-invalid");
            error = true;
        }
        if(!password || password.length < 6 || password.length > 16){
            document.getElementById('errorPass').innerText = "Password must be at least 6 characters.";
            passwordInput.classList.add("is-invalid");
            error = true;
        }
        if(confirm_pass != password){
            document.getElementById('errorConfirmPass').innerText = "Passwords do not match..";
            confirmPassInput.classList.add("is-invalid");
            error = true;
        }

        if(!error){
            try{

                showLoader();
                let res = await axios.post("/user-registration",{
                    firstName:firstName,
                    lastName:lastName,
                    userName:userName,
                    email:email,
                    phone:phone,
                    password:password
                })
                hideLoader();
                if(res.status === 200 && res.data['status'] === 'success'){
                    successToast(res.data['message'])
                    setTimeout(function (){
                        window.location.href="/userLogin"
                    },2000)
                }

            }catch(error){
                hideLoader();
                if(error.response){
                    if(error.response.status === 401){
                        errorToast(error.response.data['message']);
                    }
                }else{
                    errorToast('Network error');
                }
            }
            
        }


    }
</script>