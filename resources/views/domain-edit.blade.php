@extends('layouts.basic')

@section('content')
    <h2>Add domain page</h2>
    <br>
    <hr>
    <div class="col-sm-12 col-md-6 offset-md-3">
        @if(isset($edit_domain) && is_object($edit_domain))
        <form action="{{ route('domain.update', $edit_domain->id) }}" method="post" id="update_form" autocomplete="off">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="update_name">Domain name (Only .com | .ru | .am)</label>
                <input type="text" class="form-control" name="name" id="update_name" value="{{ $edit_domain->name }}" placeholder="Enter domain name...">
            </div>
            <button type="submit" disabled="disabled" id="update_btn" class="btn btn-primary">Update domain</button>
        </form>
        @endif
    </div>
@endsection
