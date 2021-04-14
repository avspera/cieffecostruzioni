<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cerca automezzo per targa..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Automezzi',
                        'icon' => 'truck',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Nuovo', 'icon' => 'plus', 'url' => ['/automezzo/create'],],
                            ['label' => 'Vedi tutti', 'icon' => 'list', 'url' => ['/automezzo/index'],],
                        ],
                    ],
                    [
                        'label' => 'Tagliandi',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Nuovo', 'icon' => 'plus', 'url' => ['/tagliando/create'],],
                            ['label' => 'Vedi tutti', 'icon' => 'list', 'url' => ['/tagliando/index'],],
                        ],
                    ],
                    [
                        'label' => 'Accessori',
                        'icon' => 'paperclip',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Assegna', 'icon' => 'plus', 'url' => ['/accessori/create'],],
                            ['label' => 'Vedi tutti', 'icon' => 'list', 'url' => ['/accessori/index'],],
                            ['label' => 'Categorie', 'icon' => 'list', 'url' => ['/categoria-accessori/index'],],
                        ],
                    ],
                    [
                        'label' => 'Operai',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Nuovo', 'icon' => 'plus', 'url' => ['/operaio/create'],],
                            ['label' => 'Vedi tutti', 'icon' => 'list', 'url' => ['/operaio/index'],],
                        ],
                    ],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']]               
                ] 
            ]
        ) ?>

    </section>

</aside>
