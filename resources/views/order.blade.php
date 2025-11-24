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
        <div class="row" style="margin-top: 120px">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card bordered card-form" style="padding: 30px 40px">
              <h4 class="text-center">Form Order</h4>
              <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                Name : {{ auth()->user()->name }}
              </div>
              <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                Email : {{ auth()->user()->email }}
              </div>
              <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                Duration : {{ $travelPackage->duration }}
              </div>
              <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                Harga :
                <span class="text-gray-500 font-weight-light">
                  {{ __('Rp.').number_format($travelPackage->price,2,',','.') }}
                </span>
              </div>
             <button id="pay-button" class="btn btn-book btn-block mt-3">Pay!</button>
             <a onClick="return confirm('Apakah anda sudah membayar ?')" class="btn btn-book btn-block mt-3" href="https://api.whatsapp.com/send?phone=6285767113554&text= Saya mau pesan paket travel {{ $travelPackage->name }} berikut bukti pembayaran saya ! " target="_blank">
               Continue to Book
             </a>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection

@push('style-alt')
@endpush

@push('script-alt')

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-0jpVCx1MQsfDIxeT"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snap_token }}');
        // customer will be redirected after completing payment pop-up
      });
    </script>

@endpush
