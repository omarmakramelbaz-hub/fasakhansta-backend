<?php

namespace App\Exports;

use App\Models\UserPackage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Carbon\Carbon;
class ExportPackages implements FromCollection, WithMapping ,WithEvents, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $packages = UserPackage::query();
        if(! empty(request('q'))){
            if(request('q') == 'daily'){
                $packages = $packages->whereDay('created_at', now()->day);
            }
            elseif(request('q') == 'weekly'){
                $packages = $packages->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)]);

            }
            elseif(request('q') == 'monthly'){
                $packages = $packages->whereMonth('created_at', Carbon::now()->month);

            }
            elseif(request('q') == 'yearly'){
                $packages = $packages->whereYear('created_at', Carbon::now()->year);

            }
        }
        $packages = $packages->orderBy('id','DESC')->get();

        return $packages;
    }
    public function map($package) : array {
        return [
            $package->user?->name,
            $package->package?->title,
            $package->package_price?->name,
            $package->package_price?->price,
            $package->created_at,
            $package->expire_at,
            (\Carbon\Carbon::parse($package->expire_at))->diffInDays(\Carbon\Carbon::parse($package->created_at)),
        ] ;
 
 
    }
    public function headings(): array
    {
        return [
            'packageUserName',
            'packageTitle',
            'packageType',
            'packagePrice',
            'created_at',
            'expire_at',
            'days_diff',
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