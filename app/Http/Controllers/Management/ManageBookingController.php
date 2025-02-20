<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\ViewModels\BookingView;
use App\Repositories\Management\ManageBookingRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Services\Management\ManageBookingService;
use Illuminate\Http\Request;

class ManageBookingController extends Controller
{
    protected $service, $repository;

    public function __construct()
    {
        $this->service = new ManageBookingService();
        $this->service = new ManageBookingRepository();
    }

    public function index()
    {
        return view('management.manage-booking.index');
    }

    public function table(Request $request)
    {
        $opr = $this->service->table($request);

        return $opr;
    }

    public function store(Request $request)
    {
        $opr = $this->service->store($request);

        return $opr;
    }

    public function detail($id)
    {
        $opr = $this->service->detail($id);

        return $opr;
    }

    public function edit(Request $request)
    {
        $opr = $this->service->edit($request);

        return $opr;
    }

    public function delete(Request $request)
    {
        $opr = $this->service->delete($request);

        return $opr;
    }

    public function verify(Request $request)
    {
        $opr = $this->service->verify($request);

        return $opr;
    }

    public function exportToExcel(Request $request)
    {
        $data = BookingView::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Headers
        $headers = [
            'No',
            'Code',
            'Booking Date',
            'Departure City',
            'Objective City',
            'Departure Date',
            'Total Payment',
            'Booker Telephone',
            'Booker Email',
            'Booker Name',
            'Transport Name',
            'Status',
        ];

        // Lebar kolom seragam (misal 25 untuk semua kolom)
        foreach (range('B', 'M') as $columnID) {
            $sheet->getColumnDimension($columnID)->setWidth(25);
        }

        // Menulis Header di B1
        $columnLetter = 'B';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '1', $header);
            $columnLetter++;
        }

        // Styling Header
        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'c5e0b3'], // Warna hijau
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $sheet->getStyle('B1:L1')->applyFromArray($headerStyle);

        // Menulis Data Mulai dari B2
        $rowNumber = 2;
        foreach ($data as $index => $item) {
            $sheet->setCellValue('B' . $rowNumber, $index + 1);
            $sheet->setCellValue('C' . $rowNumber, $item->code);
            $sheet->setCellValue('D' . $rowNumber, $item->booking_date);
            $sheet->setCellValue('E' . $rowNumber, $item->departure_city);
            $sheet->setCellValue('F' . $rowNumber, $item->objective_city);
            $sheet->setCellValue('G' . $rowNumber, $item->departure_date);
            $sheet->setCellValue('H' . $rowNumber, $item->total_payment);
            $sheet->setCellValue('I' . $rowNumber, $item->booker_telephone);
            $sheet->setCellValue('J' . $rowNumber, $item->booker_email);
            $sheet->setCellValue('K' . $rowNumber, $item->booker_name);
            $sheet->setCellValue('L' . $rowNumber, $item->transport_name);
            $sheet->setCellValue('M' . $rowNumber, $item->status);
            $rowNumber++;
        }

        // Pusatkan semua data
        $sheet->getStyle('B1:M' . ($rowNumber - 1))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Tambahkan border
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('B1:M' . ($rowNumber - 1))->applyFromArray($borderStyle);

        // Generate File Excel
        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="manage_booking.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
