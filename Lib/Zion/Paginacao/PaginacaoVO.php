<?php/****    Sappiens Framework*    Copyright (C) 2014, BRA Consultoria**    Website do autor: www.braconsultoria.com.br/sappiens*    Email do autor: sappiens@braconsultoria.com.br**    Website do projeto, equipe e documentação: www.sappiens.com.br*   *    Este programa é software livre; você pode redistribuí-lo e/ou*    modificá-lo sob os termos da Licença Pública Geral GNU, conforme*    publicada pela Free Software Foundation, versão 2.**    Este programa é distribuído na expectativa de ser útil, mas SEM*    QUALQUER GARANTIA; sem mesmo a garantia implícita de*    COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO EM*    PARTICULAR. Consulte a Licença Pública Geral GNU para obter mais*    detalhes.* *    Você deve ter recebido uma cópia da Licença Pública Geral GNU*    junto com este programa; se não, escreva para a Free Software*    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA*    02111-1307, USA.**    Cópias da licença disponíveis em /Sappiens/_doc/licenca**//** * \Zion\Paginacao\PaginacaoVO * @author Feliphe "O Retaliador" Bueno - feliphezion@gmail.com * @since 25/09/2014 * @version 1.0 * @copyright 2014 *  * Gerenciamento de getters and setters da paginação. * */namespace Zion\Paginacao;abstract class PaginacaoVO{    /**     * @var mixed $tipoOrdenacao Indica o tipo de ordenação ASC ou DESC     */    private $tipoOrdenacao;    /**     * @var string $quemOrdena Indica um atributo especifico para ser ordenado     */    private $quemOrdena;    /**     * @var string $sql     */    private $sql;    /**     * @var string $totalRegistros     */    private $totalRegistros;    /**     * @var string $tabelaMestra Tabela que deve ser extraida no numero de registros     */    private $tabelaMestra;    /**     * @var string $sqlContador Sql responsável por contar número de registros da Grid     */    private $sqlContador;    /**     * @var bool $filtroAtivo Deve indicar se existe ou não ocoorencia de filtro     */    private $filtroAtivo;    /**     * @var mixed $limitAtivo Indica se o SELECT deve receber LIMIT's de Paginação     */    private $limitAtivo;    /**     * @var string $chave Identificação da Chave Identificadora     */    private $chave;    /**     * @var string $aliasOrdena Alias da chave utilizada na ordeção das pesquisas     */    private $aliasOrdena;    /**     * @var string $metodoFiltra Informa a Grid Qual Método ela deve chamar para executar o filtro     */    private $metodoFiltra;    /**     * @var integer $qLinhas Informa o Número Maximo de Resultados por página     */    private $qLinhas;    /**     * @var integer $paginaAtual Informa o número da pagina atual - Este numero é varivael de acordo com o numero de linhas     */    private $paginaAtual;    /**     * @var bool $irParaPagina Ir diretamente para a página desejada | Habilitar ou não esta opção na paginação     */    private $irParaPagina;    /**     * @var bool $alterarLinhas Mostrar opção para alterar o numero de linhas(resultados) de uma grid     */    private $alterarLinhas;        private $processarNumeroPaginas;    /**     *      * Atributos de layout.     *      */    /**     * @var mixed $divDrop     */    private $divDrop;    /**     * @var mixed $divDropGroup     */    private $divDropGroup;    /**     * @var mixed $buttonDrop     */    private $buttonDrop;    /**     * @var mixed $iDrop     */    private $iDrop;    /**     * @var mixed $iDropCaret     */    private $iDropCaret;    /**     * @var mixed $ulDrop     */    private $ulDrop;    /**     * @var mixed $liFp     */    private $liFp;    /**     * @var mixed $liLp     */    private $liLp;    /**     * @var mixed $divDropGroupItems     */    private $divDropGroupItems;    /**     * @var mixed $buttonRew     */    private $buttonRew;    /**     * @var mixed $iRew     */    private $iRew;    /**     * @var mixed $buttonFwd     */    private $buttonFwd;    /**     * @var mixed $iFwd     */    private $iFwd;    /**     * @var mixed $iFp     */    private $iFp;    /**     * @var mixed $iLp     */    private $iLp;    /**     * @var mixed $divRols     */    private $divRols;    /**     * @var mixed $spanRols     */    private $spanRols;    /**     * @var mixed $divFpOff     */    private $divFpOff;    /**     * @var mixed $buttonRewOff     */    private $buttonRewOff;    /**     * @var mixed $buttonFwdOff     */    private $buttonFwdOff;    /**     * @var mixed $divPagOff     */    private $divPagOff;        /**     * @var mixed $spanDropPags     */    private $spanDropPags;    /**     * PaginacaoVO::__construct()     *      * @return     */    public function __construct()    {        $this->filtroAtivo = false;        $this->limitAtivo = true;        $this->qLinhas = 0;        $this->paginaAtual = 1;        $this->irParaPagina = true;        $this->alterarLinhas = true;        $this->processarNumeroPaginas = true;    }    /**     * PaginacaoVO::setTipoOrdenacao()     *      * @return     */    public function setTipoOrdenacao($valor)    {        $this->tipoOrdenacao = $valor;    }    /**     * PaginacaoVO::getTipoOrdenacao()     *      * @return     */    public function getTipoOrdenacao()    {        $Order = \strtoupper($this->tipoOrdenacao);        return ($Order == "ASC") ? "ASC" : "DESC";    }    /**     * PaginacaoVO::setQuemOrdena()     *      * @return     */    public function setQuemOrdena($valor)    {        $this->quemOrdena = $valor;    }    /**     * PaginacaoVO::getQuemOrdena()     *      * @return     */    public function getQuemOrdena()    {        return $this->quemOrdena;    }    /**     * PaginacaoVO::setSql()     *      * @return     */    public function setSql($valor)    {        $this->sql = $valor;    }    /**     * PaginacaoVO::getSql()     *      * @return \Doctrine\DBAL\Query\QueryBuilder     */    public function getSql()    {        return $this->sql;    }    /**     * PaginacaoVO::setTotalRegistros()     *      * @return     */    public function setTotalRegistros($valor)    {        $this->totalRegistros = $valor;        return $this;    }    /**     * PaginacaoVO::getTotalRegistros()     *      * @return \Doctrine\DBAL\Query\QueryBuilder     */    public function getTotalRegistros()    {        return $this->totalRegistros;    }    /**     * PaginacaoVO::setTabelaMestra()     *      * @return     */    public function setTabelaMestra($valor)    {        $this->tabelaMestra = $valor;    }    /**     * PaginacaoVO::getTabelaMestra()     *      * @return     */    public function getTabelaMestra()    {        return $this->tabelaMestra;    }    /**     * PaginacaoVO::setSqlContador()     *      * @return     */    public function setSqlContador($valor)    {        $this->sqlContador = $valor;    }    /**     * PaginacaoVO::getSqlContador()     *      * @return     */    public function getSqlContador()    {        return $this->sqlContador;    }    /**     * PaginacaoVO::setFiltroAtivo()     *      * @return     */    public function setFiltroAtivo($valor)    {        $this->filtroAtivo = $valor;    }    /**     * PaginacaoVO::getFiltroAtivo()     *      * @return     */    public function getFiltroAtivo()    {        return $this->filtroAtivo;    }    /**     * PaginacaoVO::setLimitAtivo()     *      * @return     */    public function setLimitAtivo($valor)    {        $this->limitAtivo = $valor;    }    /**     * PaginacaoVO::getLimitAtivo()     *      * @return     */    public function getLimitAtivo()    {        return $this->limitAtivo ? true : false;    }    /**     * PaginacaoVO::setChave()     *      * @return     */    public function setChave($valor)    {        $this->chave = \strtolower($valor);    }    /**     * PaginacaoVO::getChave()     *      * @return     */    public function getChave()    {        return $this->chave;    }    /**     * PaginacaoVO::setAliasOrdena()     *      * @return     */    public function setAliasOrdena($valor)    {        if(\is_array($valor)){                       $valor = \array_change_key_case($valor);        } else {            $valor = \strtolower($valor);        }        $this->aliasOrdena = $valor;    }    /**     * PaginacaoVO::getAliasOrdena()     *      * @return     */    public function getAliasOrdena()    {        return $this->aliasOrdena;    }    /**     * PaginacaoVO::setMetodoFiltra()     *      * @return     */    public function setMetodoFiltra($valor)    {        $this->metodoFiltra = $valor;    }    /**     * PaginacaoVO::getMetodoFiltra()     *      * @return     */    public function getMetodoFiltra()    {        return (empty($this->metodoFiltra)) ? "sisFiltrarPadrao" : $this->metodoFiltra;    }    /**     * PaginacaoVO::setQLinhas()     *      * @return     */    public function setQLinhas($valor)    {        $this->qLinhas = $valor;    }    /**     * PaginacaoVO::getQLinhas()     *      * @return     */    public function getQLinhas()    {        return(\is_numeric($this->qLinhas)) ? $this->qLinhas : 0;    }    /**     * PaginacaoVO::setPaginaAtual()     *      * @return     */    public function setPaginaAtual($valor)    {        $this->paginaAtual = $valor;    }    /**     * PaginacaoVO::getPaginaAtual()     *      * @return     */    public function getPaginaAtual()    {        return (empty($this->paginaAtual)) ? 1 : $this->paginaAtual;    }    /**     * PaginacaoVO::setIrParaPagina()     *      * @return     */    public function setIrParaPagina($valor)    {        $this->irParaPagina = (bool) $valor;    }    /**     * PaginacaoVO::getIrParaPagina()     *      * @return     */    public function getIrParaPagina()    {        return $this->irParaPagina;    }    /**     * PaginacaoVO::setAlterarLinhas()     *      * @return     */    public function setAlterarLinhas($valor)    {        $this->alterarLinhas = (bool) $valor;    }    /**     * PaginacaoVO::getAlterarLinhas()     *      * @return     */    public function getAlterarLinhas()    {        return $this->alterarLinhas;    }        /**     * PaginacaoVO::setAlterarLinhas()     *      * @return     */    public function setProcessarNumeroPaginas($valor)    {        $this->processarNumeroPaginas = $valor;    }    /**     * PaginacaoVO::getAlterarLinhas()     *      * @return     */    public function getProcessarNumeroPaginas()    {        return $this->processarNumeroPaginas;    }    /**     * PaginacaoVO::addVariaveisPaginacao()     *      * @return     */    public function addVariaveisPaginacao(Array $variaveis, $metodoEnvio = 'GET')    {        Parametros::setParametros($metodoEnvio, $variaveis);    }    /**     * PaginacaoVO::getDivDrop()     *      * @return     */    public function getDivDrop(){        return $this->divDrop;    }    /**     *      * Getters and Setters dos atributos de layout.     *      */    /**     * PaginacaoVO::setDivDrop()     *      * @param mixed $divDrop     * @return     */    public function setDivDrop($divDrop){        $this->divDrop = $divDrop;    }    /**     * PaginacaoVO::getDivDropGroup()     *      * @return     */    public function getDivDropGroup(){        return $this->divDropGroup;    }    /**     * PaginacaoVO::setDivDropGroup()     *      * @param mixed $divDropGroup     * @return     */    public function setDivDropGroup($divDropGroup){        $this->divDropGroup = $divDropGroup;    }    /**     * PaginacaoVO::getButtonDrop()     *      * @return     */    public function getButtonDrop(){        return $this->buttonDrop;    }    /**     * PaginacaoVO::setButtonDrop()     *      * @param mixed $buttonDrop     * @return     */    public function setButtonDrop($buttonDrop){        $this->buttonDrop = $buttonDrop;    }    /**     * PaginacaoVO::getIDrop()     *      * @return     */    public function getIDrop(){        return $this->iDrop;    }    /**     * PaginacaoVO::setIDrop()     *      * @param mixed $iDrop     * @return     */    public function setIDrop($iDrop){        $this->iDrop = $iDrop;    }    /**     * PaginacaoVO::getIDropCaret()     *      * @return     */    public function getIDropCaret(){        return $this->iDropCaret;    }    /**     * PaginacaoVO::setIDropCaret()     *      * @param mixed $iDropCaret     * @return     */    public function setIDropCaret($iDropCaret){        $this->iDropCaret = $iDropCaret;    }    /**     * PaginacaoVO::getUlDrop()     *      * @return     */    public function getUlDrop(){        return $this->ulDrop;    }    /**     * PaginacaoVO::setUlDrop()     *      * @param mixed $ulDrop     * @return     */    public function setUlDrop($ulDrop){        $this->ulDrop = $ulDrop;    }    /**     * PaginacaoVO::getLiFp()     *      * @return     */    public function getLiFp(){        return $this->liFp;    }    /**     * PaginacaoVO::setLiFp()     *      * @param mixed $liFp     * @return     */    public function setLiFp($liFp){        $this->liFp = $liFp;    }    /**     * PaginacaoVO::getLiLp()     *      * @return     */    public function getLiLp(){        return $this->liLp;    }    /**     * PaginacaoVO::setLiLp()     *      * @param mixed $liLp     * @return     */    public function setLiLp($liLp){        $this->liLp = $liLp;    }    /**     * PaginacaoVO::getDivDropGroupItems()     *      * @return     */    public function getDivDropGroupItems(){        return $this->divDropGroupItems;    }    /**     * PaginacaoVO::setDivDropGroupItems()     *      * @param mixed $divDropGroupItems     * @return     */    public function setDivDropGroupItems($divDropGroupItems){        $this->divDropGroupItems = $divDropGroupItems;    }    /**     * PaginacaoVO::getButtonRew()     *      * @return     */    public function getButtonRew(){        return $this->buttonRew;    }    /**     * PaginacaoVO::setButtonRew()     *      * @param mixed $buttonRew     * @return     */    public function setButtonRew($buttonRew){        $this->buttonRew = $buttonRew;    }    /**     * PaginacaoVO::getIRew()     *      * @return     */    public function getIRew(){        return $this->iRew;    }    /**     * PaginacaoVO::setIRew()     *      * @param mixed $iRew     * @return     */    public function setIRew($iRew){        $this->iRew = $iRew;    }    /**     * PaginacaoVO::getButtonFwd()     *      * @return     */    public function getButtonFwd(){        return $this->buttonFwd;    }    /**     * PaginacaoVO::setButtonFwd()     *      * @param mixed $buttonFwd     * @return     */    public function setButtonFwd($buttonFwd){        $this->buttonFwd = $buttonFwd;    }    /**     * PaginacaoVO::getIFwd()     *      * @return     */    public function getIFwd(){        return $this->iFwd;    }    /**     * PaginacaoVO::setIFwd()     *      * @param mixed $iFwd     * @return     */    public function setIFwd($iFwd){        $this->iFwd = $iFwd;    }    /**     * PaginacaoVO::getIFp()     *      * @return     */    public function getIFp(){        return $this->iFp;    }    /**     * PaginacaoVO::setIFp()     *      * @param mixed $iFp     * @return     */    public function setIFp($iFp){        $this->iFp = $iFp;    }    /**     * PaginacaoVO::getILp()     *      * @return     */    public function getILp(){        return $this->iLp;    }    /**     * PaginacaoVO::setILp()     *      * @param mixed $iLp     * @return     */    public function setILp($iLp){        $this->iLp = $iLp;    }    /**     * PaginacaoVO::getDivRols()     *      * @return     */    public function getDivRols(){        return $this->divRols;    }    /**     * PaginacaoVO::setDivRols()     *      * @param mixed $divRols     * @return     */    public function setDivRols($divRols){        $this->divRols = $divRols;    }    /**     * PaginacaoVO::getSpanRols()     *      * @return     */    public function getSpanRols(){        return $this->spanRols;    }    /**     * PaginacaoVO::setSpanRols()     *      * @param mixed $spanRols     * @return     */    public function setSpanRols($spanRols){        $this->spanRols = $spanRols;    }    /**     * PaginacaoVO::getDivFpOff()     *      * @return     */    public function getDivFpOff(){        return $this->divFpOff;    }    /**     * PaginacaoVO::setDivFpOff()     *      * @param mixed $divFpOff     * @return     */    public function setDivFpOff($divFpOff){        $this->divFpOff = $divFpOff;    }    /**     * PaginacaoVO::getButtonRewOff()     *      * @return     */    public function getButtonRewOff(){        return $this->buttonRewOff;    }    /**     * PaginacaoVO::setButtonRewOff()     *      * @param mixed $buttonRewOff     * @return     */    public function setButtonRewOff($buttonRewOff){        $this->buttonRewOff = $buttonRewOff;    }    /**     * PaginacaoVO::getButtonFwdOff()     *      * @return     */    public function getButtonFwdOff(){        return $this->buttonFwdOff;    }    /**     * PaginacaoVO::setButtonFwdOff()     *      * @param mixed $buttonFwdOff     * @return     */    public function setButtonFwdOff($buttonFwdOff){        $this->buttonFwdOff = $buttonFwdOff;    }    /**     * PaginacaoVO::getDivPagOff()     *      * @return     */    public function getDivPagOff(){        return $this->divPagOff;    }    /**     * PaginacaoVO::setDivPagOff()     *      * @param mixed $divPagOff     * @return void     */    public function setDivPagOff($divPagOff){        $this->divPagOff = $divPagOff;    }        /**     * PaginacaoVO::getDivPagOff()     *      * @return     */    public function getSpanDropPags(){        return $this->spanDropPags;    }    /**     * PaginacaoVO::setDivPagOff()     *      * @param mixed $divPagOff     * @return void     */    public function setSpanDropPags($spanDropPags){        $this->spanDropPags = $spanDropPags;    }    }