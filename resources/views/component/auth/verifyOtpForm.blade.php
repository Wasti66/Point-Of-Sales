<div>
    <!-- opt code -->
    <div class="mb-4">
        <label for="otp" class="poppins-medium fw-normal">4 digit OTP here</label>
        <input type="text" name="otp" id="otp" class="form-control border border-secondary custom-input poppins-medium" placeholder="OTP">
        <small id="otpError" class="text-danger"></small>
    </div>
    <!-- forget and login button -->
    <div class="mb-4">
        <button onclick="verifyOtp()" class="btn btn-dark px-3 text-uppercase"><small>verify otp</small></button>
    </div>
</div>

<script>
    async function verifyOtp(){
        let otp = document.getElementById('otp').value.trim();
        if(!otp || otp.length != 4){
            errorToast('Invalid OTP');
        }else{
            showLoader();
            let res = await axios.post("/verify-otp",{
                otp:otp,
                email:sessionStorage.getItem('email')
            })
            hideLoader();

            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message'])
                sessionStorage.clear();
                setTimeout(function (){
                    window.location.href="/resetPassword"
                }, 1000)
            }else{
                errorToast(res.data['message']);
            }

        }
    }
</script>
