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
                        <div class="card-header">
                            <a href="{{ url('add-hotel') }}" class="btn btn-primary">Add</a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Data Hotel</h5>
                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Hotel</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Kota</th>
                                        <th scope="col">Status Publish</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- variabel $data => dapat dari controller yg di compact --}}
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $dt->nama_hotel }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $dt->gambar) }}" width="350" srcset="">   
                                            </td>
                                            <td>{{ $dt->alamat }}</td>
                                            <td>{{ $dt->nama_kota }}</td>
                                            <td>{{ $dt->publish }}</td>
                                            <td>
                                              <a href="{{ url('edit-hotel') }}/{{ $dt->id }} " class="btn btn-sm btn-success">Edit</a>
                                              <a onclick="return confirm('Yakin hapus data?')" href="{{ url('delete-hotel') }}/{{ $dt->id }} " class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                        </div>
                    </div>


                </div>


            </div>
        </section>

    </main><!-- End #main -->
@endsection
