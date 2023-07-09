@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Produk</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form Layout</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form action="{{ route('product.update', $product->id_produk) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
                <div>
                    <label for="camera" class="form-label">Nama Produk</label>
                    <input id="camera" name="camera" type="text" class="form-control w-full" value="{{ $product->camera }}" placeholder="Masukkan Jenis Produk">
                </div>
                <div class="mt-3">
                    <label for="harga" class="form-label">Biaya Sewa</label>
                    <input id="harga" name="harga" type="text" class="form-control w-full" value="{{ $product->harga }}" placeholder="Masukkan Biaya Sewa">
                </div>
                <div class="mt-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input id="jumlah" name="jumlah" type="text" class="form-control w-full" value="{{ $product->jumlah }}" placeholder="Masukkan Jumlah Produk">
                </div>
                <div class="mt-3">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="describe" placeholder="Description">{{ $product->describe }}</textarea>
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