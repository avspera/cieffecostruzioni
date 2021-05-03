<?php
    use yii\helpers\Url;
?>
<div class="box box-default">
    <div class="box-header with-border">
    <h3 class="box-title"><?= $title ?></h3>

    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="row">
        <div class="col-md-8">
        <div class="chart-responsive">
            <canvas id="pieChart" style="width: 400px; height: 200px;"></canvas>
        </div>
        <!-- ./chart-responsive -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
        <ul class="chart-legend clearfix">
            <?php 
                foreach($categorieAccessori as $categoria){
            ?>
                <li><i class="fa fa-circle-o <?= $categoria->color ?>"></i> <?= $categoria->nome ?></li>
            <?php } ?>
        </ul>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding">
    <ul class="nav nav-pills nav-stacked">
        <?php 
            foreach($categorieAccessori as $categoria){
                $quantita = $accessori[$categoria->id]["quantita"] > 0 ? $accessori[$categoria->id]["quantita"] : 0;
                $costo_totale = $accessori[$categoria->id]["costo_totale"];
        ?>
            <li>
                <a href="<?= Url::to(["accessori/index", "oggetto" => $categoria->id]) ?>">
                    <?= $categoria->nome ?>
                    <span class="<?= $categoria->color ?>">(<?= $quantita ?>)</span>
                    <span class="pull-right"><?= $costo_totale ?></span>
                </a>
            </li>
        <?php } ?>
        
    </ul>
    </div>
    <!-- /.footer -->
</div>