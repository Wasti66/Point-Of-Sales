<!-- Modal -->
<div class="modal fade" id="productCreate" tabindex="-1" aria-labelledby="productCreate" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Add your Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- product form -->
        <form id="saveData">
            <!-- Category -->
            <div class="mb-3">
                <label for="productCategory" class="poppins-medium fw-normal">Category</label>
                <select id="productCategory" class="form-control border border-black-50 custom-input poppins-medium">
                    <option value="">Select category</option>
                </select>
                <small id="errorCategory" class="text-danger"></small>
            </div>
            <!-- name -->
            <div class="mb-3">
                <label for="name" class="poppins-medium fw-normal">Name</label>
                <input type="text" id="name" class="form-control border border-black-50 custom-input poppins-medium">
                <small id="errorName" class="text-danger"></small>
            </div>
            <!-- price -->
            <div class="mb-3">
                <label for="price" class="poppins-medium fw-normal">Price</label>
                <input type="text" id="price" class="form-control border border-black-50 custom-input poppins-medium">
                <small id="errorPrice" class="text-danger"></small>
            </div>
            <!-- unit -->
            <div class="mb-3">
                <label for="unit" class="poppins-medium fw-normal">Unit</label>
                <input type="text" id="unit" class="form-control border border-black-50 custom-input poppins-medium">
                <small id="errorUnit" class="text-danger"></small>
            </div>
            <!-- images -->
            <div class="mb-3">
                <img src="{{ url('images/default.jpg') }}" id="newImg" height="120" width="120" alt="default-image">
                <br>
                <label for="images" class="poppins-medium fw-normal">Image</label>
                <input type="file" id="images" class="form-control border border-black-50 custom-input poppins-medium" oninput="newImg.src=window.URL.createObjectURL(this.files[0])">
                <small id="errorImages" class="text-danger"></small>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="closeData" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</</button>
        <button onclick="addProduct()" class="btn btn-sm btn-dark px-3 text-uppercase">save</button>
      </div>
    </div>
  </div>
</div>

<script>
    fillCategoryDropdown();
    async function fillCategoryDropdown(){
        let res = await axios.get("/categories-list");
        res.data.forEach(function(item, i){
            let options = `<option value="${item.id}">${item.name}</option>`;
            $('#productCategory').append(options);  
        })
    }
</script>

<script>
    function clearErrors() {
        document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
    }
    async function addProduct(){
        let error = false;
        clearErrors();
        let productCategory = document.getElementById('productCategory').value.trim();
        let name = document.getElementById('name').value.trim();
        let price = document.getElementById('price').value.trim();
        let unit = document.getElementById('unit').value.trim();
        let images = document.getElementById('images').files[0];

        
        if(productCategory.length === 0){
            document.getElementById('errorCategory').innerText = "category Name field required";
            error = true;
        }
        
        if(name.length === 0){
            document.getElementById('errorName').innerText = "category Name field required";
            error = true;
        }
        if(price.length === 0){
            document.getElementById('errorPrice').innerText = "Price field required";
            error = true;
        }
        if(unit.length === 0){
            document.getElementById('errorUnit').innerText = "Unit field required";
            error = true;
        }
        if(!images){
            document.getElementById('errorImages').innerText = "Image field required";
            error = true;
        }
        if(!error){
            document.getElementById('closeData').click();
            let formData = new FormData();
            formData.append('img',images);
            formData.append('name',name);
            formData.append('price',price);
            formData.append('unit',unit);
            formData.append('category_id',productCategory);

           const config = {
                headers: {
                    'content-type':'multipart/form-data'
                }
            }
            showLoader();
            let res  = await axios.post("/product-create",formData,config);
            hideLoader();
            if(res.status === 200 && res.data['status'] === 'success'){
                successToast(res.data['message']);
                document.getElementById('saveData').reset();
                await productList()
            }else{
                errorToast(res.data['message']);
            }
        }

    }
</script>
