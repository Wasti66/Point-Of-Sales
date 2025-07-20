<section class="mt-4 mb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body shadow-sm">
                    <!-- category table list -->
                    <div class="table-responsive">
                        <table class="table" id="InvoiceData">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Vat</th>
                                    <th>Payable</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="InvoiceList">

                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>

<script>
    getInvoiceList()
    async function getInvoiceList(){
        showLoader();
        let res = await axios.get("/invoice-select");
        hideLoader();

        let InvoiceData = $("#InvoiceData");
        let InvoiceList = $("#InvoiceList");

        InvoiceData.DataTable().destroy();
        InvoiceList.empty();

        res.data.forEach(function(item,index){
            let row = `
                        <tr>
                            <td class="oppins-medium fw-normal text-sm">${index + 1}</td>    
                            <td class="oppins-medium fw-normal text-sm">${item['customer']['name']}</td>
                            <td class="oppins-medium fw-normal text-sm">${item['customer']['phone']}</td>  
                            <td class="oppins-medium fw-normal text-sm">${item['total']}</td> 
                            <td class="oppins-medium fw-normal text-sm">${item['discount']}</td>
                            <td class="oppins-medium fw-normal text-sm">${item['vat']}</td>
                            <td class="oppins-medium fw-normal text-sm">${item['payable']}</td> 
                            <td>
                                <button data-id="${item.id}" data-cus="${item['customer']['id']}" class="viewBtn btn btn-sm btn-outline-success"><i class="fa-regular fa-eye"></i></button>
                               <button data-id="${item.id}" data-cus="${item['customer']['id']}" class="deleteBtn btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </td>    
                        </tr>
                    `;
            InvoiceList.append(row);        
        })

         InvoiceData.DataTable({
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20]
        })
        $(".deleteBtn").on('click', async function(){
            let id = $(this).data('id');
            $('#invoiceDelete').modal('show');
            $('#deleteId').val(id);
        })
        $(".viewBtn").on('click', async function(){
            let id = $(this).data('id');
            let cus = $(this).data('cus');
            await InvoiceDetails(id,cus)
        })
    }
</script>