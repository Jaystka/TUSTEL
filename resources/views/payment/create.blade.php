@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Pembayaran</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form Layout</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form action="{{ route('product.store') }}" method="post">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="id_rental" class="form-label">ID Rental</label>
                    <input id="id_rental" name="id_rental" type="text" class="form-control w-full" placeholder="Masukkan ID Rental" required>
                </div>
                <div class="mt-3">
                    <label for="nama" class="form-label">Nama Pelanggan</label>
                    <input id="nama" name="nama" type="text" class="form-control w-full" placeholder="Masukkan Nama Pelanggan" required>
                </div>
                <div class="mt-3">
                    <label for="Jenis" class="form-label">Jenis</label>
                    <input id="Jenis" name="Jenis" type="text" class="form-control w-full" placeholder="Masukkan Jenis Pembayaran" required>
                </div>
                <div class="mt-3">
                    <label for="total" class="form-label">Total</label>
                    <input id="total" name="total" type="text" class="form-control w-full" placeholder="Masukkan Total Bayar" required>
                </div>
                <div class="text-right mt-5">
                    <a type="button" class="btn btn-outline-secondary w-24 mr-1" href="{{ route('product.index') }}">Cancel</a>
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