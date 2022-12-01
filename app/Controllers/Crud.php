<?php

namespace App\Controllers;

use App\Controllers\Data;


class Crud extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function insert()
    {
        $id_pa = $this->request->getVar('id_pa');
        $data = [
            'nim' => $this->request->getVar('nim'),
            'nama' => $this->request->getVar('nama'),
            'id_pa' => $id_pa
        ];
        $this->db->table('mhs')->insert($data);
        $data = [
            'user' => $this->request->getVar('nim'),
            'name' => $this->request->getVar('nama'),
            'pass' => 'mhs',
            'level' => 'mhs'
        ];
        $this->db->table('user')->insert($data);
        return redirect()->to(base_url() . '/dosen/' . $id_pa);
    }
    public function edit()
    {
        $data4 = $this->db->table('user')->getWhere(array('user' => $this->request->getVar('nip2')))->getResultArray();
        $data5 = [
            'id' => $data4[0]['id'],
            'user' => $this->request->getVar('nip'),
            'pass' => $data4[0]['pass'],
            'name' => $this->request->getVar('nama'),
            'level' => $data4[0]['level'],
        ];
        $this->db->table('user')->replace($data5);
        $data2 = $this->db->table('mhs')->getWhere(array('id_pa' => $this->request->getVar('nip2')))->getResultArray();
        for ($i = 0; $i < sizeof($data2); $i++) {
            $data3 = [
                'id' => $data2[$i]['id'],
                'nim' => $data2[$i]['nim'],
                'nama' => $data2[$i]['nama'],
                'id_pa' => $this->request->getVar('nip')
            ];
            $this->db->table('mhs')->replace($data3);
        }
        $data = [
            'id' => $this->request->getVar('id'),
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama')
        ];
        $this->db->table('dosen')->replace($data);
        return redirect()->to(base_url() . '/dosen/' . $data['nip']);
    }
    public function edit_mhs()
    {
        $data4 = $this->db->table('user')->getWhere(array('user' => $this->request->getVar('nim2')))->getResultArray();
        $id = $data4[0]['id'];
        $data5 = [
            'id' => $id,
            'user' => $this->request->getVar('nim'),
            'pass' => $data4[0]['pass'],
            'name' => $this->request->getVar('nama'),
            'level' => $data4[0]['level'],
        ];
        $this->db->table('user')->replace($data5);
        $data = $this->db->table('mhs')->getWhere(array('nim' => $this->request->getVar('nim2')))->getResultArray();
        $id_pa = $data[0]['id_pa'];
        $id = $data[0]['id'];
        $data = [
            'id' => $id,
            'nim' => $this->request->getVar('nim'),
            'nama' => $this->request->getVar('nama'),
            'id_pa' => $id_pa
        ];

        $this->db->table('mhs')->replace($data);
        return redirect()->to(base_url() . '/dosen/' . $data['id_pa']);
    }
}
