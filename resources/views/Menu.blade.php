<?php
  session_start();
  if(!isset($_SESSION['userid']))
  {
    header("location:Inicio.php?hmsg=Please Login First");
  } 
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="ciudad.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>Menu</title>
</head>
<body bgcolor="black" text="white">
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <label class="logo"><img src="proyecto3correct/5.png" height="60px" width="120px">&emsp;&emsp;</label>
    <ul>
            <li><a href="http://localhost:8000/Inicio">INICIO</a></li>
            <li><a href="http://localhost:8000/Sobre_Nosotros">SOBRE_NOSOTROS</a></li>
            <li><a href="http://localhost:8000/Menu"><font color='red'>MENU</font></a></li>
            <li><a href="http://paj9373.uta.cloud/">BLOG</a></li>
            <li><a href="http://localhost:8000/Contacto">CONTACTO</a></li>
            <?php
                if(isset($_SESSION['userid'])){
                  $name = $_SESSION['userid'];
                  if(isset($_SESSION['role'])){
              $role=$_SESSION['role'];
              if($role=="admin"){
                echo"<li><a href='http://localhost:8000/Admin'>ADMIN</a></li>";
                echo "<li><a href='http://localhost:8000/logout'>LOGOUT</a></li>";
              }
              else{
                echo"<li><a href='http://localhost:8000/order'>Orders &nbsp</a></li>";
                echo"<li><a href='http://localhost:8000/logout'>LOGOUT &nbsp</a></li>";
                echo"<li><a href='http://localhost:8000/Inicio'> &nbsp; Hello!! &nbsp;".$name."</a></li>";
              }
            }
                }
                else{
                  echo"<li><a href='#modal1' class='modal1-open'>REGISTRO</a></li>";
                  echo"<li><a href='#modal' class='modal-open'>INICIAR_SESSION</a></li>";
                }
              ?>
    </ul>
    <div class="zigzag-header"></div>
  </nav>

<div class="back6-image">
    <br><br><br><br><br><br><br><br>  
    <center>LAS MEJORES DE LA CIUDAD</center><br>
    <center><h1>Menú</h1></center><br>
    <br><br><br>
    <div class="zigzag-inverted"></div>
    <br>
    <center> 
                <br><br><br><br>
                <h1>pide tu hamburguesa ahora</h1>
            
            <br><br>
            <div style="width: 70%;">
            @foreach($hamburgers as $hamburgers)
              <figure>
              <form action="/info" method="post">
                @csrf
                <input type='hidden' name='burger_name' value="{{$hamburgers->ham_name}}">
                <img src="{{$hamburgers->ham_image}}" height='150px' width='150px'>
                <figcaption>
                  <span>{{$hamburgers->ham_name}}</span><br>
                  <span>$ {{$hamburgers->price}}</span><br>
                  <input type='submit' value='ordenar ahora' name='order' class='b3'>
                </figcaption>
              </form>
            </figure>
            @endforeach
            </div>
            <br><br>
            </center>
            <br><br>
            <div class="backfooter-image">  
      <div class="zigzag"></div>
      <footer>
        <br><br>
             <center><img src="proyecto3correct/5.png" height="180" width="250"></center> 
              <center>
                <h3>Habla a:</h3>
                Av. Intercomunal, sector la Mora, calle 8
                <h3>Telefono:</h3>
                +58 251 261 00 01
                <h3>Correo:</h3>
                yourmail@gmail.com
                <br/><br>
                <div style="align-items: center; width: 20%;">
                <a href="#" class="fa fa-pinterest"></a>
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-dribbble"></a>
                <a href="#" class="fa fa-linkedin"></a>
                <a href="#" class="fa fa-vimeo"></a>
                <br/>
              </div>
              <br>
                copyright &copy;2020 Todos los derechos reservados | Este sitio esta hecho con por DiazApp 
            </center>
      </footer>
    </div>
  </div>

<div class="modal" id="modal">
    <div class="modal__content">
      <a href="#" class="modal__close" style="visibility: visible; color: black;">X</a>
      <h3 class="modal__heading"><img src="proyecto3correct/Burguer.png" height="30px" width="30px">         Iniciar Sesion</h3>
      <hr>
      <div align="left">
        <form action='/login' method="post">
          @csrf 
        &nbsp;&nbsp;Usuario:<br>
        <center><input type="text" name="userid" class="t3" required></center>
        &nbsp;&nbsp;Contrasena:<br>
        <center><input type="Password" name="pwd" class="t3" required></center>
        <div style="text-align: right; padding-right: 10px;">
        <br><hr><br>
        <input type="submit" name="login" value="Entrar" class="b1" align="Right">
        </div>
      </form>
 </div>
    </div>
 </div>

 <div class="modal1" id="modal1">
    <div class="modal1__content">
      <a href="#" class="modal1__close" style="visibility: visible; color: black;">X</a>
      <h2 class="modal1__heading"><img src="proyecto3correct/Burguer.png" height="20px" width="20px">         Registro de Usuario</h2><br>
      <hr>
      <div align="left">
      <form name="form" action="/register" method="post">
      @csrf
      &nbsp;&nbsp;Nombre y apellido:<br>
      <center><input type="text" name="userid" class="t3" required></center>
      &nbsp;&nbsp;Correo:<br>
      <center><input type="email" name="mail" class="t3" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" title="email is not in a correct format" required></center>
      &nbsp;&nbsp;Contrasena:<br>
      <center><input type="password" name="pwd" class="t3" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></center>
      &nbsp;&nbsp;Repetir Contrasena:<br>
      <center><input type="password" name="repwd" class="t3" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></center>
      &nbsp;&nbsp;Direccion:<br>
      <center><input type="text" name="address" class="t3" required></center>
      <br><hr><br>
      <div style="text-align: right; padding-right: 10px;">
      <input type="submit" name="register" value="Cargar" onclick="ValidateEmail(document.form1.mail)" class="b1" align="Right">
      </div>
      </form>
      <script>
          function ValidateEmail(inputText)
            {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(inputText.value.match(mailformat))
            {
            document.form.mail.focus();
            return true;
            }
            else
            {
            alert("You have entered an invalid email address!");
            document.form.mail.focus();
            return false;
            }
            }
      </script>
 </div>
</div>
</div>
</body>
</html>