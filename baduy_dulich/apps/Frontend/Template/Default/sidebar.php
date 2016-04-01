<aside>

    <?php
        $root_folder_id = 72;
        $terms = \Terms::findByParentId($root_folder_id);
        if($terms){
            foreach($terms as $term){
                if($term instanceof \Terms){

                    $termName = $term->getName();
                    $termId = $term->getId();
                    $termLink = $controller->createUrl('category/default', array('id' => $term->getId()));


                    $query = \Posts::select();
                    $query->andWhere("`status` = 'PUBLISH' AND `is_draft` = 0");
                    $query->andWhere("`term_id` = {$termId}");
                    $query->addOrderBy('created_time', 'DESC');
                    $q = clone $query;
                    $totalResultTours = (int)$q->count('id')->execute();
                    $listTours = $query->execute();

                    ?>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><?= $termName ?></a></li>
                    </ul>

                    <?php if($totalResultTours > 0){
                        ?>


                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab3">
                                <div class="list-group">
                                    <?php
                                    foreach($listTours as $tour){
                                        if($tour instanceof \Posts){

                                            $tourName = $tour->getTitle();
                                            $tourLink = $controller->createUrl('post/detail', array('id' => $tour->getId()));

                                            echo "<a href='{$tourLink}' class='list-group-item'><i class='fa fa-angle-right'></i>&nbsp;&nbsp;&nbsp;{$tourName}</a>";
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                    <?php }else{ ?>

                        <small>Chưa có dữ liệu!</small>
                    <?php } ?>


                    <?php
                }
            }
        }

    ?>


</aside>