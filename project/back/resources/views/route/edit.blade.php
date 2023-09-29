@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Route
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Route</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('routes.update', $route->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('route.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
