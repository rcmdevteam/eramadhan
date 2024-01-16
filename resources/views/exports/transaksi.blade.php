<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Emel</th>
            <th>Telefon</th>
            <th>Ramadhan</th>
            <th>Jumlah</th>
            <th>Kuantiti</th>
            <th>Status</th>
            <th>Ramadhan</th>
            <th>Hari</th>
            <th>Masjid</th>
            <th>Lot Sasaran</th>
            <th>Paid at</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->emel }}</td>
                <td>{{ $item->telefon }}</td>
                <td>{{ $item->ramadhan }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->kuantiti }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->ramadhan }}</td>
                <td>{{ $item->hari }}</td>
                <td>{{ $item->masjid->name }}</td>
                <td>{{ $item->lot->sasaran }}</td>
                <td>{{ $item->mark_as_paid }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
