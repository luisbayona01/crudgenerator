<html lang="en">
                        <head>
                          <title>Bootstrap Example</title>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1">
                          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                          <script src="./public/js/angular.min.js"></script>
                          <script src="./public/js/main.js"></script>
                        </head>
                        <body ng-app="myApp" ng-controller="myCtrl"><div class="container">
                           <h2>listarUsuario</h2>
                           <div class="table-responsive">
                            <table class="table"><thead><tr><th>id</th><th>nombre</th><th>edad</th><th>color</th></tr>
                         </thead><tbody>
                  <tr><td>id</td><td>nombre</td><td>edad</td><td>color</td></tr>
            </tbody></table>
                </div><div id="myModalinsert" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">insertUsuario </h4>
         </div>
       <div class="modal-body">
       <form><div class="form-group">
                           <label for="id">id:</label>
                <input type="text" class="form-control" id="id" placeholder="Enter id" name="id">
                            </div><div class="form-group">
                           <label for="nombre">nombre:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Enter nombre" name="nombre">
                            </div><div class="form-group">
                           <label for="edad">edad:</label>
                <input type="text" class="form-control" id="edad" placeholder="Enter edad" name="edad">
                            </div><div class="form-group">
                           <label for="color">color:</label>
                <input type="text" class="form-control" id="color" placeholder="Enter color" name="color">
                            </div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div></div>
                        </body>
                        </html>