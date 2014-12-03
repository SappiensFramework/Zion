<?php/** *   @author Pablo Vanni - pablovanni@gmail.com *   @since 18/11/2005 *   Última Atualização: 13/10/2014 *   Autualizada Por: Pablo Vanni - pablovanni@gmail.com *   @name Cria uma grid de resultados com paginação */namespace Pixel\Grid;class Grid extends GridVO{    /**     * 	@param MeusDadosConverte Array - Objeto do tipo ObjConverte     * 	usado para passar uma funcao     *   ao setCondicaoTodosResultados     */    private $meusDadosConverte;    public function __construct()    {        parent::__construct();    }    /**     * 	Cria um link de ordenação     * 	@param Valor String - Identificação do Titulo para ordenação     * 	@param NomePagina String - Nome da Pagina que deve ser chamada     * 	@param CampoBd String - Campo da Tabela a Ser ordenado     * 	@param Parametros String - Parametros do Filtro         * 	@return String     */    public function ordena($valor, $campoTb)    {        $html = new \Zion\Layout\Html();                $quemOrdena = parent::getQuemOrdena();        $metodoFiltra = parent::getMetodoFiltra();        $paginaAtual = parent::getPaginaAtual();        $naoOrdenePor = parent::getNaoOrdenePor();        //Iniciar ordenando Ascendente         $tipoOrdenacao = (empty(\filter_input(\INPUT_GET, 'to'))) ? 'ASC' : parent::getTipoOrdenacao();        //Verifica Se o Não Permite Ordenação        if (in_array($campoTb, $naoOrdenePor)) {            return sprintf('<span>%s</span>', $valor);        }        $img = '';        if ($campoTb == $quemOrdena) {            if ($tipoOrdenacao == "DESC") {                $novoTipo = "ASC";                $img = $html->abreTagFechada('i', ['class'=>'fa fa-sort-alpha-desc alinD recE10px']);            } else {                $novoTipo = "DESC";                $img = $html->abreTagFechada('i', ['class'=>'fa fa-sort-alpha-asc alinD recE10px']);            }            //Seta Quem ordena            \Zion\Paginacao\Parametros::setParametros("Full", ["qo" => $campoTb, "pa" => $paginaAtual]);            //Muda o Tipo de Ordenação do Link            $qS = \Zion\Paginacao\Parametros::addQueryString(\Zion\Paginacao\Parametros::getQueryString(), ["to" => $novoTipo]);        } else {                        //$img = '';                        //Seta quem ordena e o tipo de ordenacao            \Zion\Paginacao\Parametros::setParametros("Full", ["qo" => $campoTb, "to" => $tipoOrdenacao, "pa" => $paginaAtual]);            //Recupera QS            $qS = \Zion\Paginacao\Parametros::getQueryString();        }        //Ordenação        if (!empty($novoTipo)){            $tipoOrdenacao = $novoTipo;        }                //Imagem de Ordenação        $iOr = $html->abreTagFechada('i',['class'=>'fa fa-sort recD5px']);        return '<a class="branco hand" nohref onclick="sisSvo(\'' . $campoTb . '\',\' '. $tipoOrdenacao . '\'); ' . $metodoFiltra . '(\'' . $qS . '\');" >' . $iOr . $valor . $img . '</a>';    }    public function converteValor($linha, $dadosConverte)    {        $getDadosConverte = (is_array($dadosConverte) ? $dadosConverte : $this->meusDadosConverte);        $objeto = $dadosConverte[0];//Esta sendo exucutada pelo eval        $metodo = $dadosConverte[1];        $campo = $dadosConverte[2];        $pI = (empty($getDadosConverte[3])) ? array() : $getDadosConverte[3];        $pE = (empty($getDadosConverte[4])) ? array() : $getDadosConverte[4];        $ordem = $dadosConverte[5];        if (!empty($pI)){            foreach ($pI as $valor){                $arrayPI[] = $linha[$valor];            }        }                if ($ordem == "IE") {            $arParametros = (empty($arrayPI)) ? $pE : array_merge($arrayPI, $pE);        } else {            $arParametros = (empty($arrayPI)) ? $pE : array_merge($pE, $arrayPI);        }        if (!is_array($arParametros)) {            return $linha[$campo];        } else {                        $parametros = '';                        foreach ($arParametros as $valores){                $parametros .= "'" . $valores . "',";            }                        $parametrosSeparados = substr($parametros, 0, -1);            eval('$retorno = $objeto->'.$metodo.'('.$parametrosSeparados.');');            return $retorno;        }    }        public function resultadoEval($linha, $evalCod)    {        eval($evalCod[0]);        return $r;    }    public function setMeusDadosConverte($dadosConverte)    {        $this->meusDadosConverte = $dadosConverte;    }}