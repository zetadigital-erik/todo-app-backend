<?php
namespace App\Http\Controllers\Base\Core;
use App\Exceptions\ZetaException;
use App\Http\Controllers\Controller;
use App\Http\Models\Activity;
use App\Http\Models\Task;


class TaskController extends Controller
{
    public static function createTask($request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'description'=>'string'
        ]);

        $newTask = new Task([
            'name'=>$request->get('name'),
            'status'=>$request->get('status'),
            'description'=>$request->get('description')
        ]);
        $newTask->save();
        if ($newTask){
            $loggedInAdministrator = $request->user();
            ActivityController::createActivity($loggedInAdministrator, $newTask, "Create");
        }
        return $newTask;
    }

    public static function getTask($taskId,$withParams, $withCountParams = null, $computedParams = [])
    {
        return Task::with($withParams)->withCount($withCountParams)->findOrFail($taskId)->append($computedParams);
    }

    public static function getTasks($withParams, $withCountParams = null, $query = [])
    {
        return Task::where($query)->with($withParams)->withCount($withCountParams)->get();
    }

    public static function updateTask($taskId, $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',

        ]);
        $task = self::getTask($taskId, []);

        $updateTask = $task->update([
            'name'=>$request->get('name'),
            'status'=>$request->get('status'),
            'description'=>$request->get('description')
        ]);

//        if ($updateTask){
//            $loggedInAdministrator = $request->user();
//            ActivityController::createActivity($loggedInAdministrator, $administrator, 'Update', $administrator->getChanges());
//        }

        return $updateTask;
    }






}
