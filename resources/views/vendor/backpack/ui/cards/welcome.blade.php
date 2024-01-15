<div class="card mb-2">
    <div class="card-body"
        style="background-image: url('{!! asset('images/cover-ori.jpg') !!}'); background-size: cover; background-position: top center; min-height: 200px">
        <h3 style="font-weight: 100; color: rgba(0,0,0,.7)">Assalamualaikum, {{ auth()->user()->name }}!</h3>
    </div>
</div>

@push('after_styles')
@endpush

@push('after_scripts')
@endpush
