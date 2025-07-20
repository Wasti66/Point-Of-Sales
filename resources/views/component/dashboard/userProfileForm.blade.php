<div class="row g-4">
    <!-- profile images --> 
    <div style="margin-top:-50px">
      <img src="{{ url('images/profile-image/profile.png') }}" alt="profile-image" id="profileImage" height="120px" width="120px" class="rounded-circle object-fit-cover border">  
      <input type="file" id="imageInput" class="d-none">
    </div>
    <!-- update email --> 
    <div class="col-md-6">
        <div>
            <label for="email" class="poppins-medium fw-normal"><small>Email</small></label>
            <input type="text" name="email" id="email" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="Email" disabled>
            <small id="errorCurrentPass" class="text-danger"></small>
        </div>
    </div>
    <!-- update firstName -->
    <div class="col-md-6">
        <div>
            <label for="firstName" class="poppins-medium fw-normal"><small>First Name</small></label>
            <input type="text" name="firstName" id="firstName" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="First Name">
            <small id="errorCurrentPass" class="text-danger"></small>
        </div>
    </div>
    <!-- update lastname -->
    <div class="col-md-6">
        <div>
            <label for="lastName" class="poppins-medium fw-normal"><small>Last Name</small></label>
            <input type="text" name="lastName" id="lastName" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="Last Name">
            <small id="errorCurrentPass" class="text-danger"></small>
        </div>
    </div>
    <!-- update userName -->
    <div class="col-md-6">
        <div>
            <label for="userName" class="poppins-medium fw-normal"><small>user Name</small></label>
            <input type="text" name="userName" id="userName" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="user Name">
            <small id="errorCurrentPass" class="text-danger"></small>
        </div>
    </div>
    <!-- phone -->
    <div>
        <label for="phone" class="poppins-medium fw-normal"><small>Phone</small></label>
        <input type="text" name="phone" id="phone" class="form-control form-control-sm border border-black-50 custom-input poppins-medium" placeholder="phone">
        <small id="errorCurrentPass" class="text-danger"></small>
   </div>
   <div>
     <button onclick="updateUserProfile()" class="btn btn-sm btn-dark px-3 text-uppercase"><small>save</small></button>
   </div>
</div>
<script>
    getProfile()
    async function getProfile(){
        showLoader();
        let res = await axios.get("/user-profile")
        hideLoader();
        if(res.status === 200 && res.data['status'] === "success"){
            let data = res.data['data'];

            let fields = ['email', 'firstName', 'lastName', 'userName', 'phone'];

            fields.forEach(field => {
                if (document.getElementById(field)) {
                    document.getElementById(field).value = data[field] || '';
                }
            });
        }else{
            errorToast(res.data['message']);
        }
    }
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
        document.querySelectorAll("input").forEach((el) => el.classList.remove("is-invalid"));
    }
    async function updateUserProfile(){
        let firstName = document.getElementById('firstName').value.trim();
        let lastName = document.getElementById('lastName').value.trim();
        let userName = document.getElementById('userName').value.trim();
        let phone = document.getElementById('phone').value.trim();
        
        if(firstName.length === 0){
            errorToast('First Name field required');
        }else if(lastName.length === 0){
            errorToast('Last Name field required');
        }else if(userName.length === 0){
            errorToast('User Name field required');
        }else if(phone.length === 0){
            errorToast('Phone field required');
        }else{
            showLoader();
            let res = await axios.post("/update-profile",{
                firstName:firstName,
                lastName:lastName,
                userName:userName,
                phone:phone
            })
            hideLoader();
            if(res.status === 200 && res.data['status'] === "success"){
                successToast(res.data['message']);
                setTimeout(function (){
                    window.location.href="/userProfile"
                }, 2000)
            }else{
                errorToast(res.data['message']);
            }
        }
    }
    
</script>
