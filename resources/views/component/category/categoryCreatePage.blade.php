<!-- Modal -->
<div class="modal fade" id="createList" tabindex="-1" aria-labelledby="createList" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Add your Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- category form -->
        <form id="saveData">
            <div class="mb-4">
                <label for="name" class="poppins-medium fw-normal">category</label>
                <input type="text" id="name" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Add category">
                <small id="errorName" class="text-danger"></small>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="closeData" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</</button>
        <button onclick="addcategory()" class="btn btn-sm btn-dark px-3 text-uppercase">save</button>
      </div>
    </div>
  </div>
</div>

<script>
    async function addcategory(){
        let error = false;
        let name = document.getElementById('name').value.trim();
        if(name.length === 0){
            document.getElementById('errorName').innerText = "Category name field required";
            error = true;
        }
        if(!error){
            showLoader();
            let res = await axios.post("/create-category", {
                'name':name
            })
            hideLoader();
            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                document.getElementById('closeData').click();
                document.getElementById('saveData').reset();
                await getList();
            }else{
               error(res.data['message']); 
            }
        }
    }
</script>