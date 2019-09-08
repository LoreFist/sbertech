<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;

?>
<?php foreach ($cards as $card):?>
    <article class="item" data-key="<?= $card['_source']['id']; ?>">
        <h2 class="title">
            <?= Html::a(Html::encode($card['_source']['name'])) ?>
        </h2>

        <div class="item-excerpt">
            Description: <?= Html::encode(($card['_source']['description'])) ?>
            <div class="col"><?= ($card['_source']['count_view'] != 0)? 'Count view: '.Html::encode($card['_source']['count_view']) :""  ?></div>
        </div>
    </article>

    <?php
        Modal::begin([
            'header'       => '<h2>'.$card['_source']['name'].'</h2>',
            'id' => 'modal-'.$card['_source']['id'],
            'size'=>'modal-lg',
        ]);
    ?>
    
        <div id='modal-body'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">Description: <?= $card['_source']['description'] ?> </div>
                    <div class="col">Create: <?= $card['_source']['created_at'] ?></div>
                    <div class="col"><?= ($card['_source']['update_at'] != '')? 'Update: '.$card['_source']['update_at'] :""  ?></div>
                    <div class="col"><?=  Html::img('@card_path_image/'.$card['_source']['image_url'], ['width' => 550]) ?></div>
                </div>
            </div>
        </div>
    
    <?php
        Modal::end();
    ?>
<?php endforeach; ?>
