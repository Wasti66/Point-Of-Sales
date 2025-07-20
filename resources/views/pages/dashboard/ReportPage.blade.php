@extends('layout.sideNav')
@section('title','Sale')
@section('contant')
    <section class="my-4">
        <div class="container">
            <div class="row g-3">
                <!-- sales report -->  
                <div class="col-lg-4 col-sm-6">
                   <div class="card card-body rounded-3 shadow-sm border-0">
                      <h4 class="poppins-medium fw-normal mb-4">Sales Report</h4>
                      <!-- FormDate -->  
                      <div class="mb-4">
                         <label for="FormDate" class="poppins-medium fw-normal">Form Date</label>
                         <input type="date" id="FormDate" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Form Date">
                         <small id="errorName" class="text-danger"></small>
                      </div>
                      <!-- ToDate -->  
                      <div class="mb-4">
                         <label for="ToDate" class="poppins-medium fw-normal">To Date</label>
                         <input type="date" id="ToDate" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="To Date">
                         <small id="errorName" class="text-danger"></small>
                      </div>
                      <div>
                        <button onclick="salesReport()" class="btn btn-sm btn-dark px-3 text-uppercase">Download</button>
                      </div>
                   </div> 
                </div>
                <!-- customer report -->  
                <div class="col-lg-4 col-sm-6">
                   <div class="card card-body rounded-3 shadow-sm border-0">
                      <h4 class="poppins-medium fw-normal mb-4">Customer Report</h4>
                      <!-- FormDateCustomer -->  
                      <div class="mb-4">
                         <label for="FormDateCustomer" class="poppins-medium fw-normal">Form Date</label>
                         <input type="date" id="FormDateCustomer" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Form Date">
                         <small id="errorName" class="text-danger"></small>
                      </div>
                      <!-- ToDate -->  
                      <div class="mb-4">
                         <label for="ToDateCustomer" class="poppins-medium fw-normal">To Date</label>
                         <input type="date" id="ToDateCustomer" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="To Date">
                         <small id="errorName" class="text-danger"></small>
                      </div>
                      <div>
                        <button onclick="customerReport()" class="btn btn-sm btn-dark px-3 text-uppercase">Download</button>
                      </div>
                   </div> 
                </div>
                <!-- product report -->  
                <div class="col-lg-4 col-sm-6">
                   <div class="card card-body rounded-3 shadow-sm border-0">
                      <h4 class="poppins-medium fw-normal mb-4">Product Report</h4>
                      <!-- FormDateProduct -->  
                      <div class="mb-4">
                         <label for="FormDateProduct" class="poppins-medium fw-normal">Form Date</label>
                         <input type="date" id="FormDateProduct" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="Form Date">
                         <small id="errorName" class="text-danger"></small>
                      </div>
                      <!-- ToDateProduct -->  
                      <div class="mb-4">
                         <label for="ToDateProduct" class="poppins-medium fw-normal">To Date</label>
                         <input type="date" id="ToDateProduct" class="form-control form-control border border-black-50 custom-input poppins-medium" placeholder="To Date">
                         <small id="errorName" class="text-danger"></small>
                      </div>
                      <div>
                        <button onclick="productReport()" class="btn btn-sm btn-dark px-3 text-uppercase">Download</button>
                      </div>
                   </div> 
                </div>
            </div>
        </div>
    </section>
    <script>
        function salesReport(){
            let FormDate = document.getElementById('FormDate').value;
            let ToDate = document.getElementById('ToDate').value;
            if(FormDate.length === 0 || ToDate.length === 0){
                errorToast('Date range required!');
            }else{
              window.open('/sales-report/'+FormDate+'/'+ToDate);
            }
        }
        function customerReport(){
            let FormDateCustomer = document.getElementById('FormDateCustomer').value;
            let ToDateCustomer = document.getElementById('ToDateCustomer').value;
            if(FormDateCustomer.length === 0 || ToDateCustomer.length === 0){
                errorToast('Date range required!');
            }else{
              window.open('/customers-report/'+FormDateCustomer+'/'+ToDateCustomer);
            }
        }
        function productReport(){
            let FormDateProduct = document.getElementById('FormDateProduct').value;
            let ToDateProduct = document.getElementById('ToDateProduct').value;
            if(FormDateProduct.length === 0 || ToDateProduct.length === 0){
                errorToast('Date range required!');
            }else{
              window.open('/products-report/'+FormDateProduct+'/'+ToDateProduct);
            }
        }
    </script>
@endsection