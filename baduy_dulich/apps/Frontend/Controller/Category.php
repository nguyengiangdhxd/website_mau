<?php
namespace Frontend\Controller;
class Category extends FrontendBase {
    public function executeDefault() {
        $id = $this->request()->get('id');
        if (!($cat = \Terms::retrieveById($id))) {
            $this->raise404("Không tìm thấy danh mục với id: {$id}");
        }

        $viewProp = $cat->getProperty('cat_view');
        if ($viewProp) {
            $this->setView('Category/' .$viewProp->getPropertyValue());
        } else {
            $this->setView('Category/default');
        }

        $child = ($cat->getDescendants());

        $q = \Posts::select()
            ->where('`status` = :status AND `is_draft` = 0')
            ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR);

        //Filter
        $catId = array($cat->getId());
        foreach($child as $c) {
            $catId[] = $c->getId();
        }
        $q->andWhere('`term_id` IN (' .implode(',', $catId) .')');

        //Filter by time
        $day = $this->request()->get('day');
        $month = $this->request()->get('month');
        $year = $this->request()->get('year');
        if ($day || $month || $year) {
            if ($day) {
                $q->andWhere('DAY(`created_time`) = :day')
                    ->setParameter(':day', $day, \PDO::PARAM_STR);
            }
            if ($month) {
                $q->andWhere('MONTH(`created_time`) = :month')
                    ->setParameter(':month', $month, \PDO::PARAM_STR);
            }
            if ($year) {
                $q->andWhere('YEAR(`created_time`) = :year')
                    ->setParameter(':year', $year, \PDO::PARAM_STR);
            }
        }

        //Keyword
        if (($keyword = $this->request()->get('keyword'))) {
            $q->andWhere('`title` LIKE "%' .$keyword. '%"');
        }

        //Ordering
        $orderingProp = $cat->getProperty('post_ordering');
        if ($orderingProp) {
            switch($orderingProp->getPropertyValue()) {
                case 'created_time' :
                    $q->addOrderBy('created_time');
                    break;
                case 'ordering' :
                    $q->addOrderBy('ordering');
                    break;
                case 'modified_time':
                case 'default' :
                default :
                    $q->addOrderBy('created_time', 'DESC');
                    break;
            }
        } else {
            $q->addOrderBy('created_time', 'DESC');
        }

        $qCount = clone $q;

        $total = $qCount->count()->execute();

        //Paging
        $pageSizeProp = $cat->getProperty('page_size');
        if ($pageSizeProp) {
            $page_size = $cat->getProperty('page_size')->getPropertyValue();
            if (-1 != $pageSizeProp->getPropertyValue()) {
                $q->setMaxResults($pageSizeProp->getPropertyValue());
                $page = $this->request()->get('page', 'INT', 1);
                $q->setFirstResult(($page-1)*$pageSizeProp->getPropertyValue());
            }
        } else {
            $page_size = 25;
            $q->setMaxResults(25);
            $page = $this->request()->get('page', 'INT', 1);
            $q->setFirstResult(($page-1)*$page_size);
        }

        $posts = $q->execute();
//        echo $q->getSQL();

        //Root of category
        $root = [];
        foreach($cat->getSiteRoot() as $te){
            if( $te instanceof \Terms ) {
                $root[] = $te->toArray();
            }
        }

        $this->view()->assign(array(
            'page_size' => $page_size,
            'total' => $total,
            'cat' => $cat,
            'child' => $child,
            'posts' => $posts,
            'root' => $root,
            'keyword' => $keyword
        ));

        return $this->renderComponent();
    }
}