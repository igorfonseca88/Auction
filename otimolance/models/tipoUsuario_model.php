<?php

class TipoUsuario_model extends CI_Model {
    
	function getAll() {
        $query = $this->db->query("select idTipoUsuario, tipoUsuario
                   from tb_tipousuario");
        return $query->result();
    }
}
?>
