<?php

namespace App\Http\Controllers;

use App\Models\Reminders;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RemindersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $reminders = Reminders::where("User_Id", auth()->user()->id)->get();
        return response()->json([
            'status' => true,
            'msg' => 'Listado de recordatorios por usuario',
            'data' => $reminders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $response = [];
        $user_id = auth()->user()->id;
        $validator = $this->validated($request->all());
        if (!is_array($validator)) {
            Reminders::create([
                'User_Id' => $user_id,
                'Title' => $request->Title,
                'Description' => $request->Description,
                'Reminder_date' => $request->Reminder_date,
                'Recurrence' => $request->Recurrence
            ]);
            array_push($response, ["status" => "success"]);
            return response()->json($response, 201);
        } else {
            return response()->json($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($remindersId): JsonResponse
    {
        $user_id = auth()->user()->id;
        $isReminder_id = Reminders::where(['User_Id' => $user_id, 'id' => $remindersId])->exists();
        if ($isReminder_id) {
            $reminders = Reminders::find($remindersId);
            return response()->json($reminders, 200);
        }
        return response()->json([
            'status' => false,
            'msg' => 'reminder no encontrado',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $remindersId,): JsonResponse
    {
        $response = [];
        $validator = $this->validated($request->all());
        if (!is_array($validator)) {
            $user_id = auth()->user()->id;
            $isReminder_id = Reminders::where(['User_Id' => $user_id, 'id' => $remindersId])->exists();
            if ($isReminder_id) {
                $reminders = Reminders::find($remindersId);
                $reminders->fill($request->all())->save();
                array_push($response, ["status" => "success"]);
            } else {
                array_push($response, ["status" => "error"]);
                array_push($response, ["errors" => "El recordatorio no existe"]);
            }
            return response()->json($response);
        } else {
            return response()->json($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($remindersId): JsonResponse
    {
        $response = [];
        $user_id = auth()->user()->id;
        $isReminder_id = Reminders::where(['User_Id' => $user_id, 'id' => $remindersId])->exists();
        if ($isReminder_id) {
            $reminders = Reminders::find($remindersId);
            $reminders->delete();
            array_push($response, ["status" => "success"]);
        } else {
            array_push($response, ["status" => "error"]);
            array_push($response, ["errors" => "reminder no encontrado"]);
        }
        return response()->json($response);
    }
    public function validated($args)
    {
        $response = [];
        $valadation = Validator::make($args, [
            'Title' => 'required|max:100',
            'Description' => 'required|max:255',
            'Reminder_date' => 'required',
            'Recurrence' => 'required',
        ]);
        if ($valadation->fails()) {
            array_push($response, ['status' => 'error']);
            array_push($response, ['errors' => $valadation->errors()]);
            return $response;
        } else {
            return true;
        }
    }
}
