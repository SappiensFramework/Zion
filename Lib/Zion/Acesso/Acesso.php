<?php/** *   @author Pablo Vanni - pablovanni@gmail.com *   @since 23/02/2005 *   Última Atualização: 14/10/2014 *   Autualizada Por: Pablo Vanni - pablovanni@gmail.com *   @name Verifica permissões e fornece informações de acesso sobre modulos */namespace Zion\Acesso;class Acesso extends AcessoVO{    private $acessoSql;    private $con;    public function __construct()    {        $this->con = \Zion\Banco\Conexao::conectar();        $this->acessoSql = new AcessoSql();        parent::setModuloNome(defined('MODULO'));        parent::setUsuarioCod($_SESSION['UsuarioCod']);    }    public function permissaoAcao($acaoModuloIdPermissao)    {        return (bool) $this->con->execNLinhas($this->acessoSql->permissaoAcao(parent::getModuloNome(), $acaoModuloIdPermissao, parent::getUsuarioCod()));    }    public function dadosModulo()    {        return $this->con->execLinha($this->acessoSql->dadosModulo(parent::getModuloNome()));    }    public function dadosAcaoModulo($acaoModuloIdPermissao)    {        return $this->con->execLinha($this->acessoSql->dadosAcaoModulo(parent::getModuloNome, $acaoModuloIdPermissao));    }    public function permissoesModulo()    {        return $this->con->paraArray($this->acessoSql->permissoesModulo(parent::getModuloNome(), parent::getUsuarioCod()),null, 'AcaoModuloIdPermissao');    }}