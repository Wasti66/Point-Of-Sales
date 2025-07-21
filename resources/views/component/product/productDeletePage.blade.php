<!-- Modal -->
<div class="modal fade" id="productDelete" tabindex="-1" aria-labelledby="productDelete" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="poppins-medium fw-semibold text-warning">Delete!</h4>
        <p class="poppins-medium fw-normal">Confirm if they are going to delete the data.</p>
        <form id="deleteProductForm">
          <input id="deleteId" class="d-none">
          <input id="deleteFilePath" class="d-none">
        </form>
      </div>
      <div class="modal-footer">
        <button id="closeproduct" type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
        <button onclick="deleteProduct()" class="btn btn-sm btn-danger px-3">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
    async function deleteProduct(){
        let id = document.getElementById('deleteId').value;
        let file_path = document.getElementById('deleteFilePath').value;

        showLoader();
        let res = await axios.post("/product-delete",{
            'id':id,
            'file_path':file_path
        })
        hideLoader();
        if(res.status === 200 && res.data['status'] === 'success'){
          successToast(res.data['message']);
          document.getElementById('closeproduct').click();
          document.getElementById('deleteProductForm').reset();
          await productList();
      }else{
        errorToast('Something went wrong');
      }
    }
</script>

