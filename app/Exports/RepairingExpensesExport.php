<?php

namespace App\Exports;

use App\Models\RepairingExpense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class RepairingExpensesExport implements FromCollection, WithHeadings, WithColumnFormatting, WithEvents,WithStyles,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $vehicle_number;
    protected $driver;
    protected $pno_number;
    protected $cost;
    protected $repair_date;

    public function __construct($vehicle_number='',$driver='',$pno_number='',$repair_date=''){
        $this->vehicle_number = $vehicle_number;
        $this->driver = $driver;
        $this->pno_number = $pno_number;
        $this->repair_date = $repair_date;
    }

    public function collection()
    {
        return RepairingExpense::all();
    }

    public function headings(): array
    {
        return [
            'Vehicle Number',
            'Driver',
            'PNO Number',
            'Cost',
            'Repair Date'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@',
            'B' => '@',
            'C' => '@',
            'D' => '@',
            'E' => '@'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }

    public function map($row): array
    {
        return [
            getVehicleRegstrationId($row->vehicle_id), 
            getUserName($row->driver_id), 
            getUserPnoNumber($row->driver_id), 
            'Rs. ' . number_format($row->cost, 2),
            date('F d, Y',strtotime($row->repair_date))
        ];
    }
}
