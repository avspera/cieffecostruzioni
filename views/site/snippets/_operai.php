<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $title ?> (<?= count($operai) ?>)</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
<!-- /.box-header -->
    <div class="box-body box-home-content scrollable">
        <ul class="products-list product-list-in-box">
            <?php 
                if(!empty($operai)){
                    foreach($operai as $operaio){
            ?>
                        <li class="item">
                            <div class="product-img">
                                <i class="fa fa-2x fa-user"></i>
                            </div>
                            <div class="product-info">
                                <?= Html::a($operaio->nome." ".$operaio->cognome, Url::to(["operaio/view", "id" => $operaio->id]), ["class" => "product-title"]) ?>
                                <span class="label label-warning pull-right"><?= $operaio->formatDate($operaio->created)?></span></a>
                                <span class="product-description"><?= $operaio->getRole() ?></span>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-center">Nessun dato da mostrare qui</p>
                <?php } ?>
            <!-- /.item -->
        </ul>
    </div>
<!-- /.box-body -->
    <div class="box-footer text-center">
        <?= Html::a("Vedi tutti", Url::to(["operaio/index"]), ["class" => "uppercase"]) ?>
    </div>
<!-- /.box-footer -->
</div>