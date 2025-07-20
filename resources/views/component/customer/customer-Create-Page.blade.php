<!-- Modal -->
<div class="modal fade" id="customerCreate" tabindex="-1" aria-labelledby="customerCreate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="saveData">
            <!-- name -->
            <div class="mb-4">
                <label for="name" class="poppins-medium fw-normal">Name</label>
                <input type="text" id="name" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Name">
                <small id="errorName" class="text-danger"></small>
            </div>
            <!-- email -->
            <div class="mb-4">
                <label for="email" class="poppins-medium fw-normal">Email</label>
                <input type="text" id="email" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Email">
                <small id="errorEmail" class="text-danger"></small>
            </div>
            <!-- phone -->
            <div class="mb-4">
                <label for="phone" class="poppins-medium fw-normal">Phone</label>
                <input type="text" id="phone" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Phone">
                <small id="errorPhone" class="text-danger"></small>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="closeData" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
        <button onclick="addCustomer()" class="btn btn-sm btn-dark px-3 text-uppercase">save</button>
      </div>
    </div>
  </div>
</div>

<script>
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
    }
    async function addCustomer(){
        clearErrors();
        let error = false;

        let name = document.getElementById('name').value.trim();
        let email = document.getElementById('email').value.trim();
        let phone = document.getElementById('phone').value.trim();

        if(!name || name.length < 3 || name.length > 50){
            document.getElementById('errorName').innerText = "Name must be between 3 and 50 characters.";
            error = true;
        }
        if(!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById('errorEmail').innerText = "valid email required";
            error = true;
        }
        if(!phone || !/^\d{11}$/.test(phone)){
            document.getElementById('errorPhone').innerText = "Phone must be 11 digits.";
            error = true;
        }

        if(!error){
            showLoader();
            let res = await axios.post("/customer-create",{
                'name':name,
                'email':email,
                'phone':phone
            })
            hideLoader();
            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                document.getElementById('closeData').click();
                document.getElementById('saveData').reset();
                await customersList();
            }else{
                errorToast(res.data['message']);
            }
        }

    }
</script>