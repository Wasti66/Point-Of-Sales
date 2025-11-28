@extends('layout.sideNav')
@section('title','dashboard')
@section('contant')

<div id="lowStockAlert"></div>

<section class="my-4">
    <div class="container">
        <div class="row g-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-semibold mb-4">Welcome to 
                    <span id="firstName"></span>
                    <span id="lastName"></span>
                </h4>
                <p class="mb-0">{{ date('Y-m-d') }}</p>
            </div>

            {{-- Dashboard Summary Cards --}}
            @php
                $cards = [
                    ['id'=>'product','icon'=>'fa-store','label'=>'Product','value'=>$product],
                    ['id'=>'category','icon'=>'fa-list','label'=>'Category','value'=>$category],
                    ['id'=>'customer','icon'=>'fa-users','label'=>'Customer','value'=>$customer],
                    ['id'=>'invoice','icon'=>'fa-file-invoice','label'=>'Invoice','value'=>$invoice],
                    ['id'=>'total','icon'=>'fa-dollar-sign','label'=>'Total Sale','value'=>number_format($total,2)],
                    ['id'=>'vat','icon'=>'fa-elevator','label'=>'Vat Collection','value'=>number_format($vat,2)],
                    ['id'=>'payable','icon'=>'fa-dollar-sign','label'=>'Total Collection','value'=>number_format($payable,2)],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col-md-3 col-sm-6">
                    <div class="card card-body border-0 shadow-sm">
                        <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 poppins-medium">{{ $card['value'] }}</h5>
                                <p class="mb-0 text-sm poppins-medium">{{ $card['label'] }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fa-solid {{ $card['icon'] }} fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Chart Section --}}
        <div class="row mt-4 pt-5">
            <div class="col-md-8">
                <div class="card shadow-sm p-3">
                    <h6 class="fw-semibold mb-2">📊 Daily Sales (Last 30 Days)</h6>
                    <canvas id="dailySalesChart" height="120"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h6 class="fw-semibold mb-2">🧩 Sales by Category</h6>
                    <canvas id="categorySalesChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(async ()=>{
    await userGetName();
})()

async function userGetName(){
    let res = await axios.get("/user-profile")
    document.getElementById('firstName').innerText = res.data['data']['firstName'];
    document.getElementById('lastName').innerText = res.data['data']['lastName'];
}

// ================= Chart Section =================
const dailySalesData = @json($dailySales ?? []);
const categorySalesData = @json($categorySales ?? []);

// 🔹 Daily Sales Bar Chart
const dailyLabels = dailySalesData.map(item => item.date);
const dailyTotals = dailySalesData.map(item => item.total_sales);

const ctxBar = document.getElementById('dailySalesChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: dailyLabels,
        datasets: [{
            label: 'Daily Sales (৳)',
            data: dailyTotals,
            backgroundColor: ['#36A2EB','#FF6384','#FFCE56','#4BC0C0','#9966FF','#FF9F40'],
            backgroundColor: ['#36A2EB','#FF6384','#FFCE56','#4BC0C0','#9966FF','#FF9F40'],
            borderWidth: 1
        }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

// 🔹 Category-wise Pie Chart
const categoryLabels = categorySalesData.map(item => 'Category ' + item.category_id);
const categoryTotals = categorySalesData.map(item => item.total_products);

const ctxPie = document.getElementById('categorySalesChart').getContext('2d');
new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: categoryLabels,
        datasets: [{
            data: categoryTotals,
            backgroundColor: ['#36A2EB','#FF6384','#FFCE56','#4BC0C0','#9966FF','#FF9F40'],
        }]
    },
    options: { responsive: true }
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", async function () {
        try {
            let res = await axios.get("/low-stock-check");
            let data = res.data;

            const alertDiv = document.getElementById("lowStockAlert");
            alertDiv.innerHTML = "";

            if (data.count > 0) {
                let alertHTML = `
                    <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                        <strong>⚠️ Low Stock Alert!</strong> ${data.count}The product is very low in stock.
                        <ul class="mt-2 mb-0">
                            ${data.products.map(item => `
                                <li>${item.name} — <strong>${item.quantity}</strong> pcs left</li>
                            `).join('')}
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                alertDiv.innerHTML = alertHTML;
            } else {
                alertDiv.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-3" role="alert">
                        ✅ All products are in stock!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            }
        } catch (error) {
            console.error("Low stock check failed:", error);
        }
    });
</script>


@endsection
