<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/user.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/message.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
            function hui(){
              var myHeaders = new Headers();
                myHeaders.append("Content-Type", "application/json");
                var p1=document.getElementById('kp').innerHTML;
                var p1=p1.substr(6)
                var raw = JSON.stringify({"Authentication":"helloatg","user_id":p1})
                var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
                };
                console.log("pii");
                fetch("http://127.0.0.1:8000/mango", requestOptions)
                .then(response => response.json()).then(
                  data=>{
                    console.log(data)
                    if (data.status==1){
                    var p= data.data;
                    var m='<table class="table"><thead>';
                    m+='<tr><td>Task Id</td><td>Task</td><td>status</td></tr></thead>'
                    m+='<tbody>'
                    for(var i=0;i<p.length;i++){
                      m+="<tr>"
                      m+="<td>"+p[i].id+"</td>"
                      m+="<td>"+p[i].task+"</td>"
                      m+="<td>"+p[i].status+"</td>"
                      m+="</tr>"
                    }
                    m+='</tbody></table>'
                    document.getElementById('pu').innerHTML=m;
                  }else{
                    document.getElementById('pu').innerHTML="no task yet";

                  }
                }).catch(error=>{
                      console.log(error);
                });
            }
            function fun(){
                document.getElementById('oi').innerHTML="";
                document.getElementById('tii').innerHTML="";
                hui();
                
            }
            function onClick1(){

              var preloader=document.getElementById('fp-loader');
              preloader.style.display='block';
              var myHeaders = new Headers();
              myHeaders.append("Content-Type", "application/json");
              var p1=document.getElementById('kp').innerHTML;
              var p1=p1.substr(6)
              var p2=document.getElementById("ta").value
              var p3=document.getElementById("auth").value
              var raw = JSON.stringify({"Authentication":p3,"user_id":p1,"task":p2})
              var requestOptions = {
              method: 'POST',
              headers: myHeaders,
              body: raw,
              redirect: 'follow'
              };
              fetch("http://127.0.0.1:8000/todo/add", requestOptions)
                .then(response => response.json())
                .then(data=>{
                  hui();
                  var p="";
                  if(data.status==0){
                  preloader.style.display='none';
                  for(var i=0;i<data.message.length;i++){
                    p+='<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-exclamation-circle"></i></strong><span class="po">'+data.message[0]+'</span></div>';
                  } 
                  document.getElementById('oi').innerHTML=`${p}`;
                  
                }else{
                  preloader.style.display='none';
                  p+='<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-check"></i></strong><span class="po">'+data.message+'</span></div>'
                  document.getElementById('oi').innerHTML=`${p}`;
                  var p1='<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-check"></i></strong><span class="po">please note task id of this generated task is</span><div>'+data.task.id+'</div></div>'
                  document.getElementById('tii').innerHTML=`${p1}`;

                }
            }).catch(error=>{

                  preloader.style.display='none';
                  console.log(error);
                });
            }

            function onClick2(){
              var preloader=document.getElementById('fp-loader');
              preloader.style.display='block';
              var myHeaders = new Headers();
              myHeaders.append("Content-Type", "application/json");
              var p1=document.getElementById("ti").value
              var p2=document.getElementById("au").value
              var p3=document.getElementById("st").value
              var raw = JSON.stringify({"Authentication":p2,"task_id":p1,"status":p3});
              var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                //mode:'no-cors',
                body: raw,
                redirect: 'follow'
              };
              fetch("http://127.0.0.1:8000/todo/status", requestOptions)
              .then(response => response.json())
              .then(data=>{
                hui()
                var p=""
                console.log(data);
                //var p=data.predicted_crop
                if(data.status==0){
                  preloader.style.display='none';
                  p+='<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-exclamation-circle"></i></strong><span class="po">'+data.message+'</span></div>';
                  document.getElementById('oi').innerHTML=`${p}`;
                }else{
                  preloader.style.display='none';
                  p+='<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-check"></i></strong><span class="po">'+data.message+'</span></div>'
                
                  document.getElementById('oi').innerHTML=`${p}`;

                }
              }).catch(error=>{
                  console.log(error);
                  preloader.style.display='none';
                });

            }
        </script>

        <style>
        button, input {
           overflow: visible;
            border-radius: 9px;
        }
        #po1{
          background-color: orange;
          border: 2px solid brown;
        }
        #po{
          background-color: orange;
          border: 2px solid brown;
        }
          #po1 .col-md-4{
            padding-left:180px;
            margin-block: 20px;
          }
          #po .col-md-3{
            padding-left:180px;
            margin-block: 20px;
          }
          #po{
            margin-top:40px;
          }
          #fp-loader{
              position: fixed;
              width:100%;
              height: 100%;
              top:0;
              left: 0;
              z-index: 9999;
              background: url({{URL::asset('image/Spinner-1s-137px.gif')}}) 50% 50% no-repeat rgba(34, 218, 202, 0.24);
              display: none;
          }
          .tui .tui1{
              font-size:30px;

          }
          @media screen and (max-width:768px){
            .tui .tui1{
              font-size:20px;

            }
          }
          table
          {
            border-collapse: collapse;
            display: block;
          }
          thead
          {
            display: block;
          }
          tbody
          {
            display: block;
          }
          tr
          {
            display: flex;
          }
          td
          {
           flex: 1;
           padding: 5px 10px 20px 5px;
           border: 1px solid black;
          }
          </style>
    </head>
 <body onload=fun()>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fa fa-user-circle"></i>
      </label>
      <label class="logo">laravel</label>
       <ul>
        <li><i style="font-size: 30px" class='fa fa-user-circle'></i><span>{{session('LoggedUser')[0]}}</span></li>
      </ul>
    </nav>
    <div class="row">
    <div class="col-md-6">
    <div class="tui">
      <div class="tui1" >Hello {{session('LoggedUser')[0]}} </div>
      <div class="tui1" id="kp">Name: {{session('LoggedUser')[0]}}</div>
      <div class="tui1">Email: {{session('LoggedUser')[1]}}</div>
      <div class="tui1">Pincode: {{session('LoggedUser')[2]}}</div>
    </div>
    </div>
    <div class="col-md-6" id="pu">

    </div>
    </div>

    <div id="oi"></div>
    <div id="tii"></div>
    <h3>add a task</h3>
    <div class="row" id="po1">
    <div  class="col-md-4">
    <div>task</div>
    <input name="task" id="ta" palaceholder="enter   task"/>
    </div>
    <div  class="col-md-4">
    <div>api key</div>
    <input name="Authenticatin" id="auth" palaceholder="enter api key"/>
    </div>
    <div  class="col-md-4">
    <button onclick=onClick1() type="button" class="btn btn-info">add</button>
    </div>
    </div>
    <h3>update a task</h3>
    <div class="row" id="po">
    <div class="col-md-3">
    <div>task id</div>
    <input name="task_id" id="ti" palaceholder="enter task id"/>
    </div>
    <div  class="col-md-3">
    <div>status(done/pending)</div>
    <input name="staus" id="st" palaceholder="enter status of the task"/>
    </div>
    <div  class="col-md-3">
    <div>Api Key</div>
    <input  name="Authenticatin" id="au" palaceholder="enter api key"/>
    </div>
    <div  class="col-md-3">
    <button onclick=onClick2() type="button" class="btn btn-info">update</button>
    </div>
     </div>

    <td><a href="{{route('logout')}}">logout</a></td>
    <div id="fp-loader"></div>
  </body>

</html>