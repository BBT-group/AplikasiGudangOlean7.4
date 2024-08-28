<?php

namespace App\Controllers;

use App\Models\PenerimaModel;

class Penerima extends BaseController
{

    protected $penerimaModel;


    public function __construct()
    {

        $this->penerimaModel = new PenerimaModel();
    }

    public function index()
    {
        $data = [
            'penerima' => $this->penerimaModel->findAll()
        ];
        return view('', $data);
    }

    public function indexTambah()
    {

        return view('');
    }

    public function tambahPenerima()
    {
        if (!$this->validate([
            'penerima' => 'required|is_unique[penerima.id_penerima]'
        ])) {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
        $this->penerimaModel->insert(['nama' => $this->request->getVar('nama')]);
        return redirect()->to('');
    }

    public function indexUpdate()
    {
        $data = [
            'satuan' => $this->penerimaModel->where('id_penerima', $this->request->getVar('id_penerima'))->first()
        ];
        return view('', $data);
    }

    public function updatePenerima()
    {
        if (!$this->validate([
            'penerima' => 'required|is_not_unique[penerima.id_penerima]'
        ])) {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
        $this->penerimaModel->update($this->request->getVar('id_penerima'), ['nama' => $this->request->getVar('nama')]);
        return redirect()->to('');
    }
}
