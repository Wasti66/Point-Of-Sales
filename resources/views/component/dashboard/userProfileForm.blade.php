<div class="row g-4">
    <!--<input type="" id="file_path" name="file_path" value="">-->
    <!-- profile images --> 
    <div style="margin-top:-50px">
      <img src="{{ url($user->images ?? 'images/profile-image/profile.png') }}"
        data-current-image="{{ $user->images ?? 'images/profile-image/profile.png' }}"
        alt="profile-image"
        id="profileImage"
        height="120px" width="120px"
        class="rounded-circle object-fit-cover border">
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

            // Set image src if available
            if (document.getElementById('profileImage')) {
                document.getElementById('profileImage').src = data['images'] || "{{ url('images/profile-image/profile.png') }}";
            }

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

        let imageFile = document.getElementById('imageInput').files[0];
        let currentImagePath = document.getElementById('profileImage').getAttribute('data-current-image');
        //let filePath = document.getElementById('file_path').value;
        
        if(firstName.length === 0){
            errorToast('First Name field required');
        }else if(lastName.length === 0){
            errorToast('Last Name field required');
        }else if(userName.length === 0){
            errorToast('User Name field required');
        }else if(phone.length === 0){
            errorToast('Phone field required');
        }else{
            let formData = new FormData();
            formData.append('firstName', firstName);
            formData.append('lastName', lastName);
            formData.append('userName', userName);
            formData.append('phone', phone);
            if (imageFile) {
                formData.append('img', imageFile);
                formData.append('file_path', currentImagePath); // send old image path
            }

            showLoader();
            try {
                let res = await axios.post("/update-profile", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                hideLoader();

                if (res.status === 200 && res.data.status === "success") {
                    successToast(res.data.message);
                    await getProfile(); // Reload updated profile
                } else {
                    errorToast(res.data.message);
                }
            } catch (err) {
                hideLoader();
                errorToast("Something went wrong");
            }
        }   
    }

    const profileImage = document.getElementById('profileImage');
    const imageInput = document.getElementById('imageInput');

    // When image is clicked, trigger file input
    profileImage.addEventListener('click', () => {
        imageInput.click();
    });

    // When file is selected, change the image source
    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            profileImage.src = e.target.result;
        }

        reader.readAsDataURL(file);
        }
    });
        
</script>
