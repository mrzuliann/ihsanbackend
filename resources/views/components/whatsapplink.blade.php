
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    <!-- TR-WP.COM -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<div class="trwpwhatsappall">
{{-- <div class="trwpwhatsappballon"> --}}
 <span id="kapatac" class="kapat">X</span>
  <div class="trwpwhatsapptitle">
     WhatsApp Helpdesk
  </div>
  <div class="trwpwhatsappmessage">
   halo, ada yg bisa dibantu?
  </div>
  <div class="trwpwhatsappinput">
    <form action="https://web.whatsapp.com/send?" method="get" target="_blank">
      <input type="text" name="phone" value="90" hidden>
    	<input type="text" name="text" placeholder="Hallo Mohon bantu" autocomplete="off">
      <button class="trwpwhatsappsendbutton" type="submit">
      <i class="fa fa-paper-plane-o"></i>
      </button>
    </form>
  </div>
</div>


<div id="ackapa" class="trwpwhatsappbutton">
<i class="fa fa-whatsapp"></i> <span>WhasApp Disdikbud Kab.Balangan</span>
</div>
<style>
    /* TR-WP.COM */

@import url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

@import url('http://fonts.googleapis.com/css?family=Lato:100,300,400|Raleway:100,300,400,500,600,700|Open+Sans:100,300,400,500,600');

body {
background-color: #444;
height: 1200px;
}

.trwpwhatsappballon {
font-size: 14px;
border-radius: 12px;
border: 1px solid #fff;
max-width: 250px;
}

.trwpwhatsapptitle {
background-color: #22c15e;
color: white;
padding: 14px;
border-radius: 12px 12px 0px 0px;
text-align: center;
}

.trwpwhatsappmessage {
padding: 16px 12px;
background-color: white;
}

.trwpwhatsappinput {
background-color: white;
border-radius: 0px 0px 12px 12px;
}

.trwpwhatsappinput input {
width: 206px;
border-radius: 10px;
margin: 1px 1px 0px 10px;
padding:10px;
font-family: "Raleway", Arial, sans-serif;
font-weight: 300;
font-size: 13px;
background-color: #efefef;
border: 1px solid #d4d4d4;
}

.trwpwhatsappbutton {
background-color: #22c15e;
border-radius: 20px;
padding: 8px 15px;
cursor: pointer;
color: #fff;
max-width: 220px;
margin-top: 10px;
margin-bottom: 10px;
-webkit-touch-callout: none;
-webkit-user-select: none;
-khtml-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

.trwpwhatsappall {
position: fixed;
z-index: 9999999999999999999;
bottom: 0;
right: 10px;
font-family: "Raleway", Arial, sans-serif;
font-weight: 300;
font-size: 15px;
}

.trwpwhatsappsendbutton {
  color: #22c15e;
  cursor:pointer;
}

button {border: none;}
button i {
float: right;
position: absolute;
z-index: 999999999999;
right: 23px;
top: 11;
bottom: 81px;
font-size: 18px !important;
}

.kapat {
position: absolute;
right: 8px;
top: 6px;
font-size: 13px;
border: 1px solid #fff;
border-radius: 99px;
padding: 2px 5px 2px 5px;
color: white;
font-size: 10px;
cursor: pointer;
}
</style>

<script>
    // TR-WP.COM

$(document).ready(function() {
$("#ackapa").click(function() {
$(".trwpwhatsappballon").toggle(1000);
});
$("#kapatac").click(function() {
$(".trwpwhatsappballon").toggle(1000);
});
});
</script>
