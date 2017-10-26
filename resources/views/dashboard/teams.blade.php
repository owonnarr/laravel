@extends('layouts.dashboard')

@section('content')
    <h1 class="page-header">Teams</h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/dashboard/teams/create') }}" class="btn btn-success">ADD PERSON</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Detail</th>
                        <th>Views</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>{{ $team->id }}</td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->position }}</td>
                            <td>
                                <a href="/profiles/{{ $team->id }}">
                                    <i class="glyphicon glyphicon-user" data-toggle="modal" data-target="#myModal"></i>
                                </a>
                            </td>
                            <td>
                                    <span>{{ $team->views }}</span>
                                    <i class="glyphicon glyphicon-eye-open"></i>
                            </td>
                            <td>
                                <a href="/dashboard/teams/{{ $team->id }}/edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#" onclick="event.preventDefault();
                                            this.children[0].submit();">

                                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display: none;">
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