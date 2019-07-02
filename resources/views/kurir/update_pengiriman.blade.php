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
      <h3 class="card-title">Update Progress Pengiriman</h3>

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
              <h3 class="card-title">Form Update</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('UpdateStatusPengiriman',$pengiriman->id) }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  {{-- <label>Kode Order</label> --}}
                  <input id="id" type="hidden" readonly value="{{ $pengiriman->id }}" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" autocomplete="id" > 
                </div>
                <div class="form-group">
                  <label>Kode Order</label>
                  <input id="penerima" type="text" readonly value="{{ $pengiriman->order_id }}" class="form-control @error('penerima') is-invalid @enderror" name="penerima" value="{{ old('penerima') }}" required autocomplete="penerima" > 
                </div>
                @if($pengiriman->diambil =='ok')    
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="diambil" checked="checked" value="ok" disabled="">
                    <input type="hidden" id="diambil" name="diambil" value="ok" />
                    <label class="form-check-label">Diambil</label>
                  </div>
                </div>                
                @else
                <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="diambil" value="ok">
                      <label class="form-check-label">Diambil</label>
                    </div>
                 </div>
                 @endif
                 
                 @if($pengiriman->antri =='ok')    
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="antri" checked="checked" value="ok" disabled="">
                      <input type="hidden" id="antri" name="antri" value="ok" />
                      <label class="form-check-label">Antri</label>
                    </div>
                  </div>
                  @else
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="antri" value="ok">
                      <label class="form-check-label">Antri</label>
                    </div>
                 </div>
                 @endif
                 @if($pengiriman->diantar =='ok')    
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="diantar" checked="checked" value="ok" disabled="">
                      <input type="hidden" id="diantar" name="diantar" value="ok" />
                      <label class="form-check-label">Diantar</label>
                    </div>
                  </div>
                  @else
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="diantar" value="ok">
                      <label class="form-check-label">Diantar</label>
                    </div>
                 </div>
                 @endif
                 @if($pengiriman->diterima =='ok')
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="diterima" checked="checked" value="ok" disabled="">
                      <input type="hidden" id="diterima" name="diterima" value="ok" />
                      <label class="form-check-label">Diterima</label>
                    </div> 
                  </div>
                  @else
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="diterima" value="ok">
                      <label class="form-check-label">Diterima</label>
                    </div>
                 </div> 
                 @endif                
                  <div class="form-group">
                    <label>Nama Penerima</label>
                    <input id="nama_penerima" value="{{ $pengiriman->nama_penerima }}" type="text" class="form-control @error('nama_penerima') is-invalid @enderror" name="nama_penerima" value="{{ old('nama_penerima') }}" autocomplete="nama_penerima" > 
                  </div>
                
                {{-- <div class="form-group">
                    <label for="">Bukti Transfer</label>
                    <input type="file" name="foto_transfer" class="form-control">
                    <p class="text-danger">{{ $errors->first('foto_transfer') }}</p>
                </div> --}}
               
                
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Progress Pengiriman</button>
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