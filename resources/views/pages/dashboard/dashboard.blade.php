@extends('layout.sideNav')
@section('title','dashboard')
@section('contant')
    <section class="my-4">
        <div class="container">
            <div class="row g-3">
                <h4 class="fw-semibold mb-4">Welcome to 
                    <span id="firstName"></span>
                    <span id="lastName"></span>
                </h4>
                <!-- product -->
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                         <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium" id="product"></h5>
                                <p class="mb-0 text-sm poppins-medium">Product</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-store fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- category -->
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                         <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium" id="categroy"></h5>
                                <p class="mb-0 text-sm poppins-medium">Category</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-list fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- customer -->
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                         <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium" id="customer"></h5>
                                <p class="mb-0 text-sm poppins-medium">Customer</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-users fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- invoice -->
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                         <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium" id="invoice"></h5>
                                <p class="mb-0 text-sm poppins-medium">Invoice</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-file-invoice fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- total sale -->
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                         <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium">$ <span id="total"></span></h5>
                                <p class="mb-0 text-sm poppins-medium">Total Sale</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-dollar-sign fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- vat collection -->
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                         <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium">$ <span id="vat"></span></h5>
                                <p class="mb-0 text-sm poppins-medium">Vat Collection</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-elevator fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- total collection -->
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                         <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium">$ <span id="payable"></span></h5>
                                <p class="mb-0 text-sm poppins-medium">Total Collection</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-dollar-sign fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        (async ()=>{
            showLoader();
            await  userGetName();
            await getList();
            hideLoader();
        })()

        userGetName();
        async function userGetName(){
            let res = await axios.get("/user-profile")
            document.getElementById('firstName').innerText = res.data['data']['firstName'];
            document.getElementById('lastName').innerText = res.data['data']['lastName'];
        }

        getList()
        async function getList(){
            let res = await axios.get("/summary")
            document.getElementById('product').innerText = res.data['product'];
            document.getElementById('categroy').innerText = res.data['category'];
            document.getElementById('customer').innerText = res.data['customer'];
            document.getElementById('invoice').innerText = res.data['invoice'];
            document.getElementById('total').innerText = parseInt(res.data['total']).toFixed(0);
            document.getElementById('vat').innerText = parseInt(res.data['vat']).toFixed(0);
            document.getElementById('payable').innerText = parseInt(res.data['payable']).toFixed(0);
        }
    </script>
@endsection