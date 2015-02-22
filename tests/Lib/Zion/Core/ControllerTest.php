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
/**
 * Controller()
 * @author Jose Francisco da Silva IV <silvaivctd@gmail.com>
 * @since 14/02/2015
 * @version 1.0
 * @copyright 2015
 *
 * Controller
 */
require __DIR__ . '/../../../../vendor/autoload.php';

use \Zion\Core\Controller;

class ControllerTest extends PHPUnit_Framework_TestCase
{	
	private $instance;
	private $strTest = 'teste';
	
	public function setUp()
	{
		$this->instance  = new Controller();
		parent::setUp();
	}
	
	public function testInstanceOf()
	{
		$this->assertInstanceOf("Zion\Core\Controller", $this->instance);
	}
	/**
	 * 
	 */
	public function testControleComParametro()
	{
		$this->instance->controle($this->strTest);
		$this->assertEquals($this->strTest, $this->instance->getAcao());		
	}
	
	public function testControleSemParametro()
	{
		$this->instance->controle(null);
		$this->assertEquals('iniciar', $this->instance->getAcao());
	}
	
	public function testjsonErro()
	{
		$expected = '{"sucesso":"false","retorno":"teste"}';
		$actual = $this->instance->jsonErro($this->strTest);
		$this->assertEquals($expected, $actual);
	}
	
	public function testjsonSucesso()
	{
		$expected = '{"sucesso":"true","retorno":"teste"}';
		$actual = $this->instance->jsonSucesso($this->strTest);
		$this->assertEquals($expected, $actual);
	}
	
}