@extends('../layout/' . $layout)

@section('subhead')
<title>Rental</title>
@endsection

@section('subcontent')
@include('sweetalert::alert')
<h2 class="intro-y text-lg font-medium mt-10">Daftar Rental</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a class="btn btn-primary shadow-md mr-2" href="{{ route('rental.create') }}">Tambah Rental</a>
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center">
                    <i class="w-4 h-4" data-feather="plus"></i>
                </span>
            </button>
            <div class="dropdown-menu w-40">
                <ul class="dropdown-content">
                    <li>
                        <a href="" class="dropdown-item">
                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-slate-500">{{ $rentals->links('vendor.pagination.customTotal') }}</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">ID</th>
                    <th class="whitespace-nowrap">NAMA PELANGGAN</th>
                    <th class="text-center whitespace-nowrap">PRODUK</th>
                    <th class="text-center whitespace-nowrap">TANGGAL SEWA</th>
                    <th class="text-center whitespace-nowrap">DURASI</th>
                    <th class="text-center whitespace-nowrap">JUMLAH</th>
                    <th class="text-center whitespace-nowrap">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @if($rentals->count() > 0)
                @foreach ($rentals as $rental)
                <tr class="intro-x">
                    <td class="w-40 h-10 center">
                                {{ $rental['id_rental'] }}
                    </td>
                    <td>
                        <a href="" class=" font-medium whitespace-nowrap">{{ $rental['nama'] }}</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"></div>
                    </td>
                    <td class="text-center">
                        <p>{{ $rental['camera'] }}</p>
                    </td>
                    <td class="text-center">{{ $rental['tanggal_sewa'] }}</td>
                    <td class="text-center">{{ $rental['durasi'] }} Jam</td>
                    <td class="text-center">{{ $rental['jumlah'] }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="{{ route('rental.edit', $rental->id_rental)}}">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </a>
                            <form action="{{ route('rental.destroy', $rental->id_produk) }}" method="POST" type="button" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="flex items-center text-danger" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="5">
                        Rental not found
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        {{ $rentals->links('vendor.pagination.customLinks') }}
    </div>
    <!-- END: Pagination -->
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button type="button" class="btn btn-danger w-24">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->
@endsection