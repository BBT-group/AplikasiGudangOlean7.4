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
        echo view('v_header');
        return view('v_supplier', $data);
    }

    public function tambahsupplier()
    {

        if ($this->request->getMethod() == 'post') {
            if (!$this->validate([
                'nama' => 'required|is_unique[supplier.nama]'
            ])) {
                // ganti url
                return redirect()->to(base_url('supplier/tambahsupplier'))->withInput();
            }

            $this->supplierModel->insert([
                'nama' => $this->request->getVar('nama'),
                'no_hp' => $this->request->getVar('no')
            ]);
            return redirect()->to(base_url('/supplier'));
        }
        $data['validation'] = validation_list_errors();
        echo view('v_header');
        return view('v_tambah_supplier', $data);
    }
    public function updatesupplier($id = null)

    {
        if ($this->request->getMethod() == 'post') {
            if (!$this->validate([
                'nama' => 'required|is_unique[supplier.nama]'
            ])) {
                // ganti url
                return redirect()->to(base_url('supplier/updatesupplier/' . $id))->withInput();
            }
            $this->supplierModel->update($id, [
                'nama' => $this->request->getVar('nama'),
                'no_hp' => $this->request->getVar('no')
            ]);
            return redirect()->to(base_url('/supplier'));
        }
        $data['validation'] = validation_list_errors();
        $data['supplier'] = $this->supplierModel->where('id_supplier', $id)->first();
        echo view('v_header');
        return view('v_tambah_supplier', $data);
    }
    public function deletesupplier($id)
    {
        $this->supplierModel->delete($id);
        session()->setFlashdata('success', 'supplier berhasil dihapus');
        return redirect()->to(base_url('supplier'));
    }
}
