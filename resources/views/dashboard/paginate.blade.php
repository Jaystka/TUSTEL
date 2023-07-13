<div class="intro-y block sm:flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">Rental Aktif</h2>
</div>
<div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
    <table class="table table-report sm:mt-2 ">
        <thead>
            <tr>
                <th class="whitespace-nowrap">NAMA PELANGGAN</th>
                <th class="text-center whitespace-nowrap">DURASI</th>
                <th class="text-center whitespace-nowrap">TANGGAL SEWA</th>
                <th class="text-center whitespace-nowrap">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rentall)
            <tr class="intro-x">
                <td>
                    <a href="" class="font-medium whitespace-nowrap">{{ $rentall['nama']
                        }}</a>
                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{
                        $rentall['camera'] }}</div>
                </td>
                <td class="text-center">{{ $rentall['durasi'] == '6' ? '6 Jam' : ($rentall['durasi'] ==
                    '12' ? '12
                    Jam': ($rentall['durasi'] == '24' ? '1 Hari' :
                    ($rentall['durasi'] == '48' ? '2 Hari' : ($rentall['durasi'] == '96' ? '4 Hari' :
                    ($rentall['durasi'] == '144' ? '7 Hari' : ($rentall['durasi'] == '288' ? '14 Hari' :
                    'Kosong')) )
                    )))}}</td>
                <td class="w-80">
                    <div class="text-center">{{
                        $rentall['tanggal_sewa'] }}
                    </div>
                </td>
                <td class="table-report__action w-40">
                    <div class="flex justify-center items-center">
                        {{
                        $rentall['jumlah'] }}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
    {{ $rentals->links('vendor.pagination.customLinks') }}
</div>
<script>
    feather.replace()
</script>