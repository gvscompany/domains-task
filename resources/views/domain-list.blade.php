@extends('layouts.basic')

@section('content')
    <h2>All domains</h2>
    <br>
    <hr>
    <a href="{{ route('domain.create') }}" class="btn btn-success" role="button">
        Add new domain
        <i class="fa fa-fw fa-plus"></i>
    </a>
    <hr>
    <table class="table table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Edit</th>
            <th scope="col">Trash</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($domains) && is_object($domains))
        @foreach($domains as $domain)
            <tr>
                <td>{{ $domain->id }}</td>
                <td>{{ $domain->name }}</td>
                <td>{{ \Carbon\Carbon::parse($domain->created_at)->format('d.m.Y / h:m:s') }}</td>
                <td>{{ \Carbon\Carbon::parse($domain->updated_at)->format('d.m.Y / h:m:s') }}</td>
                <td><a href="{{ route('domain.edit', ['id'=>$domain->id]) }}" class="btn btn-outline-info"><i class="fa fa-fw fa-pencil"></i></a></td>
                <td>
                    <form action="{{ route('domain.destroy', ['id'=>$domain->id]) }}" method="post" id="{{ $domain->id }}" style="display: none;">
                        @csrf <input type="hidden" name="_method" value="DELETE">
                    </form>
                    <button type="submit" class="btn btn-outline-danger" form="{{ $domain->id }}"><i class="fa fa-fw fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    @if(isset($domains) && is_object($domains))
        {{ $domains->links() }}
    @endif
@endsection
