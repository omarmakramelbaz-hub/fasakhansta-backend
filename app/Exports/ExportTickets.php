<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Carbon\Carbon;
class ExportTickets implements FromCollection, WithMapping ,WithEvents, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $tickets = Ticket::query();
        if(! empty(request('q'))){
            if(request('q') == 'daily'){
                $tickets = $tickets->whereDay('entry_date', now()->day);
            }
            elseif(request('q') == 'weekly'){
                $tickets = $tickets->whereBetween('entry_date', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)]);

            }
            elseif(request('q') == 'monthly'){
                $tickets = $tickets->whereMonth('entry_date', Carbon::now()->month);

            }
            elseif(request('q') == 'yearly'){
                $tickets = $tickets->whereYear('entry_date', Carbon::now()->year);

            }
        }
        $tickets = $tickets->latest()->get();

        return $tickets;
    }
    public function map($ticket) : array {
        return [
            $ticket->id,
            __('main.'.$ticket->status),
            $ticket->user?->name,
            $ticket->user_mobile,
            $ticket->car_type?->car_plate,
            $ticket->car_type?->car_model,
            $ticket->car_type?->car_color,
            $ticket->category_type?->title,
            $ticket->category?->title,
            $ticket->slot?->title,
            $ticket->entry_date,
            $ticket->exit_date,
            $ticket->is_print,
        ] ;
 
 
    }
    public function headings(): array
    {
        return [
            'ticket_no',
            'status',
            'username',
            'usermobile',
            'car_plate',
            'car_model',
            'car_color',
            'category type',
            'category',
            'slot',
            'entry date',
            'exit date',
            'is_print',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:I1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('fae71b');
  
            },
        ];
    }
}