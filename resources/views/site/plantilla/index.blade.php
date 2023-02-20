<div class="btnbg">
</div>
<style>
body {
    padding:0;
    margin:0;
    overflow:hidden;
	  height: 600px;
    background-color: #000000;
}
canvas {
    padding:0;
    margin:0;
}
div.btnbg {
    position:fixed;
    left:0;
    top:0;
}



.large-header {
   position: relative;
   width: 100%;
   background: #111;
   overflow: hidden;
   background-size: cover;
   background-position: center center;
   z-index: 1;
}

.main-title {
   font-family: sans-serif;
   font-size: 2em;
   position: absolute;
   margin: 0;
   padding: 0;
   color: #FFFFFF;
   text-align: center;
   top: 50%;
   left: 50%;
   -webkit-transform: translate3d(-50%, -50%, 0);
   transform: translate3d(-50%, -50%, 0);
}

.demo .main-title {
   text-transform: uppercase;
   font-size: 4.2em;
   letter-spacing: 0.1em;
}

.lara_tittle{
  font-size: .6em;
  font-weight: 100;
  display: block;
  text-align: right;
}

.laraimg{
  position:relative;
  top:3px;
}

.inter_larimg{
  width: 20px;
}

.main-title .thin {
   font-weight: 200;
       font-size: 1.5em;
}

@media only screen and (max-width: 768px) {
   .demo .main-title {
      font-size: 3em;
   }
}
</style>

<h1 class="main-title">
    <span class="thin"><?=env('APP_NAME')?></span>
    <span class="lara_tittle">
        <span class="laraimg"><a href="{{ action('Framework\Login@index') }}"><img class="inter_larimg" src="img/laravel.svg"></a></span>
        <?=env('SLOGAN_NAME')?>
    </span>
</h1>
