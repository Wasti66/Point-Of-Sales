<!-- Modal -->
<div class="modal fade" id="invoiceDelete" tabindex="-1" aria-labelledby="invoiceDelete" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4 class="poppins-medium fw-semibold text-warning">Delete!</h4>
        <p class="poppins-medium fw-normal">Confirm if they are going to delete the data.</p>
        <form id="deleteInvoiceForm">
          <input id="deleteId" class="d-none">
        </form>
      </div>
      <div class="modal-footer">
        <button id="closeInvoice" type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
        <button onclick="InvoiceDelete()" class="btn btn-sm btn-danger px-3">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
  async function InvoiceDelete(){
      let id = document.getElementById('deleteId').value;
      showLoader();
      let res = await axios.post("/invoice-delete",{
        'inv_id':id
      });
      hideLoader();
      document.getElementById('closeInvoice').click();
      document.getElementById('deleteInvoiceForm').reset();
      await getInvoiceList();
  }
</script>
