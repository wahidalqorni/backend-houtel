@extends('layouts.master')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>General Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">General</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          
          <div class="card-body">
            <h5 class="card-title">Data Hotel</h5>

            <form method="POST" action="{{ url('update-hotel') }}" enctype="multipart/form-data">
                {{-- laravel memerlukan code akses untuk mengirim data menggunakan method post --}}
                @csrf 
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Hotel</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_hotel" class="form-control" value="{{ $data->nama_hotel }}" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Kota</label>
                  <div class="col-sm-10">
                    <select name="kota_id" class="form-control" id="" required>
                      <option value="">--Pilih--</option>
                      @foreach ($kota as $kt)
                          <option value="{{ $kt->id }}" {{ $kt->id == $data->kota_id ? 'selected' : '' }} >{{ $kt->nama_kota }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Harga / Malam</label>
                  <div class="col-sm-10">
                    <input type="number" name="harga" class="form-control" value="{{ $data->harga }}" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Rating</label>
                  <div class="col-sm-10">
                    <input type="text" name="rating" class="form-control" value="{{ $data->rating }}" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Gambar</label>
                  <div class="col-sm-10">
                    <input type="file" name="gambar" class="form-control">
                    <img src="{{ asset('storage/' . $data->gambar ) }}" width="250" srcset="">
                  </div>
                </div>
               
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Publish</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="publish" aria-label="Default select example">
                      <option value="Ya" {{ $data->publish == 'Ya' ? 'selected' : '' }} >Ya</option>
                      <option value="Tidak" {{ $data->publish == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Submit Button</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
          </div>
        </div>


      </div>


    </div>
  </section>

</main><!-- End #main -->
@endsection