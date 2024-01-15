@extends('layouts.app')

@section('content')

<section>
    <div class="container">
        <h1> {{ $project->title }} </h1>
        @if($project->type)
        <p> 
            <strong>
             {{ $project->type->name }}   
            </strong>
        </p>
        @endif

        <ul class="d-flex gap-2">
         @foreach ($project->technologies as $technology)
         <li><span class="badge rounded-pill text-bg-primary">{{ $technology->name }}</span></li>
        @endforeach   
        </ul>

        <p> {{ $project->slug }} </p>
        <p> {{ $project->created_at->format('d/m/Y') }} </p>
    </div>
    <div class="container py-3">
        <div class="row">
            <div class="col-auto">
                <a href="{{ route('admin.project.edit', $project) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
        <form action="{{ route('admin.project.destroy', $project) }}" class="pt-3" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger btn-sm" type="submit" value="Delete">
        </form>   
    </div>
    
    </td>
</section>
<section>
    <div class="container">
        {{ $project->content }}
    </div>
</section>

@endsection