<?php

namespace App\Exports;

use App\Models\ValetTracker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Carbon\Carbon;
class ExportValetTrackers implements FromCollection, WithMapping ,WithEvents, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $trackers = ValetTracker::query();
        if(! empty(request('valet'))){
            $trackers = $trackers->where('user_id', request('valet') );
        }
        if(! empty(request('online'))){
            $online = request('online');
            $trackers = $trackers->whereHas('user_id', function($q) use ($online){
                $q->where('online', $online);
            });
        }
        $trackers = $trackers->orderBy('id','DESC')->get();
        return $trackers;
    }
    public function map($tracker) : array {
        return [
            $tracker->id,
            $tracker->valet?->name,
            $tracker->from_date,
            $tracker->to_date,
        ] ;
 
 
    }
    public function headings(): array
    {
        return [
            'id',
            'username',
            'from date',
            'to date',
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