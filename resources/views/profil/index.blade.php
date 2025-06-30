@extends('layout.main')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow-lg border-left-primary">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="m-0 font-weight-bold">Profil Saya</h5>
            </div>
            <div class="card-body text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4e73df&color=fff&size=100" 
                     alt="Avatar" class="rounded-circle mb-3 shadow">
                
                <h5 class="font-weight-bold">{{ $user->name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>

                <a href="{{ route('profil.edit') }}" class="btn btn-warning mt-3">
                    <i class="fas fa-user-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
