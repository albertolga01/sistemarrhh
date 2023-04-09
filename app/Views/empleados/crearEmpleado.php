<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>

    <form method="post" action="<?= base_url('/guardarEmpleado')?>"  enctype="multipart/form-data">

        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del Empleado</h3>
                </div><!-- /.card-header -->
                <div class="card-body">

                    <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  
                    <!-- INPUT NOMBRE Y DOMICILIO-->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputNombre">Nombre Completo</label>
                            <input type="text" class="form-control " id="nombreEmpleado" name="nombreEmpleado" placeholder="Nombre Completo" maxlength="100" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputDomicilio">Domicilio</label>
                            <input type="text" class="form-control" id="domicilioEmpleado" name="domicilioEmpleado" placeholder="Domicilio" maxlength="200" required>
                        </div>
                        <div class="form-group col-md-4" style="display:flex;align-items: center">                            
                            <div class='preview'>
                                <img  class="center-block img-thumbnail" id="output" width="100" height="100"/>
                            </div> 
                            <input type="file" name="fotoEmpleado" id="fotoEmpleado" onchange="loadFile(event)" required>                          
                        </div>
                    </div>

                    <!-- INPUT FECHA NACIMIENTO, EDAD, ESCOLARIDAD, CELULAR, TELEFONO-->
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputFecha">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="nacimientoEmpleado" name="nacimientoEmpleado" placeholder="Fecha de Nacimiento" oninput="calcularEdad()" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEdad">Edad</label>
                            <input type="text" readonly class="form-control" id="EdadEmpleado" name="EdadEmpleado" placeholder="Edad">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEscolaridad">Escolaridad</label>
                            <select id="escolaridadEmpleado" class="form-control" name="escolaridadEmpleado" required>
                                <option selected value="Sin estudios">Sin estudios</option>
                                <option value="Preescolar">Preescolar</option>
                                <option value="Primaria">Primaria</option>
                                <option value="Secundaria">Secundaria</option>
                                <option value="Preparatoria">Preparatoria</option>
                                <option value="Licenciatura">Licenciatura</option>
                                <option value="Especialidad">Especialidad</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCelular">Celular</label>
                            <input type="tel" class="form-control"  id="celularEmpleado" name="celularEmpleado"  maxlength="10" required>            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputTelefono">Telefono</label>
                            <input type="tel" class="form-control"  id="telefonoEmpleado" name="telefonoEmpleado"  maxlength="10">            
                        </div>
                    </div>

                    <!-- INPUT CURP, RFC, ESTADO CIVIL,TIPO DE SANGRE-->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCurp">CURP</label>
                            <input type="text" class="form-control" id="curpEmpleado" name="curpEmpleado" placeholder="CURP"  maxlength="18" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputRfc">RFC</label>
                            <input type="text" class="form-control" id="rfcEmpleado" name="rfcEmpleado" placeholder="RFC"  maxlength="13" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputEstadoCivil">Estado Civil</label>
                            <select id="estadoCivil" class="form-control"  name="estadoCivil" required>
                                <option selected value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Separación en proceso judicial">Separación en proceso judicial</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Concubinato">Concubinato</option>                  
                            </select>
                        </div>                    
                        <div class="form-group col-md-2">
                            <label for="inputTipoSangre">Tipo de Sangre</label>
                            <select id="sangreEmpleado" class="form-control"  name="sangreEmpleado" required>
                                <option selected value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>

                    <!-- INPUT NO.SEGURO SOCIAL, INFONAVIT, FONACOT-->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCurp">No. Seguro Social</label>
                            <input type="text" class="form-control" id="numeroSeguro" name="numeroSeguro" placeholder="No. Seguro Social"  maxlength="11" required>
                        </div>

                        <div class="form-group col-md-2">
                            <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content: center;">
                                <input type="checkbox" class="custom-control-input" id="infonavitEmpleado" name="infonavitEmpleado" onchange="habilitarInputs()" value="1">
                                <label class="custom-control-label" for="infonavitEmpleado">Infonavit</label>
                            </div> 
                        </div>  
                        <div class="form-group col-md-2">
                            <label for="inputMonto">Monto Descuento</label>
                            <input type="number" readonly class="form-control" id="montoDescuento" name="montoDescuento" placeholder="Monto Descuento">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputMonto">Tipo Credito</label>
                            <select id="tipoCredito" class="form-control"  name="tipoCredito" disabled>   
                                <option value="N/A" selected>N/A</option>                             
                                <option value="Cuota fija">Cuota fija</option>
                                <option value="En veces salario mínimo">En veces salario mínimo</option>
                                <option value="Porcentaje">Porcentaje</option>                                              
                            </select>
                            
                        </div> 

                        <div class="form-group col-md-2">
                            <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content:center;">
                                <input type="checkbox" class="custom-control-input" id="fonacotEmpleado" name="fonacotEmpleado" value=1 onchange="habilitarInputs()">
                                <label class="custom-control-label" for="fonacotEmpleado">Fonacot</label>
                            </div> 
                        </div>                                     
                    </div>

                    <!-- INPUT AREA, PUESTO, TIPO DE PERFIL, SALARIO-->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputArea">Area</label>
                            <select id="areaEmpleado" class="form-control"  name="areaEmpleado" required>
                                <option selected value="Administrativo">Administrativo</option>
                                <option value="Competro">Competro</option>
                                <option value="Contabilidad">Contabilidad </option>
                                <option value="Gas Unión">Gas Unión</option>
                                <option value="Insurgentes">Insurgentes </option>
                                <option value="La Caja">La Caja </option>
                                <option value="Ley del Mar">Ley del Mar</option>
                                <option value="Libramiento">Libramiento</option> 
                                <option value="Logística">Logística </option>
                                <option value="López Sáenz">López Sáenz </option>
                                <option value="Múnich">Múnich</option>
                                <option value="Operaciones">Operaciones </option>
                                <option value="Recursos Humanos">Recursos Humanos </option>
                                <option  value="Rio Presidio">Rio Presidio</option>
                                <option value="Santa Fe">Santa Fe </option>
                                <option value="Sistemas y Desarrollo">Sistemas y Desarrollo</option>
                            </select>                
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPuesto">Puesto</label>
                            <select id="puestoEmpleado" class="form-control"  name="puestoEmpleado" required>                    
                                <option selected value="Auxiliar de operaciones">Auxiliar de operaciones </option>                                
                                <option  value="Auxiliar Administrativo">Auxiliar Administrativo </option>
                                <option  value="Auxiliar Contable">Auxiliar Contable  </option>
                                <option  value="Auxiliar de Sistemas">Auxiliar de Sistemas   </option>
                                <option  value="Auxiliar de desarrollo">Auxiliar de desarrollo </option>
                                <option  value="Auxiliar de Planta">Auxiliar de Planta </option>
                                <option  value="Auxiliar mantenimiento">Auxiliar mantenimiento </option>                                                                
                                <option  value="Asistente de dirección">Asistente de dirección </option>
                                <option  value="Atención a clientes">Atención a clientes  </option>
                                <option  value="Ayu. de operador autotanque">Ayu. de operador autotanque  </option>
                                <option  value="Contador General">Contador General </option>
                                <option  value="Control Interno">Control Interno </option>
                                <option  value="Coordinador de Capacitación y Desarrollo">Coordinador de Capacitación y Desarrollo </option>
                                <option  value="Coordinador de Capital Humano">Coordinador de Capital Humano </option>
                                <option  value="Coordinador Operativo Gas">Coordinador Operativo Gas </option>
                                <option  value="Controles Internos Gas">Controles Internos Gas </option>
                                <option  value="Call Center">Call Center  </option>
                                <option  value="Cubre turno">Cubre turno </option>
                                <option  value="Despachador">Despachador</option>  
                                <option  value="Desarrollador">Desarrollador </option>
                                <option  value="Encargado de Turno">Encargado de Turno</option>
                                <option  value="Encargado de Servicio y Controles Internos">Encargado de Servicio y Controles Internos</option>
                                <option  value="Encargado de Compras">Encargado de Compras </option>
                                <option  value="Encargado Administrativa y Dependencias">Encargado Administrativa y Dependencias </option>
                                <option  value="Encargado de Ingresos">Encargado de Ingresos </option>
                                <option  value="Encargado de Nóminas">Encargado de Nóminas </option>
                                <option  value="Encargado Contable Gas y Comercializadora">Encargado Contable Gas y Comercializadora </option>
                                <option  value="Encargado de Logistica">Encargado de Logistica </option>
                                <option  value="Encargado de Mantenimiento Gas">Encargado de Mantenimiento Gas </option>
                                <option  value="Ejecutivo de Negocios La Caja">Ejecutivo de Negocios La Caja</option>
                                <option  value="Finanzas">Finanzas</option>
                                <option  value="Gerente Administrativo">Gerente Administrativo </option>
                                <option  value="Gerente de RRHH">Gerente de RRHH </option>
                                <option  value="Gerente de Finanzas">Gerente de Finanzas  </option>
                                <option  value="Gerente Operativo Gas">Gerente Operativo Gas </option>
                                <option  value="Guardia de Seguridad">Guardia de Seguridad  </option>
                                <option  value="Inmobiliaria">Inmobiliaria </option>
                                <option  value="Logística">Logística </option>
                                <option  value="Limpieza">Limpieza</option>
                                <option  value="Mantenimiento">Mantenimiento</option>
                                <option  value="Operación Gasolineras">Operación Gasolineras </option>
                                <option  value="Operaciones Grupo Petromar">Operaciones Grupo Petromar </option>
                                <option  value="Operador de autotanque">Operador de autotanque   </option>
                                <option  value="Pipero">Pipero</option>          
                                <option  value="Promoción y publicidad">Promoción y publicidad  </option>
                                <option  value="Responsable Operativo y Logistica">Responsable Operativo y Logistica</option>
                                <option  value="Responsable de Obras y Proyectos">Responsable de Obras y Proyectos </option>
                                <option  value="Responsable Operativo de Mantenimiento y Dependencias Gas">Responsable Operativo de Mantenimiento y Dependencias Gas </option>
                                <option  value="Reclutamiento y Selección">Reclutamiento y Selección </option>
                                <option  value="Servicio y Cortes">Servicio y Cortes</option>    
                                <option  value="Seguridad">Seguridad </option>     
                                <option  value="Supervisor Operativo">Supervisor Operativo</option>
                                <option  value="Supervisor operativo de responsabilidad legal">Supervisor operativo de responsabilidad legal  </option>
                                <option  value="Supervisora Logistica Comercial">Supervisora Logistica Comercial </option>
                                <option  value="Supervisora de call center">Supervisora de call center  </option>
                                <option  value="Sistemas">Sistemas  </option>
                                <option  value="Técnico">Técnico  </option>
                                <option  value="Tesorería">Tesorería </option> 
                                <option  value="Velador">Velador  </option>
                            </select>               
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPerfil">Tipo de Perfil</label>                            
                            <select id="perfilEmpleado" class="form-control"  name="perfilEmpleado" required>
                                <option selected value="Administrativo">Administrativo</option>  
                                <option  value="Operativo">Operativo</option>                         
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputSalario">Salario</label>
                            <input type="number" class="form-control" id="salarioEmpleado" name="salarioEmpleado" placeholder="Salario"  maxlength="5">
                        </div>
                    </div>

                    <!-- INPUT CUENTA, CLABE INTERBANCARIA, BANCO-->
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content: center;">
                                <input type="checkbox" class="custom-control-input" id="CuentaBancaria" name="CuentaBancaria" onchange="habilitarInputs()" value="1">
                                <label class="custom-control-label" for="CuentaBancaria">Cuenta Bancaria</label>
                            </div>                        
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputBanco">Banco</label>
                            <select id="Banco" class="form-control"  name="Banco" disabled>
                                <option value="N/A" selected>N/A</option>                                   
                                <option value="Santander" >Santander</option>
                                <option value="HSBC">HSBC</option>
                                <option value="Banorte">Banorte</option>
                                <option value="CitiBanamex">CitiBanamex</option>
                                <option value="BBVA">BBVA</option>
                                <option value="Bancoppel">Bancoppel </option>                           
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCurp">No. Cuenta</label>
                            <input type="text" readonly class="form-control" id="numeroCuenta" name="numeroCuenta" placeholder="No. Cuenta" maxlength="10">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCurp">Clave Interbancaria</label>
                            <input type="text" readonly class="form-control" id="claveInterbancaria" name="claveInterbancaria" placeholder="Clave Interbancaria" maxlength="18">
                        </div>              
                    </div>


                    <!-- INPUT FECHA DE INGRESO, ANTIGUEDAD, TALLAS-->
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputFechaIngreso">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="ingresoEmpleado" name="ingresoEmpleado" placeholder="Fecha de Ingreso" oninput="calcularAntiguedad()"   required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputAntiguedad">Antigüedad</label>
                            <input type="text" readonly class="form-control" id="antiguedadEmpleado" name="antiguedadEmpleado" placeholder="Antigüedad">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputVacaciones">Dias de Vacaciones</label>
                            <input type="text" readonly class="form-control" id="vacacionesEmpleado" name="vacacionesEmpleado" placeholder="Vacaciones">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputCamisa">Talla Camisa</label>                
                            <input type="text" class="form-control " id="camisaEmpleado" name="camisaEmpleado" placeholder="Camisa Empleado"  required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPantalon">Talla Pantalón</label>        
                            <input type="text" class="form-control " id="pantalonEmpleado" name="pantalonEmpleado" placeholder="Pantalon Empleado"  required>                               
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputBotas">Talla Botas</label>
                            <input type="number" class="form-control" id="botasEmpleado" name="botasEmpleado" placeholder="Talla Botas"  maxlength="2">
                        </div>
                    </div>

                    
                </div>    
            </div>
        </div>


     
        <!-- DATOS DE CONTACTO DE EMERGENCIA-->
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos de Contacto de Emergencía</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputNombre">Nombre Completo</label>
                            <input type="text" class="form-control " id="nombreEmergencia" name="nombreEmergencia" placeholder="Nombre Completo" maxlength="100" required>                
                        </div>            
                        <div class="form-group col-md-2">
                            <label for="inputCelularEmergencia">Celular</label>
                            <input type="tel" class="form-control"  id="celularEmergencia" name="celularEmergencia"  maxlength="10" required>            
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputTelefonoEmergencia">Telefono</label>
                            <input type="tel" class="form-control"  id="telefonoEmergencia" name="telefonoEmergencia"  maxlength="10">            
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputParentesco">Parentesco</label>
                            <input type="text" class="form-control " id="parentesco" name="parentesco" placeholder="Parentesco" maxlength="50" required>                
                        </div>  
                    </div>
                </div>    
            </div>
        </div>

    

        <!-- OBSERVACIONES -->
        <div class="col-md-12">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">
                Observaciones
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="observacionesEmpleado" name="observacionesEmpleado"></textarea>
            </div>
     
          </div>
        </div>

        <button type="submit" class="btn btn-success">AGREGAR</button>
        <button type="button" class="btn btn-danger" style="float: right;" onClick="history.go(-1);">CANCELAR</button>
        <br>
        <br>

    </form>


    <script type="text/javascript">
        function calcularEdad(){
            $fechaNacimiento = $("#nacimientoEmpleado").val();
            var hoy = new Date();
            var cumpleanos = new Date($fechaNacimiento);
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();

            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
            }
            return document.getElementById("EdadEmpleado").value = edad + " Años";            
        }

        function calcularAntiguedad(){
            
            // Si la fecha es correcta, calculamos la edad
            var fecha = $("#ingresoEmpleado").val();
            if (typeof fecha != "string" && fecha && esNumero(fecha.getTime())) {
                fecha = formatDate(fecha, "yyyy-MM-dd");
            }

            var values = fecha.split("-");
            var dia = values[2];
            var mes = values[1];
            var ano = values[0];

            // valores actuales
            var fecha_hoy = new Date();
            var ahora_ano = fecha_hoy.getYear();
            var ahora_mes = fecha_hoy.getMonth() + 1;
            var ahora_dia = fecha_hoy.getDate();

            // realizamos el calculo
            var edad = (ahora_ano + 1900) - ano;
            if (ahora_mes < mes) {
                edad--;
            }
            if ((mes == ahora_mes) && (ahora_dia < dia)) {
                edad--;
            }
            if (edad > 1900) {
                edad -= 1900;
            }

            // calculamos los meses
            var meses = 0;

            if (ahora_mes > mes && dia > ahora_dia)
                meses = ahora_mes - mes - 1;
            else if (ahora_mes > mes)
                meses = ahora_mes - mes
            if (ahora_mes < mes && dia < ahora_dia)
                meses = 12 - (mes - ahora_mes);
            else if (ahora_mes < mes)
                meses = 12 - (mes - ahora_mes + 1);
            if (ahora_mes == mes && dia > ahora_dia)
                meses = 11;

            // calculamos los dias
            var dias = 0;
            if (ahora_dia > dia)
                dias = ahora_dia - dia;
            if (ahora_dia < dia) {
                ultimoDiaMes = new Date(ahora_ano, ahora_mes - 1, 0);
                dias = ultimoDiaMes.getDate() - (dia - ahora_dia);
            }

            if(edad <= 1){
                document.getElementById("vacacionesEmpleado").value = "12 días";              
            }else if(edad == 2){
                document.getElementById("vacacionesEmpleado").value = "14 días";
            }else if(edad == 3){
                document.getElementById("vacacionesEmpleado").value = "16 días";
            }else if(edad == 4){
                document.getElementById("vacacionesEmpleado").value = "18 días";
            }else if(edad == 5){
                document.getElementById("vacacionesEmpleado").value = "20 días";
            }else{
                document.getElementById("vacacionesEmpleado").value = "22 días";
            }

            return document.getElementById("antiguedadEmpleado").value = edad + " años, " + meses + " meses y " + dias + " días";            
            //console.log(edad);
        }

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };


        function habilitarInputs(){
            if( $('#infonavitEmpleado').prop('checked') ) {
                $("#montoDescuento").attr("readonly", false); 
                $("#montoDescuento").attr("required", true); 
                $("#tipoCredito").attr("disabled", false);
            }else{
                $("#montoDescuento").attr("readonly", true);
                $("#montoDescuento").val(''); 
                $("#montoDescuento").attr("required", false); 
                $("#tipoCredito").attr("disabled", true);
                $('#tipoCredito').val("N/A").trigger('change'); 
            }

            
            if($('#CuentaBancaria').prop('checked')){
                $("#Banco").attr("disabled", false);
                $("#numeroCuenta").attr("readonly", false); 
                $("#claveInterbancaria").attr("readonly", false); 
                $("#numeroCuenta").attr("required", true); 
                $("#claveInterbancaria").attr("required", true); 
            }else{
                $("#Banco").attr("disabled", true);
                $("#numeroCuenta").attr("readonly", true); 
                $("#claveInterbancaria").attr("readonly", true); 
                $("#numeroCuenta").val(''); 
                $("#claveInterbancaria").val(''); 
                $("#numeroCuenta").attr("required", false); 
                $("#claveInterbancaria").attr("required", false); 
                $('#Banco').val("N/A").trigger('change'); 
            }
        }
        
    </script>

    <script>
        $(function () {
            // Summernote
            $('#observacionesEmpleado').summernote()            
        })
    </script>
<?= 
    $this->endSection();
?>
