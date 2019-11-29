<?php 
namespace SimpleMVC\Controller;

use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\ArticoloManager;
use Twig\Environment;

class HomeController implements ControllerInterface
{

	protected $articolo;

	public function __construct(ArticoloManager $articolo, Environment $twig)
	{
		$this->articolo = $articolo;
		$this->twig = $twig;
	}

	public function execute(ServerRequestInterface $request)
	{
		try{
			//chamo o metodo da Model sem dar new pq static
			
			//carrega a view
			$template = $this->twig->load('home.html');

			$parametros = array();
			//informo os dados q queropassar p view home no param articoli q ta dentro do for
			$parametros['articoli'] = $this->articolo->selectAll();

			//var_dump($collectArticoli);
			$conteudo = $template->render($parametros);
			echo $conteudo;
			
		}catch(Exception $e){
			echo $e->getMessage();
		}
		
	}

}
