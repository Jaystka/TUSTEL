@extends('../layout/' . $layout)

@section('subhead')
<title>TUSTEL - Pembayaran</title>
@endsection

@section('subcontent')
@include('sweetalert::alert')
<h2 class="intro-y text-lg font-medium mt-10">Daftar Pembayaran</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a class="btn btn-primary shadow-md mr-2" href="{{ route('payment.create') }}">Tambah Pembayaran</a>
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
        <div class="hidden md:block mx-auto text-slate-500">{{ $payments->links('vendor.pagination.customTotal') }}
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <input type="text" class="form-control w-56 box pr-10" name="s" placeholder="Search...">
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">ID PEMBAYARAN</th>
                    <th class="whitespace-nowrap">ID RENTAL</th>
                    <th class="text-center whitespace-nowrap">NAMA PELANGGAN</th>
                    <th class="text-center whitespace-nowrap">JENIS</th>
                    <th class="text-center whitespace-nowrap">TOTAL</th>
                    <th class="text-center whitespace-nowrap">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @if($payments->count() > 0)
                @foreach ($payments as $payment)
                <tr class="intro-x">
                    <td class="w-40 h-10 center">
                        {{ $payment['id_pembayaran'] }}
                    </td>
                    <td>
                        <a href="" class=" font-medium whitespace-nowrap">{{ $payment['id_rental'] }}</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"></div>
                    </td>
                    <td class="text-center">{{ $payment['nama'] }}</td>
                    <td class="text-center">{{ $payment['jenis'] }}</td>
                    <td class="text-center">{{ $payment['total'] }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3"
                                href="{{ route('payment.edit', $payment->id_pembayaran)}}">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </a>
                            <form action="{{ route('payment.destroy', $payment->id_pembayaran) }}" method="POST"
                                type="button" class="formDelete">
                                @csrf
                                @method('DELETE')
                                <button class="flex items-center text-danger">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1" class="btn btn-danger"
                                        data-confirm-delete="true"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="5">
                        payment not found
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        {{ $payments->links('vendor.pagination.customLinks') }}
    </div>
    <!-- END: Pagination -->
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<script>
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $(".formDelete").submit(function (event) {
        event.preventDefault(); //prevent default action
        let post_url = $(this).attr("action"); //get form action url
        let request_method = $(this).attr("method"); //get form GET/POST method
        let form_data = $(this).serialize(); //Encode form elements for submission
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonColor: '#223e8c',
            cancelDenyColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            denyButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: post_url,
                    type: request_method,
                    data: form_data,
                    success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Dihapus',
                                timer: 1500,
                            })

                            location.reload();
                        } else {
                            Swal.fire({
                                title: 'Ada Kesalahan!',
                                text: 'Terdapat kesalahan dalam proses hapus!',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: 'orange'
                            }
                            );
                        }

                    }
                });
            }
        });
    });
</script>
@endsection