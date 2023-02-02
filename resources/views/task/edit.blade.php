@extends('layouts.main')
@section('title', 'Edit Task')

@section('content')
    <div class="card">
        <form action="{{ route('task.edit', $task) }}" method="post">
            @csrf
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3>Edit Task</h3>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('tasks') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @include('partials.alerts')
                <label for="task">Task:</label>
                <textarea class="form-control  @error('task') is-invalid @enderror" name="task" id="task" cols="60"
                    rows="8" placeholder="Enter the task">{{ $task->task }}</textarea>
                @error('task')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="card-footer">
                <div class="mt-3">
                    <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                </div>
            </div>
        </form>
    </div>
@endsection
