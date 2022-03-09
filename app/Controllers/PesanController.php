<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\PesanModel;
use App\Models\DetailPesanModel;
use CodeIgniter\Controller;

class PesanController extends Controller
{
    protected $request;
    function __construct()
    {
        $this-> menu = new MenuModel();
        $this-> session = session();
        $this-> pesan = new PesanModel();
    }
    public function tampil()
    {
        $data['data'] = $this->menu->select('id,nama')->findAll();

        if (session('cart') != null) {
            $data['menu'] = array_values(session('cart'));
        } else {
            $data['menu'] = null;
        }
        return view("pesan", $data);
    }
    public function create()
    {
        $id = $this->request->getPost('id_menu');
        $nama = $this->request->getPost('nama');
        $jumlah = $this->request->getPost('jumlah');
        $men = $this->menu->find($id);
        if ($men) {
        }
        $isi = array(
            'id_menu' => $id,
            'nama' => $men['nama'],
            'harga' => $men['harga'],
            'jumlah' => $jumlah,
        );

        if ($this->session->has('cart')) {
            $index = $this->cek($id);
            $cart = array_values(session('cart'));
            if ($index == -1) {
                array_push($cart, $isi);
            } else {
                $cart[$index]['jumlah'] += $jumlah;
            }
            $this->session->set('cart', $cart);
        } else {
            $this->session->set('cart', array($isi));
        }
        return redirect('pesan')->with('success', "data berhasil ditambahkan" . $men['nama']);
    }
    public function cek($id)
    {
        $cart = array_values(session('cart'));
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id_menu'] == $id) {
                return $i;
            }
        }
        return -1;
    }
    public function delete($id)
    {
        $index = $this->cek($id);
        $cart = array_values(session('cart'));
        unset($cart[$index]);
        $this->session->set('cart', $cart);
        return redirect('pesan')->with('success', "data berhasil dihapus");
    }
    public function simpan()
    {
        if (session('cart') != null) {
            $mpesan = array(
                'id_user' => '1',
                'tanggal' => date('Y/m/d'),
                'nama' => $this->request->getPost('nama'),
                'no_meja' => $this->request->getPost('no_meja'),
                'status' => 'dibayar',
                'total_harga' => '0'
            );
            $id = $this->pesan->insert($mpesan);
            $cart = array_values(session('cart'));
            $tHarga = 0;
            foreach ($cart as $val) {
                $dPesan = array(
                    'id_pesan' => $id,
                    'id_menu' => $val['id_menu'],
                    'jumlah' => $val['jumlah'],
                    'harga' => $val['harga']
                );
                $tHarga += $val['jumlah'] * $val['harga'];
                $this->detail_pesan->insert($dPesan);
            }
            $dtharga = array(
                'total_harga' => $tHarga,
            );
            $this->pesan->update($id, $dtharga);
            $this->session->remove('cart');
            return redirect('pesan')->with('success', 'pesanan berhasil disimpan');
        }
    }
}
