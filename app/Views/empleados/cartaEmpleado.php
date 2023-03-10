<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>

<?php //print_r($empleado); ?>
    <div class="card col-md-12" id="infoEmpleado">
        <div class="card-header" style="margin-left: auto;">
            <div id="encabezado">
                <?php if($empleado['area'] == "Gas Unión" || $empleado['area'] == "Operaciones" || $empleado['area'] == "Administrativo" || $empleado['area'] == "Contabilidad" || $empleado['area'] == "Recursos Humanos" || $empleado['area'] == "Sistemas y Desarrollo" ){?>
                    <center><img src="<?= base_url()?>/public/dist/img/logoEncabezado.jpg" width="300px"></center>
                <?php }else{?>
                    <center><img src="<?= base_url()?>/public/dist/img/logoEncabezado2.png" width="204px"></center>
                <?php }?>
                <br>
                <p style="text-align:end;margin-top:30px;" class="fuenteCarta" id="fechaActual"></p>
            </div>
            <div id="cuerpocarta" style="margin:1cm 1cm 1cm 1cm">
                <div style="margin-top:120px;" class="fuenteCarta">
                    Se realiza esta constancia para los fines solicitados, mencionando que el C. <?= $empleado['nombre']?>,  laboro en esta empresa desde
                    <p id="fechaIngreso" class="fuenteCarta" style="display: contents;"></p> <p id="fechaBaja" class="fuenteCarta" style="display: contents;"></p> , en el puesto de <?= $empleado['puesto']?>.
                </div>
               
                 
                <p style="margin-top:50px;"class="fuenteCarta">Sin más por el momento, me despido esperando que sea de su utilidad la presente carta.</p>
                <center><p class="fuenteCarta" style="margin-top:100px;">
                    ______________________
                    <br>
                    JESUS LIZARRAGA 
                    <br>
                    GERENTE OPERACIONES
                </p>  </center>             
            </div>
            <div>
                <?php if($empleado['area'] == "Gas Unión"){?>
                    <img src="<?= base_url()?>/public/dist/img/piePagina.jpg" width="1000px" >
                <?php }else if($empleado['area'] == "Operaciones" || $empleado['area'] == "Administrativo" || $empleado['area'] == "Contabilidad" || $empleado['area'] == "Recursos Humanos" || $empleado['area'] == "Sistemas y Desarrollo"  ){?>
                    <br><br><br>  <br><br><br>                   
                <?php }else if($empleado['area'] == "Rio Presidio"){?>
                    <img src="<?= base_url()?>/public/dist/img/piePaginaRio.jpg" width="1030px" >
                <?php }else{?>
                    <img src="<?= base_url()?>/public/dist/img/piePagina3.png" width="1030px" >
                    <div class="ocancelada"></div>
                <?php }?>
            </div>
    
        </div> <!-- /.card-header -->  
    </div>
 


          
    <script>
        $(document).ready(function(){  
            fecha();
            fechaIngreso("<?= $empleado['fechaIngreso']?>");
            fechaBaja("<?= $empleado['fechaBaja']?>");
           imprimirEmpleado("<?= $empleado['nombre']?>");            
        });

        function fecha(){
            var hoy = new Date();
            var year = hoy.getFullYear();               
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];          
            var mes = meses[hoy.getMonth()];
            var dia= hoy.getDate();

            return document.getElementById("fechaActual").innerHTML = "Mazatlán Sinaloa, a "+dia+" de "+mes+" del " + year;  
        }

        function fechaIngreso(fecha){   
            var fecha = new Date(fecha);
            var year = fecha.getFullYear();
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
            var mes = meses[fecha.getMonth()];
            var dia= fecha.getDate() + 1;
            
            return document.getElementById("fechaIngreso").innerHTML = dia+" de "+mes+" del " + year;  
        }

        function fechaBaja(fecha){   
            var fecha = new Date(fecha);
            var year = fecha.getFullYear();
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
            var mes = meses[fecha.getMonth()];
            var dia= fecha.getDate() + 1;
            
            return document.getElementById("fechaBaja").innerHTML = "hasta el  "+dia+" de "+mes+" del " + year;  
        }



        function imprimirEmpleado($nombre){                
            kendo.drawing.drawDOM($("#infoEmpleado")).then(function(group){                                       
                return kendo.drawing.exportPDF(group,{
                    paperSize: "auto",
                    margin: {left: "0cm",right:"0cm",top: "1cm",bottom: "1cm"}
                });           
            }).done(function(data){        
                kendo.saveAs({
                    dataURI:data,
                    fileName:"Carta Recomendacion de "+$nombre
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
