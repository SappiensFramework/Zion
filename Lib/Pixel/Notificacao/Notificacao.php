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

namespace Pixel\Notificacao;
use Pixel\Notificacao\NotificacaoSql;
use Zion\Banco\Conexao;
use Zion\Tratamento\Data;

class Notificacao extends NotificacaoSql
{
    
    private $con;
    
    public function __construct() 
    {
        parent::__construct();
        $this->con = Conexao::conectar();
    }
    
    public function getUltimasNotificacoes($usuarioCod)
    {
        $notificacoes = $this->con->paraArray(parent::getUltimasNotificacoesSql($usuarioCod));
     
        foreach($notificacoes as $key => $val) {
            $notificacoes[$key]['notificacaotimeago'] = Data::instancia()->getTimeAgo($val['notificacaodatahora']);
        }

        return $notificacoes; 
    }
    
    public function limpaNotificacao($notificacaoCod, $usuarioCod)
    {
        return parent::limpaNotificacaoSql($notificacaoCod, $usuarioCod)->execute();
    }
    
    public function getNumeroNotificacoes($usuarioCod)
    {
        $resource = $this->con->executar(parent::getNumeroNotificacoesSql($usuarioCod));
        
        $notificacoes = array();
        
        while($dados = $resource->fetch()){
            array_push($notificacoes, $dados['id']);
        }
        
        return $notificacoes;
    }
    
}