<?php

/**
 * Valida()
 * @author Feliphe "O Retaliador" Bueno - feliphezion@gmail.com
 * @since 20/10/2014
 * @version 1.0
 * @copyright 2014
 * 
 * Interface para integração com outras classes de tratamento de dados.
 */

namespace Zion\Tratamento;

class Tratamento
{
    /** 
     * @var object $instancia Instância da classe singleton
     */
    private static $instancia;

    /**
     * Valida::__construct()
     * Construtor, tão tosco quanto necessário para a implementação singleton.
     * 
     * @return void
     */
    private function __construct(){
        
    }

    /**
     * Valida::instancia()
     * Retorna sempre a mesma instância da classe, de acordo com o Singleton pattern.
     * 
     * @return Tratamento
     */
    public static function instancia(){
        
        if(!isset(self::$instancia)){
            self::$instancia = new self;
        }

        return self::$instancia;
    }

    /**
     * Tratamento::texto()
     * Retorna uma instância da classe de tratamento de Strings. Texto()
     * 
     * @return Texto
     */
    public function texto()
    {
        return \Zion\Tratamento\Texto::instancia();
    }
    
    /**
     * Tratamento::data()
     * Retorna uma instância da classe de tratamento de Datas. Data()
     * 
     * @return Data
     */
    public function data()
    {
        return \Zion\Tratamento\Data::instancia();
    }
    
    /**
     * Tratamento::numero()
     * Retorna uma instância da classe de tratamento de Float. Numero()
     * 
     * @return Numero
     */
    public function numero()
    {
        return \Zion\Tratamento\Numero::instancia();
    }
    
    /**
     * Tratamento::geral()
     * Retorna uma instância da classe de tratamento de inputs especias. Geral()
     * 
     * @return Geral
     */
    public function geral()
    {
        return \Zion\Tratamento\Geral::instancia();
    }

}