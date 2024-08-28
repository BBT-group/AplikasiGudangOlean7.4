<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{

    protected $supplierModel;


    public function __construct()
    {

        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        $data = [
            'supplier' => $this->supplierModel->findAll()
        ];
        return view('', $data);
    }

    public function indexTambah()
    {

        return view('');
    }

    public function tambahSupplier()
    {
        if (!$this->validate([
            'supplier' => 'required|is_unique[supplier.id_supplier]'
        ])) {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
        $this->supplierModel->insert(['nama' => $this->request->getVar('nama')]);
        return redirect()->to('');
    }

    public function indexUpdate()
    {
        $data = [
            'satuan' => $this->supplierModel->where('id_penerima', $this->request->getVar('id_penerima'))->first()
        ];
        return view('', $data);
    }

    public function updateSupplier()
    {
        if (!$this->validate([
            'supplier' => 'required|is_not_unique[supplier.id_supplier]'
        ])) {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
        $this->supplierModel->update($this->request->getVar('id_penerima'), ['nama' => $this->request->getVar('nama')]);
        return redirect()->to('');
    }
}
