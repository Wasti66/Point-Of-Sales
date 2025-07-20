<section>
    <div class="container">
        <div class="row justify-content-center mt-4 mb-4">
            <div class="col-12">
                <div class="card card-body shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="poppins-medium fw-semibold">category</h4>
                        <button data-bs-toggle="modal" data-bs-target="#createList" class="btn btn-sm btn-dark px-3 text-uppercase"><small>Create</small></button>
                    </div>
                    <hr>
                    <!-- category table list -->
                    <div class="table-responsive">
                        <table class="table" id="tableData">
                            <thead class="table-light">
                                <tr>
                                   <th>No</th>
                                   <th>Name</th>
                                   <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableList">
                                <!-- -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    getList()
    async function getList(){
        showLoader();
        let res = await axios.get("/categories-list");
        hideLoader();

        let tableData = $('#tableData');
        let tableList = $('#tableList');
        
        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                         <td class="poppins-medium fw-normal text-center">${index+ 1}</td>
                         <td class="poppins-medium fw-normal text-center">${item.name}</td>
                         <td class="text-center">
                            <button data-id="${item.id}" class="editBtn btn btn-sm btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button data-id="${item.id}"  class="deleteBtn btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                         </td>
                      </tr>`
            tableList.append(row);         
        });

        //category edit function
        $('.editBtn').on('click', async function(){
            let id = $(this).data('id');
            await FillupUpdateForm(id)
            $('#categoryUpdate').modal('show');
            
        })
        //category delete function
        $('.deleteBtn').on('click', function(){
            let id = $(this).data('id');
            $('#categoryDelete').modal('show');
            $('#deleteId').val(id);
        })

        tableData.DataTable({
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20]
        })
        

    }
    
</script>
