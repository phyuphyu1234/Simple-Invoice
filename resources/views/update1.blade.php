
<link rel="stylesheet" type="text/css" href="{{asset('css/bulma.css')}}">
<h2 class="title is-2">Update Invo</h2>
<form method="POST" action="<?=URL::to('restore')?>/{{$invoice->id}}">
            {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
<div class="panel-body" id="app">
                    <h1>New Invoice</h1><br><br>
                    Invoice Name  :<input type="text" style="width: 300px;" value="{{$invoice->invoice}}" name="iname"></br>
                        <table class="table table-hover" style="border-bottom: 0px !important;" >
                            <thead>
                            <tr>
                                
                                <th>Item Name</th>
                                <th style="width: 200px;"># of items</th>
                                <th style="width: 130px;">Price</th>
                            
                                <th style="width: 130px;">Total</th>
                                <th style="width: 130px;"></th>
                            </tr>
                            </thead>
                            <tbody v-sortable.tr="rows">
                            <tr v-for="row in rows" track-by="$index">
                                
                                 <td>
                                    <input class="input" name="itname[]" v-model="row.itname"/>
                                </td>
                                <td>
                                    <input class="input" name="qty[]" v-model="row.qty" number/>
                                </td>
                                <td>
                                    <input class="input text-right" name="price[]" v-model="row.price" number data-type="currency"/>
                                </td>
                                
                                <td>
                                 <input class="input text-right" :value="row.qty * row.price | currencyDisplay" v-model="row.total | currencyDisplay" number readonly />
                                    <input type="hidden" name="total[]" class="form-control text-right" :value="row.qty * row.price" v-model="row.total" readonly />
                                    <input type="hidden" :value="row.qty * row.price * row.tax / 100" v-model="row.tax_amount" number/>
                                    <input type="hidden"  name="qtytotal" v-model="qtytotal" number/>
                                </td>
                                
                                <td>
                                    
                                    <button type="button" class="delete is-large" @click="removeRow($index)" width="60"></button>
                                   
                                </td>
                            </tr>
                            </tbody>
                             <td colspan="1" class="text-left" >
                                    
                                     <button type="button" class="btn text-left" @click="addRow($index)" style="text-align: center;"><span class="glyphicon glyphicon-plus"></span>Add Item</button>
                                  </td>
                           
                        </table>
                        <div style="margin-left: 878px;">
                        <table>
                        <tr style="height: 60px">
                        <td colspan="5" class="text-right" >Sub Total</td>
                              
                                  <td colspan="1" class="text-right" style="height: 60px">
                                     <input name="subtotal" style="width: 300px;" class="input text-right" :value="total" v-model="total" number readonly />
                                  </td>
                                  </tr>
                            <tr style="height: 60px">
                                <td colspan="5" class="text-right" style="width: 100px;">TAX%</td>
                                <td colspan="1" class="text-right">
                                    <input name="tax" style="width: 300px;" class="input text-right" :value="{{$invoice->tax}}" v-model="row.mytax" number  /> </td>
                                <td></td>
                            </tr>
                            <tr style="height: 60px">
                                <td colspan="5" class="text-right">TOTAL</td>
                               
                                  <td colspan="1" class="text-right">
                                     <input name="alltotal" style="width: 300px;" class="input text-right" :value=" total+(total*row.mytax/100)" v-model="total+(total*row.mytax/100)" number readonly />
                                  </td>
                                <td></td>
                            </tr>

                        </table>
                        

                        </div>
                        <div class="form-group">
                         @include('error')
                        </div>

                       
                       <input type="submit"  value="Update" style="padding: 3px 50px;margin-left: 10px; ">
                       </form>
                     
                   

        <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/accounting.min.js')}}"></script>
           <script type="text/javascript" src="{{asset('js/Sortable.js')}}"></script>
              <script type="text/javascript" src="{{asset('js/vue.min.js')}}"></script>
             <script>
               var invoice = {!! json_encode($invoice->toArray()) !!};
               var itemlst = {!! json_encode($itemlsts->toArray()) !!};
                Vue.filter('currencyDisplay', {
    // model -> view
    read: function (val) {
        if (val > 0) {
            return accounting.formatMoney(val, "$", 2, ".", ",");
        }
    },
    // view -> model
    write: function (val, oldVal) {
        return accounting.unformat(val, ",");
    }
});

Vue.directive('sortable', {
    twoWay: true,
    deep: true,
    bind: function () {
        var that = this;

        var options = {
            draggable: Object.keys(this.modifiers)[0]
        };

        this.sortable = Sortable.create(this.el, options);
        console.log('sortable bound!')

        this.sortable.option("onUpdate", function (e) {            
            that.value.splice(e.newIndex, 0, that.value.splice(e.oldIndex, 1)[0]);
        });

        this.onUpdate = function(value) {            
            that.value = value;
        }
    },
    update: function (value) {        
        this.onUpdate(value);
    }
});
  var invoices = invoice;
                 
            console.log(itemlst);
            
              
var vm = new Vue({
    el: '#app',
    data: {
        rows: itemlst,
        total: 0,
        grandtotal: 0,
        taxtotal: 0,
        delivery: 0
    },
    computed: {
        total: function () {
            var t = 0;
            $.each(this.rows, function (i, e) {
                t += accounting.unformat(e.total, ",");
            });
            return t;
        },
        qtytotal: function () {
            var t = 0;
            $.each(this.rows, function (i, e) {
                t += accounting.unformat(e.qty, ",");
            });
            return t;
        },
        
    },
    methods: {
        addRow: function (index) {
            try {
                this.rows.splice(index + 1, 0, {});
            } catch(e)
            {
                console.log(e);
            }
        },
        removeRow: function (index) {
            this.rows.splice(index, 1);
        },
        
    }
});

              </script>