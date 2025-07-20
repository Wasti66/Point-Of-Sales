@extends('layout.sideNav')
@section('title','Sale')
@section('contant')
    <section class="my-4">
        <div class="container-fluid">
            <div class="row g-2">
                <!-- belling -->  
                <div class="col-md-4">
                   <div class="card card-body rounded-3 h-100 shadow-sm border-0">
                     <div class="row">
                        <!-- -->
                        <div class="col-8">
                            <h6 class="text-uppercase text-sm fw-bold">billed to</h6>
                            <p class="mb-0 text-xs text-secondary">Name : <span id="cName"></span></p>
                            <p class="mb-0 text-xs text-secondary">Email : <span id="cEmail"></span></p>
                            <p class="mb-0 text-xs text-secondary">User ID : <span id="cId"></span></p>
                        </div>
                        <!-- -->
                        <div class="col-4 text-end">
                            <img src="{{ url('images/logo-2.png') }}" width="50px" class="mb-1" alt="logo-2.png">
                            <h6 class="mb-1">Invoice</h6>
                            <p class="mb-0 text-xs text-secondary mb-0">Date : {{ date("y-m-d") }}</p>
                        </div>
                     </div>
                     <hr class="text-secondary">
                     <!-- -->
                     <div class="row">
                        <div class="col-12 p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                       <tr class="text-xs">
                                          <th class="text-secondary">Name</th>
                                          <th class="text-secondary">Qty</th>
                                          <th class="text-secondary">Total</th>
                                          <th class="text-secondary">Remove</th>
                                       </tr>
                                    </thead>
                                    <tbody id="invoiceList">
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                     <hr class="text-secondary">
                     <!-- -->
                     <h6 class="text-uppercase text-xs fw-bold">total: $ <span id="total"></span></h6>
                     <h6 class="text-uppercase text-xs fw-bold">payable: $ <span id="payable"></span></h6>
                     <h6 class="text-uppercase text-xs fw-bold">vat(5%): $ <span id="vat"></span></h6>
                     <h6 class="text-uppercase text-xs fw-bold">discount: $ <span id="discount"></span></h6>
                     <div>
                        <label for="discountP" class="text-xs text-secondary">discount(%)</label><br>
                        <input onkeydown="return false" type="number" value="0" min="0" step="0.50" id="discountP" class="form-control form-control-sm border border-black-50 custom-input poppins-medium mb-2 w-50" onchange="DiscountChange()">
                        <button onclick="InvoiceCreate()" class="btn btn-sm btn-dark px-3 text-uppercase">
                        <small>Confirm</small>
                     </button>
                     </div>
                   </div> 
                </div>
                <!-- product -->
                <div class="col-md-4">
                   <div class="card card-body rounded-3 h-100 shadow-sm border-0">
                      <div class="table-responsive">
                        <table class="table" id="productTable">
                           <thead>
                              <tr class="text-sm">
                                 <th class="text-secondary fw-bold">Product</th>
                                 <th class="text-secondary fw-bold">Pick</th>
                              </tr>
                           </thead>
                           <!-- -->
                           <tbody id="productList">
                              
                           </tbody>
                        </table>
                      </div>
                   </div> 
                </div>
                <!-- customer -->
                <div class="col-md-4">
                   <div class="card card-body rounded-3 h-100 shadow-sm border-0">
                      <div class="table-responsive">
                        <table class="table" id="CustomerTable">
                           <thead>
                              <tr class="text-sm">
                                 <th class="text-secondary fw-bold">Customer</th>
                                 <th class="text-secondary fw-bold">Pick</th>
                              </tr>
                           </thead>
                           <!-- -->
                           <tbody id="CustomerList">
                              
                           </tbody>
                        </table>
                      </div>
                   </div> 
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
   <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-scrollable">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5">Add Product</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- product id -->
               <div class="mb-3">
                  <label for="PId" class="poppins-medium fw-normal text-sm">Product Id</label>
                  <input type="text" id="PId" class="form-control border border-black-50 custom-input poppins-medium">
                  <small id="errorId" class="text-danger"></small>
               </div>
               <!-- product name -->
               <div class="mb-3">
                  <label for="PName" class="poppins-medium fw-normal text-sm">Product Name</label>
                  <input type="text" id="PName" class="form-control border border-black-50 custom-input poppins-medium">
                  <small id="errorName" class="text-danger"></small>
               </div>
               <!-- product price -->
               <div class="mb-3">
                  <label for="PPrice" class="poppins-medium fw-normal text-sm">Product Price</label>
                  <input type="text" id="PPrice" class="form-control border border-black-50 custom-input poppins-medium">
                  <small id="errorPrice" class="text-danger"></small>
               </div>
               <!-- product Qty -->
               <div class="mb-3">
                  <label for="PQty" class="poppins-medium fw-normal text-sm">Product Qty</label>
                  <input type="text" id="PQty" class="form-control border border-black-50 custom-input poppins-medium">
                  <small id="errorQty" class="text-danger"></small>
               </div>
            </div>
            <div class="modal-footer">
               <button id="closeData" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</</button>
               <button onclick="add()" class="btn btn-sm btn-dark px-3 text-uppercase">save</button>
            </div>
         </div>
      </div>
   </div>

     <script>

         (async ()=>{
            showLoader();
            await  getCustomer();
            await getProduct();
            hideLoader();
        })()

         let invoiceItemList = [];
         
         
         function ShowInvoiceItem(){
            let invoiceList = $('#invoiceList');
            invoiceList.empty();
            invoiceItemList.forEach(function(item,index){
               let row =  `<tr class="text-xs">
                              <td>
                                 <p class="text-secondary">${item.product_name}</p>   
                              </td>
                              <td>
                                 <p class="text-secondary">${item.qty}</p>
                              </td>
                              <td>
                                 <p class="text-secondary">${item.sale_price}</p>
                              </td>
                              <td>
                                 <a data-index="${index}" class="text-xs btn btn-sm border-0 shadow remove">Remove</a>
                              </td>
                           </tr>`;
               invoiceList.append(row);            
            })
            CalculateGrandTotal()
            $('.remove').on('click', async function(){
               let index = $(this).data('index');
               removeItem(index)
            })   

         }

         function removeItem(index){
            invoiceItemList.splice(index,1)
            ShowInvoiceItem()
         }
         function DiscountChange(){
            CalculateGrandTotal()
         }
         function CalculateGrandTotal(){
            let Total=0;
            let Payable = 0;
            let Vat = 0;
            let Discount = 0;
            let discountPercentage = (parseFloat(document.getElementById('discountP').value));
            
            invoiceItemList.forEach((item,index)=>{
               Total = Total+parseFloat(item.sale_price);
            })
            if(discountPercentage===0){
               Vat = ((Total*5)/100).toFixed(2);
            }else{
               Discount = (Total*discountPercentage)/100;
               Total = (Total - (Total*discountPercentage)/100).toFixed(2);
               Vat = ((Total*5)/100).toFixed(2);
            }
            Payable = (parseFloat(Total) + parseFloat(Vat)).toFixed(2);

            document.getElementById('total').innerText = Total;
            document.getElementById('payable').innerText = Payable;
            document.getElementById('vat').innerText = Vat;
            document.getElementById('discount').innerText = Discount;

         }
         function clearErrors() {
            document.querySelectorAll("small.text-danger").forEach((el) => (el.innerText = ""));
         }
         function add(){
            let error = false;
            clearErrors();

            let PId = document.getElementById('PId').value.trim();
            let PName = document.getElementById('PName').value.trim();
            let PPrice = document.getElementById('PPrice').value;
            let PQty = document.getElementById('PQty').value.trim();

            let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);

            if(PId.length === 0){
               document.getElementById('errorId').innerText = "Id field required!";
               error = true;
            }
            if(PName.length === 0){
               document.getElementById('errorName').innerText = "Product Name field required!";
               error = true;
            }
            if(PPrice.length === 0){
               document.getElementById('errorPrice').innerText = "Price field required!";
               error = true;
            }
            if(PQty.length === 0 || !/^\d+(\.\d+)?$/.test(PQty)){
               document.getElementById('errorQty').innerText = "Quentity field only Number allowed!";
               error = true;
            }
            if(!error){
               let item = {
                  product_id:PId,
                  product_name:PName,
                  sale_price:PTotalPrice,
                  qty:PQty 
               };
               invoiceItemList.push(item);
               $("#create-modal").modal("hide");
               //console.log(invoiceItemList);
               //document.getElementById('saveData').reset();
               ShowInvoiceItem()
               
            }

         }

         function addModal(id,name,price){
            document.getElementById('PId').value = id;
            document.getElementById('PName').value = name;
            document.getElementById('PPrice').value = price;
            $("#create-modal").modal('show')
         }

         //getProduct()
         async function getProduct(){
            let res = await axios.get("/product-list");
            let productTable = $('#productTable');
            let productList = $('#productList');

            productTable.DataTable().destroy();
            productList.empty();

            res.data.forEach(function(item,index){
               let row = `
                           <tr>
                                <td class="d-flex align-items-center border-0 p-1 mt-2">
                                  <img src="${item.img_url}" height="15px" width="25px" alt=""> 
                                  <p class="text-secondary text-xs ms-2 mb-0">${item.name} ($${item.price})</p>
                                </td>
                                <td class="border-0 text-end p-1 mt-2">
                                   <button data-name="${item.name}" data-price="${item.price}" data-id="${item.id}" class="btn text-xs fw-bold btn-outline-dark text-uppercase addProdct" data-bs-toggle="modal" data-bs-target="#create-modal"style="padding: 0px 4px;">
                                      <small>Add</small>
                                   </button>
                                </td>
                              </tr>
                        `;
               productList.append(row);         
            })

            $(".addProdct").on('click', async function(){
               let PId = $(this).data('id');
               let PName = $(this).data('name');
               let PPrice = $(this).data('price');
               addModal(PId,PName,PPrice)
            })

            new DataTable('#productTable',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });

         }
         //getCustomer()
         async function getCustomer(){
            let res = await axios.get("/customers-list");
            
            let CustomerTable = $("#CustomerTable");
            let CustomerList = $("#CustomerList");

            CustomerTable.DataTable().destroy();
            CustomerList.empty();

            res.data.forEach(function(item, index){
                  let row = `
                           <tr>
                                <td class="d-flex align-items-center border-0 text-secondary text-xs p-1 mt-2">
                                  <i class="fa-regular fa-user"></i>
                                  <p class=" ms-2 mb-0">${item.name}</p>
                                </td>
                                <td class="border-0 text-end p-1 mt-2">
                                   <button data-name="${item.name}" data-email="${item.email}" data-id="${item.id}" class="addCustomer btn text-xs fw-bold btn-outline-dark text-uppercase" style="padding: 0px 5px;">
                                    <small>Add</small>
                                  </button>
                                </td>
                              </tr>
                        `;
                  CustomerList.append(row);               
            })

            $(".addCustomer").on('click', async function(){
               let cName = $(this).data('name');
               let cEmail = $(this).data('email');
               let cId = $(this).data('id');

               $("#cName").text(cName);
               $("#cEmail").text(cEmail);
               $("#cId").text(cId);
            })
            new DataTable('#CustomerTable',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });

         }

         async function InvoiceCreate(){
            let cId = document.getElementById('cId').innerText;
            let total = document.getElementById('total').innerText;
            let discount = document.getElementById('discount').innerText;
            let vat = document.getElementById('vat').innerText;
            let payable = document.getElementById('payable').innerText;

            let Data = {
               "customer_id":cId,
               "total":total,
               "discount":discount,
               "vat":vat,
               "payable":payable,
               "products":invoiceItemList
            }
            if(cId.length===0){
               errorToast('Customer Required');
            }else if(invoiceItemList.length===0){
               errorToast('Product Required');
            }else{
               try{
                  showLoader();
                  let res = await axios.post("/invoice-create",Data)
                  hideLoader();
                  if(res.status === 200 && res.data['status'] === 'success'){
                     successToast(res.data['message']);
                     setTimeout(function (){
                           window.location.href="/invoice"
                     },1000)
                  }else{
                     errorToast('Something went wrong!');
                  }
               }catch(error){
                  hideLoader();
                  if(error.response){
                     if(error.response.status === 401){
                           errorToast(error.response.data['message']);
                     }else{
                           errorToast("Server error: " + response.status);
                     }
                  }else{
                     errorToast("Network or unknown error occurred");
                  }
               }
               
            }

         }

     </script> 
@endsection