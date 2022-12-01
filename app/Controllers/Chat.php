<?php

namespace App\Controllers;

use App\Controllers\Data;


class Chat extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        if (session()->get('level') == 'mhs') {
            $data = $this->db->table('mhs')->select('id_pa')->where('nim', session()->get('user'))->get()->getResultArray();
            return redirect()->to(base_url() . '/chat/' . $data[0]['id_pa']);
        } else {
            $data = $this->db->table('dosen')->select('nip')->where('nip', session()->get('user'))->get()->getResultArray();
            $nip = $data[0]['nip'];
            $subwhere = $this->db->query("
            SELECT * FROM chat
            HAVING send_at IN
            (SELECT MAX(send_at) FROM(
                    SELECT DISTINCT
                        CASE WHEN chat.sender = 197508142006041001
                        THEN chat.receiver ELSE sender END userID, send_at, text
                    FROM chat 
                        WHERE 197508142006041001 IN (sender, receiver)
                        ) AS T
                GROUP BY userID)
                ORDER BY send_at DESC
            ");
            $data = $subwhere->getResultArray();
            // dd($data);
            // $where = $this->db->table('chat')->selectMax('send_at')->fromSubquery($subwhere, 'alias')->groupBy('sender');
            $nama = array();
            for ($i = 0; $i < sizeof($data); $i++) {
                $nim = $data[$i]['sender'];
                if (strlen($data[$i]['sender']) > 10) {
                    $nim = $data[$i]['receiver'];
                }
                $find_nama = $this->db->table('mhs')->select('nama')->where('nim', $nim)->get()->getResultArray();
                $nama[$i][] = $nim;
                $nama[$i][] = $find_nama[0]['nama'];
                // dd($nim);
            }
            // dd($nama);
            $data = [
                'list' => $subwhere->getResultArray(),
                'name' => $nama
            ];
            return view('list_chat', $data);
        }
    }
    public function showMessage()
    {
        $user = session()->get('user');
        $receiver = $this->request->getVar('target');
        $where =  "(sender='{$user}' AND receiver='{$receiver}')OR(sender='{$receiver}' AND receiver='{$user}')";
        $data = $this->db->table('chat')->orderBy('send_at', 'ASC')->getWhere($where)->getResultArray();
        echo json_encode($data);
    }
    public function sendMessage()
    {
        $data = [
            'sender' => $this->request->getVar('sender'),
            'receiver' => $this->request->getVar('receiver'),
            'text' => $this->request->getVar('text')
        ];
        $this->db->table('chat')->insert($data);
    }
}
