<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Bootstrap CSS (only once) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <title>Phisis</title>

  <style>

  /*
    keyframes apear
  */ 

    body {
      font-family: "Lato", sans-serif;
    }

    header {
      box-shadow: inset -2px 8px 300px -150px rgba(0,0,0,1);
      padding: 1vw;
      background-color: rgba(255, 255, 255, 0);
      backdrop-filter: blur(15px);
    }

    .rock-salt-regular {
      font-family: "Rock Salt", cursive;
      font-weight: 400;
      font-style: normal;
      cursor: default;
    }

    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: rgba(17, 17, 17, 0.288);
      backdrop-filter: blur(5px);
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #f1f1f1;
      display: block;
      transition: 0.3s;
    }

    .sidenav a:hover {
      color: #a9abab;
    }

    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }

 
    .closebtn:active {
      transform: rotateX(360deg);
      transition: 0.5s;
    }

    .navContainer {
      /*background-color: #474747;*/
      display: flex;
      flex-direction: column;
      gap: 2vh;
    }

    .navContainer img {
      width: 35%;
      height: auto;
    }

    .itemNav {
      background-color: #2929291a;
      backdrop-filter: blur(5px);
      width:90%;
      border-top-right-radius: 20px;  
      border-bottom-right-radius: 20px; 
    }

    .itemNav:hover {
      background-color: #47474762;
      border-left: 0.5vw solid #81818183;
    }

    .logo {
      margin-bottom: 15%;
    }

    .logo h1 {
      font-size: 300%;
    }

    .menu:active {
      transition: 0.3s;
      transform: rotatex(90deg);
    }

    .ativo {
      background-color: #3b3b3b;
      backdrop-filter: blur(5px);
      width:90%;
      border-top-right-radius: 20px;  
      border-bottom-right-radius: 20px;
      border-left: 0.5vw solid #4a4a4a;
    }

    .ativo:hover {
      background-color: #2b2b2b;
      
    }

    .bg {
      
    }

    .inicio {
      background-image: url(wallpaper.jfif);

      height: 100vh;
    }

    #titulo {
      
      h1 {
        margin-top: 3vw;
        margin-left: 10vw;
        font-size: 11vw;
      }
    }

    .amatic-sc-regular {
      font-family: "Amatic SC", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .amatic-sc-bold {
      font-family: "Amatic SC", sans-serif;
      font-weight: 700;
      font-style: normal;
    }


  </style>
</head>

<body>
  <div class="inicio">
    <!-- Header -->
  <header class="d-flex align-items-center justify-content-between bg">
    <button class="btn btn-dark menu" style="font-size:30px;cursor:pointer;" onclick="openNav()" aria-label="Open menu">
      <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M120-240v-66.67h720V-240H120Zm0-206.67v-66.66h720v66.66H120Zm0-206.66V-720h720v66.67H120Z"/></svg>
    </button>

    <h3 class="rock-salt-regular">physis</h3>
  </header>

 

  <!-- Side Navigation -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <div class="navContainer">
      <div class="d-flex flex-sm-row align-items-center logo">
        <img src="logo.png" alt="logo">
        <h1 class="rock-salt-regular">
          physis
        </h1>
      </div>
      
      <a href="inicio.php" class="d-flex align-items-center itemNav" id="inicio">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M226.67-186.67h140v-246.66h226.66v246.66h140v-380L480-756.67l-253.33 190v380ZM160-120v-480l320-240 320 240v480H526.67v-246.67h-93.34V-120H160Zm320-352Z"/></svg>
        Início
      </a>

      <a href="plantas.php" class="d-flex align-items-center itemNav" id="plantas">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M480-80q-72.33-8.33-144-40.83T207.5-212q-56.83-58.67-92.17-146Q80-445.33 80-563.32V-602h38.67Q171-602 229-584t104.33 48q9.34-88.67 50.17-182.5T480-879.33q55.67 67 96.5 160.83 40.83 93.83 50.17 182.5Q673-564.67 731-583.33 789-602 841.33-602H880v38.68q0 117.99-35.33 205.32-35.34 87.33-92.17 146t-128.33 91.17Q552.67-88.33 480-80Zm4.67-68q-11-179.33-104.43-271.79Q286.81-512.25 148-534q12.33 185.67 108.83 277 96.5 91.33 227.84 109Zm-5.34-248q14.34-24.67 37.84-52.5 23.5-27.83 45.5-46.83 2.66-64.34-20.84-131.67-23.5-67.33-61.83-137-38.33 69.67-61.83 137t-20.84 131.67q22 19 45 46.83t37 52.5Zm72 230.67q43.67-15.34 88-41.67 44.34-26.33 80.84-69.5T781.83-383Q807-446.33 812-534q-102 16-179.67 71.17-77.66 55.16-115.66 137.5 12 36 20.83 74.33 8.83 38.33 13.83 85.67Zm-72-230.67Zm72 230.67ZM484.67-148Zm32-177.33ZM480-80Z"/></svg>
        Plantas
      </a>

      <a href="faq.php" class="d-flex align-items-center itemNav" id="faq">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M548.67-346.67q16.73 0 29.03-12.3T590-388q0-16.73-12.3-29.03t-29.03-12.3q-16.73 0-29.04 12.3-12.3 12.3-12.3 29.03t12.3 29.03q12.31 12.3 29.04 12.3ZM522-473.33h51.33q1.34-29 7.67-42.84Q587.33-530 612-554q28-27.33 38.33-46.43 10.34-19.1 10.34-44.9 0-45.59-31.5-74.46-31.5-28.88-82.5-28.88-39 0-69.17 21.34Q447.33-706 434-668.67l48 20q10.33-25 26.5-37.83 16.17-12.83 38.17-12.83 27.85 0 45.26 15.83 17.4 15.83 17.4 40.83 0 18-8.66 32.17Q592-596.33 570-578.67q-32.33 29-40.17 46.17-7.83 17.17-7.83 59.17Zm-242 260q-27 0-46.83-19.84Q213.33-253 213.33-280v-533.33q0-27 19.84-46.84Q253-880 280-880h533.33q27 0 46.84 19.83Q880-840.33 880-813.33V-280q0 27-19.83 46.83-19.84 19.84-46.84 19.84H280Zm0-66.67h533.33v-533.33H280V-280ZM146.67-80q-27 0-46.84-19.83Q80-119.67 80-146.67v-600h66.67v600h600V-80h-600ZM280-813.33V-280v-533.33Z"/></svg>
        Faq
      </a>

      <a href="sobre.php" class="d-flex align-items-center itemNav" id="sobre">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="m260.67-524 220-356 220 356h-440ZM704-80q-74.33 0-125.17-50.83Q528-181.67 528-256t50.83-125.17Q629.67-432 704-432t125.17 50.83Q880-330.33 880-256t-50.83 125.17Q778.33-80 704-80Zm-584-23.33v-309.34h309.33v309.34H120Zm584.06-43.34q45.94 0 77.61-31.72 31.66-31.72 31.66-77.67 0-45.94-31.72-77.61-31.72-31.66-77.67-31.66-45.94 0-77.61 31.72-31.66 31.72-31.66 77.67 0 45.94 31.72 77.61 31.72 31.66 77.67 31.66ZM186.67-170h176v-176h-176v176ZM380-590.67h201.33L480.67-753.33 380-590.67Zm100.67 0ZM362.67-346ZM704-256Z"/></svg>
        sobre
      </a>

      <a href="contato.php" class="d-flex align-items-center itemNav"id="contato">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#FFFFFF"><path d="M796-120q-119 0-240-55.5T333-333Q231-435 175.5-556T120-796q0-18.86 12.57-31.43T164-840h147.33q14 0 24.34 9.83Q346-820.33 349.33-806l26.62 130.43q2.05 14.9-.62 26.24-2.66 11.33-10.82 19.48L265.67-530q24 41.67 52.5 78.5T381-381.33q35 35.66 73.67 65.5Q493.33-286 536-262.67l94.67-96.66q9.66-10.34 23.26-14.5 13.61-4.17 26.74-2.17L806-349.33q14.67 4 24.33 15.53Q840-322.27 840-308v144q0 18.86-12.57 31.43T796-120ZM233-592l76-76.67-21-104.66H187q3 41.66 13.67 86Q211.33-643 233-592Zm365.33 361.33q40.34 18.34 85.84 29.67 45.5 11.33 89.16 13.67V-288l-100-20.33-75 77.66ZM233-592Zm365.33 361.33Z"/></svg>
        contato
      </a>


     
      

    </div>
    
  </div>
  

  

  
  

  <!-- JS for sidenav -->
  <script>

    function openNav() {
      if (window.innerWidth > 1080) {
        document.getElementById("mySidenav").style.width = "30%";
        console.log("Largura da janela:", window.innerWidth, "px");
      } else {
        document.getElementById("mySidenav").style.width = "100%";
        console.log("Largura da janela:", window.innerWidth), "px";
      }
      
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    
    const caminho = window.location.pathname;

    if (caminho.includes('inicio.php')) {

      document.getElementById('inicio').classList.remove('itemNav');

      document.getElementById('inicio').classList.add('ativo');

    } else if (caminho.includes('plantas.php')) {

      document.getElementById('plantas').classList.remove('itemNav');

      document.getElementById('plantas').classList.add('ativo');

    } else if (caminho.includes('faq.php')) {

      document.getElementById('faq').classList.remove('itemNav');

      document.getElementById('faq').classList.add('ativo');

    } else if (caminho.includes('sobre.php')) {

      document.getElementById('sobre').classList.remove('itemNav');

      document.getElementById('sobre').classList.add('ativo');

    } else if (caminho.includes('contato.php')) {

      document.getElementById('contato').classList.remove('itemNav');

      document.getElementById('contato').classList.add('ativo');

    } 

  </script>
