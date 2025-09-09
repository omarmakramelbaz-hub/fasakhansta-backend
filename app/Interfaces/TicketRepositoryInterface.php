<?php

namespace App\Interfaces;

interface TicketRepositoryInterface 
{
    public function getAllTickets($request);
    public function getTicketById($ticketId);
    public function deleteTicket($ticketId);
    public function createTicket(array $ticketDetails);
    public function updateTicket($ticketId, array $newDetails);
    public function deleteAllTickets($ids);

}