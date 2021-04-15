<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $title ?> (<?= count($automezzi) ?>)</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php 
                if(!empty($automezzi)){
                    foreach($automezzi as $automezzo){
            ?>
                        <li class="item">
                            <div class="product-img">
                                <i class="fa fa-2x fa-truck"></i>
                            </div>
                            <div class="product-info">
                                <?= Html::a($automezzo->marca." ".$automezzo->modello, Url::to(["automezzo/view", "id" => $automezzo->id]), ["class" => "product-title"]) ?>
                                <span class="label label-warning pull-right"><?= $automezzo->formatDate($automezzo->$date)?></span></a>
                                <span class="product-description"><?= $automezzo->targa ?></span>
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
        <?= Html::a("Vedi tutti", Url::to(["automezzo/index"]), ["class" => "uppercase"]) ?>
    </div>
<!-- /.box-footer -->
</div>