const Websocket = require('ws');
const server = new Websocket.Server({port:'8080'});

lista=[];

server.addListener('error', function (event) {
    console.log('WebSocket error: ', event);
  });

server.on('connection', socket=>{
    console.log('sdfdsf');
    lista.push(socket);
    socket.on('message',message=>{
        //socket.send(`sfddfd: ${message}`);
     fSend(message);

    })
});


function fSend(msg){
    lista.forEach(item=>{
        try{
        item.send(`${msg}`);
        }catch(ex){
            console.log(ex)
        }
    })
}

// server.listen(8080, '127.0.0.1');
console.log('Node server running on port 8080');