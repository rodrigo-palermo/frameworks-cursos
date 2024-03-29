<?php


class User_model extends CI_Model
{
	private $table = 'usuario';

    public function __construct()
    {
        $this->load->database();
    }

    public function set_user($id = false)
    {
        $this->load->helper('url');

        $data = array(
            'id_perfil' => $this->input->post('id_perfil'),
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => $this->input->post('senha'),
        );

		if($id) {
			$this->db->where('id', $id);
			return $this->db->update($this->table, $data);
		}
		return $this->db->insert($this->table, $data);
    }

	public function set_user_by_admin($password)
	{
		$this->load->helper('url');

		$data = array(
			'id_perfil' => $this->input->post('id_perfil'),
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'senha' => $password,
		);

		return $this->db->insert($this->table, $data);
	}

    public function get_users($id = false)
    {
		if($id){
			$this->db->where('usuario.id',$id);
		}
		$this->db->select('usuario.*, perfil.nome perfil_nome');
		$this->db->from('usuario');
		$this->db->join('perfil','usuario.id_perfil = perfil.id');
		$query = $this->db->get();
        return $query->result_array();
    }

    public function get_user($id)
    {
		$this->db->where('usuario.id',$id);
		$this->db->select('usuario.*, perfil.nome perfil_nome');
		$this->db->from('usuario');
		$this->db->join('perfil','usuario.id_perfil = perfil.id');
		$query = $this->db->get();
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

	public function get_id_by_email($email)
    {
        $query = $this->db->get_where($this->table, array('email' => $email), 1);
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

	//Authenticate user login
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

	//Authenticate user e-mail for use in password reset method
	public function auth_user_email()
	{
		$data = array(
			'email' => $this->input->post('email')
		);

		$id = $this->get_id_by_email($data['email']);

		if($id) {
			return True;
		}
		return False;
	}

	public function get_password_by_id($id)
	{
		$query = $this->db->get_where($this->table, array('id' => $id), 1);
		$row = $query->row();
		if(isset($row))
			return $row->senha;
		else
			return False;
	}

	public function reset_user_password($id, $new_password)
	{
		$this->db->set('senha', $new_password);
		$this->db->where('id', $id);
		return $this->db->update($this->table);

	}

	public function update_user_attribute($id, $attribute, $new_value)
	{
		$this->db->set($attribute, $new_value);
		$this->db->where('id', $id);
		return $this->db->update($this->table);
	}





}
