<!-- Modal -->
<div class="modal fade" id="customerDelete" tabindex="-1" aria-labelledby="customerDelete" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="poppins-medium fw-semibold text-warning">Delete!</h4>
        <p class="poppins-medium fw-normal">Confirm if they are going to delete the data.</p>
        <form id="deleteCustomerForm">
          <input id="deleteId" class="d-none">
        </form>
      </div>
      <div class="modal-footer">
        <button id="closeCustomer" type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
        <button onclick="categoryDelete()" class="btn btn-sm btn-danger px-3">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
  async function categoryDelete(){
      let id = document.getElementById('deleteId').value;
      showLoader();
      let res = await axios.post("/customer-delete", {
        'id':id
      })
      hideLoader();
      if(res.status === 200 && res.data['status'] === 'success'){
          successToast(res.data['message']);
          document.getElementById('closeCustomer').click();
          document.getElementById('deleteCustomerForm').reset();
          await customersList();
      }else{
        errorToast(res.data['message']);
      }
  } 
</script>