@extends('layouts.master')

@section('content')
    
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Pesanan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Info Kurir</h3>
            </div>
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="http://localhost:8000/adminlte/dist/img/user2-160x160.jpg"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{$driver[0]->name}}</h3>

              <ul class="list-group list-group-unbordered mb-3">
                
                <li class="list-group-item">
                  <b>No. Hp</b> <a class="float-right">{{$driver[0]->nomor_hp}}</a>
                </li>
                <li class="list-group-item">
                  <b>Plat Nomor </b> <a class="float-right">B 2342 CK</a>
                </li>
              </ul>

              <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Rincian Pesanan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             <strong><i class="fa fa-barcode mr-1"></i> No. Pesanan </strong>

              <p class="text-muted">
                    {{$order[0]->kode_order}}
              </p>
              <hr>
              {{-- <strong><i class="fa fa-book mr-1"></i> Jenis Tilang </strong>

              <p class="text-muted">
                motor/mobil
              </p>
              <hr> --}}

              <strong><i class="fa fa-calendar"></i> Waktu Pesanan</strong>

              <p class="text-muted">{{$order[0]->created_at}}</p>

              <hr>

              <hr>

              <strong><i class="fa fa-map-marker mr-1"></i> Lokasi Pengiriman</strong>

              <p class="text-muted">{{$order[0]->alamat}}</p>

              <hr>
                <strong><i class="fa fa-money mr-1"></i> Total Pembayaran</strong>

              <p class="text-muted">{{"Rp " . number_format($order[0]->biaya_kirim,2,',','.')}}</p>

              {{-- <hr>

              <strong><i class="fa fa-file-text-o mr-1"></i> Note </strong>

              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Status Order</a></li>
                <li class="nav-item"><a class="nav-link" href="#tilang" data-toggle="tab">Bukti Surat Tilang</a></li>
                <li class="nav-item"><a class="nav-link" href="#transfer" data-toggle="tab">Bukti Transfer</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <li class="time-label">
                      <span class="bg-danger">
                            {{date('d-M-Y', strtotime($order[0]->pengiriman->created_at))}}      
                      </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    @if($order[0]->status_data == 'valid')
                    <li>
                      <i class="fa fa-desktop bg-warning"></i>

                      <div class="timeline-item">
                        {{-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span> --}}

                        <h3 class="timeline-header"><a href="#">Admin</a></h3>

                        <div class="timeline-body">
                           Data telah divalidasi, silahkan melakukan pembayaran
                        </div>
                        
                      </div>
                    </li>
                    @endif

                    @if($order[0]->status_pembayaran == 'paid')
                    <li>
                      <i class="fa fa-desktop bg-warning"></i>

                      <div class="timeline-item">
                        {{-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span> --}}

                        <h3 class="timeline-header"><a href="#">Admin</a></h3>

                        <div class="timeline-body">
                           Pembayaran Telah diterima, menunggu pencarian kurir
                        </div>
                        
                      </div>
                    </li>
                    @endif
                   
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    @if($order[0]->pengiriman->diambil == 'ok')
                    <li>
                      <i class="fa fa-motorcycle bg-primary"></i>

                      <div class="timeline-item">
                        {{-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span> --}}

                        <h3 class="timeline-header"><a href="#">Kurir </a></h3>

                        <div class="timeline-body">
                                Sedang Menuju Kejaksaaan
                      </div>
                    </li>
                    @endif
                    @if($order[0]->pengiriman->antri == 'ok')
                    <li>
                      <i class="fa fa-motorcycle bg-primary"></i>

                      <div class="timeline-item">
                        {{-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span> --}}

                        <h3 class="timeline-header"><a href="#">Kurir </a></h3>

                        <div class="timeline-body">
                                Sedang antri di Kejakasaan
                      </div>
                    </li>
                    @endif
                    @if($order[0]->pengiriman->diantar == 'ok')
                    <li>
                      <i class="fa fa-motorcycle bg-primary"></i>

                      <div class="timeline-item">
                        {{-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span> --}}

                        <h3 class="timeline-header"><a href="#">Kurir </a></h3>

                        <div class="timeline-body">
                                Sedang menuju alamat penerima
                      </div>
                    </li>
                    @endif
                    @if($order[0]->pengiriman->diterima == 'ok')
                    <li>
                      <i class="fa fa-check bg-success"></i>

                      <div class="timeline-item">
                        {{-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span> --}}

                        <h3 class="timeline-header"><a href="#">Admin</a></h3>

                        <div class="timeline-body">
                                Order selesai, sudah diterima oleh {{$order[0]->pengiriman->nama_penerima}}
                      </div>
                    </li>
                    @endif
                    
                    
                   
                    <li>
                      <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                  </ul>
          
                  
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tilang">
                        <div class="form-group">                                
                                @if (!empty($order[0]->foto))            
                                    <img class="img-fluid pad" src="{{ asset('uploads/foto_surat/' . $order[0]->foto) }}" alt="Photo">
                               @endif
                        </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="transfer">
                        <div class="form-group">                                
                                @if (!empty($order[0]->foto_transfer))            
                                    <img class="img-fluid pad" src="{{ asset('uploads/foto_transfer/' . $order[0]->foto_transfer) }}" alt="Photo">
                               @endif
                        </div>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection