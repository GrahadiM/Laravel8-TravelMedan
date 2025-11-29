@extends('layouts.app')

@section('content')
    <main>
        <section class="container mt-5" style="margin-bottom: 70px">
            <div class="col-12 col-md">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="title-alt" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item main-color">Form Order</li>
                    </ol>
                </nav>
            </div>
        </section>

        <!--=============== Package Travel ===============-->
        <section class="container detail">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card bordered card-form" style="padding: 30px 40px">
                        <h4 class="text-center">Form Order</h4>

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Name:</strong> {{ auth()->user()->name }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Email:</strong> {{ auth()->user()->email }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Paket Travel:</strong> {{ $travelPackage->name }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Duration:</strong> {{ $travelPackage->duration }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Harga:</strong>
                            <span class="text-gray-500 font-weight-light">
                                {{ 'Rp ' . number_format($travelPackage->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Order ID:</strong> {{ $transaction->order_id }}
                        </div>

                        <button id="pay-button" class="btn btn-primary btn-lg btn-block mt-3">
                            <i class="fa fa-credit-card"></i> Bayar Sekarang
                        </button>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Pilih metode pembayaran yang tersedia
                            </small>
                        </div>

                        <div class="mt-4">
                            <h6>Metode Pembayaran yang Tersedia:</h6>
                            <div class="row">
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-success">Credit Card</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-info">GoPay</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-warning">ShopeePay</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-primary">Bank Transfer</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-secondary">Alfamart/Indomaret</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('script-alt')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function() {
            // Show loading state
            const button = this;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses...';
            button.disabled = true;

            // Trigger snap popup
            window.snap.pay('{{ $snap_token }}', {
                onSuccess: function(result) {
                    console.log('success');
                    console.log(result);
                    // Redirect to success page
                    window.location.href = '{{ route("payment.success") }}';
                },
                onPending: function(result) {
                    console.log('pending');
                    console.log(result);
                    // Redirect to pending page
                    window.location.href = '{{ route("payment.pending-page") }}';
                },
                onError: function(result) {
                    console.log('error');
                    console.log(result);
                    // Redirect to error page
                    window.location.href = '{{ route("payment.failed") }}';
                },
                onClose: function() {
                    // Reset button if user closes the popup
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            });
        });
    </script>
@endpush
