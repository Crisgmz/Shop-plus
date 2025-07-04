<?php

	$objProducto =  new Producto();
	$objVenta = new Venta();

?>
			 <div class="row">
				 <div class="col-md-12 col-lg-12">
			      	<!-- Detalle de Compra -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">Facturar Venta</h4>
									<div class="heading-elements">
										<form class="heading-form" action="#">

										<div class="form-group">
											<div class="checkbox checkbox-switchery switchery-sm">
												<label>
												<input type="checkbox" id="chkBusqueda" name="chkBusqueda"
												 class="switchery" checked="checked" >
												  <i class="icon-search4"></i> <span id="lblchk3"> PRODUCTO POR CODIGO</span>
											   </label>
											</div>
										</div>

											<div class="form-group">
													<input type="checkbox" id="chkPrecio"
													data-on-text="P.P." data-off-text="P.M." class="switch" data-size="mini"
													data-on-color="primary" data-off-color="success" checked="checked">
												</label>
											</div>

									 </form>
									</div>
							</div>
							<div class="panel-heading" style="background-color:#2b2b2b;">
								<h4 class="panel-title"><h1 id="big_total" class="panel-title text-center text-black text-green"
									style="font-size:42px;">0.00</h1></h4>
							</div>

							<div class="panel-body">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-12">
											<div class="input-group">
												<span class="input-group-addon"><i class="icon-barcode2"></i></span>
												<input type="text" id="buscar_producto" name="buscar_producto"  placeholder="Busque un producto aqui..."
												 class="form-control" style="text-transform:uppercase;"
	                      						 onkeyup="javascript:this.value=this.value.toUpperCase();">
                      						</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table id="tbldetalle" class="table table-xxs">
										<thead>
											<tr class="bg-teal">
												<th></th>
												<th class="text-center text-bold">Producto</th>
												<th class="text-center text-bold">Cant.</th>
												<th class="text-center text-bold">Precio</th>
												<th class="text-center text-bold">Exento</th>
												<th class="text-center text-bold">Descuento</th>
												<th class="text-center text-bold">Importe</th>
												<th class="text-center text-bold">Vence</th>
												<th class="text-center text-bold">Quitar</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
										<tfoot id="totales_foot">
											<tr class="bg-info-800">
												<td align="center" width="10%">SUMAS</td>
												<td align="center" width="26%">ITBIS %</td>
												<td align="center" width="10%">SUBTOTAL</td>
												<td align="center" width="10%">RET. (-)</td>
												<td align="center" width="10%">TOT. SIN ITBIS</td>
												<td align="center" width="10%">DESCUENTO</td>
												<td align="center" width="10%">TOTAL</td>
												<td align="center" width="30%"><b><i class="icon-cash"></i>
												</b></td>
												<td align="center" width="30%"><b>
												<i class="icon-cancel-circle2"></i>
												</b></td>
											</tr>
											<tr>
												<td align="center" id="sumas"></td>
												<td align="center" id="iva"></td>
												<td align="center" id="subtotal"></td>
												<td align="center" id="ivaretenido"></td>
												<td align="center" id="exentas"></td>
												<td align="center" id="descuentos"></td>
												<td align="center" id="total"></td>
												<td align="center"><button type="button" id="btnguardar" data-toggle="modal" data-target="#modal_iconified_cash"
												class="btn bg-success-700 btn-sm ">Cobrar</button></td>
												<td align="center"><button type="submit" id="btncancelar" class="btn bg-danger-700 btn-sm">
												</b> Cancelar </button></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					<!-- /Detalle de Compra -->

			   	  </div>
			  </div>

			<!-- Iconified modal -->
				<div id="modal_iconified_cash" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h5 class="modal-title"><i class="icon-cash"></i> &nbsp; <span class="title-form">Facturar Venta</span></h5>
							</div>

					    <form role="form" autocomplete="off" class="form-validate-jquery" id="frmPago">
								<div class="modal-body" id="modal-container">

									<div class="form-group">
										<div class="row">
											<div class="col-sm-8">
												<label>Seleccione el Cliente</label>
												<select  data-placeholder="..." id="cbCliente" name="cbCliente"
													class="select-size-xs" style="text-transform:uppercase;"
				                   onkeyup="javascript:this.value=this.value.toUpperCase();">
													 <option value=""></option>
			                            			  <?php
														$filas = $objVenta->Listar_Clientes();
														if (is_array($filas) || is_object($filas))
														{
														foreach ($filas as $row => $column)
														{
														?>
															<option value="<?php print ($column["idcliente"])?>">
															<?php print ($column["numero_nit"].' - '.
															 $column["nombre_cliente"])?></option>
														<?php
															}
														}
														 ?>
												 </select>
											</div>

											<div class="col-sm-4">
													<label>Limite Crediticio <span class="text-danger"></span></label>
														<div class="input-group">
														<span class="input-group-addon"><i class="icon-cash3"></i></span>
														<input type="text" id="txtLimitC" name="txtLimitC" placeholder="0.00"
														 class="form-control" style="text-transform:uppercase;"
															onkeyup="javascript:this.value=this.value.toUpperCase();" readonly="readonly" disabled="disabled">
														</div>
												</div>

										</div>
									</div>


						    <div class="form-group">
									<div class="row">

										<div class="col-sm-6">
											<label>Seleccione la condicion de pago</label>
											<div class="checkbox checkbox-switchery switchery-sm">
												<label>
												<input type="checkbox" id="chkPagado" name="chkPagado"
												 class="switchery" checked="checked" >
												 <span id="lblchk2">VENTA AL CONTADO</span>
											   </label>
											</div>
										</div>

										<div class="col-sm-6">
											<label>Seleccione comprobante de Venta</label>
											<select  data-placeholder="..." id="cbCompro" name="cbCompro"
												class="select-size-xs" style="text-transform:uppercase;"
												onkeyup="javascript:this.value=this.value.toUpperCase();">
																				<?php
													$filas = $objVenta->Listar_Comprobantes();
													if (is_array($filas) || is_object($filas))
													{
													foreach ($filas as $row => $column)
													{
													?>
														<option value="<?php print ($column["idcomprobante"])?>">
														<?php print ($column["nombre_comprobante"])?></option>
													<?php
														}
													}
													 ?>
											 </select>
										</div>

									</div>
								</div>

								<div class="form-group">
									<div class="row">

										<div id="div-cbMPago" class="col-sm-6">
										 <label>Metodo de Pago</label>
											 <select id="cbMPago" name="cbMPago" data-placeholder="Seleccione un metodo de pago..." class="select-icons">
													 <option value="1" data-icon="cash">EFECTIVO</option>
													 <option value="2" data-icon="credit-card">TARJETA DE DEBITO / CREDITO</option>
													 <option value="3" data-icon="cash4">EFECTIVO Y TARJETA</option>
											 </select>
										</div>
									</div>
								</div>


								<div class="form-group">
									<div class="row">
											<div class="col-sm-4">
													<label>A Pagar <span class="text-danger"> * </span></label>
													<div class="input-group">
													<span class="input-group-addon"><i class="icon-cash3"></i></span>
													<input type="text" id="txtDeuda" name="txtDeuda" placeholder="0.00"
													 class="form-control input-sm" style="text-transform:uppercase;"
			                     onkeyup="javascript:this.value=this.value.toUpperCase();"
													 readonly="readonly" disabled="disabled">
			                 	</div>
											</div>

										<div id="div-txtMonto" class="col-sm-4">
											<label>Efectivo Recibido <span class="text-danger"> * </span></label>
											<input type="text" id="txtMonto" name="txtMonto" placeholder="0.00"
											 class="form-control input-sm" style="text-transform:uppercase;"
	                     onkeyup="javascript:this.value=this.value.toUpperCase();">
										</div>

											<div id="div-txtCambio" class="col-sm-4">
													<label>Cambio <span class="text-danger"> * </span></label>
													<div class="input-group">
													<span class="input-group-addon"><i class="icon-cash"></i></span>
													<input type="text" id="txtCambio" name="txtCambio" placeholder="0.00"
													 class="form-control input-sm" style="text-transform:uppercase;"
		                  		onkeyup="javascript:this.value=this.value.toUpperCase();"
													readonly="readonly" disabled="disabled">
		                  </div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
											<div id="div-txtNoTarjeta" class="col-sm-5">
													<label> Tarjeta Debito/Credito <span class="text-danger"> * </span></label>
													<div class="input-group">
													<span class="input-group-addon"><i class="icon-credit-card"></i></span>
													<input type="text" id="txtNoTarjeta" name="txtNoTarjeta" placeholder="numero de tarjeta"
													 class="form-control input-sm" style="text-transform:uppercase;"
													 onkeyup="javascript:this.value=this.value.toUpperCase();">
												</div>
											</div>

											<div id="div-txtHabiente" class="col-sm-7">
													<label> Tarjeta Habiente <span class="text-danger"> * </span></label>
													<div class="input-group">
													<span class="input-group-addon"><i class="icon-user"></i></span>
													<input type="text" id="txtHabiente" name="txtHabiente" placeholder="Juan Perez"
													 class="form-control input-sm" style="text-transform:uppercase;"
													 onkeyup="javascript:this.value=this.value.toUpperCase();">
												</div>
											</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
											<div id="div-txtMontoTar" class="col-sm-5">
													<label> Monto Debitado <span class="text-danger"> * </span></label>
													 <input type="text" id="txtMontoTar" name="txtMontoTar" placeholder="0.00"
													 class="touchspin-prefix" value="0" style="text-transform:uppercase;"
													 onkeyup="javascript:this.value=this.value.toUpperCase();">
												</div>
									</div>
								</div>


								</div>

								<div class="modal-footer">
									<button  type="reset" class="btn btn-default" id="reset"
									class="btn btn-link" data-dismiss="modal">Cerrar</button>
									<button type="submit" id="btnRegistrar" class="btn bg-success-800 btn-labeled"><b><i class="icon-printer4"></i>
									</b> Facturar e Imprimir</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /iconified modal -->


				<?php include('./includes/footer.inc.php'); ?>
			</div>
			<!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</div>
<!-- /page container -->
</body>
</html>
<script type="text/javascript" src="web/custom-js/new-venta.js"></script>
