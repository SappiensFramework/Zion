<?php/** * *    Sappiens Framework *    Copyright (C) 2014, BRA Consultoria * *    Website do autor: www.braconsultoria.com.br/sappiens *    Email do autor: sappiens@braconsultoria.com.br * *    Website do projeto, equipe e documentação: www.sappiens.com.br *    *    Este programa é software livre; você pode redistribuí-lo e/ou *    modificá-lo sob os termos da Licença Pública Geral GNU, conforme *    publicada pela Free Software Foundation, versão 2. * *    Este programa é distribuído na expectativa de ser útil, mas SEM *    QUALQUER GARANTIA; sem mesmo a garantia implícita de *    COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO EM *    PARTICULAR. Consulte a Licença Pública Geral GNU para obter mais *    detalhes. *  *    Você deve ter recebido uma cópia da Licença Pública Geral GNU *    junto com este programa; se não, escreva para a Free Software *    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA *    02111-1307, USA. * *    Cópias da licença disponíveis em /Sappiens/_doc/licenca * *//** * @author Pablo Vanni - pablovanni@gmail.com * @since 01/06/2006 * Última Atualização: 28/05/2007 * Atualizada Por: Pablo Vanni - pablovanni@gmail.com * @name Metodos de interação com a base de dados * @version 2.0 * @package Framework */namespace Zion\Menu;abstract class MenuSql{    protected $con;    public function __construct()    {        $this->con = \Zion\Banco\Conexao::conectar();    }    /**     * Retorna o número de Grupos disponíveis para um determinado usuário.     * @param int $usuarioCod     * @return int     */    protected function gruposDiponiveisUsuario($usuarioCod)    {        $qb = $this->con->qb();        $sql = $qb->select('a.grupoCod')                ->from('_grupo', 'a')                ->innerJoin('a', '_modulo', 'b', 'a.moduloCod = b.moduloCod')                ->innerJoin('b', '_acao_modulo', 'c', 'b.moduloCod = c.moduloCod')                ->innerJoin('c', '_permissao', 'd', 'c.acaomoduloCod = d.acaomoduloCod')                ->where($qb->expr()->eq('d.usuarioCod', ':usuarioCod'))                ->setParameter('usuarioCod', $usuarioCod, \PDO::PARAM_INT)                ->setFirstResult(0)                ->setMaxResults(1);        return $this->con->execNLinhas($sql);    }    /**     * Retorna um objeto QueryBuilder com todos os grupos disponíveis sem      * fazer qualquer tipo de restrição ordenados por "grupoPosicao" ascendente     * @return \Doctrine\DBAL\Query\QueryBuilder     */    protected function gruposDiponiveisSql()    {        $qb = $this->con->qb();        $qb->select(['grupoCod',                    'grupoNome',                    'grupoPacote',                    'grupoClass'])                ->from('_grupo', '')                ->orderBy('grupoPosicao', 'ASC');        return $qb;    }    /**     * Retorna um objeto QueryBuilder com todos os módulos disponíveis sem      * fazer qualquer tipo de restrição ordenados por "moduloPosicao" ascendente     * @return \Doctrine\DBAL\Query\QueryBuilder     */    protected function modulosDiponiveisSql()    {        $qb = $this->con->qb();        $qb->select(['moduloCod',                    'grupoCod',                    'moduloCodReferente',                    'moduloNome',                    'moduloDesc',                    'moduloNomeMenu',                    'moduloBase',                    'moduloVisivelMenu',                    'moduloClass'])                ->from('_modulo', '')                ->orderBy('moduloPosicao', 'ASC');        return $qb;    }    /**     * Retorna um objeto QueryBuilder com todos os módulos que o usuário tem     * privilegios de acesso     * @param int $usuarioCod     * @return \Doctrine\DBAL\Query\QueryBuilder     */    protected function usuarioPermissaoModuloSql($usuarioCod)    {        $qb = $this->con->qb();        $qb->select('d.moduloCod')                ->from('_usuario', 'a')                ->innerJoin('a', '_perfil', 'b', 'a.perfilCod = b.perfilCod')                ->innerJoin('b', '_permissao', 'c', 'b.perfilCod = c.perfilCod')                ->innerJoin('c', '_acao_modulo', 'd', 'c.acaoModuloCod = d.acaoModuloCod')                ->where($qb->expr()->isNotNull('c.permissaoCod'))                ->andWhere($qb->expr()->eq('a.usuarioCod', ':usuarioCod'))                ->setParameter('usuarioCod', $usuarioCod, \PDO::PARAM_INT)                ->groupBy('d.moduloCod');        return $qb;    }    /**     * Retorna um objeto um array com os dados do módulo     * @param int $moduloCod     * @param bool $visivel     * @return array     */    protected function dadosModulo($moduloCod, $visivel = true)    {        $qb = $this->con->qb();        $qb->select(['a.moduloCod',                    'a.grupoCod',                    'a.moduloNome',                    'a.moduloDesc',                    'a.nomeMenu',                    'a.moduloBase',                    'b.pacote'])                ->from('_modulo', 'a')                ->innerJoin('a', '_grupomodulo', 'b')                ->andWhere($qb->expr()->eq('a.moduloCod', ':moduloCod'))                ->setParameter('moduloCod', $moduloCod, \PDO::PARAM_INT);        if ($visivel === true) {            $qb->andWhere($qb->expr()->eq('a.visivelMenu', $qb->expr()->literal('S')));        }        return $this->con->execLinha($qb);    }    /**     * Retorna um resultset com os módulos referentes ao código do módulo      * informado no parametro int $referencia     * @param int $referencia     * @param bool $visivel     * @return resultset     */    protected function modulosReferentes($referencia, $visivel = true)    {        $qb = $this->con->qb();        $qb->select('moduloCod', 'nomeMenu')                ->from('_modulo', '')                ->andWhere($qb->expr()->eq('moduloReferente', ':moduloReferente'))                ->setParameter('moduloReferente', $referencia, \PDO::PARAM_INT);        if ($visivel === true) {            $qb->andWhere($qb->expr()->eq('visivelMenu', $qb->expr()->literal('S')));        }        $qb->orderBy('posicao', 'ASC');        return $this->con->executar($qb);    }}