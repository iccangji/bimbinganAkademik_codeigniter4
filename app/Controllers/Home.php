<?php

namespace App\Controllers;

use App\Controllers\Data;

class Home extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function data()
    {
        if (session()->get('level') == 'mhs') {
            $sub_tbl = $this->db->table('mhs')->select('id_pa')->where('nim', session()->get('user'));
            $tbl = $this->db->table('dosen')->select('nip,nama')->where('nip', $sub_tbl);
            $tbl = $tbl->get();
            $sub_tbl2 = $this->db->table('mhs')->select('id_pa')->where('nim', session()->get('user'));
            $tbl2 = $this->db->table('mhs')->getWhere(array('id_pa' => $sub_tbl2));
        } else {
            $tbl = $this->db->table('dosen')->select('nip,nama')->where('nip', session()->get('user'));
            $tbl = $tbl->get();
            $tbl2 = $this->db->table('mhs')->getWhere(array('id_pa' => session()->get('user')));
        }
        $data = [
            'dosen' => $tbl->getResultArray(),
            'mhs' => $tbl2->getResultArray()
        ];
        $data = [
            'nama_dosen' => $data['dosen'][0]['nama'],
            'nip_dosen' => $data['dosen'][0]['nip'],
            'mahasiswa' => $data['mhs']
        ];
        return $data;
    }
    public function index()
    {
        if (session()->get('level') != 'admin') {
            $data = $this->data();
        } else {
            $dosen = $this->db->table('dosen')->get()->getResultArray();
            $data = [
                'dosen' => $dosen
            ];
        }
        return view('index', $data);
    }

    public function dosen()
    {
        $nip = $this->request->getVar('dosen');
        return redirect()->to(base_url() . "/dosen/" . $nip);
    }
    public function search()
    {
        $search = $this->request->getVar('search');
        if ($search) {
            if (session()->get('level') == 'mhs') {
                $sub_tbl2 = $this->db->table('mhs')->select('id_pa')->where('nim', session()->get('user'));
                $tbl2 = $this->db->table('mhs')->where(array('id_pa' => $sub_tbl2));
            } else if (session()->get('level') == 'dosen') {
                $tbl2 = $this->db->table('mhs')->where(array('id_pa' => session()->get('user')));
            }
            $search = $tbl2->like('nama', $search)->get()->getResultArray();
            $data = $this->data();
            $data = [
                'nama_dosen' => $data['nama_dosen'],
                'nip_dosen' => $data['nip_dosen'],
                'mahasiswa' => $search
            ];
            return view('index', $data);
        } else {
            return redirect()->to(base_url());
        }
    }
}
