<?php

namespace App\Controllers;

use App\Models\LaporanInventarisModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_Inventaris extends BaseController
{
    protected $inventarisModel;

    public function __construct()
    {
        $this->inventarisModel = new LaporanInventarisModel();
    }

    public function index()
    {
        $data = [
            'inventaris' => $this->inventarisModel->getInventarisGabung(),
        ];
        echo view('v_header');
        return view('v_laporan_inventaris', $data);
    }

    public function printi()
    {
        $data = [
            'inventaris' => $this->inventarisModel->getInventarisGabung(),
        ];
        echo view('v_print_inventaris', $data);
    }

    public function exporti()
    {
        $data = $this->inventarisModel->getInventarisGabung();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header file
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'LAPORAN STOK INVENTARIS');
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue('A2', 'GUDANG PT. OLEAN PERMATA');

        // Header kolom
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'ID Barang');
        $sheet->setCellValue('C3', 'Nama Barang');
        $sheet->setCellValue('D3', 'Stok');
        $sheet->setCellValue('E3', 'Harga Beli');

        // Data
        $row = 4;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['id_inventaris']);
            $sheet->setCellValue('C' . $row, $item['nama_inventaris']);
            $sheet->setCellValue('D' . $row, $item['stok']);
            $sheet->setCellValue('E' . $row, $item['harga_beli']);
            $row++;
        }

        // Styling header
        $sheet->getStyle('A1:E2')->getFont()->setBold(true);
        $sheet->getStyle('A1:E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Mengubah warna background header
        $sheet->getStyle('A1:E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:E2')->getFill()->getStartColor()->setARGB('34a853');
        $sheet->getStyle('A3:E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A3:E3')->getFill()->getStartColor()->setARGB('b6d7a8');

        // Apply border to the header and data
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:E' . ($row - 1))->applyFromArray($styleArray);

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_stok_barang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
