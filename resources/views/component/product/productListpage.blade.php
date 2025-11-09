<section class="mt-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-body shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="poppins-medium fw-semibold">Product</h4>
                        <button data-bs-toggle="modal" data-bs-target="#productCreate" class="btn btn-sm btn-dark px-3 text-uppercase"><small>Create</small></button>
                    </div>
                    <hr>
                    <!-- product table list -->
                    <div class="table-responsive">
                        <table class="table" id="tableData">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Images</th>
                                    <th>Name</th>
                                    <th>price</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableList">

                            </tbody>
                        </table>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    productList()
    async function productList(){
        showLoader();
        let res = await axios.get("/product-list");
        hideLoader();

        let tableData = $('#tableData');
        let tableList = $('#tableList');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                    <td class="poppins-medium fw-normal">${index+ 1}</td>
                    <td>
                        <img src="${item.img_url}" height="30px" width="30px">
                    </td>
                    <td class="poppins-medium fw-normal">${item.name}</td>
                    <td class="poppins-medium fw-normal">${item.price}</td>
                    <td class="poppins-medium fw-normal">${item.unit}</td>
                    <td class="poppins-medium fw-normal">${item.quantity}</td>
                    <td>
                       <button data-path="${item.img_url}" data-id="${item.id}" class="editBtn btn btn-sm btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></button>
                       <button data-path="${item.img_url}" data-id="${item.id}" class="deleteBtn btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button> 
                    </td>
                </tr>`;
                tableList.append(row);
        });

        //edit btn
        $('.editBtn').on('click', async function(){
            let id = $(this).data('id');
            let path = $(this).data('path');
            await fillExgestingData(id,path);
            $('#productUpdate').modal('show');
        })
        //delete btn
        $('.deleteBtn').on('click', function(){
            let id = $(this).data('id');
            let path = $(this).data('path');
            $('#productDelete').modal('show');
            $('#deleteId').val(id);
            $('#deleteFilePath').val(path);
        })

        tableData.DataTable({
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20]
        })
    }
</script>