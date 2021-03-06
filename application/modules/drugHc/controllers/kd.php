<?php if (!defined('BASEPATH'))     exit('No direct script access allowed');

/*
* @package		Controller - CIMasterArtcak
* @author		Felix - Artcak Media Digital
* @copyright	Copyright (c) 2014
* @link		http://artcak.com
* @since		Version 1.0
 * @description
 * Contoh Tampilan administrator dashbard
 */

//dapat diganti extend dengan *contoh Admin_controller / Aplikan_controller di folder core. 
class Kd extends kdController {
    
    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->top_navbar = 'lay-top-navbar/kdNavbar';
        $this->load->model('mdrughc');
        $this->load->model('vpenugasan_akun');
        $this->load->model('ppuskesmas');
        $this->load->model('unit_model');
        $this->load->model('kddrughc');
        
    }
    
    /*
     * Digunakan untuk menampilkan dashboard di awal. Setiap tampilan view, harap menggunakan fungsi
     * index(). Pembentukan view terdiri atas:
     * 1. Title
     * 2. Set Partial Header
     * 3. Set Partial Right Top Menu
     * 4. Set Partial Left Menu
     * 5. Body
     * 6. Data-data tambahan yang diperlukan
     * Jika tidak di-set, maka otomatis sesuai dengan default
     */
    public function index(){
        redirect(base_url().$this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/monitoringObat');
    }
    
    public function monitoringObat()
    {
        $this->title="";
        $id_hakakses= $this->session->userdata['telah_masuk']["idha"];
        $id_akun= $this->session->userdata['telah_masuk']["idakun"];
        $nama_hakakses= $this->session->userdata['telah_masuk']["hakakses"];
        $idUnit= $this->session->userdata['telah_masuk']['idunit'];
        $namaUnit= $this->session->userdata['telah_masuk']['namaunit'];
        $idGedung= $this->session->userdata['telah_masuk']['idgedung'];
        $namaGedung= $this->session->userdata['telah_masuk']['namagedung'];
        
		
		if($this->session->userdata['telah_masuk']['idha'] != 14){
			$data['puskesmas'] = $this->session->userdata['telah_masuk']['namagedung'];
		}
		else
		{
			$data['puskesmas'] = $this->ppuskesmas->getAllEntry ();
		}
		$data['units'] = $this->unit_model->getUnitByHC ();
        $this->display('kdMonitoringStok', $data);
    }
   
   function searchMonitoringUnit(){
        header('Cache-Control: no-cache, must-revalidate');
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
		$idUnit = $this->input->post('unit');
		$puskesmas = $this->input->post('puskesmas');
		$tanggal = $this->input->post('tanggal');
		if($idUnit != -1)
		{
			$temp1 = $this->kddrughc->getAllStokBy($idUnit, $puskesmas, $tanggal);
		}else{
			$temp1 = $this->kddrughc->getAllStokHCBy($puskesmas, $tanggal);
		}
		if($temp1)
			echo $this->getPivot($temp1);
		else
			echo "[[\"NOMOR BATCH\",\"NAMA OBAT\", \"STOK OBAT TERAKHIR\", \"SATUAN\", \"EXPIRED DATE\"], [\"Kosong\", \"Kosong\", \"Kosong\", \"Kosong\", \"Kosong\"]]";
    }
	
   function searchObat($idUnit){
        header('Cache-Control: no-cache, must-revalidate');
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        $data = $this->input->post('teksnya');

        $teks = $data['tanda'];
        $temp1= $this->vpenugasan_akun->getUnitByIdAkun();
        $data["submit"] = $this->getPivot($temp1);
        return $data["submit"];
    }
	
	public function AllunitInPuskesmas () {
		$id = $this->input->post('id');
		$data['units'] = $this->unit_model->getUnitByInputHC($id);
		echo json_encode($data);
	}
	
	function clean($string) {
        return preg_replace('/[^A-Za-z0-9\-@ .,]/', '-', $string); // Removes special chars.
    }
	
	private function getPivot($data) {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        $header = "[[";
        foreach ($data as $value) {
            foreach ($value as $key => $sembarang) {
                $header .= '"' . str_replace("_", " ", strtoupper($key)) . '"';
                break;
            }
            $count = 1;
            foreach ($value as $key => $sembarang) {
                if ($count > 1) {
                    $header .= ',"' . str_replace("_", " ", strtoupper($key)) . '"';
                }
                $count ++;
            }
            $header .= "]";
            break;
        }
        $vartemp="";
        foreach ($data as $value) {
            $header .= ",[";
            foreach ($value as $key => $data) {
                $data = $this->clean($data);
//                if ($key == "ID_ICD") {
//                    $header .= '"<a href=\'' . base_url() . 'index.php/linknya/disini/lho/' . $value->ID_ICD.'/'.$value->CATEGORY.'/'.$value->SUBCATEGORY.'/'.$value->ENGLISH_NAME.'/'.$value->INDONESIAN_NAME. '\'>' . $data . '</a>"';
//                }
//                else {
                    $header .= '"' . $data . '"';
//                }
                break;
            }
            $count = 1;
            foreach ($value as $key => $data) {
                $data = $this->clean($data);
                if ($count > 1) {
//                    if ($key == "ID_ICD") {
//                        $header .= '"<a href=\'' . base_url() . 'index.php/linknya/disini/lho/' . $value->ID_ICD.'/'.$value->CATEGORY.'/'.$value->SUBCATEGORY.'/'.$value->ENGLISH_NAME.'/'.$value->INDONESIAN_NAME. '\'>' . $data . '</a>"';
//                    }
//                    else {
                        $header .= ',"' . $data . '"';
//                    }
                    
                }
                $count ++;
            }
            $header .= "]";
        }
        $header .= "]";
        echo $header;
    }
	
    public function convert($date){
        $mydate = date_create_from_format('m-d-Y', $date);
        return date_format($mydate, 'Y-m-d');
    }   
}