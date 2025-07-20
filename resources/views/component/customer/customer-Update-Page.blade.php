<!-- Modal -->
<div class="modal fade" id="customerUpdate" tabindex="-1" aria-labelledby="customerUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Update Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateCustomerForm">
            <input id="updateId" class="d-none">
            <!-- name -->
            <div class="mb-4">
                <label for="updateName" class="poppins-medium fw-normal">Name</label>
                <input type="text" id="updateName" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="category">
                <small id="updateErrorName" class="text-danger"></small>
            </div>
            <!-- email -->
            <div class="mb-4">
                <label for="updateEmail" class="poppins-medium fw-normal">Email</label>
                <input type="text" id="updateEmail" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Email">
                <small id="updateErrorEmail" class="text-danger"></small>
            </div>
            <!-- phone -->
            <div class="mb-4">
                <label for="updatephone" class="poppins-medium fw-normal">Phone</label>
                <input type="text" id="updatephone" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Phone">
                <small id="updateErrorphone" class="text-danger"></small>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="updatecloseData" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</</button>
        <button onclick="updatecategory()" class="btn btn-sm btn-dark px-3 text-uppercase">save</button>
      </div>
    </div>
  </div>
</div>

<script>
    async function FillupUpdateForm(id){
        document.getElementById('updateId').value = id;
        showLoader();
        let res = await axios.post("/customer-by-id",{
            'id':id
        }) 
        hideLoader();
        document.getElementById('updateName').value = res.data['name'];
        document.getElementById('updateEmail').value = res.data['email'];
        document.getElementById('updatephone').value = res.data['phone'];
    }
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
    }
   async function updatecategory(){
        clearErrors();
        let error = false;

        let name = document.getElementById('updateName').value.trim();
        let email = document.getElementById('updateEmail').value.trim();
        let phone = document.getElementById('updatephone').value.trim();
        let id = document.getElementById('updateId').value;

        if(name.length === 0){
            document.getElementById('updateErrorName').innerText = "Name field required";
            error = true;
        }
        if(!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
            document.getElementById('updateErrorEmail').innerText = "valid email required";
            error = true;
        }
        if(!phone || !/^\d{11}$/.test(phone)){
            document.getElementById('updateErrorphone').innerText = "Phone must be 11 digits.";
            error = true;
        }
        if(!error){
            showLoader();
            let res = await axios.post("/customer-update", {
                'name':name,
                'email':email,
                'phone':phone,
                'id':id
            })
            hideLoader();
            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                document.getElementById('updatecloseData').click();
                document.getElementById('updateCustomerForm').reset();
                await customersList(); 
            }else{
                errorToast("Request failed");
            }
        }
    }
</script>