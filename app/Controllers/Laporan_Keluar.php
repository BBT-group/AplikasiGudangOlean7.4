<?php

namespace App\Controllers;

use App\Models\LaporanKeluarModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_Keluar extends BaseController
{
    protected $barangkeluarModel;

    public function __construct()
    {
        $this->barangkeluarModel = new LaporanKeluarModel();
    }

    public function index(): string
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data['barangkeluar'] = $this->barangkeluarModel->getBarangKeluarGabungFilter($start_date, $end_date);
        } else {
            $data['barangkeluar'] = $this->barangkeluarModel->getBarangKeluarGabung();
        }

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        echo view('v_header');
        return view('v_laporan_keluar', $data);
    }

    public function printk()
    {
    $start_date = $this->request->getGet('start_date');
    $end_date = $this->request->getGet('end_date');

    if ($start_date && $end_date) {
        $data['barangkeluar'] = $this->barangkeluarModel->getBarangKeluarGabungFilter($start_date, $end_date);
    } else {
        $data['barangkeluar'] = $this->barangkeluarModel->getBarangKeluarGabung();
    }

    $data['start_date'] = $start_date;
    $data['end_date'] = $end_date;

    echo view('v_print_keluar', $data);
    }

    public function exportk()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data = $this->barangkeluarModel->getBarangKeluarGabungFilter($start_date, $end_date);
        } else {
            $data = $this->barangkeluarModel->getBarangKeluarGabung();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header file
        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'LAPORAN KELUAR STOK BARANG GUDANG PT.OLEAN PERMATA');
        $sheet->mergeCells('A2:I2');
        $sheet->setCellValue('A2', 'Periode ' . ($start_date ? $start_date : 'Semua') . ' - ' . ($end_date ? $end_date : 'Semua'));

        // Header kolom
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Id Barang Keluar');
        $sheet->setCellValue('C3', 'Tanggal');
        $sheet->setCellValue('D3', 'Nama Barang');
        $sheet->setCellValue('E3', 'Satuan');
        $sheet->setCellValue('F3', 'Nama Penerima');
        $sheet->setCellValue('G3', 'Stok Awal');
        $sheet->setCellValue('H3', 'Jumlah Keluar');
        $sheet->setCellValue('I3', 'Stok Akhir');

        // Data
        $row = 4;
        $no = 1;
        foreach ($data as $item) {
            $stok_awal = $item['stok'] + $item['jumlah']; // Menghitung stok awal

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['id_barang_keluar']);
            
            $datetime = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(new \DateTime($item['waktu']));
            $sheet->setCellValue('C' . $row, $datetime);
            $sheet->getStyle('C' . $row)->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm:ss');

            $sheet->setCellValue('D' . $row, $item['nama_barang']);
            $sheet->setCellValue('E' . $row, $item['nama_satuan']);
            $sheet->setCellValue('F' . $row, $item['nama_penerima']);
            $sheet->setCellValue('G' . $row, $stok_awal); // Mengisi stok awal
            $sheet->setCellValue('H' . $row, $item['jumlah']);
            $sheet->setCellValue('I' . $row, $item['stok']);
            $row++;
        }

        // Styling header
        $sheet->getStyle('A1:I2')->getFont()->setBold(true);
        $sheet->getStyle('A1:I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Mengubah warna background header
        $sheet->getStyle('A1:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:I2')->getFill()->getStartColor()->setARGB('34a853'); // Warna hijau, gunakan kode warna hex RGB 
        $sheet->getStyle('A3:I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A3:I3')->getFill()->getStartColor()->setARGB('b6d7a8'); 

        // Apply border to the header and data
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:I' . ($row - 1))->applyFromArray($styleArray);

        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_keluar_stok_barang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
