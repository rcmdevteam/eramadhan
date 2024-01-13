@extends(backpack_view('blank'), ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Dashboard</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            @include('vendor.backpack.ui.cards.my_income')
        </div>
        <div class="col-md-6 mb-4">
            @include('vendor.backpack.ui.cards.withdraw')
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.sponsors')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.sponsors_amount')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.appointment')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.next_appointment')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            @include('vendor.backpack.ui.cards.engagement')
        </div>
        <div class="col-md-6 mb-4">
            @include('vendor.backpack.ui.cards.geographic_reach')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.demographic_info')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.social_media_impact')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.trend_analysis')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.conversion_metrics')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.content_performance')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.donation')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.donor')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.fundraising')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.income_trend_over_time')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.roi')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.budget')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.expenses')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.income_sources')
        </div>
        <div class="col-md-3 mb-4">
            @include('vendor.backpack.ui.cards.feedback_comments')
        </div>
    </div>
@endsection
