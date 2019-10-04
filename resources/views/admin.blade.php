@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>EN BUYUK ADMIN BIZIM ADMIN</h3>
                    <div class="field">
                        @foreach ($users as $user)
                            <form method="POST" action="/admin/{{$user->id}}">
                            @csrf
                            <!-- <a href="{{ route('user.edit', $user->id ?? '') }}" class="btn btn-danger">Change</a>-->
                            <div class="control">
                                <textarea name="username" class="textarea">{{$user->name ?? ''}}</textarea>
                            </div>
                            <button type="submit" class="button is-link">CHANGE NAME</button>
                            </form>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
@endsection