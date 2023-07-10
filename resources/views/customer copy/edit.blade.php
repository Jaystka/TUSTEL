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
        <form action="{{ route('user.update', $users->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
                <div>
                    <label for="nama" class="form-label">Nama</label>
                    <input id="nama" name="nama" type="text" class="form-control w-full" value="{{ $users->name }}"
                        placeholder="Masukkan Nama Pelanggan">
                </div>
                <div class="mt-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" type="text" class="form-control w-full"
                        value="{{ $users->username }}" placeholder="Masukkan Username">
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control w-full" value="{{ $users->email }}"
                        placeholder="Masukkan Email">
                </div>
                <div class="mt-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input id="password" name="password" type="text" class="form-control w-full"
                        placeholder="Masukkan Pasword Baru">
                </div>
                <div class="text-right mt-5">
                    <a type="button" class="btn btn-outline-secondary w-24 mr-1"
                        href="{{ route('user.index') }}">Cancel</a>
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