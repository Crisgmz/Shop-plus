<?php

	$objDashboard =  new Dashboard();
	$objProducto = new Producto();
	$filas = $objDashboard->Datos_Paneles();

	$parametros = $objDashboard->Ver_Moneda_Reporte();
	if (is_array($parametros) || is_object($parametros))
	{
		foreach ($parametros as $row => $column) {
			$nombre_mon = $column['CurrencyISO'];
			$moneda = $column['Symbol'];
		}
	} else {
		$moneda = '';
	}

	$compras = $objDashboard->Compras_Anuales();
	$ventas = $objDashboard->Ventas_Anuales();

	if (is_array($filas) || is_object($filas))
	{
		foreach ($filas as $row => $column)
		{
			$compras_mes = $column["compras_mes"];
			$ventas_dia = $column["ventas_dia"];
			$inversion_stock = $column["inversion_stock"];
			$proveedores = $column["proveedores"];
			$marcas = $column["marcas"];
			$presentaciones = $column["presentaciones"];
			$productos = $column["productos"];
			$dinero_caja  = $column["dinero_caja"];
			$perecederos  = $column["perecederos"];
			$a_vencer  = $column["a_vencer"];
			$clientes  = $column["clientes"];
			$creditos  = $column["creditos"];
		}
	}

?>

<style>
/* Estilos personalizados para cards uniformes */
.uniform-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border-radius: 15px !important;
    border: none !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    transition: all 0.3s ease !important;
    overflow: hidden !important;
    position: relative !important;
}

.uniform-card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 12px 35px rgba(0,0,0,0.2) !important;
}

.uniform-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    z-index: 1;
}

.uniform-card .panel-body {
    position: relative;
    z-index: 2;
    color: white !important;
}

.uniform-card h3 {
    color: white !important;
    font-weight: bold !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
}

.uniform-card span {
    color: rgba(255,255,255,0.9) !important;
    font-weight: 500 !important;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2) !important;
}

.uniform-card i {
    color: rgba(255,255,255,0.8) !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2) !important;
}

/* Tabla con bordes redondeados */
.table-container {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

/* Charts con bordes redondeados */
.chart-panel {
    border-radius: 15px !important;
    overflow: hidden !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    z-index: 1000;
    overflow-y: auto;
    transition: transform 0.3s ease;
}

.sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    z-index: 1;
}

.sidebar-content {
    position: relative;
    z-index: 2;
    padding: 20px 0;
}

.sidebar-section {
    margin-bottom: 30px;
}

.sidebar-title {
    color: rgba(255,255,255,0.7);
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0 20px 10px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 15px;
}

.sidebar-item {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.sidebar-item:hover {
    background: rgba(255,255,255,0.1);
    color: white;
    border-left-color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.sidebar-item.active {
    background: rgba(255,255,255,0.2);
    color: white;
    border-left-color: white;
}

.sidebar-item i {
    margin-right: 12px;
    width: 20px;
    text-align: center;
    font-size: 16px;
}

/* AppBar Styles */
.app-bar {
    position: fixed;
    top: 0;
    left: 280px;
    right: 0;
    height: 70px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    z-index: 999;
    display: flex;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.app-bar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    z-index: 1;
}

.app-bar-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    position: relative;
    z-index: 2;
}

.app-bar h1 {
    color: white;
    font-size: 24px;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    margin: 0;
}

.app-bar-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.app-bar-btn {
    background: rgba(255,255,255,0.2);
    border: none;
    border-radius: 10px;
    padding: 10px 15px;
    color: white;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.app-bar-btn:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

/* Main content adjustment */
.main-content {
    margin-left: 280px;
    margin-top: 70px;
    padding: 30px;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }
    
    .app-bar {
        left: 0;
    }
    
    .main-content {
        margin-left: 0;
    }
}
</style>

<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?php echo $moneda.' '.number_format($dinero_caja, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini"><?php echo strtoupper($nombre_mon) ?> EN CAJA</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-cash icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?php echo $moneda.' '.number_format($compras_mes, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">COMPRAS DEL MES</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-bag icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-left media-middle">
                    <i class="icon-cash3 icon-3x opacity-75"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="no-margin"><?php echo $moneda.' '.number_format($ventas_dia, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">EN VENTAS DEL DIA</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-left media-middle">
                    <i class="icon-price-tags icon-3x opacity-75"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="no-margin"><?php echo $moneda.' '.number_format($inversion_stock, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">INVERTIDO EN STOCK</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-left media-middle">
                    <i class="icon-truck icon-3x opacity-75"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="no-margin"><?php echo number_format($proveedores, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">PROVEEDORES</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-left media-middle">
                    <i class="icon-cc icon-3x opacity-75"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="no-margin"><?php echo number_format($marcas, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">MARCAS</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-left media-middle">
                    <i class="icon-stack-star icon-3x opacity-75"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="no-margin"><?php echo number_format($presentaciones, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">PRESENTACIONES</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-left media-middle">
                    <i class="icon-box icon-3x opacity-75"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="no-margin"><?php echo number_format($productos, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">PRODUCTOS INGRESADOS</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?php echo number_format($perecederos, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">PERECEDEROS</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-calendar icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?php echo number_format($a_vencer, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">VENCERAN EN 30 DIAS</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-sort-time-asc icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?php echo number_format($clientes, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">CLIENTES</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-users4 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="panel panel-body uniform-card has-bg-image">
            <div class="media no-margin">
                <div class="media-body">
                    <h3 class="no-margin"><?php echo number_format($creditos, 2, '.', ','); ?></h3>
                    <span class="text-uppercase text-size-mini">CREDITOS PENDIENTES</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-wallet icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</div>
                
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-flat table-container">
            <div class="panel-heading">
                <h6 class="panel-title text-left text-uppercase">Ultimos productos</h6>
                <div class="chart-container text-left">
                    <table class="table datatable-basic table-borderless table-hover table-xxs">
                        <thead>
                            <tr>
                                <th>Barra/Interno</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Presentacion</th>
                                <th>S.Min.</th>
                                <th>Stock</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $filas = $objProducto->Listar_Productos();
                            arsort($filas);
                            if (is_array($filas) || is_object($filas)) {
                                foreach ($filas as $row => $column) {
                                    $stock_print = "";
                                    $codigo_print = "";
                                    $codigo_barra = $column['codigo_barra'];
                                    $inventariable = $column['inventariable'];
                                    $stock = $column['stock'];
                                    $stock_min = $column['stock_min'];

                                    if ($codigo_barra == '') {
                                        $codigo_print = $column['codigo_interno'];
                                    } else {
                                        $codigo_print = $codigo_barra;
                                    }

                                    if ($inventariable == 1) {
                                        if ($stock >= 1 && $stock < $stock_min) {
                                            $stock_print = '<span class="label label-warning label-rounded"><span class="text-bold">POR AGOTARSE</span></span>';
                                        } else if ($stock == $stock_min) {
                                            $stock_print = '<span class="label label-info label-rounded"><span class="text-bold">EN MINIMO</span></span>';
                                        } else if ($stock > $stock_min) {
                                            $stock_print = '<span class="">' . $stock . '</span>';
                                        } else if ($stock == 0) {
                                            $stock_print = '<span class="label label-danger label-rounded"><span class="text-bold">AGOTADO</span></span>';
                                        }
                                    } else {
                                        $stock_print = '<span class="label label-primary label-rounded"><span class="text-bold">SERVICIO</span></span>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php print($codigo_print); ?></td>
                                        <td><?php print($column['nombre_producto']); ?></td>
                                        <td><?php print($column['nombre_marca']); ?></td>
                                        <td><?php print($column['nombre_presentacion']); ?></td>
                                        <td><?php print($column['stock_min']); ?></td>
                                        <td class="success"><?php print($stock_print); ?></td>
                                        <td><?php print($column['precio_venta']); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-flat chart-panel">
            <div class="panel-heading">
                <h6 class="panel-title text-black">COMPARATIVA VENTAS Y COMPRAS DEL AÑO <?php echo date('Y') ?></h6>
            </div>
            <div class="panel-body">
                <div class="chart-container">
                    <div class="chart" id="c3-line-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-flat chart-panel">
            <div class="panel-heading">
                <h6 class="panel-title text-center text-uppercase text-black">VENTAS DEL AÑO <?php echo date('Y') ?></h6>
            </div>
            <div class="container-fluid">
                <div class="chart-container text-center">
                    <div class="display-inline-block" id="chart-ventas"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-flat chart-panel">
            <div class="panel-heading">
                <h6 class="panel-title text-center text-uppercase text-black">COMPRAS DEL AÑO <?php echo date('Y') ?></h6>
            </div>
            <div class="container-fluid">
                <div class="chart-container text-center">
                    <div class="display-inline-block" id="chart-compras"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./includes/footer.inc.php'); ?>

<script>
// Line chart
var line_chart = c3.generate({
    bindto: '#c3-line-chart',
    point: {
        r: 4
    },
    size: { height: 400, width: 1000 },
    color: {
        pattern: ['#66BB6A', '#54CFDF', '#1E88E5']
    },
    data: {
        columns: [
            ['COMPRAS', <?php foreach ($compras as $row => $column) {print($column['total'].',');}?>],
            ['VENTAS', <?php foreach ($ventas as $row => $column) {print($column['total'].',');}?>]
        ],
        type: 'spline'
    },
    grid: {
        y: {
            format: d3.format(""),
            show: true
        }
    }
});

var pie_chart = c3.generate({
    bindto: '#chart-compras',
    size: { width: 500 },
    data: {
        x: 'x',
        columns: [
            ['x', <?php foreach ($compras as $row => $column) {print('"'.$column['mes'].'",');}?>],
            ['MONTO', <?php foreach ($compras as $row => $column) {print($column['total'].',');}?>]
        ],
        type : 'bar',
        colors: {
            MONTO: '#66BB6A'
        },
    },
    axis : {
        x:{
            type: 'category',
        },
        y : {
           tick: {
               format: d3.format("")
           }
       }
    }
});

var pie_chart = c3.generate({
    bindto: '#chart-ventas',
    size: { width: 500 },
    data: {
        x: 'x',
        columns: [
            ['x', <?php foreach ($ventas as $row => $column) {print('"'.$column['mes'].'",');}?>],
            ['MONTO', <?php foreach ($ventas as $row => $column) {print($column['total'].',');}?>]
        ],
        type : 'bar',
        colors: {
            MONTO: '#54CFDF'
        },
    },
    axis : {
        x:{
            type: 'category',
        },
        y : {
           tick: {
               format: d3.format("")
           }
       }
    }
});
</script>
