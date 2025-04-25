@extends('adminlte::page')

@section('title', 'Detail Tagihan UKT')

@section('content_header')
    <h1>Detail Tagihan UKT</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Tagihan #INV{{ str_pad($tagihan->id, 8, '0', STR_PAD_LEFT) }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('tagihan.dashboard') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIM</label>
                                <p>{{ $mahasiswa->nim }}</p>
                            </div>
                            <div class="form-group">
                                <label>Nama Mahasiswa</label>
                                <p>{{ $mahasiswa->nama_lengkap }}</p>
                            </div>
                            <div class="form-group">
                                <label>Program Studi</label>
                                <p>{{ $mahasiswa->kelas->programStudi->nama_prodi }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Tagihan</label>
                                <p class="text-bold">Rp {{ number_format($tagihan->nominal, 2, ',', '.') }}</p>
                            </div>
                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <p>
                                    @if ($tagihan->status == 'lunas')
                                        <span class="badge badge-success">Sudah Lunas</span>
                                    @elseif ($tagihan->status == 'cicilan')
                                        <span class="badge badge-warning">Cicilan</span>
                                    @else
                                        <span class="badge badge-danger">Belum Lunas</span>
                                    @endif
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Jatuh Tempo</label>
                                <p>{{ date('d F Y', strtotime($tagihan->tanggal_jatuh_tempo)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Pembayaran -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Pembayaran</h3>
                </div>
                <div class="card-body">
                    @if(count($pembayaran) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPembayaran = 0; @endphp
                                @foreach($pembayaran as $index => $p)
                                    @php $totalPembayaran += $p->nominal; @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ date('d F Y H:i', strtotime($p->tanggal_pembayaran)) }}</td>
                                        <td>Rp {{ number_format($p->nominal, 2, ',', '.') }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $p->metode_pembayaran)) }}</td>
                                        <td>
                                            @if($p->status == 'confirmed')
                                                <span class="badge badge-success">Dikonfirmasi</span>
                                            @elseif($p->status == 'pending')
                                                <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                            @else
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($p->bukti_pembayaran_path)
                                                <a href="#" class="btn btn-info btn-sm">
                                                    <i class="fas fa-download"></i> Unduh
                                                </a>
                                            @else
                                                <span class="text-muted">Tidak ada bukti</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-light">
                                    <td colspan="2" class="text-right"><strong>Total Pembayaran</strong></td>
                                    <td><strong>Rp {{ number_format($totalPembayaran, 2, ',', '.') }}</strong></td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr class="bg-light">
                                    <td colspan="2" class="text-right"><strong>Sisa Tagihan</strong></td>
                                    <td><strong>Rp {{ number_format($tagihan->nominal - $totalPembayaran, 2, ',', '.') }}</strong></td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            Belum ada pembayaran yang tercatat untuk tagihan ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol untuk melakukan pembayaran -->
    @if($tagihan->status != 'lunas')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="btn btn-primary btn-lg">
                            <i class="fas fa-credit-card"></i> Lakukan Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Detail Tagihan page loaded');
    </script>
@stop