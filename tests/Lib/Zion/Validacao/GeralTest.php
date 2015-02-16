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

use \Zion\Validacao\Geral;

class GeralTest extends PHPUnit_Framework_TestCase
{	
	private $instance;
	
	public function setUp()
	{
		$this->instance  = Zion\Validacao\Geral::instancia();
		parent::setUp();
	}
	
	public function testInstanceOf()
	{
		$this->assertInstanceOf("Zion\Validacao\Geral", $this->instance);
	}
	
	public function testValidaCpfValido()
	{
		$cpfTest = '865.205.183-60';
		$valid = $this->instance->validaCPF($cpfTest);
		$this->assertTrue($valid);
	}
	
	public function testValidaCpfInvalido()
	{
		$cpfTest = null;
		$this->assertFalse($this->instance->validaCPF($cpfTest));
		$cpfTest = '1234567890123456';
		$this->assertFalse($this->instance->validaCPF($cpfTest));
		
		
	}
}