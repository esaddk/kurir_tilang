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
          <h3 class="card-title">Laporan Kambing Masuk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Id Kambing</th>
              <th>Suntik Vaksin</th>
              <th>Obat Cacing</th>                            
              <th>Cukur</th>
              <th>Berat</th>
              <th>Foto</th>
              <th>Tanggal Masuk</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Laporan_kambing_masuk as $row)
            <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->kambing_id }}</td>
              <td>{{ $row->suntik_vaksin }}</td>
              <td>{{ $row->obat_cacing }}</td>
              <td>{{ $row->cukur }}</td>
              <td>{{ $row->berat }}</td>
              <td>{{ $row->photo }}</td>
              <td>{{ $row->created_at }}</td>
              
              <td>
                    {{-- <form action="{{ route('produk.destroy', $row->id) }}" method="POST"> --}}
                    <form action="#" method="post">
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="_method" value="DELETE">                        
                        <a href="{{ route('LaporanKambingMasuk', [$row->id]) }}" 
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        @can('isAdmin')
                        <a href="{{ route('LaporanKambingMasuk', [$row->id]) }}" 
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
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
                    <th>Id</th>
                    <th>Id Kambing</th>
                    <th>Suntik Vaksin</th>
                    <th>Obat Cacing</th>              
                    <th>Cukur</th>
                    <th>Berat</th>
                    <th>Foto</th>
                    <th>Tanggal Masuk</th>
                    <th></th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

</section>

@endsection