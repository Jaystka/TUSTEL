@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Pengembalian</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Tambah Data Pengembalian</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form action="{{ route('retur.store') }}" method="post">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="id_rental" class="form-label">Nama Pelanggan</label>
                    <select data-placeholder="Pilih Pelanggan" class="tom-select w-full" id="camera" name="id_rental"
                        required>
                        <option disabled selected> -- Pilih Pelanggan -- </option>
                        @foreach($rentals as $rental)
                        <option value="{{ $rental->id_rental}}">{{ $rental->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="date" class="form-label">Tanggal Pengembalian</label>
                    <input type="datetime-local" id="date" name="tanggal_kembali" class=" form-control"
                        data-single-mode="true" required>
                </div>
                <div class="mt-3">
                    <label for="denda" class="form-label">Denda</label>
                    <input id="denda" name="denda" type="text" class="form-control w-full"
                        placeholder="Masukkan Jumlah Denda" required>
                </div>
                <div class="text-right mt-5">
                    <a type="button" class="btn btn-outline-secondary w-24 mr-1"
                        href="{{ route('retur.index') }}">Cancel</a>
                    <button class="btn btn-primary w-24">Save</button>
                </div>
            </div>
        </form>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection
@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection