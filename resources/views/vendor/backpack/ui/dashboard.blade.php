@extends(backpack_view('blank'), ['title' => 'Dashboard'])

@section('content')
    <div class="row" style="margin-top: 40px">
        <div class="col-md-12">
            <h2>Paparan</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            {{-- @include('vendor.backpack.ui.cards.my_income') --}}
        </div>
        <div class="col-md-6 mb-4">
            {{-- @include('vendor.backpack.ui.cards.withdraw') --}}
        </div>
    </div>
@endsection
