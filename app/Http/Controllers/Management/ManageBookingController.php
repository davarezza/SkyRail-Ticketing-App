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

        $headers = [
            'No',
            'Code',
            'Booking Date',
            'Departure City',
            'Objective City',
            'Departure Date',
            'Transport Name',
            'Booker Name',
            'Booker Telephone',
            'Booker Email',
            'Total Payment',
            'Status',
        ];

        $columnWidths = [
            'C' => 30,
            'D' => 24,
            'E' => 26,
            'F' => 26,
            'G' => 24,
            'H' => 30,
            'I' => 28,
            'J' => 20,
            'K' => 35,
            'L' => 20,
            'M' => 20,
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        $columnLetter = 'B';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '2', $header);
            $columnLetter++;
        }

        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'c5e0b3'],
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $sheet->getStyle('B2:M2')->applyFromArray($headerStyle);

        $rowNumber = 3;
        foreach ($data as $index => $item) {
            $statusMapping = [
                'draft' => 'Draft',
                'select_seat' => 'Select Seat',
                'waiting_payment' => 'Waiting Payment',
                'paid' => 'Paid',
                'expired' => 'Expired',
            ];
            $formattedStatus = $statusMapping[$item->status] ?? ucfirst($item->status);

            $bookingDate = \Carbon\Carbon::parse($item->booking_date)->format('d F Y');
            $departureDate = \Carbon\Carbon::parse($item->departure_date)->format('d F Y');

            $formattedTotalPayment = 'IDR ' . number_format($item->total_payment, 0, ',', '.');

            $sheet->setCellValue('B' . $rowNumber, $index + 1);
            $sheet->setCellValue('C' . $rowNumber, $item->code);
            $sheet->setCellValue('D' . $rowNumber, $bookingDate);
            $sheet->setCellValue('E' . $rowNumber, $item->departure_city);
            $sheet->setCellValue('F' . $rowNumber, $item->objective_city);
            $sheet->setCellValue('G' . $rowNumber, $departureDate);
            $sheet->setCellValue('H' . $rowNumber, $item->transport_name);
            $sheet->setCellValue('I' . $rowNumber, $item->booker_name);
            $sheet->setCellValue('J' . $rowNumber, $item->booker_telephone);
            $sheet->setCellValue('K' . $rowNumber, $item->booker_email);
            $sheet->setCellValue('L' . $rowNumber, $formattedTotalPayment);
            $sheet->setCellValue('M' . $rowNumber, $formattedStatus);

            $rowNumber++;
        }

        $sheet->getStyle('B2:M' . ($rowNumber - 1))->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('B2:M' . ($rowNumber - 1))->applyFromArray($borderStyle);

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
