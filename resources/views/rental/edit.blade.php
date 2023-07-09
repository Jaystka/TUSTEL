@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Rental</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form Layout</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form action="{{ route('rental.update', $rental->id_rental) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
                <div>
                    <label for="camera" class="form-label">Produk</label>
                    <select data-placeholder="Pilih Kamera" class="tom-select w-full" id="camera" name="id_produk" required>
                        @foreach($products as $product)
                        <option value="{{ $product->id_produk }}" 
                            {{old('id_produk', $product->id_produk) == $rental->id_produk ? 'selected' : ''}} > {{ $product->camera }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="customer" class="form-label">Nama Pelanggan</label>
                    <select data-placeholder="Pilih Nama Pelanggan" class="tom-select w-full" id="customer" name="id_customer" disabled>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id_customer }}" selected>{{ $customer->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="date" class="form-label">Waktu Sewa</label>
                    <input type="datetime-local" id="date" name="tanggal_sewa" class=" form-control" value="{{$rental->tanggal_sewa}}" data-single-mode="true" required>
                </div>
                <div class="mt-3">
                    <label for="duration" class="form-label">Durasi</label>
                    <select data-placeholder="Pilih Durasi" class="tom-select w-full" id="duration" name="durasi" required>
                        <option value="6" {{ $rental->durasi == '6' ? 'selected' : '' }}>6 Jam</option>
                        <option value="12" {{ $rental->durasi == '12' ? 'selected' : '' }}>12 Jam</option>
                        <option value="24" {{ $rental->durasi == '24' ? 'selected' : '' }}>1 Hari</option>
                        <option value="48" {{ $rental->durasi == '48' ? 'selected' : '' }}>2 Hari</option>
                        <option value="96" {{ $rental->durasi == '96' ? 'selected' : '' }}>4 Hari</option>
                        <option value="144" {{ $rental->durasi == '144' ? 'selected' : '' }}> 7 Hari</option>
                        <option value="288" {{ $rental->durasi == '288' ? 'selected' : '' }}> 14 Hari</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input id="jumlah" name="jumlah" type="text" class="form-control w-full" placeholder="Masukkan Jumlah Sewa" value="{{ $rental->jumlah }}" required>
                </div>
                <div class="text-right mt-5">
                    <a type="button" class="btn btn-outline-secondary w-24 mr-1" href="{{ route('rental.index') }}">Cancel</a>
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