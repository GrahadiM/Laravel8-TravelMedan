@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="text-danger mb-4">
                        <i class="fa fa-times-circle fa-5x"></i>
                    </div>
                    <h3 class="text-danger">Pembayaran Gagal</h3>
                    <p class="text-muted">Maaf, pembayaran Anda gagal. Silakan coba lagi.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
