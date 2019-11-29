<?php 


class PostController
{
	//funcao q renderiza pagina
	public function index($params)
	{
		//var_dump($params); //retorna apenas o valor do id

		try{
			$post = Articolo::selectById($params);
			//print_r($post);

			//parte que exibe a view
			$loader = new \Twig\Loader\FilesystemLoader('src/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('single.html');

			$parametros = array();
			//informo os dados q queropassar p view
			$parametros['id'] = $post->id;
			$parametros['titolo'] = $post->titolo;
			$parametros['testo'] = $post->testo;
			//$parametros['name'] = $post->name;
			$parametros['image'] = $post->image;

			//var_dump($collectArticoli);
			$conteudo = $template->render($parametros);
			echo $conteudo;

			
			
		}catch(Exception $e){
			echo $e->getMessage();
		}
		
	}
}



 ?>