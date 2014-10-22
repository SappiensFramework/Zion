<?php/** *   @author Pablo Vanni - pablovanni@gmail.com *   @since 28/02/2005 *   Última Atualização: 14/10/2014 *   Autualizada Por: Pablo Vanni - pablovanni@gmail.com *   @name Sql */namespace Zion\Acesso;class AcessoSql{    /**     * 	Retorna a descrição do módulo indicado pelo parametro     * 	@return String     */    public function dadosModulo($moduloNome)    {        return "SELECT  ModuloCod, GrupoModuloCod, ModuloCodReferente,                         ModuloNome, ModuloNomeMenu, ModuloDesc, ModuloVisivelMenu,                         ModuloPosicao, ModuloBase, ModuloClass                                     FROM    _modulo                                 WHERE   ModuloNome = '$moduloNome'";    }    /**     * 	Verifica se o usuário tem permissão para acessar o módulo     * 	@return String     */    public function permissaoAcao($moduloNome, $acaoModuloIdPermissao, $usuarioCod)    {        return "SELECT 	a.UsuarioCod                                 FROM 	_permissao a INNER JOIN _acao_modulo b ON (a.AcaoModuloCod = b.AcaoModuloCod)                        INNER JOIN _modulo c ON (c.ModuloCod = b.ModuloCod)                                 WHERE 	a.UsuarioCod = $usuarioCod AND                         b.AcaoModuloIdPermissao = '$acaoModuloIdPermissao' AND                         c.ModuloNome = '$moduloNome'";    }    /**     * 	Retorna as opções que o usuário tem direito     * 	@return String     */    public function permissoesModulo($moduloNome, $usuarioCod)    {        return "SELECT 	b.AcaoModuloCod, b.ModuloCod, b.AcaoModuloPermissao,                         b.AcaoModuloIdPermissao, b.AcaoModuloClass, b.AcaoModuloIcon,                         b.AcaoModuloToolTipComPermissao,                         b.AcaoModuloToolTipeSemPermissao, b.AcaoModuloFuncaoJS,                         b.AcaoModuloPosicao, b.AcaoModuloApresentacao                                  FROM 	_permissao a INNER JOIN _acao_modulo b ON (a.AcaoModuloCod = b.AcaoModuloCod)                        INNER JOIN _modulo c ON (c.ModuloCod = b.ModuloCod)                                 WHERE 	a.UsuarioCod = $usuarioCod AND                                            c.ModuloNome = '$moduloNome'";    }    public function dadosAcaoModulo($moduloNome, $acaoModuloIdPermissao)    {        return "SELECT 	a.AcaoModuloCod, a.ModuloCod, a.AcaoModuloPermissao,                         a.AcaoModuloIdPermissao, a.AcaoModuloClass, a.AcaoModuloIcon,                        a.AcaoModuloToolTipComPermissao,                         a.AcaoModuloToolTipeSemPermissao, a.AcaoModuloFuncaoJS,                         a.AcaoModuloPosicao, a.AcaoModuloApresentacao                                FROM 	_acao_modulo a INNER JOIN _modulo b ON(a.ModuloCod = b.ModuloCod)                                WHERE 	b.ModuloNome = '$moduloNome' AND                         a.AcaoModuloIdPermissao = '$acaoModuloIdPermissao'";    }}