@extends('layouts.app')

@section('content')

<section>
    <div class="container">
        <h1 class="mt-3">Projects</h1>
    </div>
</section>
<section>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <form class="form-control" action="{{ route('admin.project.index') }}" method="GET">
                            <input type="text" name="title" placeholder="Filter by title" value="{{ request()->get('title') }}">
                        </form>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
        </table>
    </div>
</section>
<section>
   <div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Category</th>
                <th></th>
                <th>
                    <a href="{{ route('admin.project.create') }}" class="btn btn-primary btn-sm">Create</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>
                        <a href="{{ route('admin.project.show', $project) }}">
                            {{ $project->title }}
                        </a>
                    </td>
                    <td>{{ $project->slug }}</td>
                    <td> 
                        {{ optional($project->type)->name }}
                    </td>
                    <td>
                        <a href="{{ route('admin.project.edit', $project) }}">Edit</a>
                    </td>
                    <td>
                      <form action="{{ route('admin.project.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                      </form>  
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Project</td>
                </tr>
            @endforelse
        </tbody>
    </table>
   </div> 
</section>

@endsection
