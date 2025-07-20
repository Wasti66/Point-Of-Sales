<!-- Modal -->
<div class="modal fade" id="InvoiceDetails" tabindex="-1" aria-labelledby="InvoiceDetails" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div id="invoice" class="modal-body">
            <div class="row">
                <!-- -->
                <div class="col-8">
                    <h6 class="text-uppercase text-sm fw-bold">billed to</h6>
                    <p class="mb-0 text-secondary">Name : <span id="cName"></span></p>
                    <p class="mb-0 text-secondary">Email : <span id="cEmail"></span></p>
                    <p class="mb-0 text-secondary">Phone : <span id="cPhone"></span></p>
                    <p class="mb-0 text-secondary">User ID : <span id="cId"></span></p>
                </div>
                <!-- -->
                <div class="col-4 text-end">
                    <img src="{{ url('images/logo-2.png') }}" width="80px" class="mb-1" alt="logo-2.png">
                    <h5 class="mb-1">Invoice</h5>
                    <p class="mb-0 text-secondary mb-0">Date : {{ date("Y-m-d") }}</p>
                </div>
            </div>
            <hr class="text-secondary">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="text-xs">
                            <th class="text-secondary">Name</th>
                            <th class="text-secondary">Qty</th>
                            <th class="text-secondary">Price</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceList">
                        
                    </tbody>
                </table>
            </div>
            <hr class="text-secondary">
            <!-- -->
            <h6 class="text-uppercase text-sm fw-semibold">total: $ <span id="total"></span></h6>
            <h6 class="text-uppercase text-sm fw-semibold">payable: $ <span id="payable"></span></h6>
            <h6 class="text-uppercase text-sm fw-semibold">vat(5%): $ <span id="vat"></span></h6>
            <h6 class="text-uppercase text-sm fw-semibold">discount: $ <span id="discount"></span></h6>
      </div>
      <div class="modal-footer">
        <button id="closeData" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</</button>
        <button onclick="InvoicePrint()" class="btn btn-sm btn-dark px-3 text-uppercase">Print</button>
      </div>
    </div>
  </div>
</div>

<script>
    
    async function InvoiceDetails(inv_id,cus_id){
        showLoader();
        let res = await axios.post("/invoice-details",{
            'inv_id':inv_id,
            'cus_id':cus_id
        })
        hideLoader();
        document.getElementById('cName').innerText = res.data['customer']['name'];
        document.getElementById('cId').innerText = res.data['customer']['id'];
        document.getElementById('cEmail').innerText = res.data['customer']['email']; 
        document.getElementById('cPhone').innerText = res.data['customer']['phone']; 
        document.getElementById('total').innerText = res.data['invoice']['total']; 
        document.getElementById('payable').innerText = res.data['invoice']['payable']; 
        document.getElementById('vat').innerText = res.data['invoice']['vat']; 
        document.getElementById('discount').innerText = res.data['invoice']['discount'];
        
        let invoiceList=$('#invoiceList');

        invoiceList.empty();

        res.data['product'].forEach(function (item,index) {
            let row=`<tr class="text-xs">
                        <td>${item['product']['name']}</td>
                        <td>${item['qty']}</td>
                        <td>${item['sale_price']}</td>
                     </tr>`
            invoiceList.append(row)
        });
        $('#InvoiceDetails').modal('show')
        
    }

    function InvoicePrint(){
        let printContents = document.getElementById('invoice').innerHTML;
        let originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        setTimeout(function() {
            location.reload();
        }, 1000);
    }
</script>
