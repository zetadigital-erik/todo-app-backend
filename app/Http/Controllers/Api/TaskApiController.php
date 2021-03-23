<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Base\Core\AdministratorController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\Core\TaskController;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public static function createTaskApi(Request $request)
    {
//        if (!$request->user()->hasPermissionTo('administrator:create')){
//            return response()->json(['message' => 'No Permission to Access'], 403);
//        }

        $newTaskApi = TaskController::createTask($request);
        if (!$newTaskApi) {
            return response()->json(['message' => 'Unable to create new administrator, please try again'], 500);
        }
        return response()->json($newTaskApi, 200);
    }

    public static function getTaskApi($taskId, Request $request)
    {
//        if (!$request->user()->hasPermissionTo('administrator:create')){
//            return response()->json(['message' => 'No Permission to Access'], 403);
//        }

        $task = TaskController::getTask($taskId, [], null, []);
        if (!$task) {
            return response()->json(['message' => 'Unable to get administrator profile, please try again'], 500);
        }
        return response()->json($task, 200);
    }

    public static function getTasksApi(Request $request)
    {
//        if (!$request->user()->hasPermissionTo('administrator:create')){
//            return response()->json(['message' => 'No Permission to Access'], 403);
//        }

        $tasks = TaskController::getTasks([], [], $request->query());
        if (empty($tasks)) {
            return response()->json(['message' => 'Unable to get administrators list, please try again'], 500);
        }
        return response()->json($tasks, 200);
    }

    public static function updateTaskApi($taskId,Request $request)
    {
//        if (!$request->user()->hasPermissionTo('administrator:create')){
//            return response()->json(['message' => 'No Permission to Access'], 403);
//        }

        $updateTaskRequest = TaskController::updateTask($taskId, $request);

        if (!$updateTaskRequest) {
            return response()->json(['message' => 'Unable to update task information, please try again'], 500);
        }
        return response()->json(['message' => 'Task information has been updated successfully'], 200);
    }

}
