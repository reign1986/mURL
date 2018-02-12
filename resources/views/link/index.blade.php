@extends('layouts.app')


@section('content')

    <div class="card-block">
        <div class="row">
            <div class="pull-left">
                <h2>Links</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('link.create') }}"> Create New Link</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>mURL</th>
            <th>URL</th>
            <th>Action</th>
        </tr>
        @foreach ($links as $link)
            <tr>
                <td>{{ ++$i }}</td>
                <td><a href="/{{ $link->murl}}" target="_blank">{{ $app->make('url')->to($link->murl)}}</a></td>
                <td>{{ $link->url}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('link.show',$link->id) }}">Show</a>
                    <a class="btn btn-warning" href="{{ route('link.edit', ['id' => $link->id]) }}">Edit</a>
                    <a class="btn btn-primary" href="{{ route('link.stats', ['id' => $link->murl]) }}">Stats</a>
                    <a class="btn btn-danger" href="{{ route('link.destroy', ['id' => $link->id]) }}"
                       onclick="event.preventDefault();
                               if(confirm('Confirm delete')) {
                               document.getElementById('delete-form-{{$link->id}}').submit();
                               }
                               ">Delete</a>
                    <form id="delete-form-{{$link->id}}"
                          action="{{ route('link.destroy', ['id' => $link->id]) }}"
                          method="POST"
                          style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    {!! $links->links() !!}
@endsection