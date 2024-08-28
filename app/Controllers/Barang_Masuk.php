<?php

namespace App\Controllers;


use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangMasukModel;
use App\Models\InventarisModel;
use App\Models\MasterBarangMasukModel;
use App\Models\SatuanModel;
use App\Models\SupplierModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use function PHPUnit\Framework\isEmpty;

class Barang_Masuk extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $barangMasukModel;
    protected $masterBarangMasukModel;
    protected $supplierModel;
    protected $inventarisModel;
    protected $satuanModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->satuanModel = new SatuanModel();
        $this->barangMasukModel = new BarangMasukModel();
        $this->masterBarangMasukModel = new MasterBarangMasukModel();
        $this->inventarisModel = new InventarisModel();
        $this->supplierModel = new SupplierModel();
        $this->dataList = $this->loadExistingData();
    }

    public function index()
    {
        $data = [
            'barang' => session()->get('datalist'),
        ];
        echo view('v_header');
        return view('v_barang_masuk', $data);
    }

    // fungsi tampil detail barang masuk
    public function indexDetailMaster($id)
    {

        $data = [
            // mengambil header ms barang masuk yaitu nama supp, tanggal, id master barang
            'header' => $this->masterBarangMasukModel->getById($id),
            // mengambil data yang memiliki id ms barang imasuk
            'barang' => $this->barangMasukModel->getByMasterId($id),
            'inventaris' => $this->barangMasukModel->getAlatByMasterId($id)
        ];

        echo view('v_header');
        // ganti url ke detail
        return view('admin/detailbarangmasuk', $data);
    }
    public function beranda()
    {
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');

        if ($startDate && $endDate) {
            $masuk = $this->masterBarangMasukModel->getBarangMasukGabungFilter($startDate, $endDate);
        } else {
            $masuk = $this->masterBarangMasukModel->getAll()->findAll();
        }

        $data = [
            'masuk' => $masuk,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        echo view('v_header');
        return view('v_beranda_barang_masuk', $data);
    }


    public function loadExistingData()
    {
        session();

        return session()->get('datalist') ?? [];
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
                // 'merk' => $this->request->getVar('merk'),
                'jenis' => $this->request->getVar('jenis'),
                'stok' => 1,
                'harga_beli' => $this->request->getVar('harga_beli'),
                // 'id_kategori' => $this->request->getVar('id_kategori'),
            ];
            $this->dataList[] = $data2;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang_masuk/index'));
        } else {
            $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_barang', $idBarang)]['stok'] += 1;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang_masuk/index'));
        }
    }
    public function index2()
    {
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
            $inventaris = $this->inventarisModel->getByName($keyword);
        } else {
            $barang = $this->barangModel->getBarangWithKategori();
            $inventaris = $this->inventarisModel;
        }
        $data = [
            'barang' => $barang->findAll(),
            'inventaris' => $inventaris->findAll(),
        ];
        echo view('v_header');
        return view('v_cari_barang_masuk', $data);
    }

    public function clearSession()
    {
        session()->remove('datalist');
        return redirect()->to(base_url('/barang_masuk'));
        // return json_encode($this->barangModel->findAll());
    }
    public function updateStok()
    {
        if (!$this->validate([
            'nama_supplier' => 'required'
        ])) {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }

        $barang = session()->get('datalist');
        if (!empty($barang)) {
            $db = \Config\Database::connect();
            try {
                // Set the isolation level if needed
                $db->query("SET TRANSACTION ISOLATION LEVEL READ COMMITTED"); // Change as required

                // Start the transaction
                $db->transBegin();

                $namasupplier = $this->request->getVar('nama_supplier');
                $newSupp = $this->supplierModel->where('nama', $namasupplier)->first();
                if ($newSupp == null) {
                    if (!$this->supplierModel->insert(['nama' => $namasupplier], true)) {
                        throw new DatabaseException('Failed to insert master barang masuk post: ' . implode(', ', $this->masterBarangMasukModel->errors()));
                    }
                    $suppId = $this->supplierModel->getInsertID();
                } else {
                    $suppId = $newSupp['id_supplier'];
                }

                $currentDateTime =  date("Y-m-d H:i:s");

                if (!$this->masterBarangMasukModel->insert(['waktu' => $currentDateTime, 'id_supplier' => $suppId, 'keterangan' => $this->request->getVar('keterangan')])) {
                    throw new DatabaseException('Failed to insert master barang masuk post: ' . implode(', ', $this->masterBarangMasukModel->errors()));
                }
                $idms = $this->masterBarangMasukModel->getInsertID();

                foreach ($barang as $b) {
                    if ($b <= 0) {
                        // If the post insert fails, rollback transaction
                        throw new DatabaseException('Failed to insert post: kurang dari 0');
                    }
                    if ($b['jenis'] == 'barang') {
                        if ($b['harga_beli'] < 1000) {
                            throw new DatabaseException('harga beli minimal 1000');
                        }
                        $barang1 = $this->barangModel->where('id_barang', $b['id_barang'])->first();
                        $data = [
                            'nama' => $barang1['nama'],
                            'id_satuan' => $barang1['id_satuan'],
                            'foto' => $barang1['foto'],

                            'stok' => $barang1['stok'] + $b['stok'],
                            'harga_beli' => $b['harga_beli'],
                            'id_kategori' => $barang1['id_kategori'],
                        ];

                        if (!$this->barangModel->update($b['id_barang'], $data)) {
                            throw new DatabaseException('Failed to barang model insert post: ' . implode(', ', $this->barangModel->errors()));
                        }

                        if (!$this->barangMasukModel->insert(['id_barang' => $barang1['id_barang'], 'id_ms_barang_masuk' => $idms, 'jumlah' => $b['stok'], 'stok_awal' => $barang1['stok']])) {
                            throw new DatabaseException('Failed to  barang masuk 1 insert post: ' . implode(', ', $this->barangMasukModel->errors()));
                        }
                    } elseif ($b['jenis'] == 'alat') {
                        if ($b['harga_beli'] < 1000) {
                            throw new DatabaseException('harga beli minimal 1000');
                        }
                        $barang1 = $this->inventarisModel->where('id_inventaris', $b['id_barang'])->first();
                        $data = [
                            'nama_inventaris' => $barang1['nama_inventaris'],
                            'foto' => $barang1['foto'],
                            'stok' => $barang1['stok'] + $b['stok'],
                            'harga_beli' => $b['harga_beli'],
                        ];

                        if (!$this->inventarisModel->update($b['id_barang'], $data)) {
                            throw new DatabaseException('Failed to insert inventaris post: ' . implode(', ', $this->inventarisModel->errors()));
                        }

                        if (!$this->barangMasukModel->insert(['id_inventaris' => $barang1['id_inventaris'], 'id_ms_barang_masuk' => $idms, 'jumlah' => $b['stok'], 'stok_awal' => $barang1['stok']])) {
                            throw new DatabaseException('Failed to insert barang masuk 2 post: ' . implode(', ', $this->barangMasukModel->errors()));
                        }
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
                    session()->remove('datalist');
                    session()->setFlashdata('message', 'Transaction successful.');
                    return redirect()->to(base_url('/barang_masuk'));
                }
            } catch (DatabaseException $e) {
                // Rollback transaction on any exception
                $db->transRollback();
                session()->setFlashdata('error', 'Transaction failed: ' . $e->getMessage());
                return redirect()->to(base_url('/barang_masuk/index'))->withInput();
            }
        } else {
            session()->setFlashdata('error', 'data kosong');
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
    }
    public function update()
    {
        $session = session();
        $datalist = $session->get('datalist') ?? [];

        $index = $this->request->getPost('index');
        $column = $this->request->getPost('column');
        $value = $this->request->getPost('value');

        if (isset($datalist[$index])) {
            $datalist[$index][$column] = $value;
            $session->set('datalist', $datalist);
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


    public function cariStok()
    {

        $idBarang = $this->request->getVar('idBarang');

        if (($idBarang != null)) {
            $a = $this->barangModel->getBarangById($idBarang);
            $jenis = 'barang';
            if ($a == null) {
                $a = $this->inventarisModel->where('id_inventaris', $idBarang)->first();
                $jenis = 'alat';
            }

            if ($a == null) {
                session()->set('id_temp', $idBarang);
                return $this->response->setJSON([
                    'status' => 'not_found',
                    'message' => 'Item not found. Please go to the input form to add this item.',
                    'a' => $a,
                    'b' => $this->barangModel->getBarangById(
                        60523110565
                    ),
                    'c' => $this->inventarisModel->getById($idBarang)->first(),
                    'd' => strlen(60523110565),


                ]);
            }
            if ($this->containsObjectWithName($this->dataList, $idBarang)) {
                $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_barang', $idBarang)]['stok'] += 1;
                session()->set('datalist', $this->dataList);
                return $this->response->setJSON(['status' => 'success']);
            }
            if ($jenis == 'barang') {
                $data2 = [
                    'id_barang' => $a['id_barang'],
                    'nama' => $a['nama'],
                    'satuan' => $a['nama_satuan'],
                    'jenis' => $jenis,
                    'stok' => 1,
                    'harga_beli' => $a['harga_beli'],
                    // 'id_kategori' => $a('id_kategori'),
                ];
            } elseif ($jenis == 'alat') {
                $data2 = [
                    'id_barang' => $a['id_inventaris'],
                    'nama' => $a['nama_inventaris'],
                    'satuan' => 'alat',
                    'jenis' => $jenis,
                    'stok' => 1,
                    'harga_beli' => $a['harga_beli'],
                    // 'id_kategori' => $a('id_kategori'),
                ];
            }

            $this->dataList[] = $data2;
            session()->set('datalist', $this->dataList);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'eror']);
        }
    }
    public function hapusBarangDatalistMasuk()
    {
        $session = session();
        $items = $session->get('datalist') ?? [];

        $index = $this->request->getPost('index');

        if (isset($items[$index])) {
            unset($items[$index]);
            $session->set('datalist', $items);
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    public function doubleForm()
    {

        $data = [
            'satuan' => $this->satuanModel->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_tambah_alat_barang', $data);
    }

    public function cariMaster() {}
}
