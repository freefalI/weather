<?php

namespace App\Http\Controllers;

use App\RoadProblemType;
use App\Station;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the task.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $query = Task::query();
        $query->where('description', 'like', '%' . request('q') . '%');
        $tasks = $query->with('problemType')->paginate(25);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Task());
        $problemTypes = RoadProblemType::get();
        return view('tasks.create', ['problemTypes' => $problemTypes]);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Task);

        $newTask = $request->validate([
            'description' => 'required|max:60',
            'comment' => 'nullable|max:255',
            'area' => 'required|json',
            'problem_type_id' => 'required|int',
        ]);
        $newTask['creator_id'] = auth()->id();

        $task = Task::create($newTask);

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Display the specified task.
     *
     * @param \App\Task $task
     * @return \Illuminate\View\View
     */
    public function show(Task $task)
    {
        $center = Station::first();
        return view('tasks.show', ['task' => $task, 'center' => $center]);
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param \App\Task $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $center = Station::first();
        $problemTypes = RoadProblemType::get();
        return view('tasks.edit', compact('task', 'center', 'problemTypes'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $taskData = $request->validate([
            'description' => 'required|max:60',
            'comment' => 'nullable|max:255',
            'area' => 'required|json',
            'problem_type_id' => 'required|int',
        ]);
        $task->update($taskData);

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('delete', $task);

        $request->validate(['task_id' => 'required']);

        if ($request->get('task_id') == $task->id && $task->delete()) {
            return redirect()->route('tasks.index');
        }

        return back();
    }
}
