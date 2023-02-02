@extends('layouts.main');
@section('title', 'Tasks')

@section('content')


    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3>Tasks</h3>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('task.create') }}" class="btn btn-primary">Add Task</a>
                    <a href="{{ route('logout') }}" class="btn btn-secondary">Log Out</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('partials.alerts')
            @if (count($tasks) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Task</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->task }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>
                                    <a href="{{ route('task.edit', $task) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('task.destroy', $task) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <div class="alert alert-danger" role="alert">
                    No Tasks Found
                </div>
            @endif
        </div>
    </div>

@endsection
