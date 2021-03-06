<?php
/**
*
*    Sappiens Framework
*    Copyright (C) 2014, BRA Consultoria
*
*    Website do autor: www.braconsultoria.com.br/sappiens
*    Email do autor: sappiens@braconsultoria.com.br
*
*    Website do projeto, equipe e documentação: www.sappiens.com.br
*   
*    Este programa é software livre; você pode redistribuí-lo e/ou
*    modificá-lo sob os termos da Licença Pública Geral GNU, conforme
*    publicada pela Free Software Foundation, versão 2.
*
*    Este programa é distribuído na expectativa de ser útil, mas SEM
*    QUALQUER GARANTIA; sem mesmo a garantia implícita de
*    COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO EM
*    PARTICULAR. Consulte a Licença Pública Geral GNU para obter mais
*    detalhes.
* 
*    Você deve ter recebido uma cópia da Licença Pública Geral GNU
*    junto com este programa; se não, escreva para a Free Software
*    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA
*    02111-1307, USA.
*
*    Cópias da licença disponíveis em /Sappiens/_doc/licenca
*
*/

namespace Pixel\Layout;

class TabVO
{

    private $id;
    private $titulo;
    private $ativa;
    private $conteudo;
    private $onClick;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setAtiva($ativa)
    {
        $this->ativa = $ativa;
        return $this;
    }

    public function getAtiva()
    {
        return $this->ativa === true ? 'active' : '';
    }

    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
        return $this;
    }

    public function getConteudo()
    {
        return $this->conteudo;
    }

    public function setOnClick($onClick)
    {
        $this->onClick = $onClick;
        return $this;
    }

    public function getOnClick()
    {
        return $this->onClick;
    }

}
