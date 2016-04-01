<div class="list-group">
    <a href="javascript:" class="list-group-item active">
        DANH MỤC
    </a>

    <?php

    $q = \Terms::select();
    $q->andWhere(" `status` = 'ACTIVE' ");
    $q->andWhere(" `scope` = 'product' ");
    $q->andWhere(" `parent_id` > 0 ");//Remove root of product
    $q->orderBy(" `name` ", "ASC");
    $termProducts = $q->execute();
//    echo $q->getSQL();
    if($termProducts){
        foreach($termProducts as $productCat){
            if($productCat instanceof \Terms){
                $productName = $productCat->getName();
                $productLink = $controller->createUrl('products/category', array('id' => $productCat->getId()));
                ?>
                    <a href="<?php echo $productLink ?>" class="list-group-item">
                        <i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;<?php echo $productName ?>
                    </a>
                <?php
            }
        }
    }

    ?>

</div>

<div class="list-group">
    <a href="javascript:" class="list-group-item active">
        HỖ TRỢ TRỰC TUYẾN
    </a>
    <div class="list-group-item text-center">

        <?php
        $hotline_category_id = (int)\Setting::get('hotline_category_id');
        if($hotline_category_id){
            $query = \Posts::select();
            $query->andWhere(" `status` = 'PUBLISH' ");
            $query->andWhere(" `is_draft` = 0 ");
            $query->andWhere(" `term_id` = {$hotline_category_id} ");

            $hotlines = $query->execute();
            if($hotlines){
                foreach($hotlines as $hotline){
                    if($hotline instanceof \Posts){
                        ?>
                        <h4>HOTLINE</h4>
                        <span class="text-danger"><i class="fa fa-phone"></i> <?php echo $hotline->getTitle() ?></span>
                        <?php
                    }
                }
            }
        }
        ?>

        <?php
        $yahoo_category_id = (int)\Setting::get('yahoo_category_id');
        if($yahoo_category_id){
            $query = \Posts::select();
            $query->andWhere(" `status` = 'PUBLISH' ");
            $query->andWhere(" `is_draft` = 0 ");
            $query->andWhere(" `term_id` = {$yahoo_category_id} ");

            $yahoo = $query->execute();
            if($yahoo){
                foreach($yahoo as $y){
                    if($y instanceof \Posts){
                        ?>
                        <h4><?php echo $y->getTitle() ?></h4>
                        <a href="ymsgr:sendim?<?php echo $y->getExcerpt() ?>">
                            <img src="http://opi.yahoo.com/online?u=<?php echo $y->getExcerpt() ?>&amp;m=g&amp;t=2&amp;l=us" border="0">
                        </a>
                        <?php
                    }
                }
            }
        }
        ?>



    </div>
</div>

<?php $controller->block('block_widget_sidebar_hot_news'); ?>

<?php $controller->block('block_widget_adv'); ?>

<div class="list-group">
    <a href="javascript:" class="list-group-item active">
        THỐNG KÊ
    </a>
    <div class="list-group-item">
        Khách online: 1<br />
        Hôm nay: 74<br />
        Tuần này: 74<br />
        Tháng này: 147<br />
        Tổng truy cập: 1698<br />
    </div>
</div>