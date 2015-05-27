<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_saran extends CI_Model {
	var $table = "tb_saran";
	function sendMail($data){
        $to = "korpri@kalbarprov.go.id";
        $subject = "Saran Dari Pengunjung Website KORPRI";
		$config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.korpri.kalbarprov.go.id',
            'smtp_port' => 25,
            'smtp_user' => 'admin@korpri.kalbarprov.go.id',
            'smtp_pass' => '4dm1nk0rpr1',
            'mailtype' => 'html'
        );
        $from = "admin@korpri.kalbarprov.go.id";
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($from, 'Admin Website KORPRI Prov. Kalbar');
        $this->email->to($to);
        $this->email->subject($subject);
        $message = "Tanggal : ".$data["tanggal"].", ";
        $message .= "Jam : ".$data["jam"].", ";
        $message .= "Nama : ".$data["nama_lengkap"].", ";
        $message .= "Nomor Identitas : ".$data["no_identitas"].", ";
        $message .= "Email : ".$data["email"].", ";
        $message .= "Telepon/HP : ".$data["telepon"].", ";
        $message .= "Alamat : ".$data["alamat"].", ";
        $message .= "Saran , ".$data["saran"];
        $this->email->message($message);
        if($this->email->send()) {
            return TRUE;
        }
        else {
            return FALSE;
        }
	}
    function getBanner(){
        $this->db->where('url', 'saran_banner');
        return $this->db->get('tb_module',1);
    }
    function insert($data){
        $this->db->insert($this->table, $data);
    }
}

/* End of file m_saran.php */
/* Location: ./application/models/m_saran.php */