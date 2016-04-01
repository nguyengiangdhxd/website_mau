<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2/7/15
 * Time: 5:52 PM
 */

namespace Frontend\Controller;


class Products extends FrontendBase {
    public $pageSize = 20;
    public function executeDefault()
    {
        return $this->executeCategory();
    }

    public function executeCategory()
    {
        $id = $this->get('id');
        if (!$id || !($term = \Terms::retrieveById($id))) {
            return $this->raise404(t('Product Category not found!'));
        }

        $cats = [$term->getId()];
        $descendants = (array) $term->getDescendants();
        foreach($descendants as $d) {
            $cats[] = $d->getId();
        }

        //create query
        $q = \Items::select();
        if (sizeof($cats) > 1) {
            $q->where('`cat_id` = :cat_id')
                ->setParameter(':cat_id', $term->getId(), \PDO::PARAM_INT);
        } else {
            $q->where('`cat_id` IN (' .implode(', ', $cats) .')');
        }

        $q->andWhere('`status` = "ACTIVE"')
            ->andWhere('`is_draft` = 0');

        //filter
        $price_from = floatval(str_replace(',', '.', str_replace('.', '', $this->get('price_from'))));
        $price_to = floatval(str_replace(',', '.', str_replace('.', '', $this->get('price_to'))));
        if ($price_from > $price_to) {
            $t = $price_from;
            $price_from = $price_to;
            $price_to = $t;
        }

        if ($price_from) {
            $q->andWhere('`regular_price` >= :pf OR `sale_price` >= :pf')
                ->setParameter(':pf', $price_from, \PDO::PARAM_STR);
        }

        if ($price_to) {
            $q->andWhere('`regular_price` <= :pf OR `sale_price` <= :pf')
                ->setParameter(':pf', $price_to, \PDO::PARAM_STR);
        }

        //Keyword
        if (($keyword = $this->request()->get('keyword'))) {
            $q->andWhere('`name` LIKE "%' .$keyword. '%"');
        }

        $ordering = $this->get('ordering');
        switch ($ordering) {
            case 'PRICE_DESCENDING':
                $q->orderBy('regular_price', 'DESC')
                    ->addOrderBy('sale_price', 'DESC');
                break;
            case 'PRICE_ASCENDING':
                $q->orderBy('regular_price', 'ASC')
                    ->addOrderBy('sale_price', 'ASC');
                break;
            default:
                $q->orderBy('public_time', 'DESC');
        }

        $cq = clone $q;
        $total = $cq->count('`id`')->execute();
        $page = abs($this->get('page', 'INT', 1));

        $per_page = (int)\Setting::get('number_product_perpage');
        $per_page = $per_page ? $per_page : $this->pageSize;
        //Paging
        $q->setMaxResults($per_page);
        $q->setFirstResult(($page - 1) * $per_page);

        $items = $q->execute();

        $this->setView('Products/category');
        $this->view()->assign([
            'term' => $term,
            'items' => $items,
            'total' => $total,
            'page' => $page,
            'page_size' => $per_page,
            'price_form' => $price_from,
            'price_to' => $price_to,
            'ordering' => $ordering,
            'keyword' => $keyword
        ]);

        return $this->renderComponent();
    }
    
    public function executeDetail()
    {
        $id = $this->get('id');
        if (!$id || !($item = \Items::retrieveById($id))) {
            return $this->raise404(t('Product Category not found!'));
        }

        $term = $item->getCat();
        $this->setView('Products/item_detail');
        $this->view()->assign([
            'item' => $item,
            'term' => $term
        ]);

        return $this->renderComponent();
    }
}