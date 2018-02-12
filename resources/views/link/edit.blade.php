@extends('layouts.app')

@section('content')
    <div class="card-block">
        <div class="row">
            <div class="pull-left">
                <h2>Edit Link</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('link.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) < 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('link.form', ['method' => 'PATCH', 'action' => route('link.update', $link->id), 'link' => $link])


@endsection