<?php

namespace App\Controllers;

use App\Models\LaporanPeminjamanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_Peminjaman extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new LaporanPeminjamanModel();
    }

    public function index(): string
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data['peminjaman'] = $this->peminjamanModel->getPeminjamanGabungFilter($start_date, $end_date);
        } else {
            $data['peminjaman'] = $this->peminjamanModel->getPeminjamanGabung();
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        echo view('v_header');
        return view('v_laporan_peminjaman', $data);
    }

    public function printp()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data['peminjaman'] = $this->peminjamanModel->getPeminjamanGabungFilter($start_date, $end_date);
        } else {
            $data['peminjaman'] = $this->peminjamanModel->getPeminjamanGabung();
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        echo view('v_print_peminjaman', $data);
    }

    public function exportp()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data = $this->peminjamanModel->getPeminjamanGabungFilter($start_date, $end_date);
        } else {
            $data = $this->peminjamanModel->getPeminjamanGabung();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header file
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN PEMINJAMAN ALAT GUDANG PT.OLEAN PERMATA');
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Periode ' . ($start_date ? $start_date : 'Semua') . ' - ' . ($end_date ? $end_date : 'Semua'));

        // Header kolom
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'ID Peminjaman');
        $sheet->setCellValue('C3', 'Tanggal Pinjam');
        $sheet->setCellValue('D3', 'Nama Alat');
        $sheet->setCellValue('E3', 'Jumlah');
        $sheet->setCellValue('F3', 'Nama Penerima');
        $sheet->setCellValue('G3', 'Tanggal Kembali');

        // Data
        $row = 4;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['id_peminjaman']);
            $sheet->setCellValue('C' . $row, $item['tanggal_pinjam'] ? date('d/m/Y H:i:s', strtotime($item['tanggal_pinjam'])) : '-');
            $sheet->setCellValue('D' . $row, $item['nama_inventaris']);
            $sheet->setCellValue('E' . $row, $item['jumlah']);
            $sheet->setCellValue('F' . $row, $item['nama_penerima']);
            $sheet->setCellValue('G' . $row, $item['tanggal_kembali'] ? date('d/m/Y H:i:s', strtotime($item['tanggal_kembali'])) : '-');
            $row++;
        }

        // Styling header
        $sheet->getStyle('A1:G2')->getFont()->setBold(true);
        $sheet->getStyle('A1:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Mengubah warna background header
        $sheet->getStyle('A1:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:G2')->getFill()->getStartColor()->setARGB('34a853'); // Warna hijau
        $sheet->getStyle('A3:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A3:G3')->getFill()->getStartColor()->setARGB('b6d7a8'); 

        // Apply border to the header and data
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:G' . ($row - 1))->applyFromArray($styleArray);

        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_peminjaman_alat_gudang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
