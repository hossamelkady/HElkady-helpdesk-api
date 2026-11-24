<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Ticket::query()->latest()->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'subject' => 'required|string|max:180',
            'requester_email' => 'required|email|max:255',
            'description' => 'required|string|max:10000',
            'priority' => 'sometimes|in:low,normal,high,urgent',
            'status' => 'sometimes|in:open,in_progress,waiting,resolved',
            'assignee' => 'nullable|string|max:160'
        ]);

        $record = Ticket::create($data);
        return response()->json(['data' => $record], 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json(['data' => $ticket]);
    }

    public function update(Request $request, Ticket $ticket): JsonResponse
    {
        $data = $request->validate(['subject' => 'sometimes|string|max:180', 'requester_email' => 'sometimes|email|max:255', 'description' => 'sometimes|string|max:10000', 'priority' => 'sometimes|in:low,normal,high,urgent', 'status' => 'sometimes|in:open,in_progress,waiting,resolved', 'assignee' => 'nullable|string|max:160']);
        $ticket->update($data);
        return response()->json(['data' => $ticket->refresh()]);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();
        return response()->json([], 204);
    }
}
