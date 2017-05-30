<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vue Datatable</title>
    <style>
      .banner {
        position: fixed;
        width: 200px;
        background-color: #333;
        top: 25px;
        left: -38px;
        transform: rotate(-37deg);
        color: white;
        text-align: center;
        line-height: 40px;
      }

      .v-table {
        margin-top: 20px;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bulma.css')}}">
</head>
<body>
<form method="POST" action="<?=URL::to('Search')?>">
 {{ csrf_field() }}
    <div class="panel-body" id="app">
    <div class="field has-addons" style="margin-left: 20px;">
  <p class="control">
    <input class="input" type="text" name="findin" placeholder="Find Invoice">
  </p>
  <p class="control">
    
     <input type="submit" class="button is-info" value="Search" >
  </p>
<a href="<?=URL::to('/')?>"  style="margin-left: 20px;"><span class="tag is-primary is-medium">Refresh</span></a>
</div>


    
    <data-table :data-table="tableData"></data-table>
<script type="text/javascript">
    var invoice = {!! json_encode($invoice->toArray()) !!};
   
    </script>
    <script src="{{asset('js/vueapp.js')}}"></script>
    </div>

</body>
</form>
</html>