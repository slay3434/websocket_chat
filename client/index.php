<?php


?>

<style>
    .frameDiv{

        width:300px;
    }

    #odpowiedz{
        width:300px;
        height: 500px;
        overflow-y: auto;
        border:1px solid crimson;
        padding:1px;
        border-radius: 10px;
    }

    .centerDiv{
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    .marginTop{
        margin-top:10px;
    }
    .marginTopLow{
        margin-top:3px;
    }
    .odp{
        border: 1px solid green;
        border-radius: 10px;
        width:250px;
        text-align: left;
        padding-left: 3px;
    }
    .odpL{
        margin-left: 0px;
        margin-right: auto;
        background-color: chartreuse;
    }
    .odpR{
        margin-right: 0px;
        margin-left: auto;
        background-color: deepskyblue;
    }

</style>

<div class="frameDiv centerDiv">
    <div class="centerDiv marginTop"><label for="login">Login</label><input id="login" type="text"></div>
    <div class="centerDiv marginTop">
        <input id="message"><button>wyslij</button> 
    </div>    
    <div id="odpowiedz" class="marginTop"></div>
</div>



<script>
    //const socket = new WebSocket('ws://localhost:8080');    
    const socket = new WebSocket('ws://localhost/testWS'); 

    socket.onmessage = ({data})=>{
        showMsg(data);     
    }


    document.getElementsByTagName('button')[0].addEventListener('click',()=>{
        let msg = document.getElementById('message').value;
        document.getElementById('message').value = "";
        let login = document.getElementById('login').value;
        socket.send(JSON.stringify({login:login, msg:msg}));   
    })


    function showMsg(msg){
        let login = document.getElementById('login').value;
        let resp = JSON.parse(msg);
        let el = document.getElementById('odpowiedz');

        let elResp = document.createElement('div');
        elResp.classList.add('odp','marginTopLow',(resp.login==login?'odpR':'odpL'));
        elResp.innerHTML = `<div><b>${resp.login}</b></div>
                            <div>${resp.msg}</div>
                            `;

        el.appendChild(elResp);
        el.scrollTop = el.scrollHeight; 
    }

</script>