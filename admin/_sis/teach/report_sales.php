<?php
$AdminLevel = LEVEL_WC_REPORTS;
if (!APP_EAD || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

$Search = filter_input_array(INPUT_POST);

//GET DATES
$StartDate = (!empty($_SESSION['wc_report_date'][0]) ? $_SESSION['wc_report_date'][0] : date("Y-m-01"));
$EndDate = (!empty($_SESSION['wc_report_date'][1]) ? $_SESSION['wc_report_date'][1] : date("Y-m-d"));

//DEFAULT REPORT
$DateStart = new DateTime($StartDate);
$DateEnd = new DateTime(date("Y-m-d", strtotime($EndDate . "+1day")));
$DateInt = new DateInterval("P1D");
$DateInterval = new DatePeriod($DateStart, $DateInt, $DateEnd);
?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-cart">Relatório de Vendas</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=teach/report">Relatórios</a>
            <span class="crumb">/</span>
            Relatório de Vendas
        </p>
    </div>

    <div class="dashboard_header_search">
        <a title="Recarregar Relatórios" href="dashboard.php?wc=teach/report_sales" class="btn btn_blue icon-spinner11 icon-notext"></a>
    </div>
</header>

<div class="dashboard_content">
    <article class="box box100">
        <div class="panel">
            <div class="wc_ead_chart_control">
                <div class="wc_ead_chart_range">
                    <form name="class_add" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="callback" value="Reports"/>
                        <input type="hidden" name="callback_action" value="get_report"/>
                        <input type="hidden" name="report_back" value="teach/report_sales"/>

                        <label class="wc_ead_chart_range_picker">
                            <span>DE:</span><input readonly="readonly" value="<?= date("d/m/Y", strtotime($StartDate)); ?>" name="start_date" type="text" data-language="pt-BR" class="jwc_datepicker_start"/>
                        </label><label class="wc_ead_chart_range_picker">
                            <span>ATÉ:</span><input readonly="readonly" value="<?= date("d/m/Y", strtotime($EndDate)); ?>" name="end_date" type="text" data-language="pt-BR" class="jwc_datepicker_end"/>
                        </label><button class="btn icon-spinner11 icon-notext"></button><img class="form_load" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
                    </form>
                </div><div class="wc_ead_chart_change">
                    <span class="icon icon-stats-bars icon-notext jwc_chart_change jwc_area_chart btn btn_blue btn_green"></span>
                    <span class="icon icon-stats-bars2 icon-notext jwc_chart_change jwc_column_chart btn btn_blue"></span>
                    <span class="icon icon-stats-dots icon-notext jwc_chart_change jwc_line_chart btn btn_blue"></span>
                </div>
            </div>
            <div id="jwc_chart_container"></div>

            <?php
            //GET TOTALS
            $Read->FullRead("SELECT count(order_id) as TotalOrders, SUM(order_status = 'approved' OR order_status = 'completed') as TotalSales, SUM(CASE WHEN order_currency = 'BRL' AND (order_status = 'approved' OR order_status = 'completed') THEN order_cms_vendor ELSE 0 END) AS TotalProfit, SUM(CASE WHEN order_currency != 'BRL' THEN order_cms_vendor ELSE 0 END) AS OtherProfit FROM " . DB_EAD_ORDERS . " WHERE date(order_purchase_date) >= :start AND date(order_purchase_date) <= :end", "start={$StartDate}&end={$EndDate}");
            $TotalOrders = str_pad($Read->getResult()[0]['TotalOrders'], 3, 0, 0);
            $TotalSales = str_pad($Read->getResult()[0]['TotalSales'], 3, 0, 0);
            $TotalProfit = number_format($Read->getResult()[0]['TotalProfit'], '2', ',', '.');
            $OtherProfit = number_format($Read->getResult()[0]['OtherProfit'], '2', ',', '.');
            $TotalConversion = ($TotalOrders >= 1 ? round(($TotalSales * 100) / $TotalOrders) : "0");
            ?>
            <div class="wc_ead_reports_boxes">
                <div class="box box25 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-cart"><?= $TotalOrders; ?></p>
                        <span>Todos os Pedidos</span>
                    </div>
                </div><div class="box box25 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-checkmark"><?= $TotalSales; ?></p>
                        <span>Vendas Confirmadas</span>
                    </div>
                </div><div class="box box25 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-filter"><?= $TotalConversion; ?>%</p>
                        <span>Taxa de Conversão</span>
                    </div>
                </div><div class="box box25 wc_ead_reports_total">
                    <div class="box_content" style="padding: 22px 10px">
                        <p style="font-size: 2em">R$ <?= $TotalProfit; ?></p>
                        <span>+ $ <?= $OtherProfit; ?> em outras moedas</span>
                    </div>
                </div>
            </div>

            <footer class="wc_ead_reports">
                <?php
                $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
                $Page = ($getPage ? $getPage : 1);
                $Pager = new Pager("dashboard.php?wc=teach/report_sales&page=", "<", ">", 3);
                $Pager->ExePager($Page, 12);
                $Read->FullRead("SELECT Year(order_purchase_date) AS OrderYear, Month(order_purchase_date) AS OrderMonth, count(order_id) as TotalOrders, SUM(order_status = 'approved' OR order_status = 'completed') as TotalSales, SUM(CASE WHEN order_currency = 'BRL' AND (order_status = 'approved' OR order_status = 'completed') THEN order_cms_vendor ELSE 0 END) AS TotalProfit, SUM(CASE WHEN order_currency != 'BRL' THEN order_cms_vendor ELSE 0 END) AS OtherProfit FROM " . DB_EAD_ORDERS . " GROUP BY DATE_FORMAT(order_purchase_date,'%Y-%m') ORDER BY order_purchase_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
                if (!$Read->getResult()):
                    $Pager->ReturnPage();
                else:
                    foreach ($Read->getResult() as $OrderReport):
                        //ORDERS
                        ?>
                        <article class="wc_ead_reports_single">
                            <h1 class="row icon-calendar">
                                <?= str_pad($OrderReport['OrderMonth'], 2, 0, 0) . "/{$OrderReport['OrderYear']}"; ?>
                            </h1><p class="row icon-cart">
                                <?= str_pad($OrderReport['TotalOrders'], 3, 0, 0); ?> Pedidos
                            </p><p class="row icon-filter">
                                <?= str_pad($OrderReport['TotalSales'], 3, 0, 0); ?> Vendas (<?= ($OrderReport['TotalOrders'] && $OrderReport['TotalSales'] ? round(($OrderReport['TotalSales'] * 100) / $OrderReport['TotalOrders']) : "0"); ?>%)
                            </p><p class="row icon-coin-dollar">
                                R$ <?= number_format($OrderReport['TotalProfit'], 2, ',', '.'); ?> ($ <?= number_format($OrderReport['OtherProfit'], 2, ',', '.'); ?>)
                            </p>
                        </article>
                        <?php
                    endforeach;
                endif;
                ?>
            </footer>
        </div>
        <?php
        $Pager->ExePaginator(DB_EAD_ORDERS, "GROUP BY DATE_FORMAT(order_purchase_date,'%Y-%m')");
        echo $Pager->getPaginator();
        ?>
    </article>
</div>

<?php
$getDayChart = array();
$getUserChart = array();
$getEnrollChart = array();
foreach ($DateInterval as $setDayChart):
    //GET DAYS
    $getDayChart[] = "'" . $setDayChart->format('d/m/Y') . "'";

    //GET DAY FOR READ
    $ReadDay = $setDayChart->format('Y-m-d');

    //GET ORDERS
    $Read->FullRead("SELECT count(order_id) AS TotalOrders, SUM(order_status = 'approved' OR order_status = 'completed') AS TotalSales, SUM(order_cms_vendor) AS TotalProfit FROM " . DB_EAD_ORDERS . " WHERE date(order_purchase_date) = :date", "date={$ReadDay}");
    $getOrderChart[] = ($Read->getResult()[0]['TotalOrders'] ? $Read->getResult()[0]['TotalOrders'] : 0);
    $getSalesChart[] = ($Read->getResult()[0]['TotalSales'] ? $Read->getResult()[0]['TotalSales'] : 0);
endforeach;

$DaysChart = implode(", ", $getDayChart);
$OrderChart = implode(", ", $getOrderChart);
$SalesChart = implode(", ", $getSalesChart);

unset($_SESSION['wc_report_date']);
?>

<script>
    $(function () {
        //DATEPICKER CONFIG
        var wc_datepicker_start = $('.jwc_datepicker_start').datepicker({autoClose: true, maxDate: new Date()}).data('datepicker');
        var wc_datepicker_end = $('.jwc_datepicker_end').datepicker({autoClose: true, maxDate: new Date()}).data('datepicker');

        $('.jwc_datepicker_end').click(function () {
            var DateString = $('.jwc_datepicker_start').val().match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
            wc_datepicker_end.update('minDate', new Date(DateString[3], DateString[2] - 1, DateString[1]));
            if (!$(this).val()) {
                $(this).val("<?= date("d/m/Y", strtotime($EndDate)); ?>");
            }
        });

        $('.jwc_datepicker_start').click(function () {
            var DateString = $('.jwc_datepicker_end').val().match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
            wc_datepicker_start.update('maxDate', new Date(DateString[3], DateString[2] - 1, DateString[1]));
            if (!$(this).val()) {
                $(this).val("<?= date("d/m/Y", strtotime($StartDate)); ?>");
            }
        });

        //CHART CONFIG
        var wc_chart = Highcharts.chart('jwc_chart_container', {
            chart: {
                type: 'area',
                spacingBottom: 0,
                spacingTop: 5,
                spacingLeft: 0,
                spacingRight: 20
            },
            title: {
                text: null
            },
            subtitle: {
                text: null
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Registros'
                }
            },
            tooltip: {
                useHTML: true,
                shadow: false,
                headerFormat: '<p class="al_center">{point.key}</p><p class="al_center" style="font-size: 2em">{point.y}</p>',
                pointFormat: '<p class="al_center">{series.name}</p><p class="al_center"></p>',
                backgroundColor: '#000',
                borderWidth: 0,
                padding: 20,
                style: {
                    padding: 20,
                    color: '#fff'
                }
            },
            xAxis: {
                categories: [<?= $DaysChart; ?>],
                minTickInterval: 7
            },
            series: [
                {
                    name: 'Pedidos',
                    data: [<?= $OrderChart; ?>],
                    color: '#0E96E5 ',
                    lineColor: '#006699'
                },
                {
                    name: 'Vendas',
                    data: [<?= $SalesChart; ?>],
                    color: '#00B494',
                    lineColor: '#008068'
                }
            ]
        });

        //CHART CHANGE
        $('.jwc_chart_change').click(function () {
            $('.jwc_chart_change').removeClass('btn_green');
            $(this).addClass('btn_green');
        });

        $('.jwc_area_chart').click(function () {
            wc_chart.update({
                chart: {
                    type: 'area'
                }
            });
        });

        $('.jwc_column_chart').click(function () {
            wc_chart.update({
                chart: {
                    type: 'column'
                }
            });
        });

        $('.jwc_line_chart').click(function () {
            wc_chart.update({
                chart: {
                    type: 'line'
                }
            });
        });
    });
</script>