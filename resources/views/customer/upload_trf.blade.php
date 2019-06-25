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
      <h3 class="card-title">Validasi Admin</h3>

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
              <h3 class="card-title">Form Validasi</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('SubmitFotoTransfer',$order->id) }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Kode Order</label>
                  <input id="kode_order" type="text" readonly value="{{ $order->kode_order }}" class="form-control @error('kode_order') is-invalid @enderror" name="kode_order" value="{{ old('kode_order') }}" required autocomplete="kode_order" > 
                </div>
                <div class="form-group">
                  <label>Nama Penerima</label>
                  <input id="penerima" type="text" readonly value="{{ $order->penerima }}" class="form-control @error('penerima') is-invalid @enderror" name="penerima" value="{{ old('penerima') }}" required autocomplete="penerima" > 
                </div>
                <div class="form-group">
                  <label>Alamat Penerima</label>
                  {{-- <input id="alamat" type="text" readonly value="{{ $order->alamat }}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat"> --}}
                  <textarea class="form-control" rows="3" placeholder="Enter ..." disabled="">{{$order->alamat}}</textarea>
                </div>
                <div class="form-group">
                  <label>No HP</label>
                  <input id="nomor_hp" type="number" readonly value="{{ $order->nomor_hp }}" class="form-control @error('nomor_hp') is-invalid @enderror" name="nomor_hp" value="{{ old('nomor_hp') }}" required autocomplete="nomor_hp">
                </div>
                
                <div class="form-group">
                        <label>Ongkos Kirim</label>
                  <input id="biaya_kirim" type="number" readonly value="{{ $order->biaya_kirim }}" class="form-control @error('biaya_kirim') is-invalid @enderror" name="biaya_kirim"  required autocomplete="penerima" > 
                </div>  

                <div class="form-group">
                    <label for="">Bukti Transfer</label>
                    <input type="file" name="foto_transfer" class="form-control">
                    <p class="text-danger">{{ $errors->first('foto_transfer') }}</p>
                </div>
               
                
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Upload Bukti Transfer</button>
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