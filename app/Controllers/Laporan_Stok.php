<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LaporanStokModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_Stok extends BaseController
{
    protected $stokModel;

    public function __construct()
    {
        $this->stokModel = new LaporanStokModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search') ?? '';
        $data = [
            'barang' => $this->stokModel->getBarangGabung($search),
            'search' => $search
        ];
        echo view('v_header');
        return view('v_laporan_stok', $data);
    }

    public function prints()
    {
        $data = [
            'barang' => $this->stokModel->getBarangGabung(),
        ];
        echo view('v_print_stok', $data);
    }
    
    public function exports()
    {
        $data = $this->stokModel->getBarangGabung();
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set header file
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN STOK BARANG GUDANG ');
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'PT.OLEAN PERMATA');
    
        // Header kolom
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'ID Barang');
        $sheet->setCellValue('C3', 'Nama Barang');
        $sheet->setCellValue('D3', 'Kategori');
        $sheet->setCellValue('E3', 'Stok');
        $sheet->setCellValue('F3', 'Satuan');
        $sheet->setCellValue('G3', 'Harga Beli');
    
        // Data
        $row = 4;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['id_barang']);
            $sheet->setCellValue('C' . $row, $item['nama']);
            $sheet->setCellValue('D' . $row, $item['nama_kategori']);
            $sheet->setCellValue('E' . $row, $item['stok']);
            $sheet->setCellValue('F' . $row, $item['nama_satuan']);
            $sheet->setCellValue('G' . $row, $item['harga_beli']);
            
            $row++;
        }
    
        // Styling header
        $sheet->getStyle('A1:G2')->getFont()->setBold(true);
        $sheet->getStyle('A1:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
        // Mengubah warna background header
        $sheet->getStyle('A1:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:G2')->getFill()->getStartColor()->setARGB('34a853'); // Warna hijau, gunakan kode warna hex RGB 
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
    
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_stok_barang.xlsx';
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
        exit;
    }
    
}
