@extends('layouts.master')
@section('content')
    
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1>Pesan Kurir</h1> --}}
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Blank Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Pesan Kurir</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form Pesan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('SubmitOrder') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Penerima</label>
                  <input id="penerima" type="text" class="form-control @error('penerima') is-invalid @enderror" name="penerima" value="{{ old('penerima') }}" required autocomplete="penerima" autofocus> </div>
                <div class="form-group">
                  <label>Alamat</label>
                  {{-- <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat"> --}}
                  <textarea class="form-control" rows="4" @error('alamat') is-invalid @enderror" name="alamat" required autocomplete="alamat"></textarea>
                </div>
                <div class="form-group">
                  <label>No HP</label>
                  <input id="nomor_hp" type="number" class="form-control @error('nomor_hp') is-invalid @enderror" name="nomor_hp" value="{{ old('nomor_hp') }}" required autocomplete="nomor_hp">
                </div>               
                <div class="form-group">
                  <label for="">Foto Surat Tilang</label>
                  <input type="file" name="photo" class="form-control">
                  <p class="text-danger">{{ $errors->first('photo') }}</p>
              </div>
              </div>
              <!-- /.card-body -->

              
        
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Footer
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>
@endsection