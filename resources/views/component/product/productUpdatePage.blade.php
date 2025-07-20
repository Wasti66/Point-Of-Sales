<!-- Modal -->
<div class="modal fade" id="productUpdate" tabindex="-1" aria-labelledby="productUpdate" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Update Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- product form -->
        <form id="updateProductrForm">
            <input type="text" id="id" class="d-none">
            <input type="text" id="imagePath" class="d-none">
            <!-- Category -->
            <div class="mb-3">
                <label for="UpdateProductCategory" class="poppins-medium fw-normal">Category</label>
                <select id="UpdateProductCategory" class="form-control border border-black-50 custom-input poppins-medium">
                    <option value="">Select category</option>
                </select>
                <small id="errorCategory" class="text-danger"></small>
            </div>
            <!-- name -->
            <div class="mb-3">
                <label for="updateName" class="poppins-medium fw-normal">Name</label>
                <input type="text" id="updateName" class="form-control border border-black-50 custom-input poppins-medium">
                <small id="errorName" class="text-danger"></small>
            </div>
            <!-- price -->
            <div class="mb-3">
                <label for="updatePrice" class="poppins-medium fw-normal">Price</label>
                <input type="text" id="updatePrice" class="form-control border border-black-50 custom-input poppins-medium">
                <small id="errorPrice" class="text-danger"></small>
            </div>
            <!-- unit -->
            <div class="mb-3">
                <label for="updateUnit" class="poppins-medium fw-normal">Unit</label>
                <input type="text" id="updateUnit" class="form-control border border-black-50 custom-input poppins-medium">
                <small id="errorUnit" class="text-danger"></small>
            </div>
            <!-- images -->
            <div class="mb-3">
                <img src="{{ url('images/default.jpg') }}" id="oldImage" height="120" width="120" alt="default-image">
                <br>
                <label for="updateImages" class="poppins-medium fw-normal">Image</label>
                <input type="file" id="updateImages" class="form-control border border-black-50 custom-input poppins-medium" oninput="oldImage.src=window.URL.createObjectURL(this.files[0])">
                <small id="errorImages" class="text-danger"></small>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="UpdatecloseData" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</</button>
        <button onclick="updateProduct()" class="btn btn-sm btn-dark px-3 text-uppercase">save</button>
      </div>
    </div>
  </div>
</div>

<script>
    async function upDatefillCategoryDropdown(){
        let res = await axios.get("/categories-list");
        res.data.forEach(function(item, i){
            let options = `<option value="${item.id}">${item.name}</option>`;
            $('#UpdateProductCategory').append(options);  
        })
    }
</script>

<script>
    async function fillExgestingData(id, path){

        document.getElementById('id').value = id;
        document.getElementById('imagePath').value = path;
        document.getElementById('oldImage').src = path;

        showLoader();
        await upDatefillCategoryDropdown();
        let res = await axios.post("/product-by-id",{
            'id':id
        })
        hideLoader();

        document.getElementById('updateName').value = res.data['name'];
        document.getElementById('updatePrice').value = res.data['price'];
        document.getElementById('updateUnit').value = res.data['unit'];
        document.getElementById('UpdateProductCategory').value = res.data['category_id'];
    }
</script>

<script>
    async function updateProduct(){
        let name = document.getElementById('updateName').value.trim();
        let category = document.getElementById('UpdateProductCategory').value.trim();
        let price = document.getElementById('updatePrice').value.trim();
        let unit = document.getElementById('updateUnit').value.trim();
        let image = document.getElementById('updateImages').files[0];

        let id = document.getElementById('id').value;
        let imagePath = document.getElementById('imagePath').value;

        document.getElementById('UpdatecloseData').click();
        let formData = new FormData();
        formData.append('name',name);
        formData.append('price',price);
        formData.append('unit',unit);
        formData.append('category_id',category);
        formData.append('img',image);
        formData.append('id',id);
        formData.append('file_path',imagePath);

        const config = {
                headers: {
                    'content-type':'multipart/form-data'
                }
            }
        showLoader();
        let res = await axios.post("/product-update",formData,config);
        hideLoader();

        if(res.status === 200 && res.data['status'] === 'success'){
            successToast(res.data['message']);
            document.getElementById('updateProductrForm').reset();
            await productList();
        }else{
            errorToast("Request failed");
        }

    }
</script>
