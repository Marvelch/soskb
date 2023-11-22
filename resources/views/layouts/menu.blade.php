<div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
    <div class="row m-0">
        <a href="{{ route('home') }}" class="text-dark small col text-decoration-none p-2 {{ Route::currentRouteName() === 'home' ? 'text-success' : '' }}">
            <p class="h5 m-0"><i class="fa-brands fa-microsoft"></i></p>
            Home
        </a>
        <a disabled class="text-muted col small text-decoration-none p-2">
            <p class="h5 m-0"><i class="icofont-pie-chart"></i></p>
            Report
        </a>
        <a href="{{ route('transaction_sales_orders') }}" class="text-muted fw-bold col small text-decoration-none p-2 {{ Route::currentRouteName() === 'transaction_sales_orders' ? 'text-success' : '' }}">
            <p class="h5 m-0"><i class="icofont-bag"></i></p>
            History
        </a>
        <a href="{{ route('index_profile') }}" class="text-muted small col text-decoration-none p-2 {{ Route::currentRouteName() === 'index_profile' ? 'text-success' : '' }}">
            <p class="h5 m-0"><i class="icofont-user"></i></p>
            Account
        </a>
    </div>
</div>
