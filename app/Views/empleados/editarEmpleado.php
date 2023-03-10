<?= 
    $this->extend('layout/dashboard-layout');
    $this->section('content');    
?>




<div class="card col-md-12">
    <div class="card-header" style="margin-left: auto;">
        <button type="button" class="btn btn-warning btn-lg" id="btn-imprimir" onClick="imprimirEmpleado('<?= $empleado['nombre']?>')"><i class="fas fa-print"></i>PRINT</button>
        <?php if($empleado['activo'] == 0){?>
            <a  href="<?= base_url('cartaEmpleado/'.$empleado['id']);?>" target="_blank"><button type="button" class="btn btn-secondary btn-lg" id="btn-cartaRecomendacion"><i class="fas fa-download"></i> CARTA</button></a>
        <?php }?>
        <?php if($empleado['activo'] == 0){?>
            <a  href="<?= base_url('checkListEmpleado/'.$empleado['id']);?>" target="_blank"><button type="button" class="btn btn-secondary btn-lg" id="btn-cartaRecomendacion"><i class="fas fa-download"></i> CHECKLIST BAJA</button></a>
        <?php }?>
        <button type="button" class="btn btn-danger btn-lg" id="btn-cancelar" onClick="history.go(-1);"><i class="fa fa-times-circle"></i> CANCELAR</button>
    </div> <!-- /.card-header -->  
</div>

    <form method="post" id="infoEmpleado" action="<?= base_url('/editarEmpleado')?>"  enctype="multipart/form-data">   
        
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title" style="font-family: DejaVuSans">
                Información del Empleado
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                
                <input type="hidden" name="Username" id="Username" value=<?=session('id');?>>  
                <input type="hidden" name="id" value="<?= $empleado['id']?>">
                <!-- INPUT NOMBRE Y DOMICILIO-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputNombre">Nombre Completo</label>
                        <input type="text" class="form-control " id="nombreEmpleado" name="nombreEmpleado" placeholder="Nombre Completo" maxlength="100" required value="<?= $empleado['nombre']?>">                
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDomicilio">Domicilio</label>
                        <input type="text" class="form-control" id="domicilioEmpleado" name="domicilioEmpleado" placeholder="Domicilio" maxlength="200" required value="<?= $empleado['domicilio']?>">
                    </div>
                    <div class="form-group col-md-4" style="display:flex;align-items: center">
                        <div id='preview'>
                            <img class="center-block img-thumbnail" src="<?= base_url()?>/public/uploads/<?=$empleado['foto']?>" width="100" height="100" id="output">
                        </div>                          
                        <input type="file" name="fotoEmpleado" id="fotoEmpleado" onchange="loadFile(event)">                        
                    </div>
                </div>

                <!-- INPUT FECHA NACIMIENTO, EDAD, ESCOLARIDAD, CELULAR, TELEFONO-->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputFecha">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="nacimientoEmpleado" name="nacimientoEmpleado" placeholder="Fecha de Nacimiento" oninput="calcularEdad()" required value="<?= $empleado['fechaNacimiento']?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEdad">Edad</label>
                        <input type="text" readonly class="form-control" id="EdadEmpleado" name="EdadEmpleado" placeholder="Edad" style="font-family: DejaVuSans">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEscolaridad">Escolaridad</label>
                        <select id="escolaridadEmpleado" class="form-control" name="escolaridadEmpleado" required>
                            <option <?php if($empleado['escolaridad']=="Sin estudios"){echo"selected";}?> value="Sin estudios">Sin estudios</option>
                            <option <?php if($empleado['escolaridad']=="Preescolar"){echo"selected";}?> value="Preescolar">Preescolar</option>
                            <option <?php if($empleado['escolaridad']=="Primaria"){echo"selected";}?> value="Primaria">Primaria</option>
                            <option <?php if($empleado['escolaridad']=="Secundaria"){echo"selected";}?> value="Secundaria">Secundaria</option>
                            <option <?php if($empleado['escolaridad']=="Preparatoria"){echo"selected";}?> value="Preparatoria">Preparatoria</option>
                            <option <?php if($empleado['escolaridad']=="Licenciatura"){echo"selected";}?> value="Licenciatura">Licenciatura</option>
                            <option <?php if($empleado['escolaridad']=="Especialidad"){echo"selected";}?> value="Especialidad">Especialidad</option>
                            <option <?php if($empleado['escolaridad']=="Maestría"){echo"selected";}?> value="Maestría">Maestría</option>
                            <option <?php if($empleado['escolaridad']=="Doctorado"){echo"selected";}?> value="Doctorado">Doctorado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCelular">Celular</label>
                        <input type="tel" class="form-control"  id="celularEmpleado" name="celularEmpleado"  maxlength="10" required value="<?= $empleado['celular']?>">            
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputTelefono">Telefono</label>
                        <input type="tel" class="form-control"  id="telefonoEmpleado" name="telefonoEmpleado"  maxlength="10" required value="<?= $empleado['telefono']?>">            
                    </div>
                </div>

                <!-- INPUT CURP, RFC, TIPO DE SANGRE-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCurp">CURP</label>
                        <input type="text" class="form-control" id="curpEmpleado" name="curpEmpleado" placeholder="CURP"  maxlength="18" required value="<?= $empleado['curp']?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputRfc">RFC</label>
                        <input type="text" class="form-control" id="rfcEmpleado" name="rfcEmpleado" placeholder="RFC"  maxlength="13" required value="<?= $empleado['rfc']?>">
                    </div>
                    <div class="form-group col-md-2">
                            <label for="inputEstadoCivil">Estado Civil</label>
                            <select id="estadoCivil" class="form-control"  name="estadoCivil" required>
                                <option value="Soltero" <?php if($empleado['estadoCivil']=="Soltero"){echo"selected";}?>>Soltero</option>
                                <option value="Casado" <?php if($empleado['estadoCivil']=="Casado"){echo"selected";}?>>Casado</option>
                                <option value="Divorciado" <?php if($empleado['estadoCivil']=="Divorciado"){echo"selected";}?>>Divorciado</option>
                                <option value="Separación en proceso judicial" <?php if($empleado['estadoCivil']=="Separación en proceso judicial"){echo"selected";}?>>Separación en proceso judicial</option>
                                <option value="Viudo" <?php if($empleado['estadoCivil']=="Viudo"){echo"selected";}?>>Viudo</option>
                                <option value="Concubinato" <?php if($empleado['estadoCivil']=="Concubinato"){echo"selected";}?>>Concubinato</option>                  
                            </select>
                        </div>  
                    <div class="form-group col-md-2">
                        <label for="inputTipoSangre">Tipo de Sangre</label>
                        <select id="sangreEmpleado" class="form-control"  name="sangreEmpleado" required>
                            <option value="A+" <?php if($empleado['tipoSangre']=="A+"){echo"selected";}?>>A+</option>
                            <option value="A-" <?php if($empleado['tipoSangre']=="A-"){echo"selected";}?> >A-</option>
                            <option value="B+" <?php if($empleado['tipoSangre']=="B+"){echo"selected";}?> >B+</option>
                            <option value="B-" <?php if($empleado['tipoSangre']=="B-"){echo"selected";}?> >B-</option>
                            <option value="AB+" <?php if($empleado['tipoSangre']=="AB+"){echo"selected";}?> >AB+</option>
                            <option value="AB-" <?php if($empleado['tipoSangre']=="AB-"){echo"selected";}?> >AB-</option>
                            <option value="O+" <?php if($empleado['tipoSangre']=="O+"){echo"selected";}?> >O+</option>
                            <option value="O-" <?php if($empleado['tipoSangre']=="O-"){echo"selected";}?> >O-</option>
                        </select>
                    </div>
                </div>

                <!-- INPUT NO.SEGURO SOCIAL, INFONAVIT, FONACOT-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCurp">No. Seguro Social</label>
                        <input type="text" class="form-control" id="numeroSeguro" name="numeroSeguro" placeholder="No. Seguro Social"  maxlength="11" required value="<?= $empleado['numeroSeguro']?>">
                    </div>
                    <div class="form-group col-md-2">
                        <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content: center;">
                            <input type="checkbox" class="custom-control-input" id="infonavitEmpleado" name="infonavitEmpleado" onchange="habilitarInputs()" value="1" <?php if($empleado['infonavitEmpleado']=="1"){echo"checked";}?>>
                            <label class="custom-control-label" for="infonavitEmpleado">Infonavit</label>
                        </div>                        
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputMonto">Monto Descuento</label>
                        <input type="number" readonly class="form-control" id="montoDescuento" name="montoDescuento" placeholder="Monto Descuento" value="<?= $empleado['montoDescuento']?>">
                    </div>
                    <div class="form-group col-md-2">
                        <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content:center;">
                            <input type="checkbox" class="custom-control-input" id="fonacotEmpleado" name="fonacotEmpleado" value=1 onchange="habilitarInputs()" <?php if($empleado['fonacotEmpleado']=="1"){echo"checked";}?>>
                            <label class="custom-control-label" for="fonacotEmpleado">Fonacot</label>
                        </div> 
                    </div> 
                    <div class="form-group col-md-2">
                        <label for="inputCurp">No. Credito</label>
                        <input type="text" readonly class="form-control" id="numeroCredito" name="numeroCredito" placeholder="No. Credito" value="<?= $empleado['numeroCredito']?>">
                    </div>
                </div>

                <!-- INPUT AREA, PUESTO, TIPO DE PERFIL, SALARIO-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputArea">Area</label>                            
                        <select id="areaEmpleado" class="form-control"  name="areaEmpleado" required>
                            <option <?php if($empleado['area']=="Rio Presidio"){echo"selected";}?> value="Rio Presidio">Rio Presidio</option>
                            <option <?php if($empleado['area']=="Múnich"){echo"selected";}?> value="Múnich">Múnich</option>
                            <option <?php if($empleado['area']=="Insurgentes"){echo"selected";}?> value="Insurgentes">Insurgentes </option>
                            <option <?php if($empleado['area']=="Santa Fe"){echo"selected";}?> value="Santa Fe">Santa Fe </option>
                            <option <?php if($empleado['area']=="López Sáenz"){echo"selected";}?> value="López Sáenz">López Sáenz </option>
                            <option <?php if($empleado['area']=="Libramiento"){echo"selected";}?> value="Libramiento">Libramiento</option>                                                            
                            <option <?php if($empleado['area']=="Ley del Mar"){echo"selected";}?> value="Ley del Mar">Ley del Mar</option>
                            <option <?php if($empleado['area']=="Operaciones"){echo"selected";}?> value="Operaciones">Operaciones </option>
                            <option <?php if($empleado['area']=="Competro"){echo"selected";}?> value="Competro">Competro </option>
                            <option <?php if($empleado['area']=="Administrativo"){echo"selected";}?> value="Administrativo">Administrativo</option>
                            <option <?php if($empleado['area']=="Contabilidad"){echo"selected";}?> value="Contabilidad">Contabilidad </option>
                            <option <?php if($empleado['area']=="Recursos Humanos"){echo"selected";}?> value="Recursos Humanos">Recursos Humanos </option>
                            <option <?php if($empleado['area']=="Sistemas y Desarrollo"){echo"selected";}?> value="Sistemas y Desarrollo">Sistemas y Desarrollo</option>
                            <option <?php if($empleado['area']=="Logística"){echo"selected";}?> value="Logística">Logística </option>
                            <option <?php if($empleado['area']=="Gas Unión"){echo"selected";}?> value="Gas Unión">Gas Unión</option>
                        </select>         
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPuesto">Puesto</label>                      
                        <select id="puestoEmpleado" class="form-control"  name="puestoEmpleado" required>                    
                            <option <?php if($empleado['puesto']=="Despachador"){echo"selected";}?>  value="Despachador">Despachador</option>                     
                            <option <?php if($empleado['puesto']=="Supervisor Operativo"){echo"selected";}?>  value="Supervisor Operativo">Supervisor Operativo</option>
                            <option <?php if($empleado['puesto']=="Responsable Operativo y Logistica"){echo"selected";}?>  value="Responsable Operativo y Logistica">Responsable Operativo y Logistica</option>
                            <option <?php if($empleado['puesto']=="Encargado de Turno"){echo"selected";}?>  value="Encargado de Turno">Encargado de Turno</option>
                            <option <?php if($empleado['puesto']=="Mantenimiento"){echo"selected";}?>  value="Mantenimiento">Mantenimiento</option>
                            <option <?php if($empleado['puesto']=="Limpieza"){echo"selected";}?>  value="Limpieza">Limpieza</option>
                            <option <?php if($empleado['puesto']=="Servicio y Cortes"){echo"selected";}?> value="Servicio y Cortes">Servicio y Cortes</option>
                            <option <?php if($empleado['puesto']=="Encargada de Servicio y Controles Internos"){echo"selected";}?>  value="Encargada de Servicio y Controles Internos">Encargada de Servicio y Controles Internos</option>
                            <option <?php if($empleado['puesto']=="Pipero"){echo"selected";}?>  value="Pipero">Pipero</option>                                   
                            <option <?php if($empleado['puesto']=="Seguridad"){echo"selected";}?>  value="Seguridad">Seguridad </option>
                            <option <?php if($empleado['puesto']=="Cubre turno"){echo"selected";}?>  value="Cubre turno">Cubre turno </option>
                            <option <?php if($empleado['puesto']=="Operación Gasolineras"){echo"selected";}?>  value="Operación Gasolineras">Operación Gasolineras </option>
                            <option <?php if($empleado['puesto']=="Auxiliar de operaciones"){echo"selected";}?>  value="Auxiliar de operaciones">Auxiliar de operaciones </option>
                            <option <?php if($empleado['puesto']=="Supervisor operativo de responsabilidad legal"){echo"selected";}?>  value="Supervisor operativo de responsabilidad legal">Supervisor operativo de responsabilidad legal  </option>
                            <option <?php if($empleado['puesto']=="Auxiliar mantenimiento"){echo"selected";}?>  value="Auxiliar mantenimiento">Auxiliar mantenimiento </option>
                            <option <?php if($empleado['puesto']=="Asistente de dirección"){echo"selected";}?>  value="Asistente de dirección">Asistente de dirección </option>
                            <option <?php if($empleado['puesto']=="Asistente de dirección"){echo"selected";}?>  value="Encargado de Compras">Encargado de Compras </option>
                            <option <?php if($empleado['puesto']=="Atención a clientes"){echo"selected";}?>  value="Atención a clientes">Atención a clientes  </option>
                            <option <?php if($empleado['puesto']=="Ejecutivo de Negocios La Caja"){echo"selected";}?>  value="Ejecutivo de Negocios La Caja">Ejecutivo de Negocios La Caja</option>
                            <option <?php if($empleado['puesto']=="Finanzas"){echo"selected";}?>  value="Finanzas">Finanzas</option>
                            <option <?php if($empleado['puesto']=="Encargada Administrativa y Dependencias"){echo"selected";}?>  value="Encargada Administrativa y Dependencias">Encargada Administrativa y Dependencias </option>
                            <option <?php if($empleado['puesto']=="Auxiliar Administrativo"){echo"selected";}?>  value="Auxiliar Administrativo">Auxiliar Administrativo </option>
                            <option <?php if($empleado['puesto']=="Tesorería"){echo"selected";}?>  value="Tesorería">Tesorería </option>
                            <option <?php if($empleado['puesto']=="Gerente Administrativo"){echo"selected";}?>  value="Gerente Administrativo">Gerente Administrativo </option>
                            <option <?php if($empleado['puesto']=="Inmobiliaria"){echo"selected";}?>  value="Inmobiliaria">Inmobiliaria </option>
                            <option <?php if($empleado['puesto']=="Responsable de Obras y Proyectos"){echo"selected";}?>  value="Responsable de Obras y Proyectos">Responsable de Obras y Proyectos </option>
                            <option <?php if($empleado['puesto']=="Promoción y publicidad"){echo"selected";}?>  value="Promoción y publicidad">Promoción y publicidad  </option>
                            <option <?php if($empleado['puesto']=="Contador General"){echo"selected";}?>  value="Contador General">Contador General </option>
                            <option <?php if($empleado['puesto']=="Auxiliar Contable"){echo"selected";}?>  value="Auxiliar Contable">Auxiliar Contable  </option>
                            <option <?php if($empleado['puesto']=="Control Interno"){echo"selected";}?>  value="Control Interno">Control Interno </option>
                            <option <?php if($empleado['puesto']=="Encargada de Ingresos"){echo"selected";}?>  value="Encargada de Ingresos">Encargada de Ingresos </option>
                            <option <?php if($empleado['puesto']=="Guardia de Seguridad"){echo"selected";}?>  value="Guardia de Seguridad">Guardia de Seguridad  </option>
                            <option <?php if($empleado['puesto']=="Coordinador de Capacitación y Desarrollo"){echo"selected";}?>  value="Coordinador de Capacitación y Desarrollo">Coordinador de Capacitación y Desarrollo </option>
                            <option <?php if($empleado['puesto']=="Reclutamiento y Selección"){echo"selected";}?>  value="Reclutamiento y Selección">Reclutamiento y Selección </option>
                            <option <?php if($empleado['puesto']=="Operaciones Grupo Petromar"){echo"selected";}?> value="Operaciones Grupo Petromar">Operaciones Grupo Petromar </option>
                            <option <?php if($empleado['puesto']=="Gerente de RRHH"){echo"selected";}?>  value="Gerente de RRHH">Gerente de RRHH </option>
                            <option <?php if($empleado['puesto']=="Coordinador de Capital Humano"){echo"selected";}?>  value="Coordinador de Capital Humano">Coordinador de Capital Humano </option>
                            <option <?php if($empleado['puesto']=="Encargada de Nóminas"){echo"selected";}?>  value="Encargada de Nóminas">Encargada de Nóminas </option>
                            <option <?php if($empleado['puesto']=="Auxiliar de Sistemas"){echo"selected";}?>  value="Auxiliar de Sistemas">Auxiliar de Sistemas   </option>
                            <option <?php if($empleado['puesto']=="Sistemas"){echo"selected";}?>  value="Sistemas">Sistemas  </option>
                            <option <?php if($empleado['puesto']=="Aux. de desarrollo"){echo"selected";}?>  value="Aux. de desarrollo">Aux. de desarrollo </option>
                            <option <?php if($empleado['puesto']=="Desarrollador"){echo"selected";}?>  value="Desarrollador">Desarrollador </option>
                            <option <?php if($empleado['puesto']=="Supervisora Logistica Comercial"){echo"selected";}?>  value="Supervisora Logistica Comercial">Supervisora Logistica Comercial </option>
                            <option <?php if($empleado['puesto']=="Logística"){echo"selected";}?>  value="Logística">Logística </option>
                            <option <?php if($empleado['puesto']=="Gerente de Finanzas"){echo"selected";}?>  value="Gerente de Finanzas">Gerente de Finanzas  </option>
                            <option <?php if($empleado['puesto']=="Encargado Contable Gas y Comercializadora"){echo"selected";}?>  value="Encargado Contable Gas y Comercializadora">Encargado Contable Gas y Comercializadora </option>
                            <option <?php if($empleado['puesto']=="Supervisora de call center"){echo"selected";}?>  value="Supervisora de call center">Supervisora de call center  </option>
                            <option <?php if($empleado['puesto']=="Call Center"){echo"selected";}?>  value="Call Center">Call Center  </option>
                            <option <?php if($empleado['puesto']=="Gerente Operativo Gas"){echo"selected";}?>  value="Gerente Operativo Gas">Gerente Operativo Gas </option>
                            <option <?php if($empleado['puesto']=="Encargado de Logistica"){echo"selected";}?>  value="Encargado de Logistica">Encargado de Logistica </option>
                            <option <?php if($empleado['puesto']=="Coordinador Operativo Gas"){echo"selected";}?>  value="Coordinador Operativo Gas">Coordinador Operativo Gas </option>
                            <option <?php if($empleado['puesto']=="Responsable Operativo de Mantenimiento y Dependencias Gas"){echo"selected";}?>  value="Responsable Operativo de Mantenimiento y Dependencias Gas">Responsable Operativo de Mantenimiento y Dependencias Gas </option>
                            <option <?php if($empleado['puesto']=="Encargado de Mantenimiento Gas"){echo"selected";}?>  value="Encargado de Mantenimiento Gas">Encargado de Mantenimiento Gas </option>
                            <option <?php if($empleado['puesto']=="Controles Internos Gas"){echo"selected";}?>  value="Controles Internos Gas">Controles Internos Gas </option>
                            <option <?php if($empleado['puesto']=="Auxiliar de Planta"){echo"selected";}?>  value="Auxiliar de Planta">Auxiliar de Planta </option>
                            <option <?php if($empleado['puesto']=="Técnico"){echo"selected";}?>  value="Técnico">Técnico  </option>
                            <option <?php if($empleado['puesto']=="Velador"){echo"selected";}?>  value="Velador">Velador  </option>
                            <option <?php if($empleado['puesto']=="Ayu. de operador autotanque"){echo"selected";}?>  value="Ayu. de operador autotanque">Ayu. de operador autotanque  </option>
                            <option <?php if($empleado['puesto']=="Operador de autotanque"){echo"selected";}?>  value="Operador de autotanque">Operador de autotanque   </option>
                        </select>               
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPerfil">Tipo de Perfil</label>                        
                        <select id="perfilEmpleado" class="form-control"  name="perfilEmpleado" required>
                            <option <?php if($empleado['tipoPerfil']=="Administrativo"){echo"selected";}?> value="Administrativo">Administrativo</option>  
                            <option <?php if($empleado['tipoPerfil']=="Operativo"){echo"selected";}?> value="Operativo">Operativo</option>                         
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputSalario">Salario</label>
                        <input type="number" class="form-control" id="salarioEmpleado" name="salarioEmpleado" placeholder="Salario"  maxlength="5" required value="<?= $empleado['salario']?>">
                    </div>
                </div>

             
                <!-- INPUT CUENTA, CLABE INTERBANCARIA, BANCO-->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <div class="custom-control custom-switch" style="margin-top: 35px;display: flex;justify-content: center;">
                            <input type="checkbox" class="custom-control-input" id="CuentaBancaria" name="CuentaBancaria" onchange="habilitarInputs()" value="1" <?php if($empleado['CuentaBancaria']=="1"){echo"checked";}?>>
                            <label class="custom-control-label" for="CuentaBancaria">Cuenta Bancaria</label>
                        </div>                        
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputBanco">Banco</label>
                        <select id="Banco" class="form-control"  name="Banco" disabled>                                
                            <option value="Santander" <?php if($empleado['Banco']=="Santander"){echo"selected";}?>>Santander</option>
                            <option value="HSBC" <?php if($empleado['Banco']=="HSBC"){echo"selected";}?>>HSBC</option>
                            <option value="Banorte" <?php if($empleado['Banco']=="Banorte"){echo"selected";}?>>Banorte</option>
                            <option value="CitiBanamex" <?php if($empleado['Banco']=="CitiBanamex"){echo"selected";}?>>CitiBanamex</option>
                            <option value="BBVA" <?php if($empleado['Banco']=="BBVA"){echo"selected";}?>>BBVA</option>                             
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCurp">No. Cuenta</label>
                        <input type="text" readonly class="form-control" id="numeroCuenta" name="numeroCuenta" placeholder="No. Cuenta" maxlength="10" value="<?= $empleado['numeroCuenta']?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCurp">Clave Interbancaria</label>
                        <input type="text" readonly class="form-control" id="claveInterbancaria" name="claveInterbancaria" placeholder="Clave Interbancaria" maxlength="18" value="<?= $empleado['claveInterbancaria']?>">
                    </div>              
                </div>


                <!-- INPUT FECHA DE INGRESO, ANTIGUEDAD, TALLAS-->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputFechaIngreso">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="ingresoEmpleado" name="ingresoEmpleado" placeholder="Fecha de Ingreso" oninput="calcularAntiguedad()"   required value="<?= $empleado['fechaIngreso']?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputAntiguedad" style="font-family: DejaVuSans">Antigüedad</label>
                        <input type="text" readonly class="form-control" id="antiguedadEmpleado" name="antiguedadEmpleado" placeholder="Antigüedad" style="font-family: DejaVuSans">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputVacaciones">Dias de Vacaciones</label>
                        <input type="text" readonly class="form-control" id="vacacionesEmpleado" name="vacacionesEmpleado" placeholder="Vacaciones">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputCamisa">Talla Camisa</label>                        
                        <select id="camisaEmpleado" class="form-control" name="camisaEmpleado" required>
                            <option <?php if($empleado['tallaCamisa']=="XS"){echo"selected";}?> value="XS">XS</option>
                            <option <?php if($empleado['tallaCamisa']=="S"){echo"selected";}?> value="S">S</option>
                            <option <?php if($empleado['tallaCamisa']=="M"){echo"selected";}?> value="M">M</option>
                            <option <?php if($empleado['tallaCamisa']=="L"){echo"selected";}?> value="L">L</option>
                            <option <?php if($empleado['tallaCamisa']=="XL"){echo"selected";}?> value="XL">XL</option>
                            <option <?php if($empleado['tallaCamisa']=="2XL"){echo"selected";}?> value="2XL">2XL</option>
                            <option <?php if($empleado['tallaCamisa']=="3XL"){echo"selected";}?> value="3XL">3XL</option>
                            <option <?php if($empleado['tallaCamisa']=="4XL"){echo"selected";}?> value="4XL">4XL</option>                    
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPantalon" style="font-family: DejaVuSans">Talla Pantalón</label>                        
                        <select id="pantalonEmpleado" class="form-control" name="pantalonEmpleado" required>
                            <option <?php if($empleado['tallaPantalon']=="25"){echo"selected";}?>  value="25">25</option>
                            <option <?php if($empleado['tallaPantalon']=="26"){echo"selected";}?>  value="26">26</option>
                            <option <?php if($empleado['tallaPantalon']=="27"){echo"selected";}?>  value="27">27</option>
                            <option <?php if($empleado['tallaPantalon']=="28"){echo"selected";}?>  value="28">28</option>
                            <option <?php if($empleado['tallaPantalon']=="30"){echo"selected";}?>  value="30">30</option>
                            <option <?php if($empleado['tallaPantalon']=="32"){echo"selected";}?>  value="32">32</option>
                            <option <?php if($empleado['tallaPantalon']=="34"){echo"selected";}?>  value="34">34</option>
                            <option <?php if($empleado['tallaPantalon']=="36"){echo"selected";}?>  value="36">36</option>
                            <option <?php if($empleado['tallaPantalon']=="38"){echo"selected";}?>  value="38">38</option>
                            <option <?php if($empleado['tallaPantalon']=="40"){echo"selected";}?>  value="40">40</option>
                            <option <?php if($empleado['tallaPantalon']=="42"){echo"selected";}?>  value="42">42</option>
                            <option <?php if($empleado['tallaPantalon']=="44"){echo"selected";}?>  value="44">44</option>                   
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputBotas">Talla Botas</label>
                        <input type="number" class="form-control" id="botasEmpleado" name="botasEmpleado" placeholder="Talla Botas"  maxlength="2" required value="<?= $empleado['tallaBotas']?>">
                    </div>
                </div>

            </div>
     
          </div>
        </div>


         <!-- DATOS DE CONTACTO DE EMERGENCIA-->
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos de Contacto de Emergencía</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNombre">Nombre Completo</label>
                            <input type="text" class="form-control " id="nombreEmergencia" name="nombreEmergencia" placeholder="Nombre Completo" maxlength="100" required value="<?= $empleado['nombreEmergencia']?>">                
                        </div>            
                        <div class="form-group col-md-3">
                            <label for="inputCelularEmergencia">Celular</label>
                            <input type="tel" class="form-control"  id="celularEmergencia" name="celularEmergencia"  maxlength="10" required value="<?= $empleado['celularEmergencia']?>">            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputTelefonoEmergencia">Telefono</label>
                            <input type="tel" class="form-control"  id="telefonoEmergencia" name="telefonoEmergencia"  maxlength="10" required value="<?= $empleado['telefonoEmergencia']?>">            
                        </div>
                    </div>
                </div>    
            </div>
        </div>

         <!-- OBSERVACIONES -->
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">
                Observaciones
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="observacionesEmpleado" name="observacionesEmpleado"><?= $empleado['observaciones']?></textarea>
            </div>
     
          </div>
        </div>
 
         
        <button type="submit" class="btn btn-success btn-lg" id="btn-actualizar"><i class="fa fa-edit"></i>ACTUALIZAR</button>                                                                                   

    </form>
    <br>
    <br>

    <br>




    <script type="text/javascript">
        $(document).ready(function(){ 
            calcularEdad();
            calcularAntiguedad();
            habilitarInputs();
        });
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
            // calculamos los dias de vacaciones
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

        $(function () {
            // Summernote
            $('#observacionesEmpleado').summernote()            
        })


        function imprimirEmpleado(nombreEmpleado){    
            document.getElementById("btn-actualizar").style.display = "none";           
            kendo.drawing.drawDOM($("#infoEmpleado")).then(function(group){ 
                                      
                return kendo.drawing.exportPDF(group,{
                    paperSize: "auto",
                    margin: {left: "1cm",right:"1cm",top: "1cm",bottom: "1cm"}
                });           
            }).done(function(data){        
                kendo.saveAs({
                    dataURI:data,
                    fileName:nombreEmpleado
                });
                document.getElementById("btn-actualizar").style.display = "block";
            });
           

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
            }else{
                $("#montoDescuento").attr("readonly", true);
                $("#montoDescuento").val(''); 
                $("#montoDescuento").attr("required", false); 
            }

            if( $('#fonacotEmpleado').prop('checked') ) {
                $("#numeroCredito").attr("readonly", false); 
                $("#numeroCredito").attr("required", true); 
            }else{
                $("#numeroCredito").attr("readonly", true);
                $("#numeroCredito").val('');  
                $("#numeroCredito").attr("required", false); 
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
            }
        }
    </script>
<?= 
    $this->endSection();
?>
