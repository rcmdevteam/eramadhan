<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Emel</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->emel }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
