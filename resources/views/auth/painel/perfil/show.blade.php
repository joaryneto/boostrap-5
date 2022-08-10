<div class="page-content">
  <div class="col-md-12 col-lg-12 pt-md-0 pt-4">
    <div class="card pmd-card">
        <!-- Card body -->
        <div class="card-body text-center">
            <div class="pmd-card-icon">
                <div class="pmd-floating-icon-wrapper">
                @if(auth()->user()->foto != null)
                    <img src="{{ asset('assets/img/perfil/'.auth()->user()->cpf.'/'.auth()->user()->cpf.'.jpg') }}" class="rounded-circle" alt="" width="100">
                @else
                    <img src="{{ asset('assets/img/logo.jpg') }}" class="rounded-circle" alt="" width="100">
                @endif
                <i class="material-icons pmd-icon-circle pmd-floating-icon-br">done</i>
                </div>
            </div>
            <h3 class="card-title">{{auth()->user()->name}}</h3>
            <p class="card-subtitle mb-2">Lider</p>
            <p class="card-text">E disse-lhes: Ide por todo omundo, pregai o evangelho a toda criatura. Marcos 16:15.</p>
        </div>
        <!-- Card Footer -->
        <!--<ul class="list-inline pmd-list-inline pmd-list-fill border-top">
            <li class="list-inline-item">
                <h3 class="pmd-list-title">12.8k</h3>
                <p class="pmd-list-subtitle">Followers</p>
            </li>
            <li class="list-inline-item">
                <h3 class="pmd-list-title">15k</h3>
                <p class="pmd-list-subtitle">Likes</p>
            </li>
            <li class="list-inline-item">
                <h3 class="pmd-list-title">13k</h3>
                <p class="pmd-list-subtitle">Share</p>
            </li>
        </ul>-->
        <div class="pmd-card-actions">
            <span>
                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">share</i></button>
                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">thumb_up</i></button>
                <button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">drafts</i></button>
            </span>
        </div>
    </div>
</div>
</div>