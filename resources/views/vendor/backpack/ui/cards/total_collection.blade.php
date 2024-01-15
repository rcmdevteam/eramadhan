<div class="card mb-2">
    <div class="card-body pt-0 mt-3" style="min-height: 184px">
        <div class="row">
            <div class="col-md-6">
                <!-- Recent Sponsor List -->
                <h6 class="font-weight-bold">Transaksi Terkini:</h6>
                <table width="100%" class="text-muted">
                    @foreach ($totaltansaksi as $transaksi)
                        <tr>
                            <td>{{ $transaksi->nama }}</td>
                            <td class="text-right">RM {{ $transaksi->jumlah }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-6">
                <!-- Balance of amount sponsors -->
                <h2 class="font-weight-bold text-dark float-right">RM {{ number_format($totalCollection, 2) }}</h2>
                <p class="text-muted float-right mb-2">Terkini 1 minutes ago</p>
                <p class="mt-0 mb-0 float-right"><a href="#"><i class="las la-download"></i> Muat Turun Rekod</a>
                </p>
            </div>
        </div>
    </div>
</div>

@push('after_styles')
@endpush

@push('after_scripts')
@endpush
