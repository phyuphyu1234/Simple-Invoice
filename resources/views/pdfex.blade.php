
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="{{asset('css/bulma.css')}}">
<div style="margin-left: 10px;margin-right: 10px;">

                   <br><br>
                    Invoice Name  :{{$invoice->invoice}}</br>
                        <table class="table table-hover" style="border-bottom: 0px !important;" >
                            <thead>
                            <tr>
                                
                                <th style="margin-left: 10px;">Item Name</th>
                                <th style="width: 200px;"># of items</th>
                                <th style="width: 130px;">Price</th>
                            
                                <th style="width: 130px;">Total</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                             @foreach ($invoice->itemlsts as $itemlst)
                            <tr>
                                
                                 <td style="margin-left: 10px;">
                                   {{ $itemlst->itname }}
                                </td>
                                <td>
                                 {{ $itemlst->qty }}
                                </td>
                                <td>
                                   {{ $itemlst->price }}
                                </td>
                                
                                <td>
                               
                                   {{ $itemlst->total }}
                                </td>
                                
                                
                            </tr>
                            @endforeach
                            </tbody>
                            
                           
                        </table>
                        </div>
                        <div style="margin-left: 568px;">
                        <table>
                        <tr style="height: 60px">
                        <td colspan="5" class="text-right" >Sub Total</td>
                              
                                  <td colspan="1" class="text-right" style="height: 60px">
                                     {{$invoice->subtotal}}
                                  </td>
                                  </tr>

                            <tr>
                                <td colspan="5" class="text-right" style="width: 100px;">TAX%</td>
                                <td colspan="1" class="text-right">
                                    {{$invoice->tax}}
                                <td></td>
                            </tr>
                            <tr style="height: 60px">
                                <td colspan="5" class="text-right">TOTAL</td>
                               
                                  <td colspan="1" class="text-right">
                                      {{$invoice->alltotal}}
                                  </td>
                                <td></td>
                            </tr>

                        </table>
                        </div>
                        

               
                     
                   

        