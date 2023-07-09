@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Pelanggan</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form Layout</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form action="{{ route('customer.update', $customers->id_customer) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
                <div>
                    <label for="nama" class="form-label">Nama Pelanggan</label>
                    <input id="nama" name="nama" type="text" class="form-control w-full" value="{{ $customers->nama }}" placeholder="Masukkan Nama Pelanggan">
                </div>
                <div class="mt-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input id="alamat" name="alamat" type="text" class="form-control w-full" value="{{ $customers->alamat }}" placeholder="Masukkan Alamat">
                </div>
                <div class="mt-3">
                    <label for="no_telp" class="form-label">No.Telpon</label>
                    <input id="no_telp" name="no_telp" type="text" class="form-control w-full" value="{{ $customers->no_telp }}" placeholder="Masukkan No Telpon">
                </div>
                <div class="text-right mt-5">
                    <a type="button" class="btn btn-outline-secondary w-24 mr-1" href="{{ route('customer.index') }}">Cancel</a>
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