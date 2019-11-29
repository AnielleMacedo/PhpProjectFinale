<?php 


class AboutController
{
	//funcao q renderiza pagina
	public function index()
	{
		
			//parte que exibe a view
			$loader = new \Twig\Loader\FilesystemLoader('src/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('about.html');

			//aki n quero passar parametro so o array vazzio q vai receber o conteudo da view about.html
			$parametros = array();
			
			$conteudo = $template->render($parametros);
			echo $conteudo;

				
	}
}



 ?>