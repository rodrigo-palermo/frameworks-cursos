<?php


class User_model extends CI_Model
{
	private $table = 'usuario';

    public function __construct()
    {
        $this->load->database();
    }

    public function set_user()
    {
        $this->load->helper('url');

        $data = array(
            'id_perfil' => $this->input->post('id_perfil'),
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => $this->input->post('senha'),
        );

        return $this->db->insert($this->table, $data);
    }

    public function get_users()
    {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function get_user($id)
    {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row();
    }

    public function get_id_by_username($username)
    {
        $query = $this->db->get_where($this->table, array('nome' => $username), 1);
        $row = $query->row();
        if(isset($row))
        	return $row->id;
        else
        	return False;
    }

	public function delete_user($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		return True;
	}

    public function auth_user()
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'senha' => $this->input->post('senha')
        );

        $id = $this->get_id_by_username($data['nome']);

        if($id){
        	$nome =  $this->get_user($id)->nome;
        	$senha = $this->get_user($id)->senha;
        	if($data['nome'] == $nome and $data['senha'] == $senha){
				return True;
			}
		}
        return False;
    }

    //Allow new user register if name not exists
	public function allow_register()
	{
		$data = array(
			'nome' => $this->input->post('nome'),
		);
		$id = $this->get_id_by_username($data['nome']);
		if($id){
			return False;
		}
		return True;
	}

	//Verify if repeated passwords match
	public function repeated_pass_match()
	{
		$data = array(
			'senha' => $this->input->post('senha'),
			'senha_repetida' => $this->input->post('senha_repetida'),
		);
		if($data['senha'] == $data['senha_repetida']){
				return True;
			}
		return False;
	}

}
