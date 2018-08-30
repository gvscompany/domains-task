@extends('layouts.basic')

@section('content')
    <h2>Add domain page</h2>
    <br>
    <hr>
    <div class="col-sm-12 col-md-6 offset-md-3">
        <form action="{{ route('domain.store') }}" method="post" data-name="domain-name">
            @csrf
            <div class="form-group">
                <label for="add_name">Domain name (Only .com | .ru | .am)</label>
                <input type="text" class="form-control" name="name" id="add_name" value="{{ old('name') }}" placeholder="Enter domain name...">
            </div>
            <button type="submit" id="save_btn" disabled="disabled" class="btn btn-primary">Save domain</button>
        </form>
    </div>
@endsection
