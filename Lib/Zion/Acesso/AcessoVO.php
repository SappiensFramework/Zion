<?php/****    Sappiens Framework*    Copyright (C) 2014, BRA Consultoria**    Website do autor: www.braconsultoria.com.br/sappiens*    Email do autor: sappiens@braconsultoria.com.br**    Website do projeto, equipe e documentação: www.sappiens.com.br*   *    Este programa é software livre; você pode redistribuí-lo e/ou*    modificá-lo sob os termos da Licença Pública Geral GNU, conforme*    publicada pela Free Software Foundation, versão 2.**    Este programa é distribuído na expectativa de ser útil, mas SEM*    QUALQUER GARANTIA; sem mesmo a garantia implícita de*    COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO EM*    PARTICULAR. Consulte a Licença Pública Geral GNU para obter mais*    detalhes.* *    Você deve ter recebido uma cópia da Licença Pública Geral GNU*    junto com este programa; se não, escreva para a Free Software*    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA*    02111-1307, USA.**    Cópias da licença disponíveis em /Sappiens/_doc/licenca**//** * @author Pablo Vanni - pablovanni@gmail.com * @since 23/02/2005 * Última Atualização: 14/10/2014 * Atualizada Por: Pablo Vanni - pablovanni@gmail.com */namespace Zion\Acesso;abstract class AcessoVO{    private $usuarioCod;    private $moduloNome;    private $acaoModuloIdPermissao;    /**     *      * @param int $valor     * @return \Zion\Acesso\AcessoVO     */    public function setUsuarioCod($valor)    {        if (!\is_numeric($valor)) {            throw new \Exception('Código do usuário inválido!');        }        $this->usuarioCod = $valor;        return $this;    }    public function getUsuarioCod()    {        return $this->usuarioCod;    }    /**     *      * @param string $valor     * @return \Zion\Acesso\AcessoVO     */    public function setModuloNome($valor)    {        if (!\is_string($valor)) {            throw new \Exception('Nome do módulo é inválido!');        }        $this->moduloNome = $valor;        return $this;    }    public function getModuloNome()    {        return $this->moduloNome;    }    /**     *      * @param string $valor     * @return \Zion\Acesso\AcessoVO     */    public function setAcaoModuloIdPermissao($valor)    {        if (!\is_string($valor)) {            throw new \Exception('Ação do módulo é inválida!');        }        $this->acaoModuloIdPermissao = $valor;        return $this;    }    public function getAcaoModuloIdPermissao()    {        return $this->acaoModuloIdPermissao;    }}