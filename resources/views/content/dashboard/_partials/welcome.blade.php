<div class="card">
  <div class="d-flex align-items-end row">
    <div class="col-sm-7">
      <div class="card-body">
        <h5 class="card-title text-primary">Olá {{ auth()->user()->name }}! 🎉</h5>
        <p class="mb-4">"Não são os tempos fáceis que moldam um homem, mas sim a maneira como ele lida com as dificuldades." - Aragorn</p>
      </div>
    </div>
    <div class="col-sm-5 text-center text-sm-left">
      <div class="card-body pb-0 px-0 px-md-4">
        <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
      </div>
    </div>
  </div>
</div>
