<div class="row justify-content-center g-2">
    <div class="col-auto">
        <a href="{{ $routeView }}" class="btn btn-info">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>
    </div>
    <div class="col-auto">
        <a href="{{ $routeEdit }}" class="btn btn-warning">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </div>
    <div class="col-auto">
        <form action="{{ $routeDelete }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    </div>
</div>
