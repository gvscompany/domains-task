@extends('layouts.basic')

@section('content')
    <h2 class="text-center">Domains search page</h2>
    <p class="text-center text-danger">
        If the domain is free, you can book it directly on this page. <br>
		Just sign in to your account, enter your domain name to see if it's free...
    </p>

    <br>
    <hr>
    <br>
    {{-- Domains search form begin --}}
    <div class="col-sm-12 col-md-6 offset-md-3">
        <form action="" autocomplete="off" id="search-domains-form">
            <div class="input-group mb-3">
                <input type="text" name="search" id="search" class="form-control" placeholder="only (.com | .ru | .ru)">
                <div class="input-group-append">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-fw fa-search"></i></span>
                    </div>
                </div>
            </div>
        </form>
        {{-- Domains search form end --}}

        <br>
        <hr>

        {{-- Domains list begin --}}
        <div class="list-group" id="domains-list">
            {{-- domains --}}
        </div>
        {{-- Domains list end --}}

    </div>
@endsection
