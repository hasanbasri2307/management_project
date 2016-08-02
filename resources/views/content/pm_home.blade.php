@extends("layouts.master")
@section("content")
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <h4>Welcome, {{ Auth::user()->name }}</h4>
        </div><!-- ./col -->


        </section><!-- right col -->
    </div><!-- /.row (main row) -->
@endsection