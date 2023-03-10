<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>

<?php //print_r($empleado); ?>
    <div id="tablaCheckList" class="tablaCheckList">
        <table class="table table-bordered"   style="margin-bottom: 0rem;">
            <tr>
                <th colspan="3" style="text-align:center;">CHECK LIST DE SALIDA DEL PERSONAL DE LA EMPRESA</th>  
            </tr>
            <tr>
                <th colspan="3" style="text-align:center;">DATOS PERSONALES</th>  
            </tr>
            <tr>
                <th scope="row">Nombre:</th>
                <td colspan="2"><?= $empleado['nombre']?></td>                      
            </tr>
            <tr>
                <th scope="row">Fecha de salida:</th>
                <td colspan="2"><?= $empleado['fechaBaja']?></td>
                
            </tr>
            <tr>
                <th scope="row">Area:</th>
                <td colspan="2"><?= $empleado['area']?></td>   
            </tr>
            <tr>
                <th scope="row">Puesto:</th>
                <td colspan="2"><?= $empleado['puesto']?></td>   
            </tr>
            <tr>
                <th scope="row">Fecha de Ingreso:</th>
                <td colspan="2"><?= $empleado['fechaIngreso']?></td>   
            </tr>
            <tr>
                <th scope="row">Motivo de Salida:</th>
                <td colspan="2"></td>   
            </tr>
            <tr>
                <th scope="row">Submotivo:</th>
                <td colspan="2"></td>   
            </tr>
            
            <table class="table table-bordered">
                <tr>
                    <th colspan="4" style="text-align:center;">ENTREGAR</th>  
                </tr>  
                <tr>
                    <th scope="row"></th>
                    <th colspan="1">SI Corresponde al puesto</th>
                    <th colspan="1">NO Corresponde al puesto</th>
                    <th colspan="1">SI entregó</th>  
                </tr>
                <tr>
                    <th scope="row">Uniformes:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Botas:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Tag:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Llaves:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Radio:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Artículos Papelería:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Claves de acceso:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Archivero:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Mouse:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Laptop:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Tablet Samsung:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Pluma para tablet:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Vehículo empresarial:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Caja chica:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th scope="row">Adeudos:</th>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>  
                </tr>
                <tr>
                    <th colspan="4">Observaciones:</th>  
                </tr>            
            </table>

            <div>
                <div style="display: flex;flex-wrap: nowrap;justify-content: center;margin-top: 70px;">
                    <p>___________________________</p>
                    <p style="margin-left:30px">___________________________</p>
                </div>
       
                <div style="display: flex;flex-wrap: nowrap;justify-content: center;">
                    <p style="margin-right: 90px;">Vo. Bo. Recursos Humanos</p>
                    <p style="padding-right: 50px;">Vo. Bo. Ingresos</p>
                </div>

                <div style="display: flex;flex-wrap: nowrap;justify-content: center;margin-top: 30px;">
                    <p>___________________________</p>
                    <p style="margin-left:30px">___________________________</p>
                </div>

                <div style="display: flex;flex-wrap: nowrap;justify-content: center;">
                    <p style="margin-right: 140px;">Reviso Nomina</p>
                    <p>Reviso Gte. RRHH</p>
                </div>
       
            </div>
        </table>
    
    </div>

   


    <script>
        $(document).ready(function(){  
           imprimirEmpleado("<?= $empleado['nombre']?>");            
        });


        function imprimirEmpleado($nombre){                
            kendo.drawing.drawDOM($("#tablaCheckList")).then(function(group){                                       
                return kendo.drawing.exportPDF(group,{
                    paperSize: "auto",
                    margin: {left: "0cm",right:"0cm",top: "1cm",bottom: "1cm"}
                });           
            }).done(function(data){        
                kendo.saveAs({
                    dataURI:data,
                    fileName:"CheckList de "+$nombre
                });                
            }).then(function(){  
                Cerrar(); 
            });            
        }

        function Cerrar(){ 
            open(location, '_self').close();  
        }
    </script>

 
<?= 
    $this->endSection();
?>
