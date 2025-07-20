<!-- Modal -->
<div class="modal fade" id="categoryUpdate" tabindex="-1" aria-labelledby="categoryUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Update Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updatecategoryForm">
            <input id="updateId" class="d-none">
            <div class="mb-4">
                <label for="updateName" class="poppins-medium fw-normal">Update category</label>
                <input type="text" id="updateName" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="category">
                <small id="updateErrorName" class="text-danger"></small>
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
       let res = await axios.post("/category-by-id",{
          'id':id
       }) 
       hideLoader();
       document.getElementById('updateName').value = res.data['name'];
    }
   async function updatecategory(){
        let error = false;
        let name = document.getElementById('updateName').value.trim();
        let id = document.getElementById('updateId').value;
        if(name.length === 0){
            document.getElementById('updateErrorName').innerText = "category name field required";
            error = true;
        }
        if(!error){
            showLoader();
            let res = await axios.post("/category-update", {
                'name':name,
                'id':id
            })
            hideLoader();
            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                document.getElementById('updatecloseData').click();
                document.getElementById('updatecategoryForm').reset();
                await getList();
            }else{
                errorToast("Request failed");
            }
        }
    }
</script>