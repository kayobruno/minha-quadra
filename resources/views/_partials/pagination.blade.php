<div class="card-body">
  <div class="row">
    <div class="col-lg-6">
      <div class="demo-inline-spacing">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $paginator->url(1) }}"><i class="tf-icon bx bx-chevrons-left"></i></a>
            </li>
            <li class="page-item {{ !$paginator->previousPageUrl() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="tf-icon bx bx-chevron-left"></i></a>
            </li>

            @for ($page = max(1, $paginator->currentPage() - 5); $page <= min($paginator->lastPage(), $paginator->currentPage() + 4); $page++)
              <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
              </li>
            @endfor

            <li class="page-item {{ !$paginator->nextPageUrl() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="tf-icon bx bx-chevron-right"></i></a>
            </li>
            <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}">
              <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}"><i class="tf-icon bx bx-chevrons-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
