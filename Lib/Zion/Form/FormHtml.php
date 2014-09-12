<?php

namespace Zion\Form;

class FormHtml extends \Zion\Form\FormAtributos
{
    protected function montaHidden(FormInputHidden $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $tipo = 'type="' . strtolower($config->getAcao()) . '"';
        $value = $config->getValor();
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';

        $retorno = sprintf("<input %s %s %s %s %s %s />", $name, $id, $tipo, $value, $complemento, $disable);

        return $retorno;
    }

    protected function montaSuggest(FormInputSuggest $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $tipo = 'type="' . strtolower($config->getAcao()) . '"';
        $value = ' value="' . $config->getValor() . '" ';
        $size = ($config->getLargura()) ? 'size="' . $config->getLargura() . '"' : '';
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';
        $placeholder = ($config->getPlaceHolder() != '') ? 'placeholder="' . $config->getPlaceHolder() . '"' : '';

        if ($config->getMaiusculoMinusculo() == "ALTA") {
            $estiloCaixa = 'style="text-transform: uppercase;"';
        } else if ($config->getMaiusculoMinusculo() == "BAIXA") {
            $estiloCaixa = 'style="text-transform: lowercase;"';
        } else {
            $estiloCaixa = '';
        }

        $retorno = sprintf("<input %s %s %s %s %s %s %s %s %s/>", $name, $id, $tipo, $value, $size, $estiloCaixa, $complemento, $disable, $placeholder);

        return $retorno;
    }

    protected function montaTexto(FormInputTexto $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $tipo = 'type="' . strtolower($config->getAcao()) . '"';
        $value = ' value="' . $config->getValor() . '" ';
        $size = ($config->getLargura()) ? 'size="' . $config->getLargura() . '"' : '';
        $len = (is_numeric($config->getMaximoCaracteres())) ? 'maxlength="' . $config->getMaximoCaracteres() . '"' : '';
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';
        $placeholder = ($config->getPlaceHolder() != '') ? 'placeholder="' . $config->getPlaceHolder() . '"' : '';
        $autocomplete = ($config->getAutoComplete() === false) ? 'autocomplete="off"' : '';

        if ($config->getMaiusculoMinusculo() == "ALTA") {
            $estiloCaixa = 'style="text-transform: uppercase;"';
        } else if ($config->getMaiusculoMinusculo() == "BAIXA") {
            $estiloCaixa = 'style="text-transform: lowercase;"';
        } else {
            $estiloCaixa = '';
        }

        $retorno = sprintf("<input %s %s %s %s %s %s %s %s %s %s %s/>", $name, $id, $tipo, $value, $size, $len, $estiloCaixa, $complemento, $disable, $placeholder, $autocomplete);

        return $retorno;
    }

    protected function montaDate(FormInputDate $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $tipo = 'type="' . strtolower($config->getAcao()) . '"';
        $value = $config->getValor();
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';
        $max = ($config->getDataMaxima()) ? 'max="' . $config->getDataMaxima() . '"' : '';
        $min = ($config->getDataMinima()) ? 'min="' . $config->getDataMinima() . '"' : '';

        $retorno = sprintf("<input %s %s %s %s %s %s %s %s />", $name, $id, $tipo, $value, $max, $min, $complemento, $disable);

        return $retorno;
    }

    protected function montaNumber(FormInputNumber $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $tipo = 'type="' . strtolower($config->getAcao()) . '"';
        $value = $config->getValor();
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';
        $max = ($config->getValorMaximo()) ? 'max="' . $config->getValorMaximo() . '"' : '';
        $min = ($config->getValorMinimo()) ? 'min="' . $config->getValorMinimo() . '"' : '';

        $retorno = sprintf("<input %s %s %s %s %s %s %s %s />", $name, $id, $tipo, $value, $max, $min, $complemento, $disable);

        return $retorno;
    }

    protected function montaFloat(FormInputFloat $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $tipo = 'type="' . strtolower($config->getAcao()) . '"';
        $value = $config->getValor();
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';
        $max = ($config->getValorMaximo()) ? 'max="' . $config->getValorMaximo() . '"' : '';
        $min = ($config->getValorMinimo()) ? 'min="' . $config->getValorMinimo() . '"' : '';
        $prefixo = $config->getPrefixo();

        $retorno = sprintf("%s<input %s %s %s %s %s %s %s %s />", $prefixo, $name, $id, $tipo, $value, $max, $min, $complemento, $disable);

        return $retorno;
    }

    protected function montaSelect(FormSelect $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $inicio = $config->getInicio();
        
        $array = $config->getArray();
        
        $tabela = $config->getTabela();
        $campoCod = $config->getCampoCod();
        $campoDesc = $config->getCampoDesc();
        $where = $config->getWhere();
        $sqlCompleto = $config->getSqlCompleto();
        
        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $value = $config->getValor();
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';
        $valor = $config->getValor();        
        
        if ($Inicio != ''){
            $campo = ($inicio === true) ? '<option value="">Selecione...</option>' : '<option value="">'.$Inicio.'</option>';
        }
        
        if($tabela and $campoCod and $campoDesc){
            $con = \Zion\Banco\Conexao::conectar();
            
            if (!empty($sqlCompleto)){
                $Sql = $sqlCompleto;
            } else {
                $Sql = "SELECT $CampoCod, $CampoDesc FROM $Tabela $Condicao";
            }

            $Rs = $Con->executar($Sql);

            while ($Linha = @mysqli_fetch_array($Rs))
                $ArrayValores[$Linha[$CampoCod]] = $Linha[$CampoDesc];
        }
        
        
        foreach ($vetor as $chave => $vale) {
            $campo .= '<option value="'. $chave .'" ';

            if ($eSelecionado === false) {
                if ($valor == '') {
                    if ("{$config->getValorPadrao()}" === "$chave") {
                        $eSelecionado = true;
                        $campo .= 'selected';
                    }
                } elseif ("$chave" === "$valor") {
                    $eSelecionado = true;
                    $campo .= 'selected';
                }
            }

            $campo .= ' > ' . $vale . ' </option>';
        }

        $retorno = sprintf("<select %s %s %s %s %s %s %s %s >%s</select>", $name, $id, $value, $complemento, $disable);

        return $retorno;
    }

    protected function montaButton(FormInputButton $config)
    {
        if (empty($config->getNome())) {
            throw new Exception('Atributo nome é obrigatório');
        }

        $name = 'name="' . $config->getNome() . '"';
        $id = ($config->getId() == '') ? 'id="' . $config->getNome() . '" ' : 'id="' . $config->getId() . '"';
        $tipo = 'type="' . strtolower($config->getAcao()) . '"';
        $value = $config->getValor();
        $complemento = $config->getComplemento();
        $disable = ($config->getDisabled() === false) ? 'disabled="disabled"' : '';
        $metodo = ($config->getMetodo()) ? 'formmethod="' . $config->getMetodo() . '"' : '';
        $action = ($config->getAction()) ? 'formaction="' . $config->getAction() . '"' : '';
        $target = ($config->getAction()) ? 'formtarget="' . $config->getAction() . '"' : '';

        $retorno = sprintf("<button %s %s %s %s %s %s %s %s>%s</button>", $name, $id, $tipo, $complemento, $disable, $metodo, $action, $target, $value);

        return $retorno;
    }

}
