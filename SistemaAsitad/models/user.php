<?php

class User
{
  private $db;
  private $id;
  private $nombre;
  private $apellido;
  private $correo;
  private $contraseÃ±a;
  private $rol;
  private $estado;
  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  //
  function getId()
  {
    return $this->id;
  }

  function setId($id)
  {
    $this->id = $id;
  }
  //
  function getNombre()
  {
    return $this->nombre;
  }

  function setNombre($nombre)
  {
    $this->nombre = $this->db->real_escape_string($nombre);
  }
  //
  function getApellido()
  {
    return $this->apellido;
  }

  function setApellido($apellido)
  {
    $this->apellido = $this->db->real_escape_string($apellido);
  }
  //
  function getCorreo()
  {
    return $this->correo;
  }

  function setCorreo($correo)
  {
    $this->correo = $this->db->real_escape_string($correo);
  }
  //
  function getContraseÃ±a()
  {
    return $this->contraseÃ±a;
  }

  function setContraseÃ±a($contraseÃ±a)
  {
    $this->contraseÃ±a = $this->db->real_escape_string($contraseÃ±a);
  }
  function getRol()
  {
    return $this->rol;
  }
  function setRol($rol)
  {
    $this->rol = $this->db->real_escape_string($rol);
  }
  function getEstado()
  {
    return $this->estado;
  }
  function setEstado($estado)
  {
    $this->estado = $this->db->real_escape_string($estado);
  }
  public function findAll()
  {
    $sql = "SELECT * FROM usuarios inner join rol on usuarios.rol= rol.idRol";
    $users = $this->db->query($sql);
    return $users;
  }
  public function findUId()
  {
    $sql = "SELECT * FROM usuarios INNER JOIN rol on usuarios.rol= rol.idRol WHERE idUsuario= '{$this->getId()}'";
    $user = $this->db->query($sql);
    return $user->fetch_object();
  }
  public function findId()
  {
    $sql = "SELECT * FROM usuarios INNER JOIN rol ON usuarios.rol = rol.idRol WHERE email='{$this->getCorreo()}'";
    $user = $this->db->query($sql);
    return $user->fetch_object();
  }
  public function save()
  {
    $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}','{$this->getApellido()}','{$this->getCorreo()}', '{$this->getContraseÃ±a()}','{$this->getRol()}','Activo')";
    $saved = $this->db->query($sql);
    return $saved;
  }
  public function exits()
  {
    $sql = "SELECT * FROM usuarios WHERE nombre='{$this->getNombre()}' OR email ='{$this->getCorreo()}';";
    $r = $this->db->query($sql);
    return $r;
  }
  public function login()
  {
    $result = false;
    $id = $this->id;
    $pass = $this->pass;

    // Comprovamos si existe el usuario
    $login = $this->findId();

    // Comprobamos si la consulta retorno el usuario
    if ($login && is_object($login)) {
      // Guardamos los datos en un Objeto
      if ($login->estado == 'Activo') {
        if ($pass == $login->contrasena) {
          $result = $login;
        }
      } elseif ($login->estado == 'Inactivo') {
        $result = 'Inactivo';
      }
    } else {
      $result = "ErrorDatos";
    }
    return $result;
  }
  public function findRol()
  {
    $sql = "SELECT * FROM rol";
    $rol = $this->db->query($sql);
    return $rol;
  }
  public function findUsers()
  {
    $sql = "CALL findUsuarios()";
    $usuarios = $this->db->query($sql);
    return $usuarios;
  }
  // Consultar Usuario Por ID
  public function findUserID()
  {
    $sql = "CALL findUserID({$this->getId()})";
    $usuarios = $this->db->query($sql);
    return $usuarios->fetch_object();
  }
  public function asitadUsers()
  {
    $sql = "CALL asitad (@a, @b, @c, @d)";
    $r = $this->db->query($sql);
    $all = [];
    while ($fila = mysqli_fetch_assoc($r)) {
      array_push($all, $fila);
    }
    //cantidad de usarios
    $countAdmin = (int) $all[0]['UsersAdmin'];
    $countPadrino = (int) $all[0]['UsersPadrino'];
    $countMedico = (int) $all[0]['UsersMedico'];
    $countPracticante = (int) $all[0]['UsersPracticante'];

    $allUsers = $countAdmin + $countPadrino + $countMedico + $countPracticante;

    $porcenAdmin = bcdiv(($countAdmin / $allUsers) * 100, '1', 2);
    $porcenPadrino = bcdiv(($countPadrino / $allUsers) * 100, '1', 2);
    $porcenMedico = bcdiv(($countMedico / $allUsers) * 100, '1', 2);
    $porcenPracticante = bcdiv(($countPracticante / $allUsers) * 100, '1', 2);

    //porcentajes

    $arr = [
      [(float) $porcenAdmin],
      [(float) $porcenPadrino],
      [(float) $porcenMedico],
      [(float) $porcenPracticante]
    ];
    return $arr;
  }
  public function activos()
  {
    $sql = "CALL activos(@a, @b)";
    $r = $this->db->query($sql);
    return $r;
  }
  public function delete()
  {
    $sql = "UPDATE usuarios SET estado='{$this->getEstado()}'WHERE 	idUsuario={$this->id}";
    $delete = $this->db->query($sql);
    return $delete;
  }
}
