<?php

namespace Pixel\Template\BarraEsquerda;

class Menu extends \Zion\Layout\Padrao
{

    public function getMenu()
    {

        $buffer  = '';
        $buffer .= $this->html->abreTagAberta('ul', array('class' => 'navigation'));
        $buffer .= $this->html->abreTagAberta('li', array('class' => 'active'));
        $buffer .= $this->html->abreTagAberta('a', array('href' => SIS_URL_BASE . 'Dashboard/'));
        $buffer .= $this->html->abreTagAberta('i', array('class' => 'menu-icon fa fa-dashboard')) . $this->html->fechaTag('i');
        $buffer .= $this->html->abreTagAberta('span', array('class' => 'mm-text')) . 'Dashboard' . $this->html->fechaTag('span');
        $buffer .= $this->html->fechaTag('a');
        $buffer .= $this->html->fechaTag('li');
        $buffer .= $this->geraMenu();
        $buffer .= $this->html->fechaTag('ul');

        return $buffer;

    }

    private function geraMenu()
    {

        $imenu = new \Zion\Menu\Menu();
        $menu = $imenu->geraMenu();

        $obj = json_decode($menu, true);

        $buffer = '';

        if ($obj['sucesso'] == true) {

            foreach ($obj['retorno'] as $valor) {

                if (is_array($valor)) {

                    foreach ($valor as $indice1 => $valor1) {

                        if ($indice1 == 'grupo') {

                            $buffer .= $this->abreGrupoMenu();
                            $buffer .= $this->populaGrupoMenu(array('grupoClass' => $valor['grupoClass'], 'grupo' => $valor1));
                        }

                        if (is_array($valor1)) {

                            $buffer .= $this->abreConjuntoSubMenu();

                            foreach ($valor1 as $valor2) {

                                if (!empty($valor2['modulo'])) {

                                    $buffer .= $this->populaSubMenu($valor2);
                                }

                                if (is_array($valor2)) {

                                    foreach ($valor2 as $valor3) {

                                        if (is_array($valor3)) {

                                            foreach ($valor3 as $valor4) {

                                                if (is_array($valor4)) {

                                                    foreach ($valor4 as $valor5) {
                                                        
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            $buffer .= $this->fechaConjuntoSubMenu();
                        }
                    }

                    $buffer .= $this->fechaGrupoMenu();
                }
            }
        } else {

            $buffer = '';
        }

        return $buffer;
    }

    private function abreGrupoMenu()
    {

        $buffer = '';
        $buffer .= $this->html->abreTagAberta('li', array('class' => 'mm-dropdown'));
        return $buffer;
    }

    private function fechaGrupoMenu()
    {

        $buffer = '';
        $buffer .= $this->html->fechaTag('li');
        return $buffer;
    }

    private function populaGrupoMenu($valor)
    {

        $buffer = '';
        $buffer .= $this->html->abreTagAberta('a', array('href' => '#'));
        $buffer .= $this->html->abreTagAberta('i', array('class' => '' . $valor['grupoClass'] . '')) . $this->html->fechaTag('i');
        $buffer .= $this->html->abreTagAberta('span', array('class' => 'mm-text')) . $valor['grupo'] . $this->html->fechaTag('span');
        $buffer .= $this->html->fechaTag('a');
        return $buffer;
    }

    private function abreConjuntoSubMenu()
    {

        $buffer = '';
        $buffer .= $this->html->abreTagAberta('ul', array('class' => ''));
        return $buffer;
    }

    private function fechaConjuntoSubMenu()
    {

        $buffer = '';
        $buffer .= $this->html->fechaTag('ul');
        return $buffer;
    }

    private function populaSubMenu($valor)
    {

        $buffer = '';
        $buffer .= $this->html->abreTagAberta('li', array('class' => ' '));
        $buffer .= $this->html->abreTagAberta('a', array('href' => $valor['menuUrl'], 'tabindex' => '-1'));
        $buffer .= $this->html->abreTagAberta('i', array('class' => '' . $valor['moduloClass'] . '')) . $this->html->fechaTag('i');
        $buffer .= $this->html->abreTagAberta('span', array('class' => 'mm-text')) . $valor['menu'] . $this->html->fechaTag('span');
        $buffer .= $this->html->fechaTag('a');
        $buffer .= $this->html->fechaTag('li');
        return $buffer;
    }

}