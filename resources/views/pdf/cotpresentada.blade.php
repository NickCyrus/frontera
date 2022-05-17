<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 120px 20px 20px 20px ;
                font-family: Arial, Helvetica, sans-serif;
            }

            header {
                position: fixed;
                display: block;
                width: 100%;
                top:-100px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            main{
                
            }

            .page-break {
                  page-break-after: always;
            }

            .box-logo{
                display: inline-block;
                width: 20%;
                border:1px solid #000;
                width: 200px;
            }
            .box-info-header{
                width: 60%;
            }

            .box-logo img{
                width: 100%;
                max-height: 100px;
            }

            .fl{float:left;}
            .fr{float:right;}
            .tdpadding{
                padding: 5px;
            }
            .tdbackgound{
                background: #D8D8D8;
            }
            
            .tc{ text-align: center; }
            .tr{ text-align: right; }
            .logo{
                height: 50px;
                padding: 5px;
            }
            .vt{
                vertical-align: top;
            }

            .tabla{
                width: 100%; 
                
                background:#FFF; 
                border-collapse: collapse
            }

            .tabla td{
                border:1px solid #000;              
            }

            .tabla th{
                border:1px solid #000; 
                background: #EDEDED;
                padding: 5px; 
            }
            .subtable{
                border-collapse: collapse; 
                width:100%; 
                border:0px solid #000;
                border-top:none;
                border-bottom:none;
            }
            .subtable td{ border:0.5px solid #000; }
            .nbl { border-left:none !important; }
            .nbr { border-right:none !important; }
            .nbtop { border-top:none !important; }
            .nbbottom { border-bottom:none !important; }
            .nborder {border: none !important }

            .tabla_relacion {
                    font-size: 11px;
            }
            .tabla_relacion td { padding: 5px; }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>

            @php $SUMTOTAL = 0; @endphp

            <table class="tabla" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="10%" class="vt"><img src="{{public_path().'/assets/img/pdf/solutec.png'}}" class="logo"/></td>
                    <td class="vt">
                        <table cellpadding="0" cellspacing="0" class="subtable">
                            <tr>
                                <td class="nbl nbtop tdpadding tdbackgound tc">Presupuesto N°:</td>
                                <td align="center" class="nbl nbr nbtop">{{$cotizacion->id}}</td>
                            </tr>
                            <tr>
                                <td class="tdpadding nbbottom nbl nbr" colspan="2" align="center">
                                    {{$cotizacion->description}}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="10%" class="vt" style="background: #EDEDED;"><img src="{{public_path().'/assets/img/pdf/frontera.png'}}" class="logo"/></td>
                </tr>
                <tr>
                    <td class="tdbackgound tdpadding vt">Lider del Proyecto:</td>
                    <td class="tc">{{$cotizacion->lider_fec}}</td>
                    <td class="vt">
                        <table class="subtable" cellpadding="0" cellspacing="0" style="width: 100%; border:none;">
                            <tr>
                                <td class="tdbackgound tdpadding nbtop nbr nbl nbbottom">Fecha:</td>
                                <td class="tdpadding nbr nbtop nbbottom tc" >{{date("d/m/Y")}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            
        </header>
 
        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table class="tabla tabla_relacion">
                    <thead>
                        <tr>
                            <th>CÓDIGO</th>
                            <th>AETOS</th>
                            <th>DESCRIPCIÓN</th>
                            <th>UNIDAD DE MEDIDA</th>
                            <th>VALOR UNITARIO</th>
                            <th>QT</th>
                            <th>VALOR TOTAL</th>
                            <th>ENTREGABLES</th>
                        </tr>
                    </thead>
                    <tbody>
                         @forelse($cotizacion::getItems($cotizacion->id) as $item)
                            @php     
                                    $cItem = $item->getItem($item->item_id); 
                                    $total = ($item->item_valor * $item->item_quantity);
                                    $SUMTOTAL += $total;
                            @endphp 
                        <tr>
                            <td>{{$cItem->code}}</td>
                            <td>{{$cItem->aetos}}</td>
                            <td>{{$cItem->description}}</td>
                            <td class="tc">{{$cItem->getMeasure()}}</td>
                            <td class="tr">@currency($item->item_valor)</td>
                            <td class="tc">{{$item->item_quantity}}</td>
                            <td class="tr">@currency($total)</td>
                            <td class=""></td>
                        </tr>
                        @empty
                        @endforelse
                        
                        @php 
                            $A   = ( $SUMTOTAL * 0.21);
                            $I   = ( $SUMTOTAL * 0.01);
                            $U   = ( $SUMTOTAL * 0.05);
                            $IVA = ( $U * 0.19);
                        @endphp;
                        <tr>
                            <td colspan="4" class="nborder"></td>
                            <td colspan="2" class="tc">Valor Costo Directo</td>
                            <td class="tr tdbackgound">@currency($SUMTOTAL)</td>
                            <td class="nborder"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="nborder"></td>
                            <td class="tc">A</td>
                            <td class="tc">21.00%</td>
                            <td class="tr">@currency($A)</td>
                            <td class="nborder"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="nborder"></td>
                            <td class="tc">I</td>
                            <td class="tc">1.00%</td>
                            <td class="tr">@currency($I)</td>
                            <td class="nborder"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="nborder"></td>
                            <td class="tc">U</td>
                            <td class="tc">5.00%</td>
                            <td class="tr">@currency($U)</td>
                            <td class="nborder"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="nborder"></td>
                            <td class="tc">IVA SOBRE U</td>
                            <td class="tc">19.00%</td>
                            <td class="tr">@currency($IVA)</td>
                            <td class="nborder"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="nborder"></td>
                            <td colspan="2" class="tc">Total</td>
                            <td class="tr tdbackgound">@currency(($SUMTOTAL + $A + $I + $U + $IVA))</td>
                            <td class="nborder"></td>
                        </tr>
                    </tbody>
            </table>
        </main>
    </body>
</html>

 