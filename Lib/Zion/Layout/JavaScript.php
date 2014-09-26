<?/** * @author Pablo Vanni - pablovanni@gmail.com * @since 15/05/2006 * Última Atualização: 15/05/2006 * Autualizada Por: Pablo Vanni - pablovanni@gmail.com * @name Agrupa as funções de validação em JavaScript * @version 2.0 * @package Framework */namespace Zion\Layout;class JavaScript{    public function srcJS($src)    {        return '<script src="' . $src . '"></script>';    }    public function abreJS()    {        return '<script type="text/javascript">';    }    public function fechaJS()    {        return '</script>';    }    public function abreFuncao($nome, $parametros)    {        return 'function ' . $nome . '(' . $parametros . '){ ';    }    public function fechaFuncao()    {        return ' } ';    }    public function entreJS($codigo)    {        return $this->abreJS() . $codigo . $this->fechaJS();    }    public function redireciona($url)    {        return ' window.location="' . $url . '" ';    }    public function abreLoadJQuery()    {        return ' $(document).ready(function() { ';    }    public function fechaLoadJQuery()    {        return ' }) ';    }}