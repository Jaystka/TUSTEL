@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Rental</title>
@endsection

@section('subcontent')

<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Tambah Data Rental</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form action="{{ route('rental.store') }}" method="post">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="camera" class="form-label">Produk</label>
                    <select data-placeholder="Pilih Kamera" class="tom-select w-full" id="camera" name="id_produk"
                        required>
                        <option disabled selected> -- Pilih Produk -- </option>
                        @foreach($rentals as $rental)
                        <option value="{{ $rental->id_produk }}">{{ $rental->camera }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="customer" class="form-label">Nama Pelanggan</label>
                    <select data-placeholder="Pilih Nama Pelanggan" class="tom-select w-full" id="customer"
                        name="id_customer" required>
                        <option disabled selected> -- Pilih Nama Pelanggan -- </option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id_customer }}">{{ $customer->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="date" class="form-label">Waktu Sewa</label>
                    <input type="datetime-local" id="date" name="tanggal_sewa" class=" form-control"
                        data-single-mode="true" required>
                </div>
                <div>
                    <label for="duration" class="form-label">Durasi</label>
                    <select data-placeholder="Pilih Durasi" class="tom-select w-full" id="duration" name="durasi"
                        required>
                        <option disabled selected> -- Pilih Durasi Rental -- </option>
                        <option value="6">6 Jam</option>
                        <option value="12">12 Jam</option>
                        <option value="24">1 Hari</option>
                        <option value="48">2 Hari</option>
                        <option value="96">4 Hari</option>
                        <option value="144"> 7 Hari</option>
                        <option value="288"> 14 Hari</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input id="jumlah" name="jumlah" type="text" class="form-control w-full"
                        placeholder="Masukkan Jumlah Sewa" required>
                </div>
                <div class="mt-3">
                    <label for="jenis" class="form-label">Jenis Pembayaran</label>
                    <input id="jenis" name="jenis" type="text" class="form-control w-full"
                        placeholder="Masukkan Jenis Pembayaran" required>
                </div>
                <div class="text-right mt-5">
                    <a type="button" class="btn btn-outline-secondary w-24 mr-1"
                        href="{{ route('rental.index') }}">Cancel</a>
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