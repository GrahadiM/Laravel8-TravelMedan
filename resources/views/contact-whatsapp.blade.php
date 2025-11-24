@extends('layouts.app')

@section('content')
    <section
        class="hero"
        id="hero"
        style="
          background-repeat: no-repeat;
          background-size: cover;
          height: 50vh;
          background-image: url('https://media.istockphoto.com/photos/tropical-beach-with-boats-and-blue-ocean-in-tropical-island-picture-id1068291116?b=1&k=20&m=1068291116&s=170667a&w=0&h=9Bsc3HJkFdNRr0ESpdMeAlfSVLX68mVrz3UY-Ye0p0s=');
        "
      >
        <div class="hero-content h-100 d-flex justify-content-center align-items-center flex-column">
            <h1 class="text-center text-white display-4">Kontak Kami</h1>
            <p class="text-white">Kami membutuhkan feedback anda untuk pelayanan yang lebih baik</p>
            <hr width="40" class="text-center" />
        </div>
    </section>

    <main class="container mb-5 position-relative" style="margin-top: -180px;z-index: 2;">
        <div class="row justify-content-center"> 
            <div class="col-lg-8"> 
                <div class="card p-4">

                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="sendwa" method="GET" action="{{ route('getWhatsapp') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea name="message" class="form-control" rows="5" id="message"></textarea>
                        </div>
                        
                        {{-- <a onClick="return confirm('Apakah anda ingin mengirimnya?')" class="btn btn-contact" target="_blank" 
                        href="https://api.whatsapp.com/send?phone=6285767113554&text=Nama%20:%20Hadoy%0AEmail%20:%20admin@test.com%0APesan%20:%20Pesannya?">
                            Kirim
                        </a> --}}
                        <button type="submit" class="btn btn-contact" id="btn-wa" onClick="return confirm('Apakah anda ingin mengirim pesan ini?')" >Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript">
    $("#btn-wa").click(function(){
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var pesan = document.getElementById('pesan').value;
        var win = window.open('https://api.whatsapp.com/send?phone=085767113554&text=Nama%20:%20'+name+'%0AEmail%20:%20'+email+'%0APesan%20:%20'+pesan);
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Please allow popups for this website');
        }
    return false;
    });
    </script> --}}
@endsection