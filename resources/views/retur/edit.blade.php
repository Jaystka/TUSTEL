@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Pengembalian</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">Form Layout</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
  <div class="intro-y col-span-12 lg:col-span-6">
    <!-- BEGIN: Form Layout -->
    <form action="{{ route('retur.update', $retur->id_retur) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="intro-y box p-5">
        <div>
          <label for="id_rental" class="form-label">ID Rental</label>
          <input id="id_rental" name="id_rental" type="text" class="form-control w-full" disabled
            value="{{ $retur->id_rental }}" placeholder="Masukkan ID Rental">
        </div>
        <div class="mt-3">
          <label for="date" class="form-label">Tanggal Pengembalian</label>
          <input type="datetime-local" id="date" name="tanggal_kembali" class="form-control"
            value="{{ $retur->tanggal_kembali }}" data-single-mode="true" required>
        </div>
        <div class="mt-3">
          <label for="denda" class="form-label">Denda</label>
          <input id="denda" name="denda" type="text" class="form-control w-full" value="{{ $retur->denda }}"
            placeholder="Masukkan Jumlah Denda">
        </div>
        <div class="text-right mt-5">
          <a type="button" class="btn btn-outline-secondary w-24 mr-1" href="{{ route('retur.index') }}">Cancel</a>
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