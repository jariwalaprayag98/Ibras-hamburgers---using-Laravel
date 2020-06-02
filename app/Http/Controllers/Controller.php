<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Inicio(){
    	return view('Inicio')->with('ham_name',"nu")->with('ing',"nu")->with('cal','nu','price','nu',"b","1");
    }

    public function Sobre_Nosotros(){
    	return view('Sobre_Nosotros');
    }

    public function Contacto(){
    	return view('Contacto');
    }

    public function Menu(){
    	$hamburgers=DB::select("select * from hamburger");
    	return view('Menu',['hamburgers'=>$hamburgers]);
    }

    public function Admin(){
		$reviews=DB::select("select * from reviews");
    	return view('Admin',['reviews'=>$reviews]);
    }

    public function admin_add(){
    	return view('admin_add');
    }

    public function admin_update(){
    	return view('admin_update');
    }

    public function admin_remove(){
    	$hamburgers=DB::select("select * from hamburger");
    	return view('admin_remove',['hamburgers'=>$hamburgers]);
    }

    public function order(){
    	session_start();
    	if(isset($_SESSION['userid'])){
			$name = $_SESSION['userid'];
		}
    	$order=DB::select("select * from orders where user_name = ?",[$name]);
    	return view('order',['order'=>$order]);
    }

    public function register(){
    	if(isset($_POST['userid']) && isset($_POST['mail']) && isset($_POST['pwd']) && isset($_POST['repwd']))
		{
			$u=$_POST['userid'];
			$p=$_POST['pwd'];
			$r=$_POST['repwd'];
			$e=$_POST['mail'];
			$a=$_POST['address'];
			if ($p!=$r)
			{
				echo '<script type="text/javascript">'; 
				echo 'alert("Passwords do not match");'; 
				echo 'window.location.href = "http://localhost:8000/Inicio#modal1";';
				echo '</script>';
			}
			else
			{
				$username=DB::table('users')->where('user_name', $u)->value('user_name');
				if(strtolower($username)!=strtolower($u))
	 			{
					session_start();
					DB::insert('INSERT INTO users (user_name, email, password, role, address) VALUES (?,?,?,?,?)',[$u,$e,$p,"normal",$a]);

					$email_data = array(
						'name' => $u,
						'email' => $e
					);

					Mail::send('welcome_email', $email_data, function ($message) use ($email_data){
				        $message->to($email_data['email'], $email_data['name'])
				            ->subject('Ibras Hamburgusa')
				            ->from('ibras.hamburgusa@gmail.com', 'Welcome');
				    });


					echo '<script type="text/javascript">'; 
					echo 'alert("Registration successful!!");'; 
					echo 'window.location.href = "/Inicio";';
					echo '</script>';
	 			}
				else
	 			{
	 				echo '<script type="text/javascript">'; 
					echo 'alert("Username already taken");'; 
					echo 'window.location.href = "/Inicio#modal1";';
					echo '</script>';	
	 			}
			}
		}
		else
		{
			echo '<script type="text/javascript">'; 
			echo 'alert("Fill all the fields.");'; 
			echo 'window.location.href = "/	Inicio#modal1";';
			echo '</script>';	
		}
    }

    public function login(){ 
		if(isset($_POST['userid']) && isset($_POST['pwd']))
		{
			$u=$_POST['userid'];
			$p=$_POST['pwd'];
		}
		$username=DB::table('users')->where('user_name', $u)->value('user_name');
		$password=DB::table('users')->where('user_name', $u)->value('password');
		$role=DB::table('users')->where('user_name', $u)->value('role');
		if($username==$u && $password==$p)
		 {
			session_start();
			$_SESSION["userid"]=$u;
			$_SESSION["role"]=$role;
			return redirect('Inicio');
		 }
		else
		 {
			echo '<script type="text/javascript">'; 
			echo 'alert("Invalid Login");'; 
			echo 'window.location.href = "http://localhost:8000/Inicio#modal";';
			echo '</script>';
		 } 

    }

    public function logout(){
    	session_start();
		if(isset($_SESSION['userid']))
		{
			unset($_SESSION['userid']);
			return redirect('Inicio');
		}
		else
		{
			return redirect('Inicio');
		}
    } 
    public function burger_info(){
    	if(isset($_POST['burger_name'])){
    		$name=$_POST['burger_name'];
    	}
    	else{
    		echo '<script type="text/javascript">'; 
			echo 'alert("Select Burger first");'; 
			echo 'window.location.href = "http://localhost:8000/Menu";';
			echo '</script>';	
    	}
    	$ham_name=DB::table('hamburger')->where('ham_name', $name)->value('ham_name');
    	$ing=DB::table('hamburger')->where('ham_name', $name)->value('ingredients');
    	$cal=DB::table('hamburger')->where('ham_name', $name)->value('calories');
    	$price=DB::table('hamburger')->where('ham_name', $name)->value('price');
    	return redirect('Inicio?ham_name='.$ham_name.'&ing='.$ing.'&c='.$cal.'#modal2');
    }

    public function store_review(){
		if(isset($_POST['name']) && isset($_POST['e-mail']) && isset($_POST['subject']) && isset($_POST['Msg'])){
			$n=$_POST['name'];
			$e=$_POST['e-mail'];
			$s=$_POST['subject'];
			$m=$_POST['Msg'];
		}
		else{
			echo '<script type="text/javascript">'; 
			echo 'alert("please fill all the fields.");'; 
			echo 'window.location.href = "http://localhost:8000/Contacto";';
			echo '</script>';
		}
		DB::insert('INSERT INTO reviews (c_name, email, subject, comments) VALUES (?,?,?,?)',[$n,$e,$s,$m]);

		echo '<script type="text/javascript">'; 
		echo 'alert("Thank you for the feedback");'; 
		echo 'window.location.href = "http://localhost:8000/Contacto";';
		echo '</script>';
    }

    public function info(){
    	$name = $_POST['burger_name'];
    	$hamburgers=DB::select("select * from hamburger where ham_name = ?",[$name]);
    	return view('info',['hamburgers'=>$hamburgers]);
    }

    public function place_order(){
    	$u=$_POST['username'];
    	$b=$_POST['name'];
    	$i=$_POST['image'];
    	$r=$_POST['Remarks'];
    	$address=DB::table('users')->where('user_name', $u)->value('address');
    	$price=DB::table('hamburger')->where('ham_name', $b)->value('price');
    	if(isset($_POST['Qty'])){
			$Qty=$_POST['Qty'];
		}
		DB::insert('INSERT INTO orders (user_name, delivery_address, item_name, amount, Qty,image,remarks) VALUES (?,?,?,?,?,?,?)',[$u,$address,$b,$price,$Qty,$i,$r]);
		echo '<script type="text/javascript">'; 
		echo 'alert("Order placed successfully");'; 
		echo 'window.location.href = "http://localhost:8000/Menu";';
		echo '</script>';
    }

    public function addburger(){
    	if(isset($_POST['file']) && isset($_POST['name']) && isset($_POST['ing']) && isset($_POST['cal']) && isset($_POST['price'])){
			$n=$_POST['file'];
			$e=$_POST['name'];
			$s=$_POST['ing'];
			$m=$_POST['cal'];
			$p=$_POST['price'];
		}
		$name=DB::table('hamburger')->where('ham_name', $e)->value('ham_name');
		if($name!=$e){
			DB::insert('INSERT INTO hamburger (ham_image, ham_name, ingredients, calories, price) VALUES (?,?,?,?,?)',['proyecto3correct/'.$n,$e,$s,$m,$p]);
			echo '<script type="text/javascript">'; 
			echo 'alert("Burger added successfully");'; 
			echo 'window.location.href = "http://localhost:8000/Menu";';
			echo '</script>';
		}
		else{
			echo '<script type="text/javascript">'; 
			echo 'alert("Burger already exists");'; 
			echo 'window.location.href = "http://localhost:8000/admin_add";';
			echo '</script>';
		}
		
    }

    public function updateburger(){
    	if(isset($_POST['file']) && isset($_POST['name']) && isset($_POST['ing']) && isset($_POST['cal']) && isset($_POST['price'])){
			$n=$_POST['file'];
			$e=$_POST['name'];
			$s=$_POST['ing'];
			$m=$_POST['cal'];
			$p=$_POST['price'];
		}
		$name=DB::table('hamburger')->where('ham_name', $e)->value('ham_name');
		if($name==$e){
			DB::update("UPDATE hamburger  SET ham_image=?, ham_name=?, ingredients=?, calories=?, price=? WHERE ham_name=?",['proyecto3correct/'.$n,$e,$s,$m,$p,$e]);
			echo '<script type="text/javascript">'; 
			echo 'alert("Burger Updated successfully");'; 
			echo 'window.location.href = "http://localhost:8000/Menu";';
			echo '</script>';
		}
		else{
			echo '<script type="text/javascript">'; 
			echo 'alert("No such Burger.");'; 
			echo 'window.location.href = "http://localhost:8000/admin_update";';
			echo '</script>';
		}
    }

    public function deleteburger(){
    	$name =$_POST['name'];
    	DB::select("DELETE FROM `hamburger` WHERE ham_name=?",[$name]);
    	echo '<script type="text/javascript">'; 
		echo 'alert("Burger successfully deleted.");'; 
		echo 'window.location.href = "http://localhost:8000/Menu";';
		echo '</script>';
    }
}
