<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>

<?php //print_r($empleado); ?>

  
    <div class="card col-md-12" id="cartaGuarderia" >
        <div class="card-header" style="margin-left: auto; background-image: url('https://sistemarrhh.grupopetromar.com/public/dist/img/marcaAguaPetromar.png'); background-repeat: no-repeat; background-size: 30%; background-position: bottom 364px right 20px;">

            <div id="encabezado">                                    
                    <center><img src="<?= base_url()?>/public/dist/img/logoEncabezado2.png" width="204px"></center>                
                <br>
                <p style="text-align:end;margin-top:30px;margin-right: 30px;" class="fuenteGuarderia" id="fechaActual"></p>
            </div>

            <div id="cuerpocarta" style="margin:1cm 1cm 1cm 1cm">
                <div style="margin-top:120px;  text-align: justify; text-justify: inter-word;" class="fuenteGuarderia">
                    Se realiza esta constancia para los fines solicitados, mencionando que <?= $empleado['nombre']?>, en el puesto de <?= $empleado['puesto']?>, con NSS; <?= $empleado['numeroSeguro']?>
                    labora en Grupo Petromar desde el día <p id="fechaIngreso" class="fuenteGuarderia" style="display: contents;"></p>
                    y con domicilio <?= $empleado['domicilio']?>.
                    
                </div>
               
                 <div style="margin-top:50px ;  text-align: justify; text-justify: inter-word;"class="fuenteGuarderia">
                    La empresa tiene su domicilio en Av. Camarón Sábalo, sin número, colonia Lomas de Mazatlán, código postal 82110 con teléfono; 
                    (669) 983-70-71, PETROMAR DEL PACÍFICO S.A. DE C.V., No. De Registro Patronal  E5374591108, RFC: PPA-020605-2K1,
                    teniendo un horario laboral rotativo y descanso rotativo entre semana, pendiente de programar sus vacaciones.
                    Sin más por el momento me despido esperando que sea de su utilidad la presente carta.
                 </div>
          
                <center><p class="fuenteGuarderia" style="margin-top:100px;">
                    Atentamente
                    <br><br>
                    ______________________
                    <br>
                    JESSICA OCHOA 
                    <br>
                    GERENTE RECURSOS HUMANOS
                </p>  </center>             
            </div>
                
            <div>  
            <img src="<?= base_url()?>/public/dist/img/piePagina3.png" width="100%" >          
            </div>
    
        </div> <!-- /.card-header -->  
    </div>
 


          
    <script>
        $(document).ready(function(){  
            fecha();
            fechaIngreso("<?= $empleado['fechaIngreso']?>");            
           // imprimirCartaGuarderia("<?= $empleado['nombre']?>");            
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
      



        function imprimirCartaGuarderia($nombre){                
            kendo.drawing.drawDOM($("#cartaGuarderia")).then(function(group){                                       
                return kendo.drawing.exportPDF(group,{
                    paperSize: "auto",
                    margin: {left: "0cm",right:"0cm",top: "1cm",bottom: "1cm"}
                });           
            }).done(function(data){        
                kendo.saveAs({
                    dataURI:data,
                    fileName:"Carta Guarderia de "+$nombre
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
