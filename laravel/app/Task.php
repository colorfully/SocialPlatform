<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\TaskRepository;

class Task extends Model
{
    /**
     * 任务资源库的实例。
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * 创建新的控制器实例。
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function _construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }
    /**
     * 获取指定用户的所有任务。
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
}
