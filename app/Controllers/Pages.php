<?php

namespace App\Controllers;

use App\Controllers\Data;

class Pages extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function data_user()
    {
        $data = $this->db->table('user')->select('name,user,pass')->get()->getResultArray();
        $data = [
            'data' => $data,
            'len_data' => sizeof($data)
        ];
        return view('list_user', $data);
    }
    public function dosen($nip)
    {
        if (session()->get('level') == 'admin') {
            $tbl = $this->db->table('dosen')->select('nip,nama')->where('nip', $nip);
            $tbl = $tbl->get();
            $tbl2 = $this->db->table('mhs')->getWhere(array('id_pa' => $nip));
            $data = [
                'dosen' => $tbl->getResultArray(),
                'mhs' => $tbl2->getResultArray()
            ];
            $dosen = $this->db->table('dosen')->get()->getResultArray();
            $data = [
                'dosen' => $dosen,
                'nip' => $nip,
                'nama_dosen' => $data['dosen'][0]['nama'],
                'nip_dosen' => $data['dosen'][0]['nip'],
                'mahasiswa' => $data['mhs']
            ];
            return view('index', $data);
        } else {
            return redirect()->to(base_url());
        }
    }
    public function search()
    {
        $nip = $this->request->getVar('nip');
        $search = $this->request->getVar('search');
        if ($search) {
            $tbl = $this->db->table('dosen')->select('nip,nama')->where('nip', $nip)->get()->getResultArray();
            $tbl2 = $this->db->table('mhs')->where(array('id_pa' => $nip));
            $search = $tbl2->like('nama', $search)->get()->getResultArray();
            $data = [
                'dosen' => $tbl,
                'mhs' => $search
            ];
            $dosen = $this->db->table('dosen')->get()->getResultArray();
            $data = [
                'dosen' => $dosen,
                'nip' => $nip,
                'nama_dosen' => $data['dosen'][0]['nama'],
                'nip_dosen' => $data['dosen'][0]['nip'],
                'mahasiswa' => $data['mhs']
            ];
            return view('index', $data);
        } else {
            return redirect()->to(base_url() . '/dosen/' . $nip);
        }
    }
    public function edit($nip, $nim = null)
    {
        if (!empty($nim)) {
            $data = $this->db->table('mhs')->select('id,nim,nama,id_pa')->where('nim', $nim)->get()->getResultArray();
            $dosen = $this->db->table('dosen')->get()->getResultArray();
            $data = [
                'data' => $data[0],
                'len_mhs' => sizeOf($data[0]),
                'dosen' => $dosen,
                'len_dosen' => sizeof($dosen),
                'nim' => $nim
            ];
            return view('edit', $data);
        } else {
            $data = $this->db->table('dosen')->select('id,nip,nama')->where('nip', $nip)->get()->getResultArray();
            $data = $data[0];
            return view('edit', $data);
        }
    }
    public function del($nip, $nim = null)
    {
        if (!empty($nim)) {
            $this->db->table('mhs')->delete(['nim' => $nim]);
            return redirect()->to(base_url() . '/dosen/' . $nip);
        }
        $this->db->table('dosen')->delete(['nip' => $nip]);
        return redirect()->to(base_url());
    }
    public function create($nip)
    {
        $data = [
            'id_pa' => $nip
        ];
        return view('create', $data);
    }
    public function chat($receiver)
    {
        $user = session()->get('user');
        $where =  "(sender='{$user}' AND receiver='{$receiver}')OR(sender='{$receiver}' AND receiver='{$user}')";
        $data = $this->db->table('chat')->orderBy('send_at', 'ASC')->getWhere($where)->getResultArray();
        $data = [
            'content' => $data,
            'size' => sizeof($data),
            'receiver' => $receiver
        ];
        return view('chat', $data);
    }
}
