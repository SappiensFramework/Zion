﻿<? class ValidacaoJSGS{ 		//Atributos da Classe	private $StringJS;   //Guarda O todo da Sting Javascript Retornada	private $Funcoes;    //Armazena as Funções Utilizadas	private $OnLoad;     //Armazenas dados que devem ser executados quando a página for carregada	private $NomeForm;   //Guarda o nome do Formulário	private $Suggest;    //Booleano que informa se o campo suggest foi utilzado	private $Mascara;    //Array de Mascaras Atribuidas	private $OpcaoFiltro; //Array com campos de filtro	private $Calendar;   //Booleano que informa se o calendário foi utilizado		//Construtor	public function ValidacaoJSGS()	{				$this->StringJS    = array();		$this->Funcoes     = array();		$this->OnLoad      = array();		$this->NomeForm    = "";		$this->Suggest     = false; 		$this->Mascara     = array();		$this->OpcaoFiltro = array();		$this->Calendar    = false;	}			public function setMascara($Valor)	{		if(!empty($Valor))		{			$this->Mascara[] = $Valor;			}	}	public function getMascara()	{		return $this->Mascara;		}							public function setOpcaoFiltro($Valor)	{		if(!empty($Valor))		{			$this->OpcaoFiltro[] = $Valor;			}	}	public function getOpcaoFiltro()	{		return $this->OpcaoFiltro;		}						public function setFuncoes($Valor)	{		if(!empty($Valor))		{			$this->Funcoes[] = $Valor;			}	}	public function getFuncoes()	{		return $this->Funcoes;		}					public function setStringJS($Valor)	{		if(!empty($Valor))		{			$this->StringJS[] = $Valor;			}	}	public function getStringJS()	{		return $this->StringJS;		}	public function resetStringJS()	{		unset($this->StringJS);	}		public function resetTodos()	{		$this->StringJS   = array();		$this->Funcoes    = array(); 		$this->OnLoad     = array();		$this->NomeForm   = "";		$this->Suggest    = false; 		$this->Mascara    = array();		$this->OpcaoFiltro = array();		$this->Calendar   = false;	}		public function setOnLoad($Nome, $Valor)	{		if(!empty($Valor) and !empty($Nome))		{			$this->OnLoad[$Nome] = $Valor;			}	}	public function getOnLoad()	{		return $this->OnLoad;		}						public function setNomeForm($Valor)	{		$this->NomeForm = $Valor;		}					public function getNomeForm()	{		return $this->NomeForm;		}			}?>