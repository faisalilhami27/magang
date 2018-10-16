<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;

class Permohonan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Permohonan_model');
        $this->load->model('Anggota_kp_model');
        $this->load->model('Keperluan_model');
        $this->load->library('form_validation');
//      require_once(APPPATH . 'third_party/PHPMailer/PHPMailerAutoload.php');
        require_once('./vendor/autoload.php');
    }

    public function index()
    {
		$data['name_csrf'] = $this->security->get_csrf_token_name();
		$data['hash_csrf'] = $this->security->get_csrf_hash();
        $this->template->load('template', 'permohonan/tbl_permohonan_list', $data);
    }

	function get_data_permohonan()
	{
		$list = $this->Permohonan_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<center>' . $no . '</center>';
			$row[] = '<center>' . '<a href="'. base_url('assets/dokumen/' . $field->gambar) .'" target="_blank"><img src="'. base_url('assets/dokumen/' . $field->gambar) .'" width="80px" height="60px"></a> ' .'</center>';
			$row[] = '<center>' . $field->npm . '</center>';
			$row[] = '<center>' . $field->nama_anggota . '</center>';
			$row[] = '<center>' . $field->kampus . '</center>';
			$row[] = '<center>' . $field->nama_keperluan . '</center>';
			$row[] = '<center>' . getStyling($field->nama_status) . '</center>';
			$row[] = '<center>
                        <a href="' . site_url('permohonan/read/'. $field->id) . '" title="View Data" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="' . site_url('permohonan/update/'. $field->id) . '" title="Update Data" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="' . site_url('permohonan/delete/'. $field->id . '/' . $field->id_anggota . '/' . $field->keperluan) . '" title="Delete Data" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure ?\')"><i class="fa fa-trash-o"></i></a>
                     </center>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Permohonan_model->count_all(),
			"recordsFiltered" => $this->Permohonan_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

    public function read($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);
		$tanggal = date("d", strtotime($row->tanggal));
		$bulan = date("m", strtotime($row->tanggal));
		$tahun = date("Y", strtotime($row->tanggal));
		$tanggal_mulai = $tanggal . " " . getBulan($bulan) . " " . $tahun;
		$tanggal2 = date("d", strtotime($row->tanggal_akhir));
		$bulan2 = date("m", strtotime($row->tanggal_akhir));
		$tahun2 = date("Y", strtotime($row->tanggal_akhir));
		$tanggal_selesai = $tanggal2 . " " . getBulan($bulan2) . " " . $tahun2;
        if ($row) {
            $data = array(
                'id' => $row->id,
                'npm' => $row->npm,
                'nama_mahasiswa' => $row->nama_anggota,
                'perguruan_tinggi' => $row->kampus,
                'email' => $row->email,
                'keperluan' => $row->nama_keperluan,
                'status' => $row->nama_status,
                'rincian' => $row->rincian_keperluan,
                'tanggal' => $tanggal_mulai,
                'tanggal_akhir' => $tanggal_selesai,
                'no_hp' => $row->no_hp,
            );
            $this->template->load('template', 'permohonan/tbl_permohonan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Permohonan'));
        }
    }

    public function update($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('permohonan/update_action'),
                'id' => set_value('id', $row->id),
                'email' => set_value('email', $row->email),
                'keperluan' => set_value('keperluan', $row->keperluan),
                'status' => set_value('status', $row->status),
            );
            $this->template->load('template', 'permohonan/tbl_permohonan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Permohonan'));
        }
    }

    public function update_action()
    {
        $email = htmlspecialchars($this->input->post('email', TRUE));
        $keperluan = htmlspecialchars($this->input->post('keperluan', TRUE));
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update(htmlspecialchars($this->input->post('id', TRUE)));
        } else {
            $data = array(
                'status' => htmlspecialchars($this->input->post('status', TRUE)),
            );

            $this->Permohonan_model->update($this->input->post('id', TRUE), $data);
            $status = $this->input->post('status', TRUE);
            if ($keperluan == 4) {
                if ($status == 1) {
                    $body = $this->load->view("sendEmailAccept", "", true);
                    $mail = new PHPMailer;
                    $mail->IsSMTP();
                    $mail->IsHTML(true);
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPDebug = 2;
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = "distarubdg@gmail.com";
                    $mail->Password = "aaoc1234";
                    $mail->SetFrom("distarubdg@gmail.com", "Distaru (dtr)");
                    $mail->Subject = "Pemberitahuan Kerja Praktek";
                    $mail->AddAddress($email);
                    $mail->Body = $body;
                    $string = "";
                    if($mail->Send()) {
                        echo $string = "Message has been sent";
                    } else {
                        echo $string = "Failed to sending message";
                    }
                } elseif ($status == 3) {
                    $body = $this->load->view("sendEmailDecline", "", true);
                    $mail = new PHPMailer;
                    $mail->IsSMTP();
                    $mail->IsHTML(true);
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPDebug = 2;
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = "distarubdg@gmail.com";
                    $mail->Password = "aaoc1234";
                    $mail->SetFrom("distarubdg@gmail.com", "Distaru (dtr)");
                    $mail->Subject = "Pemberitahuan Kerja Praktek";
                    $mail->AddAddress($email);
                    $mail->Body = $body;
                    $string = "";
                    if($mail->Send()) {
                        date_default_timezone_set("Asia/Jakarta");
                        echo $string = "Message has been sent";
                    } else {
                        date_default_timezone_set("Asia/Jakarta");
                        echo $string = "Failed to sending message";
                    }
                }
            }
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Permohonan'));
        }
    }

    public function delete($id, $id_anggota, $keperluan)
    {
        $row = $this->Permohonan_model->get_by_id($id);
        $row1 = $this->Anggota_kp_model->get_by_id($id_anggota);

        if ($row == TRUE && $row1 == TRUE) {
            $path = "assets/dokumen/" . $row->gambar;
            unlink($path);
            if ($keperluan == 4) {
				$this->Permohonan_model->delete($id);
			} else {
				$this->Permohonan_model->delete($id);
				$this->Anggota_kp_model->delete($id_anggota);
			}
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Permohonan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Permohonan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('keperluan', 'keperluan', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        // Load plugin PHPExcel nya
        require_once(APPPATH . 'third_party/PHPExcel/PHPExcel.php');

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Distaru Bandung')
            ->setLastModifiedBy('Distaru Bandung')
            ->setTitle("Permohonan Mahasiswa")
            ->setSubject("Permohonan")
            ->setDescription("Laporan Semua Data Permohonan Mahasiswa")
            ->setKeywords("Permohonan Mahasiswa");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE), // Set border top dengan garis tipis
                'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE),  // Set border right dengan garis tipis
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE), // Set border bottom dengan garis tipis
                'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE), // Set border top dengan garis tipis
                'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE),  // Set border right dengan garis tipis
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE), // Set border bottom dengan garis tipis
                'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PERMOHONAN MAHASISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A2', "NO"); // Set kolom A2 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B2', "NPM"); // Set kolom B2 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C2', "NAMA MAHASISWA"); // Set kolom C2 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D2', "PERGURUAN TINGGI"); // Set kolom C2 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('E2', "KEPERLUAN"); // Set kolom D2 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('F2', "TANGGAL"); // Set kolom E2 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G2', "NOMOR HANDPHONE"); // Set kolom E2 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F2')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G2')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $siswa = $this->Permohonan_model->get_all();

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 3; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->npm);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama_anggota);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->kampus);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->keperluan);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->tanggal);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->no_hp);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(23); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(35); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(23); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(23); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Permohonan Permohonan");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Permohonan Mahasiswa.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}

/* End of file Permohonan.php */
/* Location: ./application/controllers/Permohonan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-07 06:06:11 */
/* http://harviacode.com */


/* End of file Permohonann.php */
/* Location: ./application/controllers/Permohonann.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-24 18:32:00 */
/* http://harviacode.com */
