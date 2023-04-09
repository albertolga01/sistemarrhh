<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>


    <div class="card col-md-12" >
        <div class="card-header" style="margin-left: auto;" id="cartaGuarderia">
            <?php if($datosFonacot['empresa'] == "Gas Unión de América S.A. de C.V" || $datosFonacot['empresa'] == "Servicio Rio Presidio S.A. de C.V."){?>
                <div class="card-header" style="margin-left: auto; background-image: url('https://sistemarrhh.grupopetromar.com/public/dist/img/marcaAguaPetromar.png'); background-repeat: no-repeat; background-size: 45%; background-position: bottom 120px right 1px;">
            <?php }else if($datosFonacot['empresa'] == "Petromar del Pacífico S.A. de C.V." ){?>  
                <div class="card-header" style="margin-left: auto; background-image: url('https://sistemarrhh.grupopetromar.com/public/dist/img/marcaAguaPetromar.png'); background-repeat: no-repeat; background-size: 50%; background-position: bottom 170px right 1px;">
            <?php }else{?> 
                <div class="card-header" style="margin-left: auto; background-image: url('https://sistemarrhh.grupopetromar.com/public/dist/img/pieApoyos.png'); background-repeat: no-repeat; background-size: 100%; background-position: bottom 1px right 1px;">
            <?php }?>   
            
                
                <div id="encabezado"> 
                    <?php if($datosFonacot['empresa'] == "Gas Unión de América S.A. de C.V"){?>      
                        <center><img src="<?= base_url()?>/public/dist/img/LogoGas.jpg" width="300px" style="margin-top:50px;opacity: 0.5;"></center>  
                    <?php }else if($datosFonacot['empresa'] == "Petromar del Pacífico S.A. de C.V." || $datosFonacot['empresa'] == "Servicio Rio Presidio S.A. de C.V." ){?>                              
                        <center><img src="<?= base_url()?>/public/dist/img/logoEncabezado2.png" width="204px;" style="opacity: 0.5;"></center>         
                    <?php }else{?>  
                        <img src="<?= base_url()?>/public/dist/img/logo-apoyosAdministrativo.jpg" width="350px" style="margin-top:50px;opacity: 0.5;"> 
                    <?php }?>                                  
                
                    <?php if($datosFonacot['empresa'] == "Apoyos Administrativos P.P.A. S.C."){?>
                        <br>
                        <br>
                        <br>
                    <?php }else{?>  
                        <br>
                    <?php }?>  
                    <p style="text-align:end;margin-top:30px;" class="fuenteGuarderia" id="fechaActual"></p>
                </div>

                <div id="cuerpocarta" style="margin:1cm 1cm 1cm 1cm">
                    <div style="margin-top:120px;  text-align: justify; text-justify: inter-word;" class="fuenteGuarderia">
                        Dirigida al INSTITUTO FONACOT: <br><br><br>

                        Por medio de la presente hacemos constar que el C.<?= $empleado['nombre']?>, con número de seguro social <?= $empleado['numeroSeguro']?>,
                        con CURP: <?= $empleado['curp']?>; y RFC: <?= $empleado['rfc']?>; labora en esta empresa denominada <?= $datosFonacot['empresa']?>, con
                        número de FONACOT <?= $datosFonacot['numeroFonacot']?>, a partir del  
                        <p id="fecha" class="fuenteGuarderia" style="display: contents;"></p>.      
                        
                    </div>
                
                    <div style="margin-top:50px ;  text-align: justify; text-justify: inter-word;" class="fuenteGuarderia">
                        Sin otro particular se extiende la presente a petición del interesado para los fines que juzgue convenientes. 
                    </div>
                    <?php if($datosFonacot['empresa'] == "Gas Unión de América S.A. de C.V" || $datosFonacot['empresa'] == "Servicio Rio Presidio S.A. de C.V."){?>
                        <center><p class="fuenteGuarderia" style="margin-top:100px;margin-bottom:-150px">
                            Atentamente
                            <br><br>
                            ______________________
                            <br>
                            JESSICA OCHOA 
                            <br>
                            GERENTE RECURSOS HUMANOS
                        </p>  </center>                       
                    <?php }else{?>    
                        <center><p class="fuenteGuarderia" style="margin-top:100px;">
                            Atentamente
                            <br><br>
                            ______________________
                            <br>
                            JESSICA OCHOA 
                            <br>
                            GERENTE RECURSOS HUMANOS
                        </p>  </center>    
                    <?php }?>         
                </div>
                
                <div>  
                    <?php if($datosFonacot['empresa'] == "Petromar del Pacífico S.A. de C.V."){?>                    
                        <img src="<?= base_url()?>/public/dist/img/piePetromar.png" width="100%" >   
                    <?php }else if($datosFonacot['empresa'] == "Servicio Rio Presidio S.A. de C.V."){?>                
                        <img src="<?= base_url()?>/public/dist/img/pieRio.png" width="100%" >
                    <?php }else if($datosFonacot['empresa'] == "Gas Unión de América S.A. de C.V"){?> 
                        <img src="<?= base_url()?>/public/dist/img/pieGasUnion.png" width="100%" >
                    <?php }else{?>    
                            <br><br><br><br><br><br><br><br> 
                    <?php }?>                         
                </div>
            </div>
        </div> <!-- /.card-header -->  
    </div>
 


          
    <script>
        $(document).ready(function(){  
            fecha();            
            fechaFonacot("<?= $datosFonacot['fecha']?>");         
            //imprimirCartaGuarderia("<?= $empleado['nombre']?>");            
        });

        function fecha(){
            var hoy = new Date();
            var year = hoy.getFullYear();               
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];          
            var mes = meses[hoy.getMonth()];
            var dia= hoy.getDate();

            return document.getElementById("fechaActual").innerHTML = "Mazatlán Sinaloa, a "+dia+" de "+mes+" del " + year;  
        }

  

        function fechaFonacot(fecha){   
            var fecha = new Date(fecha);
            var year = fecha.getFullYear();
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"];
            var mes = meses[fecha.getMonth()];
            var dia= fecha.getDate() + 1;            
            return document.getElementById("fecha").innerHTML =  dia+" de "+mes+" del " + year;  ;  
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
