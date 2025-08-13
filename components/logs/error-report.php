<?php
if(isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];

    $type = $msg['type'];
    $message = $msg['text'];


    if($type == 'd'){
        //  DANGER MODAL
        ?>
            <style>
                .blinking{
                    animation:blinkingText 1.2s infinite;
                }
                @keyframes blinkingText{
                    0%{     color: #fa0000;    }
                    15%{    color: rgba(255, 0, 20, 0.93); }
                    40%{    color: rgba(250, 5, 25, 0.84); }
                    60%{    color: rgba(255, 0, 0, 0.72); }
                    75%{    color: rgba(250, 0, 0, 0.55); }
                    85%{    color: rgba(250, 0, 0, 0.62);  }
                    100%{   color: rgba(250, 0, 0, 0.73);    }
                }
            </style>
        <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-danger">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout fa fa-exclamation-triangle blinking"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }
    elseif($type == 'i'){
        ?>
        <div -id="divDis" class="animated--grow-in text-dark fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-secondary">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout fa fa-info-circle"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }
    elseif ($type == 'w'){
        //  WARNING MODAL
        ?>
        <div -id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout fa fa-exclamation"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }
    elseif ($type == 's'){
        //  SUCCESS MODAL
        ?>
        <div id="divDis" class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-success">
            <div class="closebtn">
                <!-- <span style="color: firebrick" class="fa fa-window-close"></span> -->
            </div>
            <span class="animated--grow-in fadeout fa fa-check"></span> <?php echo $message  ?>
            <span style="float: right; color: firebrick; font-size:15px" href="#!" class="closebtn" data-bs-dismiss="toast" aria-label="Close"><span class="fa fa-times"></span></span>
        </div>
        <?php
    }

    unset($_SESSION['message']);

}

?>

<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 1000);
        }
    }
</script>


<script type="text/javascript">
    //close div in 5 secs
    window.setTimeout("closeDisDiv();", 10000);

    function closeDisDiv(){
        document.getElementById("divDis").style.display="none";
        $(".fadeout").click(function (){
            $("div").fadeOut();
        });
    }
</script>


