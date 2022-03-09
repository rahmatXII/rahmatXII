<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;
class MenuController extends Controller{

    /**
     * instance of the main request object.
     * 
     * @var HTTP\incomingrequest
     */
    protected $request;
    function __construct()
    {
        $this->menus = new MenuModel();
    }
    public function tampil()
    {
        # code...
        //$menus= new MenuModel();
        $data['data'] = $this->menus->findAll();
        return view ('menu',$data);
    }
    public function create()
    {
        $data=array(
            'nama'=> $this->request->getpost('nama'),
            'harga'=> $this->request->getpost('harga'),
            'jumlah'=> $this->request->getpost('jumlah'),
            'jenis'=> $this->request->getpost('jenis'),
            'keterangan'=> $this->request->getpost('keterangan'),
        );
        $this->menus->insert($data);
        return redirect('menu')->with('succes','data berhasil disimpan');
    }
    public function edit($id)
    {
        $data = array(
            'nama'=> $this->request->getpost('nama'),
            'harga'=> $this->request->getpost('harga'),
            'jumlah'=> $this->request->getpost('jumlah'),
            'jenis'=> $this->request->getpost('jenis'),
            'keterangan'=> $this->request->getpost('keterangan'),
        );
        $this->menus->update($id, $data);
        return redirect('menu')->with('success', 'data berhasil disimpan');
    }
    public function show($id)
    {
        # code...
    }
    public function delete($id)
    {
        $this->menus->delete($id);
        return redirect('menu')->with('success', 'data berhasil dihapus');
    }
}