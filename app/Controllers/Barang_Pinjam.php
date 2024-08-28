<?php

namespace App\Controllers;

use App\Models\InventarisModel;
use App\Models\MasterPeminjamanModel;
use App\Models\PeminjamanModel;
use App\Models\PenerimaModel;

use CodeIgniter\Database\Exceptions\DatabaseException;

use function PHPUnit\Framework\isEmpty;

class Barang_Pinjam extends BaseController
{
    protected $peminjamanModel;
    protected $penerimaModel;
    protected $masterPeminjamanModel;
    protected $inventarisModel;
    protected $dataList;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->penerimaModel = new PenerimaModel();
        $this->masterPeminjamanModel = new MasterPeminjamanModel();
        $this->inventarisModel = new InventarisModel();
        $this->dataList = session()->get('datalist_pinjam') ?? [];
    }

    public function index()
    {

        $data = [
            'pinjam' => session()->get('datalist_pinjam'),
        ];
        echo view('v_header');
        return view('v_peminjaman', $data);
    }
    public function indexDetailMaster($id)
    {
        $idBarang = $this->request->getVar('id_ms_barang_keluar');
        $data = [
            // mengambil header ms barang masuk yaitu nama supp, tanggal, id master barang
            'header' => $this->masterPeminjamanModel->getById($id),
            // mengambil data yang memiliki id ms barang masuk
            'barang' => $this->peminjamanModel->getByMasterId($id)
        ];
        echo view('v_header');
        return view('admin\detailpeminjaman', $data);
    }

    public function index2()
    {
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->inventarisModel->getByName($keyword);
        } else {
            $barang = $this->inventarisModel;
        }
        $data = [
            'barang' => $barang->findAll()
        ];
        echo view('v_header');
        return view('v_cari_peminjaman', $data);
    }

    public function indexCari()
    {
        echo view('v_header');
        return view('v_cari_peminjaman');
    }

    public function beranda()
    {
        // $keyword = $this->request->getVar('search');
        // if ($keyword) {
        //     $masuk = $this->masterBarangMasukModel->getBarangByName($keyword);
        // } else {
        //     $masuk = $this->masterBarangMasukModel;
        // }
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');

        $query = $this->masterPeminjamanModel->getAllWithNama();

        if ($startDate) {
            $query = $query->where('tanggal_pinjam >=', $startDate);
        }

        if ($endDate) {
            $query = $query->where('tanggal_pinjam <=', $endDate);
        }

        $data = [
            'pinjam' => $query->findAll(),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        echo view('v_header');
        return view('v_beranda_peminjaman', $data);
    }


    function containsObjectWithName($objects, $name)
    {
        if ($objects != null) {
            foreach ($objects as $object) {
                if ($object['id_inventaris'] == $name) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }

    public function clearSession()
    {
        session()->remove('datalist_pinjam');
        // ganti link
        return redirect()->to(base_url('/barang_pinjam'));
        // return json_encode($this->inventarisModel->findAll());
    }

    public function getColumnValueIndices(array $array, string $column, $value)
    {
        foreach ($array as $index => $item) {
            if (isset($item[$column]) && $item[$column] == $value) {
                return $index;
            }
        }
    }

    public function saveData()
    {
        $idInventaris = $this->request->getVar('id_inventaris');
        if (!$this->containsObjectWithName($this->dataList, $idInventaris) || $this->dataList == null) {
            $data2 = [
                'id_inventaris' => $this->request->getVar('id_inventaris'),
                'nama_inventaris' => $this->request->getVar('nama_inventaris'),
                // 'jenis' => $this->request->getVar('jenis'),
                'stok' => 1,
                'stok_awal' =>  $this->request->getVar('stok'),
            ];
            $this->dataList[] = $data2;
            session()->set('datalist_pinjam', $this->dataList);
            return redirect()->to(base_url('/barang_pinjam/index'));
        } else {
            $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_inventaris', $idInventaris)]['stok'] += 1;
            session()->set('datalist_pinjam', $this->dataList);
            return redirect()->to(base_url('/barang_pinjam/index'));
        }
    }

    public function updateStok()
    {
        if (!$this->validate([
            'nama_penerima' => 'required'
        ])) {
            // ganti url
            return redirect()->to(base_url('/barang_pinjam/index'))->withInput();
        }


        $barang = session()->get('datalist_pinjam');
        if (!empty($barang)) {
            $db = \Config\Database::connect();


            try {
                // Set the isolation level if needed
                $db->query("SET TRANSACTION ISOLATION LEVEL READ COMMITTED"); // Change as required

                // Start the transaction
                $db->transBegin();


                $namaPenerima = $this->request->getVar('nama_penerima');
                if ($this->penerimaModel->where('nama', $namaPenerima)->first() == null) {
                    $penerimaId = $this->penerimaModel->insert(['nama' => $namaPenerima]) ? $this->penerimaModel->getInsertID() : throw new DatabaseException('Failed to insert post:gagal menambah master' . implode(', ', $this->masterPeminjamanModel->errors()));
                } else {
                    $penerima = $this->penerimaModel->where('nama', $namaPenerima)->first();
                    $penerimaId = $penerima['id_penerima'];
                }
                $keterangan = $this->request->getVar('keterangan');
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime =  date("d-m-Y H:i:s");
                if (!$this->masterPeminjamanModel->insert(['tanggal_pinjam' => $currentDateTime, 'id_penerima' => $penerimaId, 'keterangan' => $keterangan])) {
                    throw new DatabaseException('Failed to insert post:gagal menambah master' . implode(', ', $this->masterPeminjamanModel->errors()));
                }

                $idms = $this->masterPeminjamanModel->getInsertID();

                foreach ($barang as $b) {

                    $barang1 = $this->inventarisModel->where('id_inventaris', $b['id_inventaris'])->first();

                    $sisa = $barang1['stok'] - $b['stok'];
                    if ($sisa < 0 || $b['stok'] <= 0) {
                        // If the post insert fails, rollback transaction
                        throw new DatabaseException('Failed to insert post: kurang dari 0');
                    }
                    $data = [
                        'nama_inventaris' => $barang1['nama_inventaris'],
                        'foto' => $barang1['foto'],
                        'stok' => $sisa,
                    ];

                    if (!$this->inventarisModel->update($barang1['id_inventaris'], $data)) {
                        throw new DatabaseException('Failed to insert post: gagal update data alat');
                    }
                    if (!$this->peminjamanModel->insert(['id_inventaris' => $barang1['id_inventaris'], 'id_ms_peminjaman' => $idms, 'jumlah' => $b['stok'], 'stok_awal' => $barang1['stok']])) {
                        throw new DatabaseException('Failed to insert post: gagla update peminjaman');
                    }
                } // Commit the transaction
                if ($db->transStatus() === FALSE) {
                    // If something went wrong, rollback transaction
                    $db->transRollback();
                    throw new DatabaseException('Transaction failed.');
                } else {
                    // Otherwise, commit the transaction
                    $db->transCommit();

                    session()->remove('datalist_pinjam');
                    session()->setFlashdata('message', 'Transaction successful.');
                    // ganti url
                    return redirect()->to(base_url('/barang_pinjam'))->withInput();
                }
            } catch (DatabaseException $e) {
                // Rollback transaction on any exception
                $db->transRollback();
                session()->setFlashdata('error', 'Transaction failed: ' . $e->getMessage());
                return redirect()->to(base_url('/barang_pinjam/index'))->withInput();
            }
        } else {
            // ganti url
            session()->setFlashdata('error', 'data kosong');
            return redirect()->to(base_url('/barang_pinjam/index'))->withInput();
        }
    }

    public function update()
    {
        $session = session();
        $datalist = $session->get('datalist_pinjam') ?? [];

        $index = $this->request->getPost('index');
        $column = $this->request->getPost('column');
        $value = $this->request->getPost('value');

        if (isset($datalist[$index])) {
            $datalist[$index][$column] = $value;
            $session->set('datalist_pinjam', $datalist);
        }

        return $this->response->setJSON(['status' => 'success']);
    }




    public function cariStok()
    {
        $idInventaris = $this->request->getVar('idBarang');

        if ($idInventaris != null) {

            $a = $this->inventarisModel->where(
                'id_inventaris',
                $idInventaris
            )->first();
            if ($a == null) {
                session()->set('id_temp', $idInventaris);
                return $this->response->setJSON([
                    'status' => 'not_found',
                    'message' => 'Item not found. Please go to the input form to add this item.'
                ]);
            }
            if ($this->containsObjectWithName($this->dataList, $idInventaris) || $this->dataList != null) {
                $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_inventaris', $idInventaris)]['stok'] += 1;
                session()->set('datalist', $this->dataList);
                return $this->response->setJSON(['status' => 'success']);
            }
            $data2 = [
                'id_inventaris' => $idInventaris,
                'nama_inventaris' => $a['nama_inventaris'],
                'stok' => 1,
                'stok_awal' => $a['stok'],
            ];
            $this->dataList[] = $data2;
            session()->set('datalist_pinjam', $this->dataList);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'eror']);
        }
    }

    public function hapusBarangDatalistPinjam()
    {
        $session = session();
        $items = $session->get('datalist_pinjam') ?? [];

        $index = $this->request->getPost('index');

        if (isset($items[$index])) {
            unset($items[$index]);
            $session->set('datalist_pinjam', $items);
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    public function updateStatus()
    {
        if ($this->request->getMethod() == 'POST') {


            $db = \Config\Database::connect();

            $id = $this->request->getVar('id_ms_peminjaman');
            try {
                // Set the isolation level if needed
                $db->query("SET TRANSACTION ISOLATION LEVEL READ COMMITTED"); // Change as required

                // Start the transaction
                $db->transBegin();

                $data = $this->masterPeminjamanModel->where('id_ms_peminjaman', $id)->first();

                $currentDateTime =  date("Y-m-d H:i:s");
                $newData = [
                    'tanggal_pinjam' => $data['tanggal_pinjam'],
                    'tanggal_kembali' => $currentDateTime,
                    'id_penerima' => $data['id_penerima'],
                    'status' => '0',
                    'bukti_peminjaman' => $data['bukti_peminjaman']
                ];
                if (!$this->masterPeminjamanModel->update($data['id_ms_peminjaman'], $newData)) {
                    throw new DatabaseException('Failed to insert post: gagal update data alat');
                };
                $barang = $this->peminjamanModel->getByMasterId($id);

                foreach ($barang as $b) {

                    $barang1 = $this->inventarisModel->where('id_inventaris', $b['id_inventaris'])->first();

                    $sisa = $barang1['stok'] + $b['jumlah'];
                    $data = [
                        'nama_inventaris' => $barang1['nama_inventaris'],
                        'foto' => $barang1['foto'],
                        'stok' => $sisa,
                    ];

                    if (!$this->inventarisModel->update($barang1['id_inventaris'], $data)) {
                        throw new DatabaseException('Failed to insert post: gagal update data alat');
                    }
                } // // Commit the transaction
                if ($db->transStatus() === FALSE) {
                    // If something went wrong, rollback transaction
                    $db->transRollback();
                    throw new DatabaseException('Transaction failed.');
                } else {
                    // Otherwise, commit the transaction
                    $db->transCommit();

                    session()->setFlashdata('message', 'Transaction successful.');
                    // ganti url
                    return redirect()->to(base_url('/barang_pinjam'))->withInput();
                }
            } catch (DatabaseException $e) {
                // Rollback transaction on any exception
                $db->transRollback();
                session()->setFlashdata('error', 'Transaction failed: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        }
    }
}
