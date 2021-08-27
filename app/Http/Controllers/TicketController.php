<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(): View
    {
        return view('tickets.index');
    }
}
