<?php
class News extends \Toxotes\Widget {
    /** @var Posts[]  */
    public $list = [];
    public $term_id = 0;
    public $term;

    public function begin() {
        $termId = $this->getParams('term_id');
        $ordering = $this->getParams('ordering');
        $fetchChild = $this->getParams('fetch_child', false);

        $q = Posts::read()
            ->where('`status`=:status AND `is_draft` = 0')
            ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR);

        $term = Terms::retrieveById($termId);
        if (!$term) {
            return;
        }

        if ($fetchChild) {
            $child = $term->getDescendants();
            $ids = array($term->getId());
            foreach($child as $_c) {
                $ids[] = $_c->getId();
            }
            $q->andWhere('`term_id` IN (' .implode(',', $ids) .')');
        } else {
            $q->andWhere('`term_id`=:term_id')
                ->setParameter(':term_id', $term->getId(), \PDO::PARAM_INT);
        }

        //limit
        $limit = $this->getParams('limit');
        if ($limit) {
            $q->setMaxResults((int) $limit);
        }

        if ($ordering) {
            foreach($ordering as $_ordering) {
                $q->addOrderBy($_ordering['field'], $_ordering['order']);
            }
        } else {
            $q->addOrderBy('modified_time', 'DESC');
        }
//        echo $q->getSQL();

        $this->list = $q->execute()->fetchAll(\PDO::FETCH_CLASS, 'Posts', array(null, false));
        $this->term_id = $termId;
        $this->term = $term;
    }

    public function html() {
        $this->begin();
        $this->fetchViewPath();
        $this->fetchViewFile();

        return $this->render(array(
            'widget' => $this
        ));
    }
}