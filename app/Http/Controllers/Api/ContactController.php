<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ContactsRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService){
        $this->contactService = $contactService;
    }

    // Send message from contacts page
    public function send_message(ContactsRequest $request){
        // Validate sended datas
        $validated = $request->validated();

        $data = $request->all();

        $this->contactService->store($data);

        // Return success response
        return response()->json([
            'status' => true
        ]);
    }
}
