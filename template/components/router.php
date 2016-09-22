<?php
	class Router {
		private $routes;//массив в котором будут храниться маршруты 
		
		public function __construct() {
			$routesPath = ROOT."/config/routes.php";
			$this->routes = include($routesPath);
		}
		
		private function getURI() {
			if (!empty($_SERVER['REQUEST_URI'])) {
				return trim ($_SERVER['REQUEST_URI'],'/');
			}
		
		}  
		
		public function run() { //принимает отправления от front controller'a
			$uri = $this->getURI();
			
			//Проверить наличие такого запроса в routes.php
			foreach ($this->routes as $uriPattern => $path) {
				//сравниваем $uriPattern и $uri
														// $uriPattern         $path
				if (preg_match("~$uriPattern~",$uri)) { //'blog/([0-9]+)' => 'blog/Post'
					
					/*echo '<br>Ищем в запросе набранном юзером: '.$uri; echo '<br>Ищем совпадение: '.$uriPattern; echo '<br>обрабатывает это: '.$path; $internalRoute = preg_replace("~$uriPattern~",$path,$uri); echo "<br>Нужно сформировать: ".$internalRoute;*/
					//получаем внутренний путь из внешнего согласно правилу
					$uri = str_replace("mvc/", "", $uri);
					//echo $uri; die;					
					$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
					//определить контроллер, action и параметры 
					$segments = explode('/', $internalRoute); //разбиваем строку и получаем массив 
					// ниже получим blogController
					$controllerName = array_shift($segments).'Controller'; //берем первый эл-т [blog] и удаляем его из массива. остался эл-т [Post]
					$controllerName = ucfirst($controllerName); //BlogController
					
					$actionName = 'action' . ucfirst(array_shift($segments)); //получаем actionPost
					//в массиве $segments как раз остаются передаваемые параметры 
					//echo "<h1>$actionName</h1>";
					$params = $segments;
					
					//подключить файл класс-котроллера
					$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';					
					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					} else {
						echo "файл не найден";
						break;
					} 
					
					//создать объект и вызвать метод тоесть action
					$controllerObject = new $controllerName;
					$result = call_user_func_array(array($controllerObject, $actionName), $params);
					//$result = $controllerObject->$actionName($params);
					if ($result != null) {
						break;
					}
				}
			}
			//Если есть совпадение, определить какой контроллер и action обрабатывают запрос
			//Создать объект и вызвать метод то есть action
		}
	}

?>