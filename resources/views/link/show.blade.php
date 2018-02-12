@extends('layouts.app')


@section('content')
    <div class="card-block">
        <div class="row">
            <div class="pull-left">
                <h2>Show Link</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('link.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <strong>mURL:</strong>
                {{ $link->murl}}
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>URL:</strong>
                {{ $link->url}}
            </div>
        </div>
    </div>
@endsection