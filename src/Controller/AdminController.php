<?php 


class AdminController
{

	//funcao q renderiza pagina/mostra a tabela com todos os articoli
	public function index()
	{
		
			//parte que exibe a view
			$loader = new \Twig\Loader\FilesystemLoader('src/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('admin.html');

			$objArticoli = Articolo::selectAll();//esse metodo q retorna 1 array c todos objtos do db

			$parametros = array();
			//agora quero passar parametro pq quero listar os articoli na tbl do admin.html logo na view faco 1 for p exibi-los
			$parametros['articoli'] = $objArticoli;//crio 1 param
			
			$conteudo = $template->render($parametros);
			echo $conteudo;				
	}


	//nessa page quero exibir um form simples onde o administrator pode alterar o titulo e conteudo do articolo
	public function create()
	{
		$loader = new \Twig\Loader\FilesystemLoader('src/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('create.html');

			$parametros = array();
			
			$conteudo = $template->render($parametros);
			echo $conteudo;
	}

	public function insert()//metodo insert do controller q recebe os dados e envia pro model articolo
	{
		//print_r($_POST);

		//capturo p ve se houve erro ou n
		try{
			//metodo insert q esta dentro da model
			Articolo::insert($_POST);
			echo '<script>alert("Articolo inserito con successo!");</script>';
			//envio o admin pra page q mostra todas as publicacoes
			echo '<script>location.href="http://localhost/Quotidiano_MVC/?pagina=admin&metodo=index"</script>';

		}catch(Exception $e) {
			echo '<script>alert("'.$e->getMessage().'");</script>';
			//COMO DEU ERRO MANDA DE VOLT PRO CREATE  p inserir den
			echo '<script>location.href="http://localhost/Quotidiano_MVC/?pagina=admin&metodo=create"</script>';

		}
		
	}

	//metodo q chama a view q tem o formulario update do articolo
	public function change($paramId){

		$loader = new \Twig\Loader\FilesystemLoader('src/View');
		$twig = new \Twig\Environment($loader);
		$template = $twig->load('update.html');

		
		//$id = $_GET['id'];
		//echo $id; inves de pegar esse id diretamente pescamos akele id do core urlGet e so incluir como paramId
		//echo $paramId;
		$post= Articolo::selectById($paramId);
		//var_dump($post);

		$parametros = array();
		//aki tem q ter parametro de acordo com o id pq a modifica tem q ta inserida nos campos p poder modificar
		$parametros['id']= $post->id;
		$parametros['data']= $post->data;
		$parametros['titolo']=$post->titolo;
		$parametros['testo']=$post->testo;

		$conteudo = $template->render($parametros);
		echo $conteudo;

	}

	public function update()
	{

		//se de erro no update Controlleramin capturo con try/catch
		try{
			Articolo::update($_POST); //pesco o array do dob
			echo '<script>alert("Modifica eseguita con successo!");</script>';
			//envio o admin pra page q mostra todas as publicacoes
			echo '<script>location.href="http://localhost/Quotidiano_MVC/?pagina=admin&metodo=index"</script>';

		}catch(Exception $e) {
			echo '<script>alert("'.$e->getMessage().'");</script>';
			//reecaminha p pagina do metodo change q exibe o form de modifica
			echo '<script>location.href="http://localhost/Quotidiano_MVC/?pagina=admin&metodo=change&id= '.$_POST['id'].'"</script>';

		}

//var_dump($_POST); N PEGA
	}


	public function delete($paramId)//pesco o id do core, podia usar $_GET[id] tb p recuperar o id
	{

		/*$id=$_GET['id']; nesse modo n precisava do paramId no delete
		Articolo::delete($id);*/

		try{
			Articolo::delete($paramId);
			echo '<script>alert("Cancellazione eseguita con successo!");</script>';
			echo '<script>location.href="http://localhost/Quotidiano_MVC/?pagina=admin&metodo=index"</script>';

		}catch(Exception $e) {
			echo '<script>alert("'.$e->getMessage().'");</script>';
			//reecaminha p mesma pagina p deletar denovo
			echo '<script>location.href="http://localhost/Quotidiano_MVC/?pagina=admin&metodo=index"</script>';

		}

	}


}



 ?>