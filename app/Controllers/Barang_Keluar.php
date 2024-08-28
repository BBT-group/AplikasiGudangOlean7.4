<?php

namespace App\Controllers;


use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangKeluarModel;
use App\Models\MasterBarangKeluarModel;
use App\Models\PenerimaModel;

use CodeIgniter\Database\Exceptions\DatabaseException;

class Barang_Keluar extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $barangKeluarModel;
    protected $masterBarangKeluarModel;
    protected $penerimaModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->masterBarangKeluarModel = new MasterBarangKeluarModel();
        $this->penerimaModel = new PenerimaModel();
        $this->dataList = $this->loadExistingData();
    }

    public function index()
    {
        $data = [
            'barang' => session()->get('datalist_keluar'),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_barang_keluar', $data);
    }

    // fungsi tampil detail barang masuk
    public function indexDetailMaster($idBarang)

    {

        $data = [
            // mengambil header ms barang masuk yaitu nama supp, tanggal, id master barang
            'header' => $this->masterBarangKeluarModel->getById($idBarang),
            // mengambil data yang memiliki id ms barang masuk
            'barang' => $this->barangKeluarModel->getByMasterId($idBarang)
        ];
        echo view('v_header');
        // ganti url ke detail
        return view('admin\detailbarangkeluar', $data);
    }



    public function beranda()
    {
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');

        $query = $this->masterBarangKeluarModel;

        if ($startDate && $endDate) {
            $query = $query->where('waktu >=', $startDate . ' 00:00:00')
                ->where('waktu <=', $endDate . ' 23:59:59');
        }

        $data = [
            'keluar' => $query->getAll(),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        echo view('v_header');
        return view('v_beranda_barang_keluar', $data);
    }


    public function loadExistingData()
    {
        return session()->get('datalist_keluar') ?? [];
    }
    function containsObjectWithName($objects, $name)
    {
        if ($objects != null) {
            foreach ($objects as $object) {
                if ($object['id_barang'] == $name) {
                    return true;
                }
            }
        }
        return false;
    }
    public function saveData()
    {
        $idBarang = $this->request->getVar('id_barang');
        if (!$this->containsObjectWithName($this->dataList, $idBarang) || $this->dataList == null) {
            $data2 = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'stok' => 1,
                'stok_awal' =>  $this->request->getVar('stok')
            ];

            $this->dataList[] = $data2;
            session()->set('datalist_keluar', $this->dataList);
            return redirect()->to(base_url('/barang_keluar/index'));
        } else {
            $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_barang', $idBarang)]['stok'] += 1;
            session()->set('datalist_keluar', $this->dataList);
            return redirect()->to(base_url('/barang_keluar/index'));
        }
    }
    public function index2()
    {
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
        } else {
            $barang = $this->barangModel->getBarangWithKategori();
        }
        $data = [
            'barang' => $barang->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_cari_barang_keluar', $data);
    }
    public function clearSession()
    {
        session()->remove('datalist_keluar');
        return redirect()->to(base_url('/barang_keluar'));
    }
    public function updateStok()
    {
        if (!$this->validate([
            'penerima' => 'required'
        ])) {
            return redirect()->to(base_url('/barang_keluar/index'))->withInput();
        }
        $barang = session()->get('datalist_keluar');
        if (!empty($barang)) {
            $db = \Config\Database::connect();

            try {
                // Set the isolation level if needed
                $db->query("SET TRANSACTION ISOLATION LEVEL READ COMMITTED"); // Change as required

                // Start the transaction
                $db->transBegin();

                $namaPenerima = $this->request->getVar('penerima');
                if ($this->penerimaModel->where('nama', $namaPenerima)->first() == null) {
                    $penerimaId = $this->penerimaModel->insert(['nama' =>
                    $namaPenerima], true);
                } else {
                    $penerima = $this->penerimaModel->where('nama', $namaPenerima)->first();
                    $penerimaId = $penerima['id_penerima'];
                }
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime =  date("Y-m-d H:i:s");

                if (!$this->masterBarangKeluarModel->insert(['waktu' => $currentDateTime, 'id_penerima' => $penerimaId, 'keterangan' => $this->request->getVar('keterangan')])) {
                    throw new DatabaseException('gagal insert master barang keluar');
                }

                $idms = $this->masterBarangKeluarModel->getInsertID();


                foreach ($barang as $b) {
                    $barang1 = $this->barangModel->where('id_barang', $b['id_barang'])->first();
                    $sisa = $barang1['stok'] - $b['stok'];
                    if ($sisa < 0 || $b <= 0) {
                        // If the post insert fails, rollback transaction
                        throw new DatabaseException('Failed to insert post: kurang dari 0');
                    }
                    $data = [
                        'nama' => $barang1['nama'],
                        'id_satuan' => $barang1['id_satuan'],
                        'foto' => $barang1['foto'],
                        'stok' => $sisa,
                        'harga_beli' => $barang1['harga_beli'],
                        'id_kategori' => $barang1['id_kategori'],
                    ];

                    if (!$this->barangModel->update($b['id_barang'], $data)) {
                        // If the post insert fails, rollback transaction
                        throw new DatabaseException('Failed to insert post: ' . implode(', ', $this->barangModel->errors()));
                    }

                    if (!$this->barangKeluarModel->insert(['id_barang' => $barang1['id_barang'], 'id_ms_barang_keluar' => $idms, 'jumlah' => $b['stok'], 'stok_awal' => $barang1['stok']])) {
                        // If the post insert fails, rollback transaction
                        throw new DatabaseException('Failed to insert post: ' . implode(', ', $this->barangKeluarModel->errors()));
                    }
                }


                // Commit the transaction
                if ($db->transStatus() === FALSE) {
                    // If something went wrong, rollback transaction
                    $db->transRollback();
                    throw new DatabaseException('Transaction failed.');
                } else {
                    // Otherwise, commit the transaction
                    $db->transCommit();

                    session()->remove('datalist_keluar');
                    session()->setFlashdata('message', 'Transaction successful.');
                    return redirect()->to(base_url('/barang_keluar'))->withInput();
                }
            } catch (DatabaseException $e) {
                // Rollback transaction on any exception
                $db->transRollback();

                session()->setFlashdata('error', 'Transaction failed: ' . $e->getMessage());
                return redirect()->to(base_url('/barang_keluar/index'))->withInput();
            }
        } else {
            session()->setFlashdata('error', 'data kosong');
            return redirect()->to(base_url('/barang_keluar/index'))->withInput();
        }
    }
    public function update()
    {
        $session = session();
        $datalist = $session->get('datalist_keluar') ?? [];

        $index = $this->request->getPost('index');
        $column = $this->request->getPost('column');
        $value = $this->request->getPost('value');

        if (isset($datalist[$index])) {
            $datalist[$index][$column] = $value;
            $session->set('datalist_keluar', $datalist);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function getColumnValueIndices(array $array, string $column, $value)
    {
        foreach ($array as $index => $item) {
            if (isset($item[$column]) && $item[$column] == $value) {
                return $index;
            }
        }
    }

    public function hapusBarangDatalistKeluar()
    {
        $session = session();
        $items = $session->get('datalist_keluar') ?? [];

        $index = $this->request->getPost('index');

        if (isset($items[$index])) {
            unset($items[$index]);
            $session->set('datalist_keluar', $items);
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    public function cariStok()
    {
        $idBarang = $this->request->getPost('idBarang');
        if ($idBarang != null) {
            $a = $this->barangModel->getBarangWithSatuan($idBarang)->first();
            if ($a == null) {
                session()->set('id_barang_temp', $idBarang);
                return $this->response->setJSON([
                    'status' => 'not_found',
                    'message' => 'Item not found. Please go to the input form to add this item.'
                ]);
            }
            if ($this->containsObjectWithName($this->dataList, $idBarang)) {
                $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_barang', $idBarang)]['stok'] += 1;
                session()->set('datalist_keluar', $this->dataList);
                return $this->response->setJSON(['status' => 'success']);
            }
            $data2 = [
                'id_barang' => $idBarang,
                'nama' => $a['nama'],
                'satuan' => $a['nama_satuan'],
                // 'merk' => $a('merk'),
                'stok' => 1,
                'stok_awal' =>  $a['stok'],
            ];
            $this->dataList[] = $data2;
            session()->set('datalist_keluar', $this->dataList);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'eror']);
        }
    }
}
