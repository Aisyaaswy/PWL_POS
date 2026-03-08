@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @empty($penjualan)
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('/penjualan/' . $penjualan->penjualan_id) }}" class="form-horizontal">
                @csrf
                {!! method_field('PUT') !!}

                {{-- Header --}}
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Petugas</label>
                    <div class="col-10">
                        <select class="form-control" name="user_id" required>
                            <option value="">- Pilih Petugas -</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->user_id }}"
                                    @if ($item->user_id == $penjualan->user_id) selected @endif>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Kode Penjualan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="penjualan_kode"
                            value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                        @error('penjualan_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Pembeli</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="pembeli"
                            value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                        @error('pembeli')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tanggal</label>
                    <div class="col-10">
                        <input type="date" class="form-control" name="penjualan_tanggal"
                            value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal) }}" required>
                        @error('penjualan_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Detail Item --}}
                <hr>
                <h5>Detail Item Barang</h5>
                <table class="table table-bordered table-sm" id="tabel_detail">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga Jual</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>
                                <button type="button" class="btn btn-success btn-sm" id="btn_tambah_item">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody_detail">
                        @foreach ($penjualan->detail as $detail)
                        <tr class="row-item">
                            <td>
                                <select class="form-control select-barang" name="barang_id[]" required>
                                    <option value="">- Pilih Barang -</option>
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->barang_id }}"
                                            data-harga="{{ $item->harga_jual }}"
                                            @if ($item->barang_id == $detail->barang_id) selected @endif>
                                            {{ $item->barang_nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control input-harga" name="harga[]"
                                    min="0" required value="{{ $detail->harga }}">
                            </td>
                            <td>
                                <input type="number" class="form-control input-jumlah" name="jumlah[]"
                                    min="1" required value="{{ $detail->jumlah }}">
                            </td>
                            <td>
                                <input type="text" class="form-control input-subtotal" readonly
                                    value="{{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-hapus-item">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <th>
                                <input type="text" class="form-control" id="total_harga" readonly
                                    value="{{ number_format($penjualan->detail->sum(fn($d) => $d->harga * $d->jumlah), 0, ',', '.') }}">
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

                <div class="form-group row mt-3">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection

@push('js')
<script>
    var barangOptions = `{!! collect($barang)->map(function($b){ return '<option value="'.$b->barang_id.'" data-harga="'.$b->harga_jual.'">'.$b->barang_nama.'</option>'; })->implode('') !!}`;

    function hitungSubtotal(row) {
        var harga  = parseInt($(row).find('.input-harga').val()) || 0;
        var jumlah = parseInt($(row).find('.input-jumlah').val()) || 0;
        $(row).find('.input-subtotal').val((harga * jumlah).toLocaleString('id-ID'));
        hitungTotal();
    }

    function hitungTotal() {
        var total = 0;
        $('.input-subtotal').each(function () {
            total += parseInt($(this).val().replace(/\./g, '')) || 0;
        });
        $('#total_harga').val(total.toLocaleString('id-ID'));
    }

    $(document).on('change', '.select-barang', function () {
        var harga = $(this).find(':selected').data('harga') || 0;
        $(this).closest('tr').find('.input-harga').val(harga);
        hitungSubtotal($(this).closest('tr'));
    });

    $(document).on('input', '.input-harga, .input-jumlah', function () {
        hitungSubtotal($(this).closest('tr'));
    });

    $('#btn_tambah_item').on('click', function () {
        var baris = `
        <tr class="row-item">
            <td>
                <select class="form-control select-barang" name="barang_id[]" required>
                    <option value="">- Pilih Barang -</option>
                    ${barangOptions}
                </select>
            </td>
            <td><input type="number" class="form-control input-harga" name="harga[]" min="0" required placeholder="0"></td>
            <td><input type="number" class="form-control input-jumlah" name="jumlah[]" min="1" value="1" required></td>
            <td><input type="text" class="form-control input-subtotal" readonly value="0"></td>
            <td><button type="button" class="btn btn-danger btn-sm btn-hapus-item"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#tbody_detail').append(baris);
    });

    $(document).on('click', '.btn-hapus-item', function () {
        if ($('.row-item').length > 1) {
            $(this).closest('tr').remove();
            hitungTotal();
        } else {
            alert('Minimal harus ada 1 item barang.');
        }
    });
</script>
@endpush