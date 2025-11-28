@extends('layout.sideNav')
@section('title','Todays Vs Yesterdays Report')
@section('contant')
   <div class="container my-5">
    <div class="card shadow-sm p-4">
        <h4 class="fw-semibold mb-4">📊 Today vs Yesterday Sales</h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 text-center">
                    <h6>Today's Sale</h6>
                    <h3 class="text-success fw-bold">${{ $todaySales }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 text-center">
                    <h6>Yesterday's Sale</h6>
                    <h3 class="text-primary fw-bold">${{ $yesterdaySales }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3 text-center">
                    <h6>Change</h6>
                    @if($changePercent >= 0)
                        <h3 class="text-success fw-bold">📈 {{ $changePercent }}% Increase</h3>
                    @else
                        <h3 class="text-danger fw-bold">📉 {{ abs($changePercent) }}% Decrease</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ✅ Chart Area -->
    <div class="mt-5">
        <canvas id="salesComparisonChart" height="400"></canvas>
    </div>
</div>
<script>
(async () => {
    // 🔹 Step 1: API থেকে ডাটা নেওয়া
    const res = await axios.get("/api/sales-today-yesterday");
    const data = res.data;

    const today = data.today || 0;
    const yesterday = data.yesterday || 0;

    // 🔹 Step 2: পার্থক্য হিসাব
    let change = 0;
    let status = "";
    if (yesterday > 0) {
        change = (((today - yesterday) / yesterday) * 100).toFixed(2);
    }

    // 🔹 Step 3: UI তে ডাটা বসানো
    document.getElementById("todaySale").innerText = today.toLocaleString();
    document.getElementById("yesterdaySale").innerText = yesterday.toLocaleString();

    const changePercent = document.getElementById("changePercent");
    const changeText = document.getElementById("changeText");

    if (change > 0) {
        changePercent.innerHTML = `▲ ${change}%`;
        changePercent.classList.add("text-success");
        changeText.innerText = "Increase 📈";
    } else if (change < 0) {
        changePercent.innerHTML = `▼ ${Math.abs(change)}%`;
        changePercent.classList.add("text-danger");
        changeText.innerText = "Decrease 📉";
    } else {
        changePercent.innerHTML = `0%`;
        changePercent.classList.add("text-muted");
        changeText.innerText = "No Change";
    }

    // 🔹 Step 4: Chart.js Visualization
    const ctx = document.getElementById("salesComparisonChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Yesterday", "Today"],
            datasets: [{
                label: "Sales (৳)",
                data: [yesterday, today],
                backgroundColor: ["#FF6384", "#36A2EB"],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
})();
</script>
@endsection