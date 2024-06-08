<nav class="navbar navbar-expand-lg bg-dark shadow" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('transactions.index')) active @endif" href="{{ route('transactions.index') }}">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('products.index')) active @endif" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('products.types.index')) active @endif" href="{{ route('products.types.index') }}">Products Types</a>
                </li>
            </ul>
        </div>
    </div>
</nav>