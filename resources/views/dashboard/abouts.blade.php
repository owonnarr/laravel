@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Abouts</h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/dashboard/abouts/create') }}" class="btn btn-success">ADD ABOUT</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>About</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($abouts as $about)
                        <tr>
                            <td>{{ $about->id }}</td>
                            <td>{{ $about->name }}</td>
                            <td>{{ $about->description }}</td>
                            <td>
                                <a href="/dashboard/abouts/{{ $about->id }}/edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#" onclick="event.preventDefault();
                                            this.children[0].submit();">

                                    <form action="{{ route('abouts.destroy', $about->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                    </form>
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection