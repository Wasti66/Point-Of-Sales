<section id="about" class="pt-5 pb-5">
    <div class="container">
        <div class="text-center">
            <h5 class="text-info mb-3">POS Feature</h5>
            <h2 class="text-center fw-bold fs-2">Available features</h2>
        </div>
        <div class="row mt-5">
            @foreach ($features as $feature)
                <div class="col-md-4 mb-4">
                    <div class="bg-light rounded shadow-md px-3 py-3 h-100">
                        <h3 class="fw-semibold fs-4 mb-3">{{ $feature['title'] }}</h3>
                        <p>{{ $feature['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
