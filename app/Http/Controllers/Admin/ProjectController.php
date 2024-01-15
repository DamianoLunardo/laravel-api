<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Type;
use App\Models\Technology;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = request()->all();
        if(isset($data['title'])) {
            $query = Project::where('title', 'like', "%{$data['title']}%")->limit(20);
        } else {
            $query = Project::limit(20);
        }

        $projects =$query->get();

        $projects = Project::limit(20)->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'ASC')->get();
        $types = Type::all();

        $technologies = Technology::orderBy('name', 'ASC')->get();
        $technologies = Technology::all();
        
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|string|unique:projects',
            'content' => 'nullable|min:5|string',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        $project = Project::create($data);

        if($request->has('technologies')){

            $project->technologies()->attach($data['technologies']);
        }


        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name', 'ASC')->get();
        $technologies = Technology::orderBy('name', 'ASC')->get();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required','max:255','string',Rule::unique('projects')->ignore($project->id)],
            'content' => 'nullable|min:5|string',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ]);

        $data = $request->all();

        // if($project->title !== $data['title']){
            $data ['slug'] = Str::slug($data['title'], '-');
        // }

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        $project->update($data);
        return redirect()->route('admin.projects.show', $project);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);
        $project->delete();

        return redirect()->route('admin.projects.index', $project);
    }
}
