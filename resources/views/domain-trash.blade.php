@extends('layouts.basic')

@section('content')
    <h2>All trash</h2>
    <br>
    <hr>
    <table class="table table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Deleted at</th>
            <th scope="col">Restore</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($domains) && is_object($domains))
        @foreach($domains as $domain)
            <tr>
                <td>{{ $domain->id }}</td>
                <td>{{ $domain->name }}</td>
                <td>{{ \Carbon\Carbon::parse($domain->deleted_at)->format('d.m.Y / h:m:s') }}</td>
                <td><a href="{{ route('restore.trashed', ['id'=>$domain->id]) }}" class="btn btn-outline-success"><i class="fa fa-fw fa-share-square-o"></i></a></td>
                <td><a href="{{ route('delete.trashed', ['id'=>$domain->id]) }}" class="btn btn-outline-danger"><i class="fa fa-fw fa-times"></i></a></td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
@endsection
