
@if (Session::has('message'))
    <section class="loginbox">
        <div class="alert alert-info">
            <button type="button" class="close">×</button>
            {{ Session::get('message') }}
        </div>
    </section>
@endif

@if (Session::has('success'))
    <section class="loginbox">
        <div class="alert alert-success">
            <button type="button" class="close">×</button>
            {{ Session::get('success') }}
        </div>
    </section>
@endif

@if (Session::has('danger'))
    <section class="loginbox">
        <div class="alert alert-danger">
            <button type="button" class="close">×</button>
            {{ Session::get('danger') }}
        </div>
    </section>
@endif