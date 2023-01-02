<form method="post">
<div class="mainr">
  <input type="range" min="0" max="100" value="50" id="slider" name="slider">
    <div id="selector">
       <div class="SelectBtn"></div>
       <div id="SelectValue"></div>
        </div> 
        <div id="progressbar"></div>
</div>
<input type="submit" name="s" id="s">
</form>

<?php
  if(isset($_POST["s"]))
  {
    print_r($_POST);
  }
 ?>

<script type="text/javascript">
  var slider=document.getElementById("slider");
  var selector=document.getElementById("selector");
  var SelectValue=document.getElementById("SelectValue");
  var progressbar=document.getElementById("progressbar");
  SelectValue.innerHTML=slider.value;

  slider.oninput=function(){
      SelectValue.innerHTML=this.value;
    
    selector.style.left=this.value + "%";
        progressbar.style.width=this.value + "%";

  }
</script>

<style type="text/css">
  body{
   /* background: #000; */
  }
.mainr{
                          
  width: 60%;
  margin: 24% auto;
  position: relative;
}

#slider{
  -webkit-appearance:none; 
  background: #000;
  width: 100%;
  height: 5px;
  outline: none;
  border-radius: 3px;
}
#slider::-webkit-slider-thumb{
  -webkit-appearance:none;
  width: 48px;
  height: 48px;
  cursor: pointer;
  z-index: 3;
  position: relative;
}


#selector{
   height: 104px;
   width: 48px;
   position: absolute;
   bottom: -20px;
   left: 50%;
   transform: translateX(-50%);
   z-index: 2;

}
.SelectBtn{
    height: 48px;
    width: 48px;
    background-image: url(../assets/img/spinner.gif);
    background-size: cover;
    background-position: center;
    border-radius: 50%;
    position: absolute;
    bottom: 0;
}
#SelectValue{
  width: 48px;
  height: 40px;
  position: absolute;
  top:0;
  background: #ffd200;
  border-radius: 4px;
  text-align: center;
  line-height: 45px;
  font-size: 20px;
  font-weight: bold;
}
#SelectValue::after{
  content: '';
/*  border-top:17px solid #ffd200;
  border-left: 24px solid #000;
  border-right: 24px solid #000; */
  position: absolute;
  bottom: 14px;
  left:0;


}
#progressbar{
  width: 50%;
  height: 7px;
  background:#ffd200;
  border-radius: 3px;
  position: absolute;
  top:0;
  left: 0;
}
</style>

<!-- <body>
    <div id="right_panel"></div>
</body>
<style type="text/css">
	
	#right_panel {
    position: absolute;
    width: 5%;
    padding-left: 4px;
    height: 10%;
    right: 0;
    background-color: #f0f0ff;
}

#right_panel::after {
    content: '';
    background-color: #ccc;
    position: absolute;
    left: 0;
    width: 4px;
    height: 50%;
    cursor: ew-resize;
}
</style>
<script type="text/javascript">
	const BORDER_SIZE = 4;
const panel = document.getElementById("right_panel");

let m_pos;
function resize(e){
  const dx = m_pos - e.x;
  m_pos = e.x;
  panel.style.width = (parseInt(getComputedStyle(panel, '').width) + dx) + "px";

  console.log(panel.style.width);
}

panel.addEventListener("mousedown", function(e){
  if (e.offsetX < BORDER_SIZE) {
    m_pos = e.x;
    document.addEventListener("mousemove", resize, false);

  }
}, false);

document.addEventListener("mouseup", function(){
    document.removeEventListener("mousemove", resize, false);
}, false);
</script>