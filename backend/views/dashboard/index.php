<?php

use common\models\Clients;
use common\models\Contact;
use common\models\Portfolio;
use common\models\PortfolioCategory;
use yii\bootstrap4\Html;
use yii\helpers\Url;
$this->title = 'Dashboard';
$this->params['title'] = 'dashboard';

$clinetsCount = Clients::find()->count();
$portfolioCount = Portfolio::find()->count();
$xabarlarSoni = Contact::find()->where('status=0')->count();

?>
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bullhorn"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Hamkorlar</span>
                <span class="info-box-number"><?=$clinetsCount?> <small>ta</small></span>
            </div>

        </div>

    </div>


    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Portfolio</span>
                <span class="info-box-number"><?=$portfolioCount?> <small>ta</small></span>
            </div>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Xabarlar</span>
                <span class="info-box-number"><?=$xabarlarSoni?> <small>ta</small></span>
            </div>

        </div>

    </div>

</div>




<div class="row">

    <div class="col-md-8">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Yangi Xabarlar</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <?php foreach(Contact::find()->limit(5)->where('status=0')->orderBy('id DESC')->all() as $xabar){?>
                        <tr class='success'>
                            <td><?php  echo $xabar->id?></td>
                            <td><?php  echo html::a($xabar->name,url::to(['/contact/view','id'=>$xabar->id]))?></td>
                            <td><?php  echo $xabar->title?></td>
                            <td><?php  echo Html::a($xabar->phone,'tel:'.$xabar->phone)?></td>
                        </tr>
                        <?php  }?>
                    </table>
                </div>

            </div>

            <div class="box-footer clearfix">

                <a href="<?=url::to(['/contact/index'])?>" class="btn btn-sm btn-default btn-flat pull-right"
                    data-pjax="0">View All
                    Orders</a>
            </div>

        </div>

    </div>

</div>


<section class="content">
        <div class="row">
          <div class="col-md-6">

         


            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Kategoryalar</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <canvas id="pieChart" style="height: 192px; width: 384px;" height="192" width="384"></canvas>
              </div>

            </div>

          </div>

        </div>

      </section>


<?php


$categories =  PortfolioCategory::find()->all();
$array = [];
$array2 = [];


foreach($categories as $key=>$catagory){
    $array['value'] = $catagory->getCategoryPartfolioCount();
    $array['color'] = "#".rand(111111,999999);
    $array['highlight'] = "#".rand(111111,999999);
    $array['label'] = $catagory->title;
    array_push($array2,$array);
}
$json = json_encode($array2);

$js = <<<JS
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieChart = new Chart(pieChartCanvas)
      var PieData =$json
      var pieOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: '#fff',
        segmentStrokeWidth: 2,
        percentageInnerCutout: 50, // This is 0 for Pie charts
        animationSteps: 100,
        animationEasing: 'easeOutBounce',
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
      }
      pieChart.Doughnut(PieData, pieOptions)

     
JS;

$this->registerJs($js);
?>
