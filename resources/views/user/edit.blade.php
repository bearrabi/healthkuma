@extends('layouts.app')
@include('layouts.sections.header')
@include('layouts.sections.navbar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('user edit') }}</div>

                <div class="card-body">
                    <div class="alert alert-warning"> user edit page</div>         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
