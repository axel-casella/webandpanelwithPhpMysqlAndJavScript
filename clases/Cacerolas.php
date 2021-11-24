<?php


class Cacerolas implements JsonSerializable
{
    protected $id_producto;
    protected $imagen;
    protected $nombre;
    protected $descripicion;
    protected $id_color;
    protected $id_categoria;
    protected $precio;

    public static $reglasCacerolas = [
        'nombre' => ['required'],
        'descripcion' => ['required', 'min:10'],
        'precio' => ['required', 'numeric']
    ];

    public static $reglasCacerolas2 = [
        'nombre' => ['required'],
        'descripcion' => ['required', 'min:10'],
        'precio' => ['required', 'numeric'],
        'color'  => ['required'],
        'categoria'  => ['required']
    ];

    /**
     *
     * @return array
     */
    public function jsonSerialize()
    {
        // Implement jsonSerialize() method.
        return [
            'id_producto' => $this->getIdProducto(),
            'imagen' => $this->getImagen(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripicion(),
            'id_color' => $this->getColor(),
            'id_categoria' => $this->getCategoria(),
            'precio' => $this->getPrecio(),
        ];
    }


    /**
     * Retorna todos los productos de la base de datos.
     *
     * @return array|Cacerolas[]
     */
    public function traerSartenes()
    {
        $base = DBConnection::getConnection();
        $querySartenes = "SELECT productos.id_producto, colores.color, productos.imagen, productos.nombre, productos.descripcion, productos.precio, categorias.categoria
                          FROM productos
                          INNER JOIN colores ON productos.id_color=colores.id_color
                          INNER JOIN categorias ON productos.id_categoria=categorias.id_categoria
                          ORDER BY id_producto ASC";
        $stmt = $base->prepare($querySartenes);
        $stmt->execute();
        $resultado = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cacerolas = new Cacerolas();
            $cacerolas->setIdProducto($fila['id_producto']);
            $cacerolas->setNombre($fila['nombre']);
            $cacerolas->setDescripicion($fila['descripcion']);
            $cacerolas->setCategoria($fila['categoria']);
            $cacerolas->setColor($fila['color']);
            $cacerolas->setImagen($fila['imagen']);
            $cacerolas->setPrecio($fila['precio']);

            $resultado[] = $cacerolas;
        }

        return $resultado;
    }


    public function traerUnSarten($id_producto){
        $base = DBConnection::getConnection();
        $querySarten = 'SELECT productos.id_producto, colores.color, productos.nombre, productos.descripcion, productos.precio, productos.imagen, categorias.categoria
                        FROM productos
                        INNER JOIN colores ON productos.id_color=colores.id_color
                        INNER JOIN categorias ON productos.id_categoria=categorias.id_categoria
                        WHERE id_producto = ?';
        $stmt = $base->prepare($querySarten);

        if(!$stmt->execute([$id_producto])){
            return false;
        }

        $resultado = [];

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cacerolas = new Cacerolas;
            $cacerolas->setIdProducto($fila['id_producto']);
            $cacerolas->setNombre($fila['nombre']);
            $cacerolas->setDescripicion($fila['descripcion']);
            $cacerolas->setCategoria($fila['categoria']);
            $cacerolas->setColor($fila['color']);
            $cacerolas->setPrecio($fila['precio']);
            $cacerolas->setImagen($fila['imagen']);

            $resultado[] = $cacerolas;
        }
        return $resultado;
    }

    public function crearSarten($data){
        $base = DBConnection::getConnection();
        $queryCrear = 'INSERT INTO productos(id_producto,imagen,nombre,descripcion,precio,id_color,id_categoria)
                       VALUES(:id_producto,:imagen,:nombre,:descripcion,:precio,:color,:categoria)';
        $stmt = $base->prepare($queryCrear);
        if(!$stmt->execute($data)){
            return false;
        }

        return true;
    }

   public function editarSarten(array $data){
        $base = DBConnection::getConnection();
        $query = 'UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, id_color = :color, id_categoria = :categoria
                  WHERE id_producto = :id_producto';
       $stmt = $base->prepare($query);

        if(!$stmt->execute( $data)){
            return false;
        }

       return true;
   }

    public function borrarProducto($id_producto){
        $base = DBConnection::getConnection();
        $queryBorrar = "DELETE FROM productos 
                        WHERE id_producto = ?";

        $stmt = $base->prepare($queryBorrar);
        if(!$stmt->execute([$id_producto])){
            return false;
        }
        return true;

    }



    /**
     * @return mixed
     */
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    /**
     * @param mixed $id_producto
     */
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripicion()
    {
        return $this->descripicion;
    }

    /**
     * @param mixed $descripicion
     */
    public function setDescripicion($descripicion)
    {
        $this->descripicion = $descripicion;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }


    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

}
    



