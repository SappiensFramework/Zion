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

namespace Pixel\Template\BarraSuperior\PesquisarOrganograma;

class PesquisarOrganogramaForm extends \Zion\Layout\Padrao
{

    private $con;
    private $pesquisarOrganogramaSql;

    public function __construct()
    {

    	$this->con = \Zion\Banco\Conexao::conectar();
    	$this->html = new \Zion\Layout\Html();
        //$this->pesquisarOrganogramaSql = new \Pixel\Template\BarraSuperior\PesquisarOrganograma\PesquisarOrganogramaSql();
        $this->pesquisarOrganogramaClass = new \Pixel\Template\BarraSuperior\PesquisarOrganograma\PesquisarOrganogramaClass();

    }  	

    /**
     * 
     * @return Form
     */
    public function getForm()
    {	
        //return '';
    	$buffer = '';

    	if($_SESSION['usuarioCod']) {

            //$getDadosUsuario = $this->con->execLinhaArray($this->pesquisarOrganogramaSql->getDadosUsuario($_SESSION['usuarioCod']));
            $getDadosUsuario = $this->pesquisarOrganogramaClass->getDadosUsuario();
            $form = $this->getFormPesquisarOrganograma();

            $buffer  = '';
            $buffer .= $this->html->abreTagAberta('li', array('class' => 'clearfix'));
            $buffer .= $this->html->abreTagAberta('form', array('id' => 'FormOrganograma', 'name' => 'FormOrganograma', 'class' => 'navbar-form clearfix'));
            $buffer .= $form->getFormHtml('organograma');

            if($getDadosUsuario['organogramacod'] <> $_SESSION['organogramaCod']) {

                $buffer .= $this->html->abreTagAberta('div', array('style' => 'float:inherit; position:relative; margin-top:-37px; padding-right:15px;'));
                $buffer .= $this->html->abreTagAberta('a', array('href' => '#', 'title' => 'Redefinir organograma', 'onclick' => 'getController(\'organogramaCod\', \'organograma\', \'resetOrganogramaCod\')', 'class' => 'close')) . '×' . $this->html->fechaTag('a');
                $buffer .= $this->html->fechaTag('div');	 

            }

            $buffer .= $this->html->fechaTag('form');   	    	    
            $buffer .= $this->html->fechaTag('li');
            $buffer .= $form->javaScript(false, true)->getLoad(true);
            $buffer .= $this->getJSEstatico();    

	}

        return $buffer;	    

    }

    public function getFormPesquisarOrganograma()
    {

        $form = new \Pixel\Form\Form();

        $form->config('FormOrganograma', 'GET')
                ->setNovalidate(true);

        //$getDadosOrganograma = $this->con->execLinhaArray($this->pesquisarOrganogramaSql->getDadosOrganograma($_SESSION['organogramaCod']));
        $getDadosOrganograma = $this->pesquisarOrganogramaClass->getDadosOrganograma($_SESSION['organogramaCod']);
        $organogramaNome = $getDadosOrganograma['organogramanome'];

        $campos[] = $form->texto('organograma', 'organograma');
        $campos[] = $form->suggest('organograma', 'organograma', false)
                ->setUrl(SIS_URL_BASE . 'Dashboard/')
                ->setParametros(['acao' => 'getSuggest'])
                ->setClassCss('clearfix')
                ->setPlaceHolder($organogramaNome)
                ->setHidden(true)
                ->setHiddenValue('organogramaCod')
                ->setOnSelect('getController(\'sisHorganograma\', \'organograma\', \'setOrganogramaCod\')');

        return $form->processarForm($campos);
    }  	

    public function getJSEstatico()
    {

        $jsStatic = \Pixel\Form\FormJavaScript::iniciar();
        //$jQuery = new \Zion\JQuery\JQuery();                
        return $jsStatic->getFunctions($jsStatic->setFunctions($this->getMeuJS()));

    }    

    private function getMeuJS()
    {

        $buffer  = '';
        $buffer .= 'function getController(a,b,c){
                        var aa = $("#"+a).val();
                        $.ajax({type: "get", url: "'.SIS_URL_BASE.'Dashboard/?acao="+c+"&a="+aa, dataType: "json", beforeSend: function() {
                            $("#"+b).html(\'<i class="fa fa-refresh fa-spin" style="margin-top:10px;"></i>\');
                        }}).done(function (ret) {
                            $("#"+b).html(ret.retorno);
                            location.reload();
                        }).fail(function () {
                            sisMsgFailPadrao();
                        });  
                    }';
        return $buffer;

    }    

}