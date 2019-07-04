@extends('layouts.master_table')
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

        <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Unpaid Orders</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kode Order</th>
              <th>Penerima</th>
              <th>Alamat</th>
              <th>Nomor HP</th>
              <th>Status Data</th>
              <th>Status Pembayaran</th>
              <th>Tanggal Request</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order as $row)
            <tr>
              <td>{{ $row->kode_order }}</td>
              <td>{{ $row->penerima }}</td>
              <td>{{ $row->alamat }}</td>
              <td>{{ $row->nomor_hp }}</td>
              <td>{{ $row->status_data }}</td>
              <td>{{ $row->status_pembayaran }}</td>
              <td>{{ $row->updated_at }}</td>
              
              <td>
                    {{-- <form action="{{ route('produk.destroy', $row->id) }}" method="POST"> --}}
                    <form action="#" method="post">
                        @csrf
                        @can('isCustomer')
                        <input type="hidden" name="_method" value="DELETE">                        
                        <a href="{{ route('GetUnpaidOrder', [$row->id]) }}" 
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        @endcan
                        @can('isAdmin')
                        <a href="{{ route('ValidateTransferOrder', [$row->id]) }}" 
                            class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i>
                        </a>
                        @endcan
                        @can('isAdmin')
                        <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                    <th>Kode Order</th>
                    <th>Penerima</th>
                    <th>Alamat</th>
                    <th>Nomor HP</th>
                    <th>Status Data</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Request</th>
                    <th></th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

</section>

@endsection