
<!-- </nav> -->
                
                    <!-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="uno" type="button" role="tab" aria-controls="nav-home" aria-selected="true">uno</button>
                    <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="dos" type="button" role="tab" aria-controls="nav-home" aria-selected="false">dos</button> -->
<div class="divImgHeader">

  <img class="headerImage"  src="img/bannerFinal.jpg" alt="imagen cabecera">
</div>

<div>
<!-- ms-auto sirve para alinear a la derecha -->
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid"> -->
   <!--  <a class="navbar-brand" href="index.php">Inicio</a> -->
 <!--    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <!-- <div class="collapse navbar-collapse" id="navbarNav"> -->
  <ul class="my-nav-ul">
    
   <!--  <li class="my-nav-li active">
      <a class="my-nav-item" href="index.php?page=inicio">Inicio</a>
    </li> -->
    <li class="my-nav-li ">
      <a class="my-nav-item" href="index.php">Plantas</a>
    </li>
    <?php
      if(isset($_SESSION['logeado']) && $_SESSION['logeado']) {
        if($_SESSION['logeado']) {
          echo <<<EOF
          <li style="float:right" class="my-nav-li ">
            <a class="my-nav-item" href="salir.php">Salir</a>
          </li>
          EOF;
        } else {
          echo <<<EOF
          <li style="float:right" class="my-nav-li ">
            <a class="my-nav-item" href="registro.php?page=registro">Registro</a>
          </li>
          EOF;
        }
        
      } else {
        echo <<<EOF
        <li style="float:right" class="my-nav-li ">
          <a class="my-nav-item" href="login.php">Login</a>
        </li> 
        <li style="float:right" class="my-nav-li ">
            <a class="my-nav-item" href="registro.php?page=registro">Registro</a>
        </li>
        EOF;
      }
    ?>
     

  </ul>
    <!-- </div> -->
  </div>
</div>


   