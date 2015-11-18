<?php/** * *    Sappiens Framework *    Copyright (C) 2014, BRA Consultoria * *    Website do autor: www.braconsultoria.com.br/sappiens *    Email do autor: sappiens@braconsultoria.com.br * *    Website do projeto, equipe e documentação: www.sappiens.com.br *    *    Este programa é software livre; você pode redistribuí-lo e/ou *    modificá-lo sob os termos da Licença Pública Geral GNU, conforme *    publicada pela Free Software Foundation, versão 2. * *    Este programa é distribuído na expectativa de ser útil, mas SEM *    QUALQUER GARANTIA; sem mesmo a garantia implícita de *    COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO EM *    PARTICULAR. Consulte a Licença Pública Geral GNU para obter mais *    detalhes. *  *    Você deve ter recebido uma cópia da Licença Pública Geral GNU *    junto com este programa; se não, escreva para a Free Software *    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA *    02111-1307, USA. * *    Cópias da licença disponíveis em /Sappiens/_doc/licenca * *//** *  @author Pablo Vanni - pablovanni@gmail.com *  @criado 18/11/2005 *  Última Atualização: 13/10/2014 *  Atualizada Por: Pablo Vanni - pablovanni@gmail.com *  @name Cria uma grid de resultados com paginação */namespace Pixel\Grid;use Zion\Paginacao\PaginacaoVO;class GridVO extends PaginacaoVO{    private $colunas;    private $colunasSemHTML;    private $alinhamento;    private $naoOrdenePor;    private $objConverte;    private $complementoTD;    private $cssTD;    private $formatarComo;    private $selecao;    private $selecaoMultipla;    private $substituirPor;    private $legenda;    private $totalizador;    private $view;    private $paginar;    private $processarUpload;    private $configuracaoPersonalizada;    public function __construct()    {        parent::__construct();        $this->colunas = [];        $this->alinhamento = [];        $this->naoOrdenePor = [];        $this->objConverte = [];        $this->complementoTD = [];        $this->cssTD = [];        $this->formatarComo = [];        $this->selecao = true;        $this->selecaoMultipla = false;        $this->view = 'form_padrao.html.twig';        $this->paginar = true;        $this->configuracaoPersonalizada = true; //Configuração 2    }    /**     * Monta um array representativo das colunas da tabela de um banco de dados.     * Por questões de compatibilidade as colunas serão convertidas      * automaticamente para minisculo     * @param array $arrayColunas     * @throws \Exception     */    public function setColunas($arrayColunas)    {        if (!\is_array($arrayColunas)) {            throw new \Exception("Grid: Colunas deve ser um array!");        }        $this->colunas = \array_change_key_case($arrayColunas, \CASE_LOWER);    }    public function getColunas()    {        return $this->colunas;    }    public function setColunasSemHTML($arrayColunasSemHTML)    {        if (!\is_array($arrayColunasSemHTML)) {            throw new \Exception("Grid: Colunas HTML deve ser um array!");        }        $this->colunasSemHTML = \array_change_key_case($arrayColunasSemHTML, \CASE_LOWER);    }    public function getColunasSemHTML()    {        return $this->colunasSemHTML;    }    /**     * Verifica se uma coluna ou um array com varias colunas existe na variavel      * $this->colunas     * @param string|array $coluna     * @param string $metodo     * @throws \Exception     */    private function verificaColunas($coluna, $metodo = '')    {        $msg = "Grid: Coluna %s não encontrada no metodo: %s, verifique sua configuração de colunas!";        if (empty($this->colunas)) {            throw new \Exception("Grid: O array de colunas esta vázio, ele deve ter prioridade na ordem de configuração!");        }        if (\is_array($coluna)) {            foreach (\array_keys($coluna) as $col) {                if (!\array_key_exists($col, $this->colunas)) {                    throw new \Exception(\sprintf($msg, $col, $metodo));                }            }        } else {            if (!\array_key_exists($coluna, $this->colunas)) {                throw new \Exception(\sprintf($msg, $coluna, $metodo));            }        }    }    /**     * Monta um array com informações de alinhamento de campos, pode alinhar um     * ou mais campos     * setAlinhamento(['campo1'=>'Esquerda', 'campo2'=>'Centro'],'campo3'=>'Direita');     * @param array $arrayAlinhamento     * @throws \Exception     */    public function setAlinhamento($arrayAlinhamento)    {        if (!\is_array($arrayAlinhamento)) {            throw new \Exception("Grid: Alinhamento deve ser um array!");        }        $this->alinhamento = \array_change_key_case($arrayAlinhamento, \CASE_LOWER);        $this->verificaColunas($this->alinhamento, __METHOD__);    }    /**     * Retorna a posição de alinhamento do identificador passado pelo parâmetro     * $valor, se não encontrar nenhuma ocorrencia retorna uma string vazia     * @param string $valor     * @return string     */    public function getAlinhamento($valor)    {        if (!\array_key_exists($valor, $this->alinhamento)) {            return '';        }        switch (\strtoupper($this->alinhamento[$valor])) {            case 'DIREITA': return ' alinD ';            case 'CENTRO': return ' alinC ';            default: return '';        }    }    /**     * Usa um objeto, um metodos e a indicação de como usa-los, com a função     * de converter um resultado da grid.     *      * $grid->converterResultado($this, 'mostraIcone', 'moduloClass', ['moduloClass']);     *      * @param object $objeto     * @param string $metodo     * @param string $campo     * @param array $parametrosInternos     * @param array $paremetrosExternos     * @param string $ordem     * @throws \Exception     */    public function converterResultado($objeto, $metodo, $campo, $parametrosInternos = [], $paremetrosExternos = [], $ordem = 'IE')    {        if (!\is_object($objeto)) {            throw new \Exception("Grid: Objeto informado inválido!");        }        if (!\is_string($metodo)) {            throw new \Exception("Grid: Metodo informado inválido!");        }        if (!\is_string($campo)) {            throw new \Exception("Grid: Campo informado inválido!");        }        if (!empty($parametrosInternos)) {            if (!\is_array($parametrosInternos)) {                throw new \Exception("Grid: ParametrosInternos informado inválido!");            }            $parametrosInternos = \array_map('strtolower', $parametrosInternos);        }        if (!empty($paremetrosExternos)) {            if (!\is_array($paremetrosExternos)) {                throw new \Exception("Grid: ParametrosInternos informado inválido!");            }            $paremetrosExternos = \array_map('strtolower', $paremetrosExternos);        }        if (!\in_array(\strtoupper($ordem), ["IE", "EI"])) {            throw new \Exception("Grid: Ordem informado inválido!");        }        $campoMinusculo = \strtolower($campo);        $this->verificaColunas($campoMinusculo, __METHOD__);        $this->objConverte[$campoMinusculo] = [$objeto, $metodo, $campoMinusculo, $parametrosInternos, $paremetrosExternos, $ordem];    }    public function getObjetoConverte()    {        return $this->objConverte;    }    /**     * Usa um objeto, um metodo e a indicação de como usa-los, com a função     * de inserir um complemento em cada TD de resultado de uma grid     *      * $grid->complementoTD($this, 'mostraIcone', ['moduloClass']);     *      * @param object $objeto     * @param string $metodo     * @param array $parametrosInternos     * @param array $paremetrosExternos     * @param string $ordem     * @throws \Exception     */    public function complementoTD($objeto, $metodo, $parametrosInternos = [], $paremetrosExternos = [], $ordem = 'IE')    {        if (!\is_object($objeto)) {            throw new \Exception("Grid: Objeto informado inválido!");        }        if (!\is_string($metodo)) {            throw new \Exception("Grid: Metodo informado inválido!");        }        if (!empty($parametrosInternos)) {            if (!\is_array($parametrosInternos)) {                throw new \Exception("Grid: ParametrosInternos informado inválido!");            }            $parametrosInternos = \array_map('strtolower', $parametrosInternos);        }        if (!empty($paremetrosExternos)) {            if (!\is_array($paremetrosExternos)) {                throw new \Exception("Grid: ParametrosInternos informado inválido!");            }            $paremetrosExternos = \array_map('strtolower', $paremetrosExternos);        }        if (!\in_array(\strtoupper($ordem), ["IE", "EI"])) {            throw new \Exception("Grid: Ordem informado inválido!");        }        $this->complementoTD = [$objeto, $metodo, $parametrosInternos, $paremetrosExternos, $ordem];    }    public function getComplementoTD()    {        return $this->complementoTD;    }    public function cssTD($objeto, $metodo, $parametrosInternos = [], $paremetrosExternos = [], $ordem = 'IE')    {        if (!\is_object($objeto)) {            throw new \Exception("Grid: Objeto informado inválido!");        }        if (!\is_string($metodo)) {            throw new \Exception("Grid: Metodo informado inválido!");        }        if (!empty($parametrosInternos)) {            if (!\is_array($parametrosInternos)) {                throw new \Exception("Grid: ParametrosInternos informado inválido!");            }            $parametrosInternos = \array_map('strtolower', $parametrosInternos);        }        if (!empty($paremetrosExternos)) {            if (!\is_array($paremetrosExternos)) {                throw new \Exception("Grid: ParametrosInternos informado inválido!");            }            $paremetrosExternos = \array_map('strtolower', $paremetrosExternos);        }        if (!\in_array(\strtoupper($ordem), ["IE", "EI"])) {            throw new \Exception("Grid: Ordem informado inválido!");        }        $this->cssTD = [$objeto, $metodo, $parametrosInternos, $paremetrosExternos, $ordem];    }    public function getCssTD()    {        return $this->cssTD;    }    /**     * Monta um array com informações de ordenação de campos, pode ordenar um     * ou mais campos     *      * $grid->naoOrdenePor(['moduloClass']);     *      * @param array $arrayNaoOrdenePor     * @throws \Exception     */    public function naoOrdenePor($arrayNaoOrdenePor)    {        if (!\is_array($arrayNaoOrdenePor)) {            throw new \Exception("Grid: NaoOrdenePor informado inválido!");        }        $this->naoOrdenePor = \array_map('strtolower', $arrayNaoOrdenePor);        $this->verificaColunas(\array_flip($this->naoOrdenePor), __METHOD__);    }    public function getNaoOrdenePor()    {        return $this->naoOrdenePor;    }    /**     * Formata um resultado da grid, pode ser (DATA, DATAHORA, NUMERO, MOEDA)     *      * $grid->setFormatarComo('moduloClass','DATA');     *      * @param string $identificacao     * @param string $como     * @throws \Exception     */    public function setFormatarComo($identificacao, $como)    {        $possibilidades = ['DATA', 'DATAHORA', 'NUMERO', 'MOEDA'];        if (!\in_array(\strtoupper($como), $possibilidades)) {            throw new \Exception("Grid: FormatarComo tipo de formatação não encontrada, use (DATA, DATAHORA, NUMERO, MOEDA)");        }        if (!\is_string($identificacao)) {            throw new \Exception("Grid: formatarComo parametro 1 informado inválido!");        }        if (!\is_string($como)) {            throw new \Exception("Grid: gormatarComo parametro 2 informado inválido!");        }        $campoMinusculo = \strtolower($identificacao);        $this->verificaColunas($campoMinusculo, __METHOD__);        $this->formatarComo[$campoMinusculo] = $como;    }    public function getFormatarComo()    {        return $this->formatarComo;    }    public function getSelecao()    {        return $this->selecao;    }    /**     * Indica se a grid deve apresentar checkbox ou radiobox de seleção      * de resultados     * @param bool $selecao     */    public function setSelecao($selecao)    {        if (!\is_bool($selecao)) {            throw new \Exception("Grid: setSelecao parametro deve ser um booleano!");        }        $this->selecao = $selecao;    }    public function getSelecaoMultipla()    {        return $this->selecaoMultipla;    }    /**     * Por padrão a seleção multipla é verdadeira, no caso de setar false para      * este metodo a grid irá trazer radios para a seleção de resultados.     * @param bool $selecaoMultipla     */    public function setSelecaoMultipla($selecaoMultipla)    {        if (!\is_bool($selecaoMultipla)) {            throw new \Exception("Grid: setSelecaoMultipla parametro deve ser um booleano!");        }        $this->selecaoMultipla = $selecaoMultipla;    }    /**     * Substitui um valor da grid por um valor equivalente em um array     *      * $grid->substituaPor('moduloVisivelMenu', ['S' => 'Sim', 'N' => 'Não']);     *      * @param string $identificacao     * @param string $por     * @throws \Exception     */    public function substituaPor($identificacao, $por)    {        if (!\is_string($identificacao)) {            throw new \Exception("Grid: substituaPor parametro 1 informado inválido!");        }        if (!\is_array($por)) {            throw new \Exception("Grid: substituaPor parametro 2 informado inválido!");        }        $campoMinusculo = \strtolower($identificacao);        $this->verificaColunas($campoMinusculo, __METHOD__);        $this->substituirPor[$campoMinusculo] = $por;    }    public function getSubstituirPor()    {        return $this->substituirPor;    }    public function setLegenda($legenda)    {        if (\is_null($legenda) or \is_string($legenda)) {            $this->legenda = $legenda;        } else {            throw new \Exception("Grid: legenda parametro 1 informado inválido!");        }    }    public function getLegenda()    {        return $this->legenda;    }    public function setTotalizador($identificador, $configuracoes)    {        if (!\is_string($identificador)) {            throw new \Exception("Grid: Totalizador parametro 1 informado inválido!");        }        if (!\is_array($configuracoes)) {            throw new \Exception("Grid: Totalizador parametro 2 informado inválido!");        }        $this->totalizador[$identificador] = $configuracoes;    }    public function getTotalizador()    {        return $this->totalizador;    }    public function setView($view)    {        if (!\is_string($view)) {            throw new \Exception("Grid: view informada inválida!");        }        $this->view = $view;    }    public function getView()    {        return $this->view;    }    public function setProcessarUpload($processarUpload)    {        if (!\is_array($processarUpload)) {            throw new \Exception("Grid: processarUpload informado incorretamente!");        }        $this->processarUpload = $processarUpload;    }    public function getProcessarUpload()    {        return $this->processarUpload;    }        public function setConfiguracaoPersonalizada($configuracaoPersonalizada)    {        if (!\is_bool($configuracaoPersonalizada)) {            throw new \Exception("Grid: setConfiguracaoPersonalizada parametro deve ser um booleano!");        }        $this->configuracaoPersonalizada = $configuracaoPersonalizada;    }        public function getConfiguracaoPersonalizada()    {        return $this->configuracaoPersonalizada;    }}