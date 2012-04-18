<?php

class TipoUsuario_model extends CI_Model {
    
    function getAll() {
        $query = $this->db->query("select idTipoUsuario, tipoUsuario
                    from tb_tipousuario");
        return $query->result();
    }
    
    function buscarUsuarioPorId($id){
        $this->db->where('idTipoUsuario', $id);
        $query = $this->db->get("tb_tipousuario");
        return $query->result();
    }
}
?>
