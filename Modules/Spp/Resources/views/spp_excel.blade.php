<table>
    <thead>
        <tr>
            <th>Id Spp</th>
            <th>Nama Siswa</th>
            <th>Bulan</th>
            <th>Status</th>
            <th>Jumlah Bayar</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($spp as $spp)
        <tr>
            <td>{{ $id_spp }}</td>
            <td>{{ $user->nama_siswa }}</td>
            <td>{{ $user->bulan }}</td>
            <td>{{ $user->status }}</td>
            <td>{{ $user->jumlah_bayar }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
