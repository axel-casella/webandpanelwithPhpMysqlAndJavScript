<?php



class Validator
{

    /** @var array */
    protected $campos;

    /** @var array */
    protected $reglas;

    /** @var array  */
    protected $errores = [];

    /**
     * Validator constructor.
     * @param array $campos
     * @param array $reglas
     */
    public function __construct($campos, $reglas)
    {
        $this->campos = $campos;
        $this->reglas = $reglas;

        $this->validar();
    }

    /**
     * Realiza la validación.
     */
    protected function validar()
    {
        foreach ($this->reglas as $nombreCampo => $reglasCampo) {
            $this->aplicarListaReglas($nombreCampo, $reglasCampo);
        }
    }

    /**
     *
     * @param string $campo
     * @param array $listaReglas
     * @throws Exception
     */
    protected function aplicarListaReglas($campo, $listaReglas)
    {

        foreach ($listaReglas as $regla) {

            $this->aplicarRegla($campo, $regla);
        }
    }

    /**
     *
     * @param string $campo
     * @param string $regla
     * @throws Exception
     */
    protected function aplicarRegla($campo, $regla)
    {

        if (strpos($regla, ':') !== false) {
            [$nombreRegla, $parametroRegla] = explode(':', $regla);

            $nombreMetodo = '_' . $nombreRegla;

            if (!method_exists($this, $nombreMetodo)) {
                throw new Exception('No existe una validación llamada ' . $nombreRegla . '.');
            }

            $this->{$nombreMetodo}($campo, $parametroRegla);
        } else {
            $nombreMetodo = '_' . $regla;

            if (!method_exists($this, $nombreMetodo)) {
                throw new Exception('No existe una validación llamada ' . $regla . '.');
            }

            $this->{$nombreMetodo}($campo);
        }
    }

    /**
     *
     * @param string $campo
     * @param string $mensaje
     */
    protected function registrarError($campo, $mensaje)
    {
        if (!isset($this->errores[$campo])) {
            $this->errores[$campo] = [];
        }

        $this->errores[$campo][] = $mensaje;
    }

    /**
     *
     * @return bool
     */
    public function passes()
    {
        return empty($this->errores);
    }

    /**
     *
     * @return array
     */
    public function getErrores()
    {
        return $this->errores;
    }

    /**
     *
     * @param string $campo
     */
    protected function _required($campo)
    {
        if (empty($this->campos[$campo])) {
            $this->registrarError($campo, 'Ingrese el/la ' . $campo . ' del producto.');
        }
    }

    /**
     *
     * @param string $campo
     */
    protected function _numeric($campo)
    {
        if (!is_numeric($this->campos[$campo])) {
            $this->registrarError($campo, 'El ' . $campo . ' debe ser un número.');
        }
    }

    /**
     *
     * @param string $campo
     * @param int $cantidad
     */
    protected function _min($campo, $cantidad)
    {
        if (strlen($this->campos[$campo]) < $cantidad) {
            $this->registrarError($campo, 'La ' . $campo . ' debe tener al menos ' . $cantidad . ' caracteres.');
        }
    }
}
